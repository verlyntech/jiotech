// Static preview server for D:\JIO with caching disabled, so reviewers never measure a stale build.
// Also answers POST /wp-json/jio/v1/chat the way inc/chatbot.php does, so the website assistant works in the preview.
// The API key is read from .env (git-ignored) and never sent to the browser.
// Usage: node preview/serve.mjs [port]   (default 5173), then open http://localhost:5173/preview/
import { createServer } from 'node:http';
import { readFile, stat } from 'node:fs/promises';
import { extname, join, normalize, resolve, sep } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(fileURLToPath(new URL('..', import.meta.url)));
const port = Number(process.argv[2]) || 5173;
const types = {
	'.html': 'text/html; charset=utf-8', '.css': 'text/css; charset=utf-8', '.js': 'text/javascript; charset=utf-8',
	'.mjs': 'text/javascript; charset=utf-8', '.json': 'application/json', '.svg': 'image/svg+xml',
	'.png': 'image/png', '.jpg': 'image/jpeg', '.jpeg': 'image/jpeg', '.webp': 'image/webp', '.ico': 'image/x-icon',
	'.md': 'text/plain; charset=utf-8', '.txt': 'text/plain; charset=utf-8',
};

// ---- Website assistant (mirrors inc/chatbot.php; the intent catalog is jio-theme/inc/intents.json, design in CHATBOT.md) ----
// Intent first, response second: each message is routed by rules (a pending quote question, or an exact catalog example)
// or classified by the model, then the dialogue manager decides the reply: a template, the quote flow, the fallback
// ladder, or the model's own answer. Models are tried in order: the chosen one, then two free fallbacks on other capacity.
const CHAT_MODELS = ['nvidia/nemotron-3.5-super-vl:free', 'nvidia/nemotron-3.5-lightning:free', 'google/gemma-4-31b-it:free'];
const MAX_TURN = 10, MAX_CHAR = 800, LIMIT = 20; // LIMIT counts model calls per visitor per hour
const hits = new Map(); // ip -> { n, reset }
const ARABIC = /[؀-ۿ]/;

async function apiKey() {
	if (process.env.OPENROUTER_API_KEY) return process.env.OPENROUTER_API_KEY;
	const env = await readFile(join(root, '.env'), 'utf8').catch(() => '');
	return (env.match(/^OPENROUTER_API_KEY=(.*)$/m) || [])[1]?.trim() || '';
}

const norm = (s) => String(s).toLowerCase().replace(/[^\p{L}\p{N}\s]/gu, ' ').replace(/\s+/g, ' ').trim();

/** Fill {phone}, {email} and the like from the knowledge file. */
function fill(str, k) {
	const c = k.company;
	const vars = { phone: c.phone, phone_raw: c.phone.replace(/\s+/g, ''), email: c.email, office: c.office, whatsapp: c.whatsapp, home: '/' };
	return String(str).replace(/\{(\w+)\}/g, (m, v) => (v in vars ? vars[v] : m));
}

function systemPrompt(k, cat, state) {
	const intents = Object.entries(cat.intents).map(([name, d]) =>
		`- ${name}: ${d.description}${d.examples.length ? ' e.g. "' + d.examples.slice(0, 3).join('", "') + '"' : ''}`);
	const slots = cat.quote.slots.map((s) => `- ${s.key}: ${s.options.length ? 'one of ' + JSON.stringify(s.options) : 'short free text, such as "40 kVA", "3 racks" or "200 users"'}`
		+ (s.covers ? s.options.map((o, i) => `\n    "${o}" covers ${s.covers[i]}`).join('') : ''));
	slots.push('- If the service does not clearly map to one option, leave it out rather than guess. For service_info, never use "Not sure, or several".');
	const flow = state.flow === 'quote'
		? `A quote request is in progress. Details so far: ${JSON.stringify(state.slots)}. Waiting for: ${state.asked || 'nothing'}. If the visitor answers that question, use intent request_quote and fill that slot.`
		: 'No quote request is in progress.';
	return [
		"You are the website assistant for JIO Technologies LLC. You answer visitors' questions about JIO's services, industries, process and contact details.",
		'Work in two steps: first decide what the visitor wants (the intent), then write the reply.',
		'Return only one JSON object and nothing else, in this shape:',
		'{"intent": "<intent name>", "slots": {}, "suggest": [], "reply": "<reply text>"}',
		'',
		'INTENTS (pick exactly one name):',
		...intents,
		'',
		'SLOTS: only for request_quote (any of them) and service_info (service only), and only details the visitor actually stated:',
		...slots,
		'',
		'SUGGEST: only for fallback: up to three intent names the visitor most likely meant.',
		'',
		'STATE: ' + flow,
		'',
		'REPLY RULES:',
		'- Answer only from the facts below. If the answer is not here, say you do not have that information and give the phone number or email so the visitor can ask a person.',
		'- Never invent prices, certifications, licence numbers, client names, ratings, response times or service-level commitments. Those are listed under "not confirmed" and must not be claimed.',
		'- Match the format to the question. A simple question (yes or no, or a single fact) gets one or two plain sentences with no bullets. Use bullets only when listing several items or steps: up to four, each starting with "- " on its own line and one short sentence (about 15 words at most). Keep every reply under about 60 words. No headings, no bold, no closing pleasantries, no follow-up question.',
		'- Give the direct answer first.',
		'- For request_quote, the reply only acknowledges and asks for the next missing detail, in this order: service, site, scale, timeline.',
		'- For fallback, the reply is one short line asking the visitor to rephrase.',
		'- If the visitor writes in Arabic, write the reply in Arabic. Intent and slot values stay in English.',
		'- Do not ask for personal, financial or government ID details. If a visitor shares them, tell them not to, and that they should use the quote form or call.',
		'',
		'FACTS:',
		JSON.stringify(k, null, 2),
	].join('\n');
}

