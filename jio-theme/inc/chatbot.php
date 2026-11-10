<?php
/**
 * JIO website assistant: a server-side proxy to the OpenRouter chat API.
 *
 * Intent first, response second (design in CHATBOT.md, catalog in inc/intents.json): each message is routed by
 * rules (an answer to the pending quote question, or an exact catalog example) or classified by the model, then
 * the dialogue manager picks the reply: a template, the quote flow, the fallback ladder, or the model's answer.
 * Mirrors preview/serve.mjs.
 *
 * The API key never reaches the browser. Set it in wp-config.php:
 *   define( 'JIO_OPENROUTER_KEY', 'sk-or-...' );
 * or as an environment variable named OPENROUTER_API_KEY.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Models tried in order: the chosen model first, then two free fallbacks on different capacity
 * (NVIDIA Lightning, then Google Gemma), so a busy free endpoint does not end the conversation.
 */
function jio_chat_models() {
	return array(
		'nvidia/nemotron-3.5-super-vl:free',
		'nvidia/nemotron-3.5-lightning:free',
		'google/gemma-4-31b-it:free',
	);
}
const JIO_CHAT_MAX_TURN = 10;
const JIO_CHAT_MAX_CHAR = 800;
const JIO_CHAT_LIMIT    = 20; // model calls per visitor per hour; rule-routed turns are free

function jio_chat_json( $file ) {
	static $cache = array();
	if ( ! isset( $cache[ $file ] ) ) {
		$cache[ $file ] = json_decode( (string) file_get_contents( get_template_directory() . '/inc/' . $file ), true );
	}
	return $cache[ $file ];
}

function jio_chat_norm( $s ) {
	$s = mb_strtolower( (string) $s );
	$s = preg_replace( '/[^\p{L}\p{N}\s]/u', ' ', $s );
	return trim( preg_replace( '/\s+/u', ' ', $s ) );
}

/** Fill {phone}, {email} and the like from the knowledge file. */
function jio_chat_fill( $str ) {
	$c    = jio_chat_json( 'knowledge.json' )['company'];
	$vars = array(
		'phone'     => $c['phone'],
		'phone_raw' => preg_replace( '/\s+/', '', $c['phone'] ),
		'email'     => $c['email'],
		'office'    => $c['office'],
		'whatsapp'  => $c['whatsapp'],
		'home'      => home_url( '/' ),
	);
	return preg_replace_callback(
		'/\{(\w+)\}/',
		function ( $m ) use ( $vars ) {
			return isset( $vars[ $m[1] ] ) ? $vars[ $m[1] ] : $m[0];
		},
		(string) $str
	);
}

