/* JIO website assistant widget. Talks to the server-side proxy; the API key never reaches the browser.
   Replies are built with DOM text nodes, never innerHTML. Lines starting with "- " become a bullet list. */
(function () {
	'use strict';

	var root = document.querySelector('[data-chat]');
	if (!root) return;

	var endpoint = root.getAttribute('data-endpoint');
	var toggle = root.querySelector('[data-chat-toggle]');
	var panel = root.querySelector('[data-chat-panel]');
	var close = root.querySelector('[data-chat-close]');
	var log = root.querySelector('[data-chat-log]');
	var chipsBox = root.querySelector('[data-chat-chips]');
	var form = root.querySelector('[data-chat-form]');
	var input = root.querySelector('[data-chat-input]');
	var send = root.querySelector('[data-chat-send]');
	var history = [];
	var busy = false;

	var FALLBACK = '- I cannot answer right now.\n- Call +971 55 344 0144 or email sales@jiotechuae.com.';

	function open(state) {
		panel.hidden = !state;
		root.classList.toggle('is-open', state);
		toggle.setAttribute('aria-expanded', state ? 'true' : 'false');
		toggle.setAttribute('aria-label', state ? 'Close chat' : 'Open chat');
		if (state) input.focus();
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

	function add(role, text) {
		var row = document.createElement('div');
		row.className = 'chat__msg chat__msg--' + role;
		var body = document.createElement('div');
		body.className = 'chat__text';
		if (role === 'assistant') body.appendChild(render(text));
		else body.textContent = text;
		row.appendChild(body);
		log.appendChild(row);
		log.scrollTop = log.scrollHeight;
		return row;
	}

	function setBusy(state) {
		busy = state;
		send.disabled = state;
		input.disabled = state;
	}

	function ask(text) {
		text = (text || '').trim();
		if (!text || busy) return;
		if (chipsBox) { chipsBox.remove(); chipsBox = null; }
		add('user', text);
		history.push({ role: 'user', content: text });
		input.value = '';
		setBusy(true);

		var pending = document.createElement('div');
		pending.className = 'chat__msg chat__msg--assistant chat__pending';
		pending.innerHTML = '<span class="chat__typing" aria-label="Thinking"><i></i><i></i><i></i></span>';
		log.appendChild(pending);
		log.scrollTop = log.scrollHeight;

		fetch(endpoint, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify({ messages: history.slice(-10) })
		})
			.then(function (res) {
				return res.json().catch(function () { return {}; }).then(function (data) {
					return { ok: res.ok, status: res.status, data: data };
				});
			})
			.then(function (r) {
				pending.remove();
				if (r.ok && r.data.reply) {
					add('assistant', r.data.reply);
					history.push({ role: 'assistant', content: r.data.reply });
				} else if (r.status === 429) {
					add('assistant', '- You have sent a lot of messages this hour.\n- Call +971 55 344 0144 or email sales@jiotechuae.com.');
				} else {
					add('assistant', FALLBACK);
				}
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
	root.querySelectorAll('[data-chat-chip]').forEach(function (chip) {
		chip.addEventListener('click', function () { ask(chip.textContent); });
	});
})();