function cleanMessages(raw) {
	if (!Array.isArray(raw)) return [];
	return raw.slice(-MAX_TURN).map((m) => {
		const role = m && m.role === 'assistant' ? 'assistant' : 'user';
		const text = String((m && m.content) || '').replace(/<[^>]*>/g, '').trim();
		return text ? { role, content: text.slice(0, MAX_CHAR) } : null;
	}).filter(Boolean);
}

/** Keep only slot values the catalog allows: an option slot must hold one of its options. "" means skipped, which only
    the Skip chip can set, so it is dropped from the model's output (allowSkipped false). */
function cleanSlots(raw, cat, allowSkipped = false) {
	const out = {};
	if (!raw || typeof raw !== 'object') return out;
	for (const s of cat.quote.slots) {
		if (!(s.key in raw) || raw[s.key] == null) continue;
		const v = String(raw[s.key]).replace(/<[^>]*>/g, '').trim().slice(0, 120);
		if (v === '') { if (allowSkipped) out[s.key] = v; continue; }
		if (!s.options.length) { out[s.key] = v; continue; }
		const hit = s.options.find((o) => norm(o) === norm(v));
		if (hit) out[s.key] = hit;
	}
	return out;
}

/** The state the browser hands back each turn. Never trusted: every field is re-validated. */
function cleanState(raw, cat) {
	raw = raw && typeof raw === 'object' ? raw : {};
	const keys = cat.quote.slots.map((s) => s.key);
	return {
		flow: raw.flow === 'quote' ? 'quote' : '',
		asked: [...keys, 'confirm'].includes(raw.asked) ? raw.asked : '',
		slots: cleanSlots(raw.slots, cat, true),
		misses: Math.min(Math.max(parseInt(raw.misses, 10) || 0, 0), 5),
	};
}

/** Rule layer 1: an exact (normalised) catalog example. */
function ruleIntent(text, cat) {
	const n = norm(text);
	if (!n) return null;
	for (const [name, d] of Object.entries(cat.intents)) if (d.examples.some((e) => norm(e) === n)) return name;
	return null;
}

/** Rule layer 2: an answer to the quote question just asked (an option, "Skip", or free text for the size). */
function slotAnswer(text, state, cat) {
	if (state.flow !== 'quote') return null;
	const slot = cat.quote.slots.find((s) => s.key === state.asked);
	if (!slot) return null;
	const n = norm(text);
	if (n === norm(cat.quote.skip)) return { [slot.key]: '' };
	const i = slot.options.findIndex((o, j) => norm(o) === n || (slot.short && norm(slot.short[j]) === n));
	if (i > -1) return { [slot.key]: slot.options[i] };
	if (!slot.options.length && !text.includes('?') && !ruleIntent(text, cat)) return { [slot.key]: text.trim().slice(0, 120) };
	return null;
}

function chip(key, cat, k, turnSlots) {
	const c = cat.chips[key];
	if (!c) return null;
	const out = { label: fill(c.label, k) };
	if (c.send) out.send = c.send;
	if (c.href) out.href = fill(c.href, k);
	if (c.action) out.action = c.action;
	if (c.reset) out.reset = true;
	if (c.slots_from_turn && turnSlots.service) out.state = { slots: { service: turnSlots.service } };
	return out;
}

