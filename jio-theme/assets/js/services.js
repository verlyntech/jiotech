/* All five service areas stay visible; the gallery links to each section. */
(function () {
	'use strict';
	var gallery = document.querySelector('[data-capabilities]');
	if (!gallery) return;
	var links = Array.prototype.slice.call(gallery.querySelectorAll('[data-cap-tab]'));
	var sections = links.map(function (link) { return document.getElementById(link.getAttribute('aria-controls')); }).filter(Boolean);
	var mark = function (selected) {
		links.forEach(function (link) {
			if (link === selected) link.setAttribute('aria-current', 'location');
			else link.removeAttribute('aria-current');
		});
	};
	links.forEach(function (link) {
		link.addEventListener('click', function () { mark(link); });
	});
	var linkForHash = function () { return links.find(function (link) { return link.getAttribute('href') === location.hash; }); };
	mark(linkForHash() || links[0]);
	window.addEventListener('hashchange', function () {
		var link = linkForHash();
		if (link) mark(link);
	});
	if ('IntersectionObserver' in window) {
		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) return;
				var link = links.find(function (item) { return item.getAttribute('aria-controls') === entry.target.id; });
				if (link) mark(link);
			});
		}, { rootMargin: '-15% 0px -65% 0px' });
		sections.forEach(function (section) { observer.observe(section); });
	}
})();
