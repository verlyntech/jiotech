/* Connected service selector with concise overviews and enquiry links. */
(function () {
	'use strict';
	var explorer = document.querySelector('[data-service-explorer]');
	if (!explorer) return;
	var navigation = explorer.querySelector('[data-service-nav]');
	var nodes = Array.prototype.slice.call(explorer.querySelectorAll('[data-service-node]'));
	var panels = Array.prototype.slice.call(explorer.querySelectorAll('[data-service-summary]'));
	var wires = Array.prototype.slice.call(explorer.querySelectorAll('[data-service-wire]'));
	var position = explorer.querySelector('[data-service-position]');
	if (!navigation || !nodes.length || nodes.length !== panels.length) return;
	navigation.setAttribute('role', 'tablist');
	navigation.setAttribute('aria-orientation', 'vertical');
	nodes.forEach(function (node) { node.setAttribute('role', 'tab'); });
	panels.forEach(function (panel) { panel.setAttribute('role', 'tabpanel'); panel.tabIndex = 0; });
	var select = function (node, updateHash) {
		var service = node.getAttribute('data-service-node');
		var index = nodes.indexOf(node);
		explorer.setAttribute('data-active-service', service);
		nodes.forEach(function (item) {
			var active = item === node;
			item.setAttribute('aria-selected', String(active));
			item.tabIndex = active ? 0 : -1;
			item.classList.toggle('is-active', active);
		});
		panels.forEach(function (panel) { panel.hidden = panel.getAttribute('data-service-summary') !== service; });
		wires.forEach(function (wire) { wire.classList.toggle('is-active', wire.getAttribute('data-service-wire') === service); });
		position.textContent = String(index + 1).padStart(2, '0') + ' / ' + String(nodes.length).padStart(2, '0');
		if (updateHash && window.history && window.history.replaceState) window.history.replaceState(null, '', '#service-' + service);
	};
	nodes.forEach(function (node, index) {
		node.addEventListener('click', function (event) {
			if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
			event.preventDefault();
			select(node, true);
			if (window.matchMedia('(max-width: 900px)').matches) {
				explorer.querySelector('.service-explorer__overview').scrollIntoView({ block: 'start', behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
			}
		});
		node.addEventListener('keydown', function (event) {
			var next;
			if (event.key === 'ArrowDown' || event.key === 'ArrowRight') next = (index + 1) % nodes.length;
			else if (event.key === 'ArrowUp' || event.key === 'ArrowLeft') next = (index - 1 + nodes.length) % nodes.length;
			else if (event.key === 'Home') next = 0;
			else if (event.key === 'End') next = nodes.length - 1;
			else if (event.key === ' ') next = index;
			else return;
			event.preventDefault();
			select(nodes[next], true);
			nodes[next].focus();
		});
	});
	var syncHash = function () {
		var selected = nodes.find(function (node) { return '#' + node.id === location.hash || node.getAttribute('href') === location.hash; });
		if (selected) select(selected, false);
	};
	select(nodes[0], false);
	syncHash();
	var revealExplorer = function () {
		var target = document.getElementById(location.hash.slice(1));
		if (!nodes.some(function (node) { return '#' + node.id === location.hash; }) && !(target && target.hasAttribute('data-service-summary'))) return;
		window.requestAnimationFrame(function () { document.getElementById('capabilities').scrollIntoView({ block: 'start' }); });
	};
	window.addEventListener('load', revealExplorer, { once: true });
	window.addEventListener('hashchange', function () { syncHash(); revealExplorer(); });
})();
