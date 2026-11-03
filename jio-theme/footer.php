<footer class="site-foot">
	<div class="foot__cta">
		<div class="wrap foot__cta-row">
			<p>Need a UPS sized, a network rebuilt or a <span>server room built?</span></p>
			<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a quote</a>
		</div>
	</div>
	<div class="wrap foot">
		<div class="foot__id">
			<img class="foot__logo" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo.webp" width="1282" height="262" alt="JIO Tech, JIO Technologies LLC" loading="lazy">
			<address>Al Muroor Road<br>Abu Dhabi, United Arab Emirates</address>
		</div>
		<div class="foot__col">
			<p class="label">Services</p>
			<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>#power">Power &amp; energy</a>
			<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>#datacenter">Data centers &amp; cloud</a>
			<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>#network">Network &amp; security</a>
			<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>#operations">Managed IT &amp; support</a>
			<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>#equipment">Equipment supply</a>
		</div>
		<div class="foot__col">
			<p class="label">Company</p>
			<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a>
			<a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>">Industries</a>
			<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
			<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a>
			<a href="<?php echo esc_url( home_url( '/client-support/' ) ); ?>">Client support</a>
			<a href="https://jiotech.ae/">B2B portal</a>
		</div>
		<div class="foot__col">
			<p class="label">Contact</p>
			<a href="tel:+971553440144">+971 55 344 0144</a>
			<a href="mailto:sales@jiotechuae.com">sales@jiotechuae.com</a>
			<a href="https://wa.me/971553440144">WhatsApp</a>
		</div>
	</div>
	<div class="wrap foot__base">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> JIO Technologies LLC</span>
		<span><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy</a> &nbsp;/&nbsp; <a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>">Terms</a></span>
	</div>
</footer>
<div class="chat" data-chat data-endpoint="<?php echo esc_url( rest_url( 'jio/v1/chat' ) ); ?>" data-quote-url="<?php echo esc_url( home_url( '/contact/#quote' ) ); ?>">
	<div class="chat__panel" id="chat-panel" data-chat-panel role="region" aria-label="JIO assistant" hidden>
		<header class="chat__head">
			<p class="chat__title"><span class="chat__dot" aria-hidden="true"></span>JIO assistant</p>
			<button type="button" class="chat__icon-btn" data-chat-close aria-label="Close chat">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
			</button>
		</header>
		<div class="chat__log" data-chat-log role="log" aria-live="polite">
			<div class="chat__msg chat__msg--assistant"><p class="chat__text">Hi. Ask about our power, IT, security or support services, or answer a few questions and I'll fill in the quote form for you.</p></div>
			<div class="chat__chips" data-chat-chips>
				<button type="button" class="chat__chip chat__chip--go">Get a quote</button>
				<button type="button" class="chat__chip">What do you offer?</button>
				<button type="button" class="chat__chip">Do you work with government?</button>
			</div>
		</div>
		<form class="chat__form" data-chat-form>
			<label class="sr" for="chat-input">Your question</label>
			<input id="chat-input" class="chat__input" data-chat-input type="text" maxlength="800" autocomplete="off" placeholder="Ask a question" required>
			<button type="submit" class="chat__send" data-chat-send aria-label="Send">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"/></svg>
			</button>
		</form>
		<p class="chat__note">Answers come from an AI model. Don't share personal or ID details.</p>
	</div>
	<button type="button" class="chat__toggle" data-chat-toggle aria-expanded="false" aria-controls="chat-panel" aria-label="Open chat">
		<svg class="chat__ico-open" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16v11H10l-6 4z"/><path d="M8 9.5h8M8 12.5h5"/></svg>
		<svg class="chat__ico-close" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
	</button>
</div>
<?php wp_footer(); ?>
</body>
</html>
