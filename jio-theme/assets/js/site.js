/* JIO Technologies: small progressive enhancements. Every page works without this file. */
(function () {
	'use strict';

	// Mark the current page in the primary nav.
	var here = location.pathname.replace(/\/$/, '');
	document.querySelectorAll('.nav a').forEach(function (a) {
		var p = new URL(a.href, location.href).pathname.replace(/\/$/, '');
		if (p && p === here) a.setAttribute('aria-current', 'page');
	});

	// Segmented radiogroup helper: click and arrow keys.
	function segmented(group, onChange) {
		var btns = Array.prototype.slice.call(group.querySelectorAll('[role="radio"]'));
		function select(btn, focus) {
			btns.forEach(function (b) {
				var on = b === btn;
				b.setAttribute('aria-checked', on ? 'true' : 'false');
				b.tabIndex = on ? 0 : -1;
			});
			if (focus) btn.focus();
			onChange(btn);
		}
		btns.forEach(function (b, i) {
			b.tabIndex = b.getAttribute('aria-checked') === 'true' ? 0 : -1;
			b.addEventListener('click', function () { select(b); });
			b.addEventListener('keydown', function (e) {
				var d = e.key === 'ArrowRight' || e.key === 'ArrowDown' ? 1 : e.key === 'ArrowLeft' || e.key === 'ArrowUp' ? -1 : 0;
				if (!d) return;
				e.preventDefault();
				select(btns[(i + d + btns.length) % btns.length], true);
			});
		});
	}

	// Hero: focus one layer of the power chain.
	var chain = document.querySelector('[data-chain]');
	if (chain) {
		var cap = chain.querySelector('[data-chain-cap]');
		var key = chain.querySelector('[data-insp-k]');
		var keys = { all: 'All layers', power: 'Power: 3 layers', it: 'IT: 3 layers', security: 'Security: 2 layers' };
		var captions = {
			all: 'Six layers, one supplier. If the UPS fails, so does everything under it.',
			power: 'Power: mains and solar input, UPS and battery strings, and distribution to the racks.',
			it: 'IT: power distribution, servers, storage and cloud, and the network that connects them.',
			security: 'Security: the firewall at the network edge and CCTV on site.'
		};
		// Length of the spine the current travels along.
		var list = chain.querySelector('.chain__list');
		var setRun = function () {
			if (!list) return;
			var spine = getComputedStyle(list, '::before');
			var run = list.offsetHeight - parseFloat(spine.top) - parseFloat(spine.bottom) - 48;
			list.style.setProperty('--run', Math.max(0, run) + 'px');
		};
		setRun();
		window.addEventListener('resize', setRun);
		segmented(chain.querySelector('.seg'), function (btn) {
			var f = btn.getAttribute('data-focus-btn');
			chain.setAttribute('data-focus', f);
			if (cap) cap.textContent = captions[f];
			if (key) key.textContent = keys[f];
		});
	}

	// Industries rail: boxed arrow buttons page through the cards.
	var rail = document.querySelector('[data-rail]');
	if (rail) {
		var prev = document.querySelector('[data-rail-prev]');
		var next = document.querySelector('[data-rail-next]');
		var step = function () { var c = rail.querySelector('.ind-card'); return c ? c.offsetWidth + 16 : 320; };
		var sync = function () {
			if (prev) prev.disabled = rail.scrollLeft <= 2;
			if (next) next.disabled = rail.scrollLeft + rail.clientWidth >= rail.scrollWidth - 2;
		};
		if (prev) prev.addEventListener('click', function () { rail.scrollBy({ left: -step(), behavior: 'smooth' }); });
		if (next) next.addEventListener('click', function () { rail.scrollBy({ left: step(), behavior: 'smooth' }); });
		rail.addEventListener('scroll', sync, { passive: true });
		window.addEventListener('resize', sync);
		sync();
	}

	// Hero photo carousel: boxed arrows step through three slides. No autoplay, so the headline stays put.
	var car = document.querySelector('[data-carousel]');
	if (car) {
		var slides = car.querySelectorAll('[data-slide]');
		var cur = 0;
		var show = function (n) {
			cur = (n + slides.length) % slides.length;
			slides.forEach(function (sl, i) { sl.classList.toggle('is-on', i === cur); });
			var c = car.querySelector('[data-car-count]');
			if (c) c.textContent = (cur + 1) + ' / ' + slides.length;
		};
		var p = car.querySelector('[data-car-prev]'), nx = car.querySelector('[data-car-next]');
		if (p) p.addEventListener('click', function () { show(cur - 1); });
		if (nx) nx.addEventListener('click', function () { show(cur + 1); });
	}

	// Hero email capture hands the address to the quote form below.
	var capture = document.querySelector('[data-capture]');
	if (capture) {
		capture.addEventListener('submit', function (e) {
			e.preventDefault();
			var email = capture.querySelector('input').value;
			var target = document.getElementById('em');
			if (target) target.value = email;
			// Say that the address was carried over, at the top of the form where the eye lands.
			var form = target && target.form;
			if (form && email) {
				var carry = form.querySelector('[data-carry]');
				if (!carry) {
					carry = document.createElement('p');
					carry.className = 'form__carry';
					carry.setAttribute('data-carry', '');
					carry.setAttribute('role', 'status');
					form.insertBefore(carry, form.querySelector('.form__row'));
				}
				carry.textContent = 'Your email ' + email + ' is filled in below. Add your name and company to send the request.';
			}
			var quote = document.getElementById('quote');
			if (quote) quote.scrollIntoView({ behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
			var first = document.getElementById('fn');
			if (first) setTimeout(function () { first.focus({ preventScroll: true }); }, 500);
		});
	}

	// Live Abu Dhabi clock.
	var clock = document.querySelector('[data-clock]');
	if (clock && window.Intl) {
		var fmt = new Intl.DateTimeFormat('en-GB', { hour: '2-digit', minute: '2-digit', timeZone: 'Asia/Dubai' });
		var tick = function () { clock.textContent = fmt.format(new Date()); };
		tick();
		setInterval(tick, 15000);
	}

	// Support priority routing.
	var pr = document.querySelector('[data-priority]');
	if (pr) {
		var field = document.querySelector('[data-priority-field]');
		segmented(pr, function (btn) {
			var p = btn.getAttribute('data-p');
			document.querySelectorAll('[data-route]').forEach(function (r) { r.hidden = r.getAttribute('data-route') !== p; });
			if (field) field.value = p;
		});
	}

	// Services local nav: highlight the group in view.
	var local = document.querySelector('[data-localnav]');
	if (local && 'IntersectionObserver' in window) {
		var links = local.querySelectorAll('a');
		var obs = new IntersectionObserver(function (entries) {
			entries.forEach(function (en) {
				if (!en.isIntersecting) return;
				links.forEach(function (a) { a.classList.toggle('is-active', a.getAttribute('href') === '#' + en.target.id); });
			});
		}, { rootMargin: '-45% 0px -50% 0px' });
		links.forEach(function (a) { var s = document.querySelector(a.getAttribute('href')); if (s) obs.observe(s); });
	}

	// Quote form: validate on submit, show the problem under each field and a summary at the top.
	var quoteForm = document.querySelector('[data-quote]');
	if (quoteForm) {
		var summary = quoteForm.querySelector('[data-form-errors]');
		var errFor = function (el) { var id = el.getAttribute('aria-describedby'); return id ? document.getElementById(id.split(' ')[0]) : null; };
		var messageFor = function (el) {
			if (el.type === 'email' && el.value && el.validity.typeMismatch) return 'That email address looks incomplete. Use the format name@company.ae.';
			return el.getAttribute('data-err') || 'This field is required.';
		};
		var setError = function (el, text) {
			var err = errFor(el);
			el.setAttribute('aria-invalid', text ? 'true' : 'false');
			if (err) { err.textContent = text || ''; err.hidden = !text; }
			var field = el.closest('.field, .check');
			if (field) field.classList.toggle('is-invalid', !!text);
		};
		var controls = Array.prototype.slice.call(quoteForm.querySelectorAll('[required]'));
		controls.forEach(function (el) {
			var evt = (el.type === 'checkbox' || el.tagName === 'SELECT') ? 'change' : 'input';
			el.addEventListener(evt, function () { if (el.getAttribute('aria-invalid') === 'true' && el.checkValidity()) setError(el, ''); });
		});
		quoteForm.addEventListener('submit', function (e) {
			var bad = controls.filter(function (el) { return !el.checkValidity(); });
			controls.forEach(function (el) { setError(el, bad.indexOf(el) > -1 ? messageFor(el) : ''); });
			var list = summary.querySelector('ul');
			list.innerHTML = '';
			if (bad.length) {
				e.preventDefault();
				bad.forEach(function (el) {
					var li = document.createElement('li'), a = document.createElement('a');
					a.href = '#' + el.id; a.textContent = messageFor(el);
					a.addEventListener('click', function (ev) { ev.preventDefault(); el.focus(); });
					li.appendChild(a); list.appendChild(li);
				});
				summary.hidden = false;
				summary.focus();
				return;
			}
			summary.hidden = true;
			if (quoteForm.getAttribute('action') !== '#') return;
			e.preventDefault();
			var msg = quoteForm.querySelector('[data-form-msg]');
			if (msg) msg.textContent = 'Preview only: this form is not connected yet. Call +971 55 344 0144 or email sales@jiotechuae.com.';
		});
	}

	// Support form is not wired to a backend yet: say so instead of failing silently.
	var supportForm = document.querySelector('[data-support]');
	if (supportForm) {
		supportForm.addEventListener('submit', function (e) {
			if (supportForm.getAttribute('action') !== '#') return;
			e.preventDefault();
			var msg = supportForm.querySelector('[data-form-msg]');
			if (msg) msg.textContent = 'Preview only: this form is not connected yet. For anything urgent call +971 55 344 0144.';
		});
	}
})();
