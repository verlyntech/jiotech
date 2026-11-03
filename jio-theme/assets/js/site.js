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

	// Connected layers: only the active square expands; neighbours keep their size.
	var layers = document.querySelector('[data-layers]');
	if (layers) {
		var layerRail = layers.querySelector('[data-layers-rail]');
		var layerControls = layers.querySelector('[data-layers-controls]');
		var layerPrev = layers.querySelector('[data-layers-prev]');
		var layerNext = layers.querySelector('[data-layers-next]');
		var activeLayer = null;
		var layerStates = Array.prototype.map.call(layers.querySelectorAll('[data-layer-card]'), function (card) {
			return { card: card, button: card.querySelector('.layer-card__toggle'), detail: card.querySelector('.layer-card__detail'), pinned: false, hovered: false, focused: false };
		});
		var setLayer = function (selected) {
			activeLayer = selected;
			layerStates.forEach(function (state) {
				var open = state === selected;
				if (!open) state.pinned = state.hovered = state.focused = false;
				state.card.classList.toggle('is-open', open);
				state.button.setAttribute('aria-expanded', String(open));
				state.detail.setAttribute('aria-hidden', String(!open));
			});
		};
		var syncLayers = function () {
			layerControls.hidden = layerRail.scrollWidth <= layerRail.clientWidth + 2;
			layerPrev.disabled = layerRail.scrollLeft <= 2;
			layerNext.disabled = layerRail.scrollLeft + layerRail.clientWidth >= layerRail.scrollWidth - 2;
		};
		var revealLayer = function () {
			if (!activeLayer) return;
			var cardBox = activeLayer.card.getBoundingClientRect(), railBox = layerRail.getBoundingClientRect();
			var distance = cardBox.left < railBox.left + 2 ? cardBox.left - railBox.left - 2 : cardBox.right > railBox.right - 2 ? cardBox.right - railBox.right + 2 : 0;
			if (Math.abs(distance) > 1) layerRail.scrollBy({ left: distance, behavior: 'auto' });
		};
		layerStates.forEach(function (state) {
			state.card.addEventListener('pointerenter', function (e) {
				if (e.pointerType === 'touch') return;
				state.hovered = true; setLayer(state);
			});
			state.card.addEventListener('pointerleave', function () {
				state.hovered = false;
				if (activeLayer === state && !state.pinned && !state.focused) setLayer(null);
			});
			state.button.addEventListener('focus', function () { state.focused = true; setLayer(state); });
			state.button.addEventListener('blur', function () {
				state.focused = state.pinned = false;
				if (activeLayer === state && !state.hovered) setLayer(null);
			});
			state.button.addEventListener('click', function () {
				state.pinned = !state.pinned;
				setLayer(state.pinned ? state : null);
			});
			state.card.addEventListener('keydown', function (e) {
				if (e.key === 'Escape') { e.preventDefault(); setLayer(null); }
			});
		});
		document.addEventListener('pointerdown', function (e) { if (!e.target.closest('[data-layer-card]')) setLayer(null); });
		setLayer(null);
		layers.setAttribute('data-layers-ready', '');
		if ('ResizeObserver' in window) {
			var layerObserver = new ResizeObserver(function () { revealLayer(); syncLayers(); });
			layerObserver.observe(layerRail);
			layerStates.forEach(function (state) { layerObserver.observe(state.card); });
		} else {
			layerRail.addEventListener('transitionend', function () { revealLayer(); syncLayers(); });
		}
		var stepLayer = function (direction) {
			var compact = layerRail.querySelector('.layer-card:not(.is-open)');
			var distance = compact.offsetWidth + parseFloat(getComputedStyle(layerRail).columnGap);
			setLayer(null);
			layerRail.scrollBy({ left: direction * distance, behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
		};
		layerPrev.addEventListener('click', function () { stepLayer(-1); });
		layerNext.addEventListener('click', function () { stepLayer(1); });
		layerRail.addEventListener('scroll', syncLayers, { passive: true });
		window.addEventListener('resize', syncLayers);
		syncLayers();
	}

	// Homepage industries: one row, moved one card at a time by the arrows.
	var industryRail = document.querySelector('[data-industry-rail]');
	if (industryRail) {
		var industryCards = industryRail.querySelectorAll('.ind-card');
		var industryPrev = document.querySelector('[data-industry-prev]');
		var industryNext = document.querySelector('[data-industry-next]');
		var industryPosition = document.querySelector('[data-industry-position]');
		var industryStep = function () { return industryCards[0].getBoundingClientRect().width + parseFloat(getComputedStyle(industryRail.querySelector('.industries__track')).columnGap); };
		var syncIndustries = function () {
			var step = industryStep();
			var visible = Math.max(1, Math.round(industryRail.clientWidth / step));
			var first = Math.min(industryCards.length - visible, Math.max(0, Math.round(industryRail.scrollLeft / step)));
			industryPrev.disabled = industryRail.scrollLeft <= 2;
			industryNext.disabled = industryRail.scrollLeft + industryRail.clientWidth >= industryRail.scrollWidth - 2;
			var range = visible === 1 ? String(first + 1) : (first + 1) + '–' + Math.min(first + visible, industryCards.length);
			var text = range + ' of ' + industryCards.length + ' industries';
			if (industryPosition.textContent !== text) industryPosition.textContent = text;
		};
		var moveIndustry = function (direction) {
			industryRail.scrollBy({ left: direction * industryStep(), behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
		};
		industryPrev.addEventListener('click', function () { moveIndustry(-1); });
		industryNext.addEventListener('click', function () { moveIndustry(1); });
		industryRail.addEventListener('keydown', function (event) {
			if (event.target !== industryRail || (event.key !== 'ArrowRight' && event.key !== 'ArrowLeft')) return;
			event.preventDefault(); moveIndustry(event.key === 'ArrowRight' ? 1 : -1);
		});
		industryRail.addEventListener('scroll', syncIndustries, { passive: true });
		window.addEventListener('resize', syncIndustries);
		industryRail.setAttribute('data-ready', '');
		document.querySelector('[data-industry-controls]').hidden = false;
		syncIndustries();
	}

	// Pause decorative sector motion while it is off screen.
	var sectorMotion = document.querySelector('[data-sector-motion]');
	if (sectorMotion && 'IntersectionObserver' in window) {
		sectorMotion.setAttribute('data-motion', 'paused');
		new IntersectionObserver(function (entries) {
			sectorMotion.setAttribute('data-motion', entries[0].isIntersecting ? 'running' : 'paused');
		}, { threshold: .15 }).observe(sectorMotion);
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
