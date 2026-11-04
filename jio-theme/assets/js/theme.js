/* Blocking head script: apply the saved/system theme before the page is painted. */
(function () {
	'use strict';
	var key = 'jio-color-theme';
	var root = document.documentElement;
	// Play the logo intro when the site is opened, not on every click between its pages.
	var calm = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	if (!calm && document.referrer.indexOf(location.origin + '/') !== 0) root.classList.add('logo-intro');
	// Clear it once played: the theme toggle shows a different logo image, which would otherwise replay the intro.
	document.addEventListener('animationend', function (event) {
		if (event.animationName === 'logo-reveal') root.classList.remove('logo-intro');
	});
	var system = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;
	var preference = null;
	var valid = function (value) { return value === 'light' || value === 'dark'; };
	try {
		var saved = window.localStorage.getItem(key);
		if (valid(saved)) preference = saved;
	} catch (error) { /* Storage can be unavailable; switching still works for this page. */ }
	var apply = function () {
		var theme = preference || (system && system.matches ? 'dark' : 'light');
		root.setAttribute('data-theme', theme);
		root.style.colorScheme = theme;
		document.querySelectorAll('[data-theme-toggle]').forEach(function (button) {
			button.setAttribute('aria-pressed', String(theme === 'dark'));
			button.title = theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode';
		});
	};
	apply();
	var bind = function () {
		document.querySelectorAll('[data-theme-toggle]').forEach(function (button) {
			button.hidden = false;
			button.addEventListener('click', function () {
				preference = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
				try { window.localStorage.setItem(key, preference); } catch (error) { /* Keep the in-memory choice. */ }
				apply();
			});
		});
		apply();
	};
	if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', bind, { once: true });
	else bind();
	var systemChanged = function () { if (!preference) apply(); };
	if (system && system.addEventListener) system.addEventListener('change', systemChanged);
	else if (system && system.addListener) system.addListener(systemChanged);
	window.addEventListener('storage', function (event) {
		if (event.key !== key && event.key !== null) return;
		preference = valid(event.newValue) ? event.newValue : null;
		apply();
	});
})();
