<?php
/**
 * Client support.
 */
get_header(); ?>

<main id="main">

<section class="phero">
	<div class="wrap phero__grid">
		<h1>Something is down. Here is the fastest way to reach us.</h1>
		<div class="phero__side">
			<p>Technical support runs 24/7, remote and onsite. Pick how urgent it is and we will route it.</p>
		</div>
	</div>
</section>

<section class="support">
	<div class="wrap support__grid">

		<!-- Priority selector: segmented pill (Wise) -->
		<div class="support__route">
			<div class="seg seg--light" role="radiogroup" aria-label="Priority" data-priority>
				<button type="button" role="radio" aria-checked="true" data-p="normal">Normal</button>
				<button type="button" role="radio" aria-checked="false" data-p="high">High</button>
				<button type="button" role="radio" aria-checked="false" data-p="urgent">Urgent</button>
			</div>
			<div class="route" data-route="normal">
				<h2>Normal</h2>
				<p>A question, a change request, or a fault that is not stopping work. Use the form and we will schedule it.</p>
			</div>
			<div class="route" data-route="high" hidden>
				<h2>High</h2>
				<p>Part of the business is affected: one site, one system, or a UPS reporting a fault. Submit the form, then call to confirm.</p>
				<a class="link" href="tel:+971553440144">Call +971 55 344 0144</a>
			</div>
			<div class="route route--urgent" data-route="urgent" hidden>
				<h2>Urgent</h2>
				<p>Systems are down, or a UPS is running on battery with no mains. Call now; do not wait for the form.</p>
				<a class="btn" href="tel:+971553440144">Call +971 55 344 0144</a>
			</div>
			<dl class="direct direct--stack">
				<div><dt>WhatsApp</dt><dd><a href="https://wa.me/971553440144">Message us</a></dd></div>
				<div><dt>Email</dt><dd><a href="mailto:sales@jiotechuae.com">sales@jiotechuae.com</a></dd></div>
				<div><dt>General questions</dt><dd><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">Read the FAQ</a></dd></div>
			</dl>
		</div>

		<form class="form" id="support-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-support>
			<input type="hidden" name="action" value="jio_support"><?php wp_nonce_field( 'jio_support', 'jio_nonce', false ); ?>
			<div class="sr" aria-hidden="true"><label for="s-website">Leave this empty</label><input id="s-website" name="website" tabindex="-1" autocomplete="off"></div>
			<h2 class="form__h">Submit a support request</h2>
			<input type="hidden" name="priority" value="normal" data-priority-field>
			<div class="form__row">
				<div class="field"><label for="s-name">Your name</label><input id="s-name" name="name" autocomplete="name" required></div>
				<div class="field"><label for="s-co">Company</label><input id="s-co" name="company" autocomplete="organization" required></div>
			</div>
			<div class="form__row">
				<div class="field"><label for="s-em">Email</label><input id="s-em" type="email" name="email" autocomplete="email" required></div>
				<div class="field"><label for="s-ph">Phone</label><input id="s-ph" type="tel" name="phone" autocomplete="tel" required></div>
			</div>
			<div class="field"><label for="s-sys">Affected system</label>
				<select id="s-sys" name="system">
					<option>UPS or batteries</option>
					<option>Servers or storage</option>
					<option>Network or Wi-Fi</option>
					<option>Firewall or security</option>
					<option>CCTV</option>
					<option>Microsoft 365 or email</option>
					<option>Other</option>
				</select>
			</div>
			<div class="field"><label for="s-desc">What is happening?</label><textarea id="s-desc" name="description" rows="5" required placeholder="What stopped working, since when, and at which site"></textarea></div>
			<label class="check"><input type="checkbox" name="consent" required> <span>I agree to JIO processing these details to handle this request. I can withdraw consent at any time.</span></label>
			<button class="btn" type="submit">Submit request</button>
			<p class="form__note" data-form-msg role="status" aria-live="polite"><?php echo esc_html( jio_form_notice( 'support' ) ); ?></p>
		</form>

	</div>
</section>

</main>

<?php get_footer(); ?>
