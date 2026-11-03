/* JIO website assistant widget. Talks to the server-side proxy; the API key never reaches the browser.
   Replies are built with DOM text nodes, never innerHTML. Lines starting with "- " become a bullet list.
   The server returns quick replies (chips) and the dialogue state (quote flow, filled details, fallback count);
   the widget sends that state back with each message. Design in CHATBOT.md. */
(function () {
	'use strict';

	var root = document.querySelector('[data-chat]');
	if (!root) return;

	var endpoint = root.getAttribute('data-endpoint');
	var quoteUrl = root.getAttribute('data-quote-url');
	var toggle = root.querySelector('[data-chat-toggle]');
	var panel = root.querySelector('[data-chat-panel]');
	var close = root.querySelector('[data-chat-close]');
	var log = root.querySelector('[data-chat-log]');
	var form = root.querySelector('[data-chat-form]');
	var input = root.querySelector('[data-chat-input]');
	var send = root.querySelector('[data-chat-send]');
	var history = [];
	var state = {};
	var busy = false;
	var PREFILL_KEY = 'jio-chat-prefill';

	var FALLBACK = 'I cannot answer right now. Call +971 55 344 0144 or email sales@jiotechuae.com.';

	function open(on) {
		panel.hidden = !on;
		root.classList.toggle('is-open', on);
		toggle.setAttribute('aria-expanded', on ? 'true' : 'false');
		toggle.setAttribute('aria-label', on ? 'Close chat' : 'Open chat');
		if (on) input.focus();
	}

	/* Render a reply: consecutive "- " / "* " / "• " lines become <ul>, anything else a <p>. Markdown bold is stripped. */
	function render(text) {
		var frag = document.createDocumentFragment();
		var list = null;
		text.replace(/\*\*/g, '').split(/\n+/).forEach(function (raw) {
			var line = raw.trim();
			if (!line) return;
			var m = line.match(/^(?:[-*•]|\d+[.)])\s+(.*)$/);
			if (m) {
				if (!list) { list = document.createElement('ul'); list.className = 'chat__list'; frag.appendChild(list); }
				var li = document.createElement('li');
				li.textContent = m[1];
				list.appendChild(li);
			} else {
				list = null;
				var p = document.createElement('p');
				p.textContent = line;
				frag.appendChild(p);
			}
		});
		return frag;
	}

	function scrollDown() { log.scrollTop = log.scrollHeight; }

	function add(role, text) {
		var row = document.createElement('div');
		row.className = 'chat__msg chat__msg--' + role;
		var body = document.createElement('div');
		body.className = 'chat__text';
		if (role === 'assistant') body.appendChild(render(text));
		else body.textContent = text;
		row.appendChild(body);
		log.appendChild(row);
		scrollDown();
		return row;
	}

	/* Quick replies under the latest answer. Only the newest set is live; older sets go when the visitor replies. */
	function clearChips() {
		log.querySelectorAll('[data-chat-chips]').forEach(function (box) { box.remove(); });
	}

	function chips(list) {
		if (!list || !list.length) return;
		var box = document.createElement('div');
		box.className = 'chat__chips';
		box.setAttribute('data-chat-chips', '');
		list.forEach(function (c) {
			if (!c || !c.label) return;
			var el;
			if (c.href) {
				el = document.createElement('a');
				el.href = c.href;
				if (/^https?:/.test(c.href) && c.href.indexOf(location.origin) !== 0) { el.target = '_blank'; el.rel = 'noopener'; }
			} else {
				el = document.createElement('button');
				el.type = 'button';
				el.addEventListener('click', function () {
					if (c.action === 'prefill') return prefill(c);
					if (c.reset) state = {};
					if (c.state) state = Object.assign({}, state, c.state, { slots: Object.assign({}, state.slots, c.state.slots) });
					ask(c.send || c.label);
				});
			}
			el.className = 'chat__chip' + (c.action ? ' chat__chip--go' : '');
			el.textContent = c.label;
			box.appendChild(el);
		});
		log.appendChild(box);
		scrollDown();
	}

	/* Hand the gathered details to the quote form: here if the page has one, otherwise on the contact page. */
	function fillForm(data) {
		var quote = document.querySelector('[data-quote]');
		if (!quote) return false;
		var sv = quote.querySelector('#sv');
		var ms = quote.querySelector('#ms');
		if (sv && data.service) {
			Array.prototype.forEach.call(sv.options, function (o) { if (o.text.trim() === data.service) sv.value = o.value || o.text; });
		}
		if (ms && data.message) ms.value = data.message;
		var carry = quote.querySelector('[data-carry]');
		if (!carry) {
			carry = document.createElement('p');
			carry.className = 'form__carry';
			carry.setAttribute('data-carry', '');
			carry.setAttribute('role', 'status');
			quote.insertBefore(carry, quote.querySelector('.form__row'));
		}
		carry.textContent = 'What you told the assistant is filled in below. Add your name, company and email to send the request.';
		var section = document.getElementById('quote') || quote;
		section.scrollIntoView({ behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
		var first = quote.querySelector('#fn');
		if (first) setTimeout(function () { first.focus({ preventScroll: true }); }, 500);
		return true;
	}

	function prefill(c) {
		clearChips();
		state = {};
		if (fillForm(c.form)) {
			add('assistant', c.done);
			if (window.matchMedia('(max-width: 640px)').matches) open(false); // the panel covers the form on phones
			return;
		}
		try { sessionStorage.setItem(PREFILL_KEY, JSON.stringify(c.form)); } catch (e) { /* storage blocked: the visitor still lands on the form */ }
		location.href = quoteUrl;
	}

	function setBusy(on) {
		busy = on;
		send.disabled = on;
		input.disabled = on;
	}

	function ask(text) {
		text = (text || '').trim();
		if (!text || busy) return;
		clearChips();
		add('user', text);
		history.push({ role: 'user', content: text });
		input.value = '';
		setBusy(true);

		var pending = document.createElement('div');
		pending.className = 'chat__msg chat__msg--assistant chat__pending';
		pending.innerHTML = '<span class="chat__typing" aria-label="Thinking"><i></i><i></i><i></i></span>';
		log.appendChild(pending);
		scrollDown();

		fetch(endpoint, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify({ messages: history.slice(-10), state: state })
		})
			.then(function (res) { return res.json().catch(function () { return {}; }); })
			.then(function (data) {
				pending.remove();
				if (data.state) state = data.state;
				var reply = data.reply || FALLBACK;
				add('assistant', reply);
				history.push({ role: 'assistant', content: reply });
				chips(data.chips);
			})
			.catch(function () {
				pending.remove();
				add('assistant', FALLBACK);
			})
			.then(function () {
				setBusy(false);
				input.focus();
			});
	}

	toggle.addEventListener('click', function () { open(panel.hidden); });
	close.addEventListener('click', function () { open(false); toggle.focus(); });
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && !panel.hidden) { open(false); toggle.focus(); }
	});
	form.addEventListener('submit', function (e) { e.preventDefault(); ask(input.value); });
	root.querySelectorAll('[data-chat-chips] button').forEach(function (chip) {
		chip.addEventListener('click', function () { ask(chip.textContent); });
	});

	// Arriving on the contact page from the assistant: fill the form with what was gathered on the previous page.
	try {
		var carried = sessionStorage.getItem(PREFILL_KEY);
		if (carried) {
			sessionStorage.removeItem(PREFILL_KEY);
			fillForm(JSON.parse(carried));
		}
	} catch (e) { /* storage blocked or bad data: nothing to fill */ }
})();