/** Quote flow (slot filling): ask for the next missing detail, then confirm and hand the details to the form. */
function quoteStep(state, newSlots, modelReply, ar, cat) {
	const entering = state.flow !== 'quote';
	state.flow = 'quote';
	Object.assign(state.slots, newSlots);
	const next = cat.quote.slots.find((s) => !(s.key in state.slots));
	const lead = entering ? cat.quote.intro : cat.quote.ack;
	let reply, chips;
	if (next) {
		state.asked = next.key;
		reply = `${lead}\n${next.question}`;
		chips = next.options.map((o, i) => ({ label: (next.short && next.short[i]) || o, send: (next.short && next.short[i]) || o }));
		chips.push({ label: cat.quote.skip, send: cat.quote.skip });
	} else {
		state.asked = 'confirm';
		const given = cat.quote.slots.filter((s) => state.slots[s.key]);
		reply = [cat.quote.confirm, ...given.map((s) => `- ${s.label}: ${state.slots[s.key]}`)].join('\n');
		const service = state.slots.service || cat.quote.slots[0].options.at(-1);
		const message = given.filter((s) => s.key !== 'service').map((s) => `${s.label}: ${state.slots[s.key]}`).join('\n');
		chips = [
			{ label: cat.chips.open_form.label, action: 'prefill', form: { service, message }, done: cat.quote.done },
			{ label: cat.chips.restart_quote.label, send: cat.chips.restart_quote.send, reset: true },
		];
	}
	if (ar && modelReply) reply = modelReply; // Arabic: the model's reply carries the same question
	return { reply, chips };
}

/** Dialogue manager: decide the reply and quick replies for a classified turn. */
function manage(turn, state, cat, k) {
	const { intent, slots, modelReply, suggest, ar } = turn;
	const def = cat.intents[intent];
	if (intent === 'fallback') {
		state.misses++;
		if (state.misses >= 2) { // second miss in a row: hand off to a person
			state.misses = 0;
			return { reply: fill(cat.fallback.second, k), chips: ['call', 'email', 'whatsapp'].map((c) => chip(c, cat, k, {})), handoff: true };
		}
		const picks = (suggest.length ? suggest : cat.fallback.default_suggest).map((i) => cat.fallback.suggest_chips[i]).filter(Boolean);
		return { reply: fill(cat.fallback.first, k), chips: [...new Set(picks)].slice(0, 3).map((c) => chip(c, cat, k, {})) };
	}
	state.misses = 0;
	if (def.handler === 'quote') return quoteStep(state, slots, modelReply, ar, cat);
	let reply = def.handler === 'template' ? fill(def.reply, k) : modelReply;
	if (ar && modelReply) reply = modelReply;
	if (!reply) reply = fill(cat.unavailable, k);
	const chips = def.chips.map((c) => chip(c, cat, k, slots)).filter(Boolean);
	if (state.flow === 'quote' && state.asked) chips.unshift(chip('continue_quote', cat, k, {})); // a side question pauses the quote, it doesn't lose it
	return { reply, chips: chips.slice(0, 4) };
}

/** Parse the model's JSON. Anything malformed is handled, never shown raw. */
function parseModel(text, cat) {
	const t = String(text || '').replace(/^```(?:json)?|```$/gm, '').trim();
	let o = null;
	try { o = JSON.parse(t.slice(t.indexOf('{'), t.lastIndexOf('}') + 1)); } catch { o = null; }
	if (!o || typeof o !== 'object') return t && !t.startsWith('{') ? { intent: 'services_overview', slots: {}, suggest: [], modelReply: t } : null;
	const intent = cat.intents[o.intent] ? o.intent : 'fallback';
	return {
		intent,
		slots: cleanSlots(o.slots, cat),
		suggest: Array.isArray(o.suggest) ? o.suggest.filter((i) => cat.intents[i] && i !== 'fallback') : [],
		modelReply: typeof o.reply === 'string' ? o.reply.trim() : '',
	};
}

async function callModel(key, msgs) {
	for (const model of CHAT_MODELS) {
		try {
			const r = await fetch('https://openrouter.ai/api/v1/chat/completions', {
				method: 'POST',
				headers: { Authorization: `Bearer ${key}`, 'Content-Type': 'application/json', 'X-Title': 'JIO Technologies website' },
				body: JSON.stringify({ model, max_tokens: 1200, reasoning: { enabled: false }, response_format: { type: 'json_object' }, messages: msgs }),
				signal: AbortSignal.timeout(30000),
			});
			const data = await r.json().catch(() => ({}));
			const content = (data.choices?.[0]?.message?.content || '').trim();
			if (r.status === 200 && content) return content;
			console.error(`[chat] ${model} failed: HTTP ${r.status} ${JSON.stringify(data.error || {}).slice(0, 200)}`);
		} catch (e) {
			console.error(`[chat] ${model} failed: ${e.name} ${e.message}`);
		}
	}
	return null;
}