function jio_chat_system_prompt( $state ) {
	$cat = jio_chat_json( 'intents.json' );

	$lines   = array();
	$lines[] = 'You are the website assistant for JIO Technologies LLC. You answer visitors\' questions about JIO\'s services, industries, process and contact details.';
	$lines[] = 'Work in two steps: first decide what the visitor wants (the intent), then write the reply.';
	$lines[] = 'Return only one JSON object and nothing else, in this shape:';
	$lines[] = '{"intent": "<intent name>", "slots": {}, "suggest": [], "reply": "<reply text>"}';
	$lines[] = '';
	$lines[] = 'INTENTS (pick exactly one name):';
	foreach ( $cat['intents'] as $name => $d ) {
		$eg      = $d['examples'] ? ' e.g. "' . implode( '", "', array_slice( $d['examples'], 0, 3 ) ) . '"' : '';
		$lines[] = '- ' . $name . ': ' . $d['description'] . $eg;
	}
	$lines[] = '';
	$lines[] = 'SLOTS: only for request_quote (any of them) and service_info (service only), and only details the visitor actually stated:';
	foreach ( $cat['quote']['slots'] as $s ) {
		$lines[] = '- ' . $s['key'] . ': ' . ( $s['options'] ? 'one of ' . wp_json_encode( $s['options'], JSON_UNESCAPED_UNICODE ) : 'short free text, such as "40 kVA", "3 racks" or "200 users"' );
		if ( ! empty( $s['covers'] ) ) {
			foreach ( $s['options'] as $i => $o ) {
				$lines[] = '    "' . $o . '" covers ' . $s['covers'][ $i ];
			}
		}
	}
	$lines[] = '- If the service does not clearly map to one option, leave it out rather than guess. For service_info, never use "Not sure, or several".';
	$lines[] = '';
	$lines[] = 'SUGGEST: only for fallback: up to three intent names the visitor most likely meant.';
	$lines[] = '';
	$lines[] = 'STATE: ' . ( 'quote' === $state['flow']
		? 'A quote request is in progress. Details so far: ' . wp_json_encode( (object) $state['slots'], JSON_UNESCAPED_UNICODE ) . '. Waiting for: ' . ( $state['asked'] ? $state['asked'] : 'nothing' ) . '. If the visitor answers that question, use intent request_quote and fill that slot.'
		: 'No quote request is in progress.' );
	$lines[] = '';
	$lines[] = 'REPLY RULES:';
	$lines[] = '- Answer only from the facts below. If the answer is not here, say you do not have that information and give the phone number or email so the visitor can ask a person.';
	$lines[] = '- Never invent prices, certifications, licence numbers, client names, ratings, response times or service-level commitments. Those are listed under "not confirmed" and must not be claimed.';
	$lines[] = '- Match the format to the question. A simple question (yes or no, or a single fact) gets one or two plain sentences with no bullets. Use bullets only when listing several items or steps: up to four, each starting with "- " on its own line and one short sentence (about 15 words at most). Keep every reply under about 60 words. No headings, no bold, no closing pleasantries, no follow-up question.';
	$lines[] = '- Give the direct answer first.';
	$lines[] = '- For request_quote, the reply only acknowledges and asks for the next missing detail, in this order: service, site, scale, timeline.';
	$lines[] = '- For fallback, the reply is one short line asking the visitor to rephrase.';
	$lines[] = '- If the visitor writes in Arabic, write the reply in Arabic. Intent and slot values stay in English.';
	$lines[] = '- Do not ask for personal, financial or government ID details. If a visitor shares them, tell them not to, and that they should use the quote form or call.';
	$lines[] = '';
	$lines[] = 'FACTS:';
	$lines[] = wp_json_encode( jio_chat_json( 'knowledge.json' ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	return implode( "\n", $lines );
}

/** Clean the visitor's messages: plain text, bounded length and turn count. */
function jio_chat_clean_messages( $raw ) {
	if ( ! is_array( $raw ) ) {
		return array();
	}
	$out = array();
	foreach ( array_slice( $raw, -JIO_CHAT_MAX_TURN ) as $m ) {
		$role = ( isset( $m['role'] ) && 'assistant' === $m['role'] ) ? 'assistant' : 'user';
		$text = isset( $m['content'] ) ? trim( wp_strip_all_tags( (string) $m['content'] ) ) : '';
		if ( '' === $text ) {
			continue;
		}
		$out[] = array( 'role' => $role, 'content' => mb_substr( $text, 0, JIO_CHAT_MAX_CHAR ) );
	}
	return $out;
}

/**
 * Keep only slot values the catalog allows: an option slot must hold one of its options. "" means skipped, which only
 * the Skip chip can set, so it is dropped from the model's output ($allow_skipped false).
 */
function jio_chat_clean_slots( $raw, $allow_skipped = false ) {
	$out = array();
	if ( ! is_array( $raw ) ) {
		return $out;
	}
	foreach ( jio_chat_json( 'intents.json' )['quote']['slots'] as $s ) {
		if ( ! isset( $raw[ $s['key'] ] ) || is_array( $raw[ $s['key'] ] ) ) {
			continue;
		}
		$v = mb_substr( trim( wp_strip_all_tags( (string) $raw[ $s['key'] ] ) ), 0, 120 );
		if ( '' === $v ) {
			if ( $allow_skipped ) {
				$out[ $s['key'] ] = '';
			}
			continue;
		}
		if ( ! $s['options'] ) {
			$out[ $s['key'] ] = $v;
			continue;
		}
		foreach ( $s['options'] as $o ) {
			if ( jio_chat_norm( $o ) === jio_chat_norm( $v ) ) {
				$out[ $s['key'] ] = $o;
				break;
			}
		}
	}
	return $out;
}

/** The state the browser hands back each turn. Never trusted: every field is re-validated. */
function jio_chat_clean_state( $raw ) {
	$raw  = is_array( $raw ) ? $raw : array();
	$keys = wp_list_pluck( jio_chat_json( 'intents.json' )['quote']['slots'], 'key' );
	$keys[] = 'confirm';
	return array(
		'flow'   => ( isset( $raw['flow'] ) && 'quote' === $raw['flow'] ) ? 'quote' : '',
		'asked'  => ( isset( $raw['asked'] ) && in_array( $raw['asked'], $keys, true ) ) ? $raw['asked'] : '',
		'slots'  => jio_chat_clean_slots( isset( $raw['slots'] ) ? $raw['slots'] : array(), true ),
		'misses' => min( max( isset( $raw['misses'] ) ? (int) $raw['misses'] : 0, 0 ), 5 ),
	);
}

/** Rule layer 1: an exact (normalised) catalog example. */
function jio_chat_rule_intent( $text ) {
	$n = jio_chat_norm( $text );
	if ( '' === $n ) {
		return null;
	}
	foreach ( jio_chat_json( 'intents.json' )['intents'] as $name => $d ) {
		foreach ( $d['examples'] as $e ) {
			if ( jio_chat_norm( $e ) === $n ) {
				return $name;
			}
		}
	}
	return null;
}

/** Rule layer 2: an answer to the quote question just asked (an option, "Skip", or free text for the size). */
function jio_chat_slot_answer( $text, $state ) {
	if ( 'quote' !== $state['flow'] ) {
		return null;
	}
	$cat  = jio_chat_json( 'intents.json' );
	$slot = null;
	foreach ( $cat['quote']['slots'] as $s ) {
		if ( $s['key'] === $state['asked'] ) {
			$slot = $s;
		}
	}
	if ( ! $slot ) {
		return null;
	}
	$n = jio_chat_norm( $text );
	if ( jio_chat_norm( $cat['quote']['skip'] ) === $n ) {
		return array( $slot['key'] => '' );
	}
	foreach ( $slot['options'] as $i => $o ) {
		if ( jio_chat_norm( $o ) === $n || ( isset( $slot['short'][ $i ] ) && jio_chat_norm( $slot['short'][ $i ] ) === $n ) ) {
			return array( $slot['key'] => $o );
		}
	}
	if ( ! $slot['options'] && false === strpos( $text, '?' ) && ! jio_chat_rule_intent( $text ) ) {
		return array( $slot['key'] => mb_substr( trim( $text ), 0, 120 ) );
	}
	return null;
}

function jio_chat_chip( $key, $turn_slots = array() ) {
	$cat = jio_chat_json( 'intents.json' );
	if ( ! isset( $cat['chips'][ $key ] ) ) {
		return null;
	}
	$c   = $cat['chips'][ $key ];
	$out = array( 'label' => jio_chat_fill( $c['label'] ) );
	foreach ( array( 'send', 'action' ) as $f ) {
		if ( isset( $c[ $f ] ) ) {
			$out[ $f ] = $c[ $f ];
		}
	}
	if ( isset( $c['href'] ) ) {
		$out['href'] = jio_chat_fill( $c['href'] );
	}
	if ( ! empty( $c['reset'] ) ) {
		$out['reset'] = true;
	}
	if ( ! empty( $c['page_from_turn'] ) ) {
		$pages = array();
		foreach ( $cat['quote']['slots'] as $s ) {
			if ( 'service' === $s['key'] && isset( $s['pages'] ) ) {
				$pages = $s['pages'];
			}
		}
		$service = isset( $turn_slots['service'] ) ? $turn_slots['service'] : '';
		if ( ! isset( $pages[ $service ] ) ) {
			return null; // no page for this service (or none named): drop the button
		}
		$out['href'] = home_url( $pages[ $service ] );
	}
	if ( ! empty( $c['slots_from_turn'] ) && ! empty( $turn_slots['service'] ) ) {
		$out['state'] = array( 'slots' => array( 'service' => $turn_slots['service'] ) );
	}
	return $out;
}

/** Chips that point to a person; a paused quote stays one tap away, since its questions need no model. */
function jio_chat_handoff_chips( $state = null ) {
	$chips = array( jio_chat_chip( 'call' ), jio_chat_chip( 'email' ), jio_chat_chip( 'whatsapp' ) );
	if ( $state && 'quote' === $state['flow'] ) {
		array_unshift( $chips, jio_chat_chip( 'continue_quote' ) );
	}
	return $chips;
}

/** Quote flow (slot filling): ask for the next missing detail, then confirm and hand the details to the form. */
function jio_chat_quote_step( &$state, $new_slots, $model_reply, $ar ) {
	$q        = jio_chat_json( 'intents.json' )['quote'];
	$chips    = jio_chat_json( 'intents.json' )['chips'];
	$entering = 'quote' !== $state['flow'];
	$state['flow']  = 'quote';
	$state['slots'] = array_merge( $state['slots'], $new_slots );

	$next = null;
	foreach ( $q['slots'] as $s ) {
		if ( ! array_key_exists( $s['key'], $state['slots'] ) ) {
			$next = $s;
			break;
		}
	}
	$lead = $entering ? $q['intro'] : $q['ack'];

	if ( $next ) {
		$state['asked'] = $next['key'];
		$reply          = $lead . "\n" . $next['question'];
		$out_chips      = array();
		foreach ( $next['options'] as $i => $o ) {
			$label       = isset( $next['short'][ $i ] ) ? $next['short'][ $i ] : $o;
			$out_chips[] = array( 'label' => $label, 'send' => $label );
		}
		$out_chips[] = array( 'label' => $q['skip'], 'send' => $q['skip'] );
	} else {
		$state['asked'] = 'confirm';
		$lines          = array( $q['confirm'] );
		$message        = array();
		foreach ( $q['slots'] as $s ) {
			if ( empty( $state['slots'][ $s['key'] ] ) ) {
				continue;
			}
			$lines[] = '- ' . $s['label'] . ': ' . $state['slots'][ $s['key'] ];
			if ( 'service' !== $s['key'] ) {
				$message[] = $s['label'] . ': ' . $state['slots'][ $s['key'] ];
			}
		}
		$reply     = implode( "\n", $lines );
		$options   = $q['slots'][0]['options'];
		$service   = ! empty( $state['slots']['service'] ) ? $state['slots']['service'] : end( $options ); // "Not sure, or several"
		$out_chips = array(
			array(
				'label'  => $chips['open_form']['label'],
				'action' => 'prefill',
				'form'   => array( 'service' => $service, 'message' => implode( "\n", $message ) ),
				'done'   => $q['done'],
			),
			array( 'label' => $chips['restart_quote']['label'], 'send' => $chips['restart_quote']['send'], 'reset' => true ),
		);
	}
	if ( $ar && '' !== $model_reply ) {
		$reply = $model_reply; // Arabic: the model's reply carries the same question
	}
	return array( 'reply' => $reply, 'chips' => $out_chips );
}

/** Dialogue manager: decide the reply and quick replies for a classified turn. */
function jio_chat_manage( $turn, &$state ) {
	$cat = jio_chat_json( 'intents.json' );
	$def = $cat['intents'][ $turn['intent'] ];

	if ( 'fallback' === $turn['intent'] ) {
		$state['misses']++;
		if ( $state['misses'] >= 2 ) { // second miss in a row: hand off to a person
			$state['misses'] = 0;
			return array( 'reply' => jio_chat_fill( $cat['fallback']['second'] ), 'chips' => jio_chat_handoff_chips(), 'handoff' => true );
		}
		$picks = array();
		foreach ( ( $turn['suggest'] ? $turn['suggest'] : $cat['fallback']['default_suggest'] ) as $i ) {
			if ( isset( $cat['fallback']['suggest_chips'][ $i ] ) ) {
				$picks[] = $cat['fallback']['suggest_chips'][ $i ];
			}
		}
		$picks = array_slice( array_values( array_unique( $picks ) ), 0, 3 );
		return array( 'reply' => jio_chat_fill( $cat['fallback']['first'] ), 'chips' => array_map( 'jio_chat_chip', $picks ) );
	}
	$state['misses'] = 0;

	if ( 'quote' === $def['handler'] ) {
		return jio_chat_quote_step( $state, $turn['slots'], $turn['model_reply'], $turn['ar'] );
	}
	$reply = 'template' === $def['handler'] ? jio_chat_fill( $def['reply'] ) : $turn['model_reply'];
	if ( $turn['ar'] && '' !== $turn['model_reply'] ) {
		$reply = $turn['model_reply'];
	}
	if ( '' === $reply ) {
		$reply = jio_chat_fill( $cat['unavailable'] );
	}
	$chips = array();
	foreach ( $def['chips'] as $c ) {
		$chip = jio_chat_chip( $c, $turn['slots'] );
		if ( $chip ) {
			$chips[] = $chip;
		}
	}
	if ( 'quote' === $state['flow'] && $state['asked'] ) {
		array_unshift( $chips, jio_chat_chip( 'continue_quote' ) ); // a side question pauses the quote, it doesn't lose it
	}
	return array( 'reply' => $reply, 'chips' => array_slice( $chips, 0, 4 ) );
}

/** Parse the model's JSON. Anything malformed is handled, never shown raw. */
function jio_chat_parse_model( $text ) {
	$cat = jio_chat_json( 'intents.json' );
	$t   = trim( preg_replace( '/^```(?:json)?|```$/m', '', (string) $text ) );
	$a   = strpos( $t, '{' );
	$b   = strrpos( $t, '}' );
	$o   = ( false !== $a && false !== $b ) ? json_decode( substr( $t, $a, $b - $a + 1 ), true ) : null;
	if ( ! is_array( $o ) ) {
		// Plain text instead of JSON: keep it as an answer rather than lose the turn.
		return ( '' !== $t && '{' !== $t[0] ) ? array( 'intent' => 'services_overview', 'slots' => array(), 'suggest' => array(), 'model_reply' => $t ) : null;
	}
	$intent  = ( isset( $o['intent'] ) && is_string( $o['intent'] ) && isset( $cat['intents'][ $o['intent'] ] ) ) ? $o['intent'] : 'fallback';
	$suggest = array();
	if ( isset( $o['suggest'] ) && is_array( $o['suggest'] ) ) {
		foreach ( $o['suggest'] as $i ) {
			if ( is_string( $i ) && 'fallback' !== $i && isset( $cat['intents'][ $i ] ) ) {
				$suggest[] = $i;
			}
		}
	}
	return array(
		'intent'      => $intent,
		'slots'       => jio_chat_clean_slots( isset( $o['slots'] ) ? $o['slots'] : array() ),
		'suggest'     => $suggest,
		'model_reply' => ( isset( $o['reply'] ) && is_string( $o['reply'] ) ) ? trim( $o['reply'] ) : '',
	);
}

function jio_chat_key() {
	if ( defined( 'JIO_OPENROUTER_KEY' ) && JIO_OPENROUTER_KEY ) {
		return JIO_OPENROUTER_KEY;
	}
	$env = getenv( 'OPENROUTER_API_KEY' );
	return $env ? $env : '';
}

/** Free endpoints fail when busy or rate-limited, so try each model in turn and stop at the first reply. */
function jio_chat_call_model( $key, $messages ) {
	foreach ( jio_chat_models() as $model ) {
		$res = wp_remote_post(
			'https://openrouter.ai/api/v1/chat/completions',
			array(
				'timeout' => 30,
				'headers' => array(
					'Authorization' => 'Bearer ' . $key,
					'Content-Type'  => 'application/json',
					'HTTP-Referer'  => home_url( '/' ),
					'X-Title'       => 'JIO Technologies website',
				),
				'body'    => wp_json_encode(
					array(
						'model'           => $model,
						'max_tokens'      => 1200,
						'reasoning'       => array( 'enabled' => false ), // direct answers: faster, and the token budget isn't spent thinking
						'response_format' => array( 'type' => 'json_object' ),
						'messages'        => $messages,
					)
				),
			)
		);
		if ( is_wp_error( $res ) ) {
			error_log( '[jio chat] ' . $model . ' failed: ' . $res->get_error_message() );
			continue;
		}
		$code    = wp_remote_retrieve_response_code( $res );
		$data    = json_decode( wp_remote_retrieve_body( $res ), true );
		$content = isset( $data['choices'][0]['message']['content'] ) ? trim( (string) $data['choices'][0]['message']['content'] ) : '';
		if ( 200 === $code && '' !== $content ) {
			return $content;
		}
		error_log( '[jio chat] ' . $model . ' failed: HTTP ' . $code );
	}
	return null;
}

/** Per-visitor hourly limit on model calls, stored in a transient keyed on a hash of the IP. */
function jio_chat_rate_ok() {
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
	$key = 'jio_chat_' . md5( $ip );
	$n   = (int) get_transient( $key );
	if ( $n >= JIO_CHAT_LIMIT ) {
		return false;
	}
	set_transient( $key, $n + 1, HOUR_IN_SECONDS );
	return true;
}

/**
 * Conversation log for the weekly review (CHATBOT.md): daily counts per intent, routing and handoff in the option
 * jio_chat_stats (kept 60 days), and the last 50 unrecognised messages in jio_chat_misses with emails and long
 * digit runs masked. Read them with `wp option get jio_chat_stats --format=json`.
 */
function jio_chat_log( $intent, $via, $handoff, $text ) {
	$day   = gmdate( 'Y-m-d' );
	$stats = get_option( 'jio_chat_stats', array() );
	$stats = is_array( $stats ) ? $stats : array();
	foreach ( array( 'turns', 'intent:' . $intent, 'via:' . $via ) as $k ) {
		$stats[ $day ][ $k ] = isset( $stats[ $day ][ $k ] ) ? $stats[ $day ][ $k ] + 1 : 1;
	}
	if ( $handoff ) {
		$stats[ $day ]['handoff'] = isset( $stats[ $day ]['handoff'] ) ? $stats[ $day ]['handoff'] + 1 : 1;
	}
	ksort( $stats );
	update_option( 'jio_chat_stats', array_slice( $stats, -60, null, true ), false );

	if ( 'fallback' === $intent ) {
		$masked   = preg_replace( array( '/\S+@\S+/', '/\d[\d\s-]{5,}\d/' ), array( '[email]', '[number]' ), $text );
		$misses   = get_option( 'jio_chat_misses', array() );
		$misses   = is_array( $misses ) ? $misses : array();
		$misses[] = array( 'day' => $day, 'text' => mb_substr( $masked, 0, 200 ) );
		update_option( 'jio_chat_misses', array_slice( $misses, -50 ), false );
	}
}

/** Slots go out as an object even when empty, so the browser always gets {} rather than []. */
function jio_chat_state_out( $state ) {
	$state['slots'] = (object) $state['slots'];
	return $state;
}

function jio_chat_handle( WP_REST_Request $request ) {
	$messages = jio_chat_clean_messages( $request->get_param( 'messages' ) );
	if ( empty( $messages ) || 'user' !== end( $messages )['role'] ) {
		return new WP_REST_Response( array( 'error' => 'empty' ), 400 );
	}
	$cat   = jio_chat_json( 'intents.json' );
	$state = jio_chat_clean_state( $request->get_param( 'state' ) );
	$last  = end( $messages )['content'];
	$ar    = (bool) preg_match( '/[\x{0600}-\x{06FF}]/u', $last );

	// 1. Rules first: a pending quote answer, then an exact catalog example. Arabic goes to the model so it can reply in Arabic.
	$via      = 'rule';
	$answered = $ar ? null : jio_chat_slot_answer( $last, $state );
	$ruled    = ( $ar || $answered ) ? null : jio_chat_rule_intent( $last );
	if ( $answered ) {
		$turn = array( 'intent' => 'request_quote', 'slots' => $answered, 'suggest' => array(), 'model_reply' => '' );
	} elseif ( $ruled && 'model' !== $cat['intents'][ $ruled ]['handler'] ) {
		$turn = array( 'intent' => $ruled, 'slots' => array(), 'suggest' => array(), 'model_reply' => '' );
	} else {
		// 2. The model classifies and extracts; for model-handled intents it also writes the answer.
		$via = 'model';
		if ( ! jio_chat_rate_ok() ) {
			return new WP_REST_Response( array( 'reply' => jio_chat_fill( $cat['limit'] ), 'chips' => jio_chat_handoff_chips( $state ), 'intent' => 'limit', 'state' => jio_chat_state_out( $state ) ), 429 );
		}
		$key     = jio_chat_key();
		$content = '' !== $key ? jio_chat_call_model( $key, array_merge( array( array( 'role' => 'system', 'content' => jio_chat_system_prompt( $state ) ) ), $messages ) ) : null;
		$turn    = null !== $content ? jio_chat_parse_model( $content ) : null;
		// Model down but the message matched an intent: give its checked offline answer rather than a dead end.
		if ( ! $turn && $ruled && ! empty( $cat['intents'][ $ruled ]['offline'] ) ) {
			$turn = array( 'intent' => $ruled, 'slots' => array(), 'suggest' => array(), 'model_reply' => jio_chat_fill( $cat['intents'][ $ruled ]['offline'] ) );
		}
		if ( ! $turn ) {
			error_log( '[jio chat] no usable model reply' );
			jio_chat_log( 'unavailable', $via, true, $last );
			return new WP_REST_Response( array( 'reply' => jio_chat_fill( $cat['unavailable'] ), 'chips' => jio_chat_handoff_chips( $state ), 'intent' => 'unavailable', 'state' => jio_chat_state_out( $state ) ), 200 );
		}
		if ( $ruled ) {
			$turn['intent'] = $ruled; // an exact example outranks the model's guess
		}
	}
	$turn['ar'] = $ar;

	// 3. Dialogue manager.
	$out = jio_chat_manage( $turn, $state );
	jio_chat_log( $turn['intent'], $via, ! empty( $out['handoff'] ), $last );
	return new WP_REST_Response(
		array(
			'reply'  => $out['reply'],
			'chips'  => $out['chips'],
			'intent' => $turn['intent'],
			'state'  => jio_chat_state_out( $state ),
		),
		200
	);
}

add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'jio/v1',
			'/chat',
			array(
				'methods'             => 'POST',
				'callback'            => 'jio_chat_handle',
				'permission_callback' => '__return_true',
			)
		);
	}
);
