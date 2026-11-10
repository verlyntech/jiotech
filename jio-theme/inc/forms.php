<?php
/**
 * Quote and support forms, emailed to the sales address with wp_mail() (no plugin).
 *
 * Both forms post to admin-post.php. The visitor is sent back to the same page with
 * ?jio_form=<form>-<status>#<form>-form, and the form prints the matching message.
 */

const JIO_FORM_MAX_FILE = 10 * MB_IN_BYTES;

/** A posted text field, unslashed, sanitised and capped. */
function jio_form_text( $key, $max = 200, $multiline = false ) {
	$raw = isset( $_POST[ $key ] ) ? (string) wp_unslash( $_POST[ $key ] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification -- checked in jio_form_start().
	$val = $multiline ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw );
	return mb_substr( $val, 0, $max );
}

/** Back to the page the form was on, with a status for jio_form_notice(). */
function jio_form_back( $form, $status ) {
	$back = wp_get_referer() ? wp_get_referer() : home_url( 'quote' === $form ? '/contact/' : '/client-support/' );
	$back = remove_query_arg( 'jio_form', strtok( $back, '#' ) );
	wp_safe_redirect( add_query_arg( 'jio_form', $form . '-' . $status, $back ) . '#' . $form . '-form' );
	exit;
}

/** Nonce and spam trap. A filled trap gets a fake success, so bots learn nothing. */
function jio_form_start( $form ) {
	if ( ! isset( $_POST['jio_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['jio_nonce'] ) ), 'jio_' . $form ) ) {
		jio_form_back( $form, 'expired' );
	}
	if ( '' !== jio_form_text( 'website' ) ) {
		jio_form_back( $form, 'sent' );
	}
}

/** Send to the sales address, replying to the visitor. */
function jio_form_mail( $subject, array $lines, $name, $email, $attachments = array() ) {
	$to   = jio_chat_json( 'knowledge.json' )['company']['email'];
	$body = implode( "\n", $lines ) . "\n\n--\nSent from the " . wp_parse_url( home_url(), PHP_URL_HOST ) . ' website';
	$name = str_replace( array( '"', "\r", "\n" ), '', $name );
	return wp_mail( $to, $subject, $body, array( 'Reply-To: "' . $name . '" <' . $email . '>' ), $attachments );
}

/** Quote request: the homepage and Contact page form. */
function jio_handle_quote() {
	jio_form_start( 'quote' );
	$f = array(
		'first'   => jio_form_text( 'first_name' ),
		'last'    => jio_form_text( 'last_name' ),
		'company' => jio_form_text( 'company' ),
		'email'   => sanitize_email( jio_form_text( 'email' ) ),
		'phone'   => jio_form_text( 'phone', 40 ),
		'service' => jio_form_text( 'service' ),
		'message' => jio_form_text( 'message', 5000, true ),
	);
	$services = array();
	foreach ( jio_chat_json( 'intents.json' )['quote']['slots'] as $slot ) {
		if ( 'service' === $slot['key'] ) {
			$services = $slot['options']; // the same list as the form's "What do you need?" options
		}
	}
	if ( '' === $f['first'] || '' === $f['last'] || '' === $f['company'] || ! is_email( $f['email'] ) || ! in_array( $f['service'], $services, true ) || empty( $_POST['consent'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		jio_form_back( 'quote', 'invalid' );
	}

	$attachments = array();
	$file        = isset( $_FILES['rfq'] ) ? $_FILES['rfq'] : null; // phpcs:ignore WordPress.Security.NonceVerification
	if ( $file && UPLOAD_ERR_NO_FILE !== $file['error'] ) {
		$type = wp_check_filetype(
			$file['name'],
			array(
				'pdf'  => 'application/pdf',
				'doc'  => 'application/msword',
				'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'xls'  => 'application/vnd.ms-excel',
				'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'dwg'  => 'application/acad',
				'zip'  => 'application/zip',
			)
		);
		if ( UPLOAD_ERR_OK !== $file['error'] || ! $type['ext'] || $file['size'] > JIO_FORM_MAX_FILE || ! is_uploaded_file( $file['tmp_name'] ) ) {
			jio_form_back( 'quote', 'file' );
		}
		// Copy under its own name so the email shows "drawings.pdf", not a temp name; deleted after sending, never stored.
		$dir  = get_temp_dir();
		$path = trailingslashit( $dir ) . wp_unique_filename( $dir, sanitize_file_name( $file['name'] ) );
		if ( ! move_uploaded_file( $file['tmp_name'], $path ) ) {
			jio_form_back( 'quote', 'file' );
		}
		$attachments[] = $path;
	}

	$name = $f['first'] . ' ' . $f['last'];
	$sent = jio_form_mail(
		'Quote request: ' . $f['service'] . ' (' . $f['company'] . ')',
		array(
			'Name: ' . $name,
			'Company: ' . $f['company'],
			'Email: ' . $f['email'],
			'Phone: ' . ( $f['phone'] ? $f['phone'] : 'not given' ),
			'Service: ' . $f['service'],
			'',
			'What they need to keep running:',
			$f['message'] ? $f['message'] : '(nothing added)',
			'',
			$attachments ? 'Attachment: ' . basename( $attachments[0] ) : 'No attachment',
		),
		$name,
		$f['email'],
		$attachments
	);
	foreach ( $attachments as $path ) {
		wp_delete_file( $path );
	}
	jio_form_back( 'quote', $sent ? 'sent' : 'mail' );
}

/** Support request: the Client support page form. */
function jio_handle_support() {
	jio_form_start( 'support' );
	$f = array(
		'name'     => jio_form_text( 'name' ),
		'company'  => jio_form_text( 'company' ),
		'email'    => sanitize_email( jio_form_text( 'email' ) ),
		'phone'    => jio_form_text( 'phone', 40 ),
		'system'   => jio_form_text( 'system' ),
		'priority' => jio_form_text( 'priority', 20 ),
		'desc'     => jio_form_text( 'description', 5000, true ),
	);
	$systems = array( 'UPS or batteries', 'Servers or storage', 'Network or Wi-Fi', 'Firewall or security', 'CCTV', 'Microsoft 365 or email', 'Other' );
	if ( ! in_array( $f['priority'], array( 'normal', 'high', 'urgent' ), true ) ) {
		$f['priority'] = 'normal';
	}
	if ( '' === $f['name'] || '' === $f['company'] || ! is_email( $f['email'] ) || '' === $f['phone'] || ! in_array( $f['system'], $systems, true ) || '' === $f['desc'] || empty( $_POST['consent'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		jio_form_back( 'support', 'invalid' );
	}
	$sent = jio_form_mail(
		'Support (' . strtoupper( $f['priority'] ) . '): ' . $f['system'] . ' (' . $f['company'] . ')',
		array(
			'Priority: ' . ucfirst( $f['priority'] ),
			'Name: ' . $f['name'],
			'Company: ' . $f['company'],
			'Email: ' . $f['email'],
			'Phone: ' . $f['phone'],
			'Affected system: ' . $f['system'],
			'',
			'What is happening:',
			$f['desc'],
		),
		$f['name'],
		$f['email']
	);
	jio_form_back( 'support', $sent ? 'sent' : 'mail' );
}

foreach ( array( 'quote', 'support' ) as $jio_form ) {
	add_action( 'admin_post_nopriv_jio_' . $jio_form, 'jio_handle_' . $jio_form );
	add_action( 'admin_post_jio_' . $jio_form, 'jio_handle_' . $jio_form );
}

/** The message to show inside a form after it comes back, or ''. */
function jio_form_notice( $form ) {
	$status = isset( $_GET['jio_form'] ) ? sanitize_key( wp_unslash( $_GET['jio_form'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification -- display only.
	$prefix = $form . '-';
	if ( 0 !== strpos( $status, $prefix ) ) {
		return '';
	}
	$company = jio_chat_json( 'knowledge.json' )['company'];
	$text    = array(
		'sent'    => 'quote' === $form ? 'Thanks, your request is with our team. We will call you to schedule the discovery meeting.' : 'Thanks, your support request is with our team. For anything urgent, also call ' . $company['phone'] . '.',
		'invalid' => 'Some details were missing or not valid. Please check the form and send it again.',
		'file'    => 'The attachment could not be accepted. Use a PDF, Word, Excel, DWG or ZIP file up to 10 MB, or send the form without it.',
		'expired' => 'This page was open too long and the form expired. Please send it again.',
		'mail'    => 'Your request could not be sent just now. Please call ' . $company['phone'] . ' or email ' . $company['email'] . '.',
	);
	$key = substr( $status, strlen( $prefix ) );
	return isset( $text[ $key ] ) ? $text[ $key ] : '';
}
