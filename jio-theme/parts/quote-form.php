<form class="form" action="#" method="post" data-quote>
	<div class="form__row">
		<div class="field"><label for="fn">First name</label><input id="fn" name="first_name" autocomplete="given-name" required></div>
		<div class="field"><label for="ln">Last name</label><input id="ln" name="last_name" autocomplete="family-name" required></div>
	</div>
	<div class="field"><label for="co">Company</label><input id="co" name="company" autocomplete="organization"></div>
	<div class="form__row">
		<div class="field"><label for="em">Work email</label><input id="em" type="email" name="email" autocomplete="email" required></div>
		<div class="field"><label for="ph">Phone</label><input id="ph" type="tel" name="phone" autocomplete="tel"></div>
	</div>
	<div class="field"><label for="sv">Service</label>
		<select id="sv" name="service">
			<option>UPS solutions</option>
			<option>Power &amp; energy</option>
			<option>Cloud &amp; data services</option>
			<option>Cybersecurity &amp; compliance</option>
			<option>Digital transformation &amp; IT advisory</option>
			<option>Smart infrastructure</option>
			<option>Network &amp; connectivity</option>
			<option>Data center design &amp; hosting</option>
			<option>Maintenance &amp; managed support</option>
			<option>IT procurement &amp; vendor management</option>
			<option>Other</option>
		</select>
	</div>
	<div class="field"><label for="ms">What do you need to keep running?</label><textarea id="ms" name="message" rows="4"></textarea></div>
	<label class="check"><input type="checkbox" name="consent" required> <span>I agree to the <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">privacy policy</a> and to JIO processing these details to reply.</span></label>
	<button class="btn" type="submit">Request a quote</button>
	<p class="form__note" data-form-msg>Connect this form to Contact Form 7, WPForms or your CRM before launch.</p>
</form>
