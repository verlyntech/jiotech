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

	// Homepage service spotlight: anchors remain useful when JavaScript is unavailable.
	var spotlight = document.querySelector('[data-home-spotlight]');
	if (spotlight) {
		var serviceTabs = Array.from(spotlight.querySelectorAll('[data-spotlight-tab]'));
		var servicePanels = Array.from(spotlight.querySelectorAll('[data-spotlight-panel]'));
		spotlight.querySelector('[data-spotlight-nav]').setAttribute('role', 'tablist');
		serviceTabs.forEach(function (tab) {
			tab.setAttribute('role', 'tab');
			tab.setAttribute('aria-controls', tab.hash.slice(1));
		});
		servicePanels.forEach(function (panel) {
			panel.setAttribute('role', 'tabpanel');
			panel.setAttribute('aria-labelledby', 'spotlight-tab-' + panel.dataset.spotlightPanel);
			panel.tabIndex = 0;
		});
		var selectService = function (index) {
			serviceTabs.forEach(function (tab, i) {
				tab.setAttribute('aria-selected', String(i === index));
				tab.tabIndex = i === index ? 0 : -1;
			});
			servicePanels.forEach(function (panel, i) { panel.hidden = i !== index; });
		};
		serviceTabs.forEach(function (tab, index) {
			tab.addEventListener('click', function (event) {
				if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
				event.preventDefault(); selectService(index);
			});
			tab.addEventListener('keydown', function (event) {
				var next;
				if (event.key === 'ArrowRight' || event.key === 'ArrowDown') next = (index + 1) % serviceTabs.length;
				else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') next = (index - 1 + serviceTabs.length) % serviceTabs.length;
				else if (event.key === 'Home') next = 0;
				else if (event.key === 'End') next = serviceTabs.length - 1;
				else if (event.key === ' ') next = index;
				else return;
				event.preventDefault(); selectService(next); serviceTabs[next].focus();
			});
		});
		spotlight.querySelectorAll('[data-spotlight-next]').forEach(function (button, index) {
			button.addEventListener('click', function () {
				var next = (index + 1) % serviceTabs.length;
				selectService(next);
				servicePanels[next].querySelector('[data-spotlight-next]').focus({ preventScroll: true });
			});
		});
		var serviceFromHash = function () { return serviceTabs.findIndex(function (tab) { return tab.hash === location.hash; }); };
		selectService(Math.max(0, serviceFromHash()));
		window.addEventListener('hashchange', function () {
			var index = serviceFromHash(); if (index >= 0) selectService(index);
		});
		spotlight.setAttribute('data-spotlight-ready', '');
	}

	// Company perspectives: the selected chapter changes both the copy and image space.
	var company = document.querySelector('[data-company-perspectives]');
	if (company) {
		var companyTabs = Array.from(company.querySelectorAll('[data-company-tab]'));
		var companyPanels = Array.from(company.querySelectorAll('[data-company-panel]'));
		company.querySelector('[data-company-nav]').setAttribute('role', 'tablist');
		companyTabs.forEach(function (tab) { tab.setAttribute('role', 'tab'); });
		companyPanels.forEach(function (panel) {
			panel.setAttribute('role', 'tabpanel'); panel.tabIndex = 0;
			panel.setAttribute('aria-labelledby', 'company-tab-' + panel.dataset.companyPanel);
		});
		var selectCompany = function (tab, updateHash) {
			companyTabs.forEach(function (item) {
				item.setAttribute('aria-selected', String(item === tab)); item.tabIndex = item === tab ? 0 : -1;
			});
			companyPanels.forEach(function (panel) { panel.hidden = panel.dataset.companyPanel !== tab.dataset.companyTab; });
			if (updateHash) history.replaceState(null, '', tab.getAttribute('href'));
		};
		companyTabs.forEach(function (tab, index) {
			tab.addEventListener('click', function (event) {
				if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
				event.preventDefault(); selectCompany(tab, true);
			});
			tab.addEventListener('keydown', function (event) {
				var next;
				if (event.key === 'ArrowRight') next = (index + 1) % companyTabs.length;
				else if (event.key === 'ArrowLeft') next = (index - 1 + companyTabs.length) % companyTabs.length;
				else if (event.key === 'Home') next = 0;
				else if (event.key === 'End') next = companyTabs.length - 1;
				else if (event.key === ' ') next = index;
				else return;
				event.preventDefault(); selectCompany(companyTabs[next], true); companyTabs[next].focus();
			});
		});
		selectCompany(companyTabs.find(function (tab) { return tab.getAttribute('href') === location.hash; }) || companyTabs[0], false);
		window.addEventListener('hashchange', function () {
			var tab = companyTabs.find(function (item) { return item.getAttribute('href') === location.hash; });
			if (tab) selectCompany(tab, false);
		});
		company.setAttribute('data-company-ready', '');
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

	// Static industry wheel: each icon opens the corresponding sector overview.
	var industryExplorer = document.querySelector('[data-industry-explorer]');
	if (industryExplorer) {
		var industryTabs = Array.from(industryExplorer.querySelectorAll('[data-industry-tab]'));
		var industryPanels = Array.from(industryExplorer.querySelectorAll('[data-industry-panel]'));
		industryExplorer.querySelector('[data-industry-nav]').setAttribute('role', 'tablist');
		var selectIndustry = function (tab, updateHash) {
			industryTabs.forEach(function (item) {
				item.setAttribute('role', 'tab');
				item.setAttribute('aria-selected', String(item === tab));
				item.tabIndex = item === tab ? 0 : -1;
			});
			industryPanels.forEach(function (panel) {
				panel.setAttribute('role', 'tabpanel');
				panel.setAttribute('aria-labelledby', 'industry-tab-' + panel.id);
				panel.tabIndex = 0;
				panel.hidden = panel.id !== tab.dataset.industryTab;
			});
			if (updateHash) history.replaceState(null, '', tab.getAttribute('href'));
		};
		industryTabs.forEach(function (tab, index) {
			tab.addEventListener('click', function (event) {
				if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
				event.preventDefault(); selectIndustry(tab, true);
			});
			tab.addEventListener('keydown', function (event) {
				var next;
				if (event.key === 'ArrowRight' || event.key === 'ArrowDown') next = (index + 1) % industryTabs.length;
				else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') next = (index - 1 + industryTabs.length) % industryTabs.length;
				else if (event.key === 'Home') next = 0;
				else if (event.key === 'End') next = industryTabs.length - 1;
				else if (event.key === ' ') next = index;
				else return;
				event.preventDefault(); selectIndustry(industryTabs[next], true); industryTabs[next].focus();
			});
		});
		var selectIndustryHash = function () {
			selectIndustry(industryTabs.find(function (tab) { return tab.getAttribute('href') === location.hash; }) || industryTabs[0], false);
		};
		selectIndustryHash(); window.addEventListener('hashchange', selectIndustryHash);
	}

	// Platform partners reveal once, with a short stagger as each row enters view.
	var partnerSection = document.querySelector('[data-partner-reveal]');
	if (partnerSection && 'IntersectionObserver' in window && !matchMedia('(prefers-reduced-motion: reduce)').matches) {
		var partnerHeading = partnerSection.querySelector('.sec-head');
		var partnerItems = Array.from(partnerSection.querySelectorAll('.logos > li'));
		var partnerColumns = matchMedia('(max-width: 720px)').matches ? 2 : 4;
		var partnerTargets = [partnerHeading].concat(partnerItems);
		var partnerObserver = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) return;
				entry.target.setAttribute('data-partner-visible', '');
				partnerObserver.unobserve(entry.target);
			});
		}, { threshold: .15, rootMargin: '0px 0px -20px 0px' });
		partnerTargets.forEach(function (item, index) {
			item.setAttribute('data-partner-item', '');
			item.style.setProperty('--partner-delay', (index === 0 ? 0 : ((index - 1) % partnerColumns) * 90) + 'ms');
			partnerObserver.observe(item);
		});
		partnerSection.setAttribute('data-partner-ready', '');
	}

	// One continuous ribbon, with a hidden duplicate for a seamless loop.
	var vendorStrip = document.querySelector('[data-vendor-strip]');
	if (vendorStrip) {
		var vendorLogos = vendorStrip.querySelector('[data-vendor-logos]');
		var vendorCopy = vendorLogos.cloneNode(true);
		vendorCopy.removeAttribute('data-vendor-logos');
		vendorCopy.removeAttribute('aria-label');
		vendorCopy.setAttribute('aria-hidden', 'true');
		vendorCopy.querySelectorAll('img').forEach(function (img) { img.alt = ''; });
		vendorStrip.querySelector('[data-vendor-track]').appendChild(vendorCopy);
		vendorStrip.setAttribute('data-vendor-ready', '');

	}

	// Homepage background video plays only while on screen, and stays on its poster when motion is reduced.
	var videoSection = document.querySelector('[data-home-video]');
	if (videoSection) {
		var homeVideo = videoSection.querySelector('[data-home-video-element]');
		var videoMotion = matchMedia('(prefers-reduced-motion: reduce)');
		var videoVisible = false;
		var syncHomeVideo = function () {
			if (!videoVisible || document.hidden || videoMotion.matches) { homeVideo.pause(); return; }
			var playing = homeVideo.play();
			if (playing) playing.catch(function () { /* autoplay blocked: the poster stays */ });
		};
		if ('IntersectionObserver' in window) {
			new IntersectionObserver(function (entries) {
				videoVisible = entries[0].isIntersecting; syncHomeVideo();
			}, { threshold: .1 }).observe(videoSection);
		} else { videoVisible = true; syncHomeVideo(); }
		document.addEventListener('visibilitychange', syncHomeVideo);
		videoMotion.addEventListener('change', syncHomeVideo);
	}

	// Run decorative connector flow only while its section is visible.
	var motionTargets = document.querySelectorAll('[data-sector-motion], .industry-orbit, .sector-list > li, [data-service-explorer], [data-vendor-strip]');
	if ('IntersectionObserver' in window) {
		var motionObserver = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) { entry.target.setAttribute('data-motion', entry.isIntersecting ? 'running' : 'paused'); });
		}, { threshold: .05 });
		motionTargets.forEach(function (target) { target.setAttribute('data-motion', 'paused'); motionObserver.observe(target); });
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
