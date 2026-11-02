<?php
/**
 * JIO website assistant: a server-side proxy to the OpenRouter chat API.
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
const JIO_CHAT_LIMIT    = 20; // requests per visitor per hour

/** Build the system prompt from the knowledge file. Mirrors preview/serve.mjs. */
function jio_chat_system_prompt() {
	$path = get_template_directory() . '/inc/knowledge.json';
	$k    = json_decode( (string) file_get_contents( $path ), true );

	$lines   = array();
	$lines[] = 'You are the website assistant for JIO Technologies LLC. You answer visitors\' questions about JIO\'s services, industries, process and contact details.';
	$lines[] = 'Rules:';
	$lines[] = '- Answer only from the facts below. If the answer is not here, say you do not have that information and give the phone number or email so the visitor can ask a person.';
	$lines[] = '- Never invent prices, certifications, licence numbers, client names, ratings, response times or service-level commitments. Those are listed under "not confirmed" and must not be claimed.';
	$lines[] = '- Format every reply as up to four short bullet points, each starting with "- " on its own line. Each bullet is one short sentence (about 15 words at most). No headings, no bold, no paragraphs, no closing pleasantries.';
	$lines[] = '- Give the direct answer first. If the visitor needs more, end with one bullet pointing to the phone number or the quote form.';
	$lines[] = '- Use the visitor\'s language where possible; if they write in Arabic, reply in Arabic.';
	$lines[] = '- Encourage a quote request through the form on the website or a call to the phone number for anything specific to a site.';
	$lines[] = '- Do not ask for personal, financial or government ID details. If a visitor shares them, tell them not to, and that they should use the quote form or call.';
	$lines[] = '';
	$lines[] = 'FACTS:';
	$lines[] = wp_json_encode( $k, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
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

function jio_chat_key() {
	if ( defined( 'JIO_OPENROUTER_KEY' ) && JIO_OPENROUTER_KEY ) {
		return JIO_OPENROUTER_KEY;
	}
	$env = getenv( 'OPENROUTER_API_KEY' );
	return $env ? $env : '';
}

/** Per-visitor hourly limit, stored in a transient keyed on a hash of the IP. */
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

function jio_chat_handle( WP_REST_Request $request ) {
	if ( ! jio_chat_rate_ok() ) {
		return new WP_REST_Response( array( 'error' => 'limit' ), 429 );
	}
	$messages = jio_chat_clean_messages( $request->get_param( 'messages' ) );
	if ( empty( $messages ) || 'user' !== end( $messages )['role'] ) {
		return new WP_REST_Response( array( 'error' => 'empty' ), 400 );
	}

	$key = jio_chat_key();
	if ( '' === $key ) {
		return new WP_REST_Response( array( 'error' => 'unconfigured' ), 503 );
	}

	$messages = array_merge( array( array( 'role' => 'system', 'content' => jio_chat_system_prompt() ) ), $messages );

	// Free endpoints fail when busy or rate-limited, so try each model in turn and stop at the first reply.
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
						'model'      => $model,
						'max_tokens' => 1200,
						'reasoning'  => array( 'enabled' => false ), // direct answers: faster, and the token budget isn't spent thinking
						'messages'   => $messages,
					)
				),
			)
		);

		if ( is_wp_error( $res ) ) {
			error_log( '[jio chat] ' . $model . ' failed: ' . $res->get_error_message() );
			continue;
		}
		$code  = wp_remote_retrieve_response_code( $res );
		$data  = json_decode( wp_remote_retrieve_body( $res ), true );
		$reply = isset( $data['choices'][0]['message']['content'] ) ? trim( (string) $data['choices'][0]['message']['content'] ) : '';
		if ( 200 === $code && '' !== $reply ) {
			return new WP_REST_Response( array( 'reply' => $reply ), 200 );
		}
		error_log( '[jio chat] ' . $model . ' failed: HTTP ' . $code );
	}

	return new WP_REST_Response( array( 'error' => 'upstream' ), 502 );
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
