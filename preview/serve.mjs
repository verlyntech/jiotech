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

// ---- Website assistant (mirrors inc/chatbot.php) ----
// Tried in order: the chosen model first, then two free fallbacks on different capacity (NVIDIA Lightning, Google Gemma).
const CHAT_MODELS = ['nvidia/nemotron-3.5-super-vl:free', 'nvidia/nemotron-3.5-lightning:free', 'google/gemma-4-31b-it:free'];
const MAX_TURN = 10, MAX_CHAR = 800, LIMIT = 20;
const hits = new Map(); // ip -> { n, reset }

async function apiKey() {
	if (process.env.OPENROUTER_API_KEY) return process.env.OPENROUTER_API_KEY;
	const env = await readFile(join(root, '.env'), 'utf8').catch(() => '');
	return (env.match(/^OPENROUTER_API_KEY=(.*)$/m) || [])[1]?.trim() || '';
}

function systemPrompt(knowledge) {
	return [
		"You are the website assistant for JIO Technologies LLC. You answer visitors' questions about JIO's services, industries, process and contact details.",
		'Rules:',
		'- Answer only from the facts below. If the answer is not here, say you do not have that information and give the phone number or email so the visitor can ask a person.',
		'- Never invent prices, certifications, licence numbers, client names, ratings, response times or service-level commitments. Those are listed under "not confirmed" and must not be claimed.',
		'- Format every reply as up to four short bullet points, each starting with "- " on its own line. Each bullet is one short sentence (about 15 words at most). No headings, no bold, no paragraphs, no closing pleasantries.',
		'- Give the direct answer first. If the visitor needs more, end with one bullet pointing to the phone number or the quote form.',
		"- Use the visitor's language where possible; if they write in Arabic, reply in Arabic.",
		'- Encourage a quote request through the form on the website or a call to the phone number for anything specific to a site.',
		'- Do not ask for personal, financial or government ID details. If a visitor shares them, tell them not to, and that they should use the quote form or call.',
		'',
		'FACTS:',
		JSON.stringify(knowledge, null, 2),
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
	if (!rateOk(req.socket.remoteAddress || 'unknown')) return sendJson(res, 429, { error: 'limit' });
	let raw = '';
	for await (const c of req) raw += c;
	let body = {};
	try { body = JSON.parse(raw || '{}'); } catch { return sendJson(res, 400, { error: 'empty' }); }
	const messages = cleanMessages(body.messages);
	if (!messages.length || messages[messages.length - 1].role !== 'user') return sendJson(res, 400, { error: 'empty' });
	const key = await apiKey();
	if (!key) return sendJson(res, 503, { error: 'unconfigured' });
	const knowledge = JSON.parse(await readFile(join(root, 'jio-theme/inc/knowledge.json'), 'utf8'));
	const msgs = [{ role: 'system', content: systemPrompt(knowledge) }, ...messages];
	for (const model of CHAT_MODELS) {
		try {
			const r = await fetch('https://openrouter.ai/api/v1/chat/completions', {
				method: 'POST',
				headers: { Authorization: `Bearer ${key}`, 'Content-Type': 'application/json', 'X-Title': 'JIO Technologies website' },
				body: JSON.stringify({ model, max_tokens: 1200, reasoning: { enabled: false }, messages: msgs }),
				signal: AbortSignal.timeout(30000),
			});
			const data = await r.json().catch(() => ({}));
			const reply = (data.choices?.[0]?.message?.content || '').trim();
			if (r.status === 200 && reply) return sendJson(res, 200, { reply });
			console.error(`[chat] ${model} failed: HTTP ${r.status} ${JSON.stringify(data.error || {}).slice(0, 200)}`);
		} catch (e) {
			console.error(`[chat] ${model} failed: ${e.name} ${e.message}`);
		}
	}
	return sendJson(res, 502, { error: 'upstream' });
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
