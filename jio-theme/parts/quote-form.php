<form class="form" id="quote-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data" novalidate data-quote>
	<input type="hidden" name="action" value="jio_quote"><?php wp_nonce_field( 'jio_quote', 'jio_nonce', false ); ?>
	<div class="sr" aria-hidden="true"><label for="q-website">Leave this empty</label><input id="q-website" name="website" tabindex="-1" autocomplete="off"></div>
	<div class="form__errors" data-form-errors role="alert" tabindex="-1" hidden>
		<p class="form__errors-h">Check these before sending:</p>
		<ul></ul>
	</div>
	<div class="form__row">
		<div class="field"><label for="fn">First name</label><input id="fn" name="first_name" autocomplete="given-name" required aria-describedby="fn-err" data-err="Enter your first name."><p class="field__err" id="fn-err" hidden></p></div>
		<div class="field"><label for="ln">Last name</label><input id="ln" name="last_name" autocomplete="family-name" required aria-describedby="ln-err" data-err="Enter your last name."><p class="field__err" id="ln-err" hidden></p></div>
	</div>
	<div class="field"><label for="co">Company or organisation</label><input id="co" name="company" autocomplete="organization" required aria-describedby="co-err" data-err="Enter your company or organisation."><p class="field__err" id="co-err" hidden></p></div>
	<div class="form__row">
		<div class="field"><label for="em">Work email</label><input id="em" type="email" name="email" autocomplete="email" required aria-describedby="em-err" data-err="Enter a work email address, like name@company.ae."><p class="field__err" id="em-err" hidden></p></div>
		<div class="field"><label for="ph">Phone <span class="field__opt">optional</span></label><input id="ph" type="tel" name="phone" autocomplete="tel" inputmode="tel" aria-describedby="ph-hint"><p class="field__hint" id="ph-hint">For a faster call back.</p></div>
	</div>
	<div class="field"><label for="sv">What do you need?</label>
		<select id="sv" name="service" required aria-describedby="sv-err" data-err="Choose what you need, or pick &ldquo;Not sure, or several&rdquo;.">
			<option value="" disabled selected>Choose one</option>
			<option>Power &amp; energy (UPS, batteries, renewables)</option>
			<option>Data center design &amp; hosting</option>
			<option>Cybersecurity &amp; data protection</option>
			<option>Network &amp; connectivity</option>
			<option>Managed IT &amp; 24/7 support</option>
			<option>Consulting &amp; cloud</option>
			<option>Digital transformation</option>
			<option>Not sure, or several</option>
		</select>
		<p class="field__err" id="sv-err" hidden></p>
	</div>
	<div class="field"><label for="ms">What do you need to keep running? <span class="field__opt">optional</span></label><textarea id="ms" name="message" rows="4"></textarea></div>
	<div class="field"><label for="rfq">Attach an RFQ or drawings <span class="field__opt">optional</span></label><input id="rfq" type="file" name="rfq" accept=".pdf,.doc,.docx,.xls,.xlsx,.dwg,.zip" aria-describedby="rfq-hint"><p class="field__hint" id="rfq-hint">PDF, Word, Excel, DWG or ZIP, up to 10 MB.</p></div>
	<label class="check"><input id="cn" type="checkbox" name="consent" required aria-describedby="cn-err" data-err="Tick the box so we can use these details to reply."> <span>I agree to the <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">privacy policy</a> and to JIO processing these details to reply.</span></label>
	<p class="field__err" id="cn-err" hidden></p>
	<div class="form__send">
		<button class="btn" type="submit">Request a call and quote</button>
		<p class="form__reassure">We call you to schedule the discovery meeting. Your details are used only to reply to this request.</p>
		<!-- Client to confirm before launch: add a reply-time commitment here, e.g. "We reply within one working day." Do not publish one that is not confirmed. -->
	</div>
	<p class="form__note" data-form-msg role="status" aria-live="polite"><?php echo esc_html( jio_form_notice( 'quote' ) ); ?></p>
</form>
