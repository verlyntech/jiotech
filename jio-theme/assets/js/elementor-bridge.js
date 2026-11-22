/* Theme behaviour for pages built with Elementor (colours for dark mode are in inc/elementor-dark.php).
   1. Jump links: Elementor sections can't take an HTML id, so a target carries the class "jio-anchor-<name>".
      A link to #<name> (or a visit to page/#<name>) scrolls to it; if the target is a tab, the tab is opened first.
   2. Dark mode icons: icons drawn in dark ink swap to their light "-dark.svg" twins. */
(function () {
	'use strict';
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	var find = function (name) {
		if (!/^[a-z0-9-]+$/.test(name)) return null;
		// Live service links also use #service-<name>.
		return document.querySelector('.jio-anchor-' + name) || (name.indexOf('service-') === 0 ? document.querySelector('.jio-anchor-' + name.slice(8)) : null);
	};
	var go = function (name, smooth) {
		var el = find(name);
		if (!el) return false;
		var target = el;
		if (el.getAttribute('role') === 'tab') {
			el.click();
			target = el.closest('[data-e-type="e-tabs"]') || el;
		}
		// Scroll a beat later, so other click and load handlers on the page can't cancel it; keep the header offset.
		setTimeout(function () {
			var offset = parseFloat(getComputedStyle(document.documentElement).scrollPaddingTop) || 0;
			window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - offset, behavior: smooth && !reduceMotion ? 'smooth' : 'instant' });
		}, 60);
		return true;
	};
	document.addEventListener('click', function (event) {
		var link = event.target.closest('a[href]');
		if (!link || event.defaultPrevented || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
		var url = new URL(link.href, location.href);
		if (!url.hash || url.pathname !== location.pathname || url.search !== location.search) return;
		if (!find(url.hash.slice(1))) return;
		event.preventDefault();
		if (location.hash !== url.hash) history.pushState(null, '', url.hash);
		go(url.hash.slice(1), true);
	});
	window.addEventListener('hashchange', function () { go(location.hash.slice(1), true); });
	// Wait for Elementor's tabs to start before opening one from the address.
	window.addEventListener('load', function () { if (location.hash) setTimeout(function () { go(location.hash.slice(1), false); }, 0); });

	var DARK_ICONS = /\/assets\/elementor\/(industry-[a-z-]+|map-hub-(?:blue|green)|metric-[a-z]+|placeholder-image|hero-placeholder|step-[a-z]+|value-[a-z]+)\.svg/;
	var icons = Array.prototype.filter.call(document.querySelectorAll('.elementor img'), function (img) { return DARK_ICONS.test(img.src); });
	var swapIcons = function () {
		var dark = document.documentElement.getAttribute('data-theme') === 'dark';
		icons.forEach(function (img) {
			var light = img.getAttribute('data-light-src') || img.src;
			img.setAttribute('data-light-src', light);
			var want = dark ? light.replace(/\.svg/, '-dark.svg') : light;
			if (img.src !== want) img.src = want;
		});
	};
	if (icons.length) {
		swapIcons();
		new MutationObserver(swapIcons).observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });
	}

	// 3. Home hero: fetch the dark-mode background once the page has loaded, so the first switch to dark mode doesn't blink.
	var heroImg = document.querySelector('.jio-hero-bg img');
	if (heroImg) {
		window.addEventListener('load', function () {
			var bg = getComputedStyle(document.documentElement).getPropertyValue('--jio-hero-dark').trim().replace(/^url\(["']?|["']?\)$/g, '');
			var sheet = document.querySelector('link[href*="/assets/css/main.css"]');
			if (bg && sheet) new Image().src = new URL(bg, sheet.href).href; // The path in the variable is relative to main.css.
		});
	}
})();