function rateOk(ip) {
	const now = Date.now();
	const h = hits.get(ip) || { n: 0, reset: now + 3600e3 };
	if (now > h.reset) { h.n = 0; h.reset = now + 3600e3; }
	if (h.n >= LIMIT) { hits.set(ip, h); return false; }
	h.n++; hits.set(ip, h); return true;
}

function sendJson(res, code, obj) {
	res.writeHead(code, { 'Content-Type': 'application/json', 'Cache-Control': 'no-store' });
	res.end(JSON.stringify(obj));
}

async function chat(req, res) {
	let raw = '';
	for await (const c of req) raw += c;
	let body = {};
	try { body = JSON.parse(raw || '{}'); } catch { return sendJson(res, 400, { error: 'empty' }); }
	const messages = cleanMessages(body.messages);
	if (!messages.length || messages[messages.length - 1].role !== 'user') return sendJson(res, 400, { error: 'empty' });
	const k = JSON.parse(await readFile(join(root, 'jio-theme/inc/knowledge.json'), 'utf8'));
	const cat = JSON.parse(await readFile(join(root, 'jio-theme/inc/intents.json'), 'utf8'));
	const state = cleanState(body.state, cat);
	const last = messages[messages.length - 1].content;
	const ar = ARABIC.test(last);
	// Model unavailable or limit reached: point to a person, and keep a paused quote one tap away (its questions need no model).
	const handoff = (reply) => ({ reply: fill(reply, k), chips: [...(state.flow === 'quote' ? ['continue_quote'] : []), 'call', 'email', 'whatsapp'].map((c) => chip(c, cat, k, {})) });

	// 1. Rules first: a pending quote answer, then an exact catalog example. Arabic goes to the model so it can reply in Arabic.
	let turn = null, via = 'rule';
	const answered = ar ? null : slotAnswer(last, state, cat);
	const ruled = ar || answered ? null : ruleIntent(last, cat);
	if (answered) turn = { intent: 'request_quote', slots: answered, suggest: [], modelReply: '' };
	else if (ruled && cat.intents[ruled].handler !== 'model') turn = { intent: ruled, slots: {}, suggest: [], modelReply: '' };
	else {
		// 2. The model classifies and extracts; for model-handled intents it also writes the answer.
		via = 'model';
		if (!rateOk(req.socket.remoteAddress || 'unknown')) return sendJson(res, 429, { ...handoff(cat.limit), intent: 'limit', state });
		const key = await apiKey();
		const content = key ? await callModel(key, [{ role: 'system', content: systemPrompt(k, cat, state) }, ...messages]) : null;
		turn = content ? parseModel(content, cat) : null;
		// Model down but the message matched an intent: give its checked offline answer rather than a dead end.
		if (!turn && ruled && cat.intents[ruled].offline) turn = { intent: ruled, slots: {}, suggest: [], modelReply: fill(cat.intents[ruled].offline, k) };
		if (!turn) {
			console.error('[chat] no usable model reply');
			return sendJson(res, 200, { ...handoff(cat.unavailable), intent: 'unavailable', state });
		}
		if (ruled && turn.intent !== ruled) turn.intent = ruled; // an exact example outranks the model's guess
	}
	turn.ar = ar;

	// 3. Dialogue manager.
	const out = manage(turn, state, cat, k);
	console.log(`[chat] intent=${turn.intent} via=${via}${out.handoff ? ' handoff' : ''}${state.flow ? ` flow=${state.flow}:${state.asked}` : ''}`);
	return sendJson(res, 200, { reply: out.reply, chips: out.chips, intent: turn.intent, state });
}

createServer(async (req, res) => {
	try {
		const url = new URL(req.url, 'http://x');
		if (req.method === 'POST' && url.pathname === '/wp-json/jio/v1/chat') return await chat(req, res);
		let path = decodeURIComponent(url.pathname);
		let file = normalize(join(root, path));
		if (file !== root && !file.startsWith(root + sep)) { res.writeHead(403).end('Forbidden'); return; }
		const info = await stat(file).catch(() => null);
		if (info && info.isDirectory()) file = join(file, 'index.html');
		const body = await readFile(file);
		res.writeHead(200, {
			'Content-Type': types[extname(file).toLowerCase()] || 'application/octet-stream',
			'Cache-Control': 'no-store, max-age=0',
		});
		res.end(req.method === 'HEAD' ? undefined : body);
	} catch {
		res.writeHead(404, { 'Content-Type': 'text/plain', 'Cache-Control': 'no-store' }).end('Not found');
	}
}).listen(port, () => console.log(`Preview: http://localhost:${port}/preview/  (no-store, root ${root})`));
