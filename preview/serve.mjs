// Static preview server for D:\JIO with caching disabled, so reviewers never measure a stale build.
// Also answers POST /wp-json/jio/v1/chat the way inc/chatbot.php does, so the website assistant works in the preview.
// The API key is read from .env (git-ignored) and never sent to the browser.
// Usage: node preview/serve.mjs [port]   (default 5173), then open http://localhost:5173/preview/
import { createServer } from 'node:http';
import { readFile, stat, realpath } from 'node:fs/promises';
import { extname, join, normalize, resolve, sep } from 'node:path';
import { fileURLToPath, pathToFileURL } from 'node:url';

const root = resolve(fileURLToPath(new URL('..', import.meta.url)));
const port = Number(process.argv[2]) || 5173;
const types = {
	'.mp4': 'video/mp4',
	'.html': 'text/html; charset=utf-8', '.css': 'text/css; charset=utf-8', '.js': 'text/javascript; charset=utf-8',
	'.mjs': 'text/javascript; charset=utf-8', '.json': 'application/json', '.svg': 'image/svg+xml',
	'.png': 'image/png', '.jpg': 'image/jpeg', '.jpeg': 'image/jpeg', '.webp': 'image/webp', '.ico': 'image/x-icon',
	'.md': 'text/plain; charset=utf-8', '.txt': 'text/plain; charset=utf-8',
};

import { createChatHandler, sendJson } from './chat.mjs';

// Only public website files are downloadable; backend modules and secrets are excluded.
export function isPublicPath(path) {
    if (/^\/preview\/(?:index|solutions|industries|about|contact|client-support|faq|careers|partnerships|privacy-policy|terms-conditions|404)\.html$/.test(path)) return true;
    if (/^\/preview\/service-(?:power-energy-solutions|web-development|network-connectivity-solutions|cyber-security|managed-services|maintenance-technical-support|it-consulting-advisory|digital-transformation|business-process-automation|cloud-saas-transformation|identity-access-management|endpoint-detection-response)\.html$/.test(path)) return true;
    return /^\/jio-theme\/assets\/(?:css|js|img|logos|video)\/[a-z0-9_-]+(?:\/[a-z0-9_-]+)*\.(?:css|js|png|jpe?g|webp|svg|ico|woff2?|ttf|mp4)$/i.test(path);
}

export function createPreviewServer({ root: websiteRoot = root, chatOptions = {} } = {}) {
    const root = websiteRoot;
    const chat = createChatHandler({ ...chatOptions, root });
    const server = createServer(async (req, res) => {
        try {
            const host = new URL('http://' + (req.headers.host || 'invalid'));
            const currentPort = String(server.address().port);
            if (!['localhost', '127.0.0.1', '[::1]'].includes(host.hostname) || host.port !== currentPort) return sendJson(res, 403, { error: 'host' });
            if (req.headers.origin && !['http://localhost:' + currentPort, 'http://127.0.0.1:' + currentPort, 'http://[::1]:' + currentPort].includes(req.headers.origin)) return sendJson(res, 403, { error: 'origin' });
            const url = new URL(req.url, host);
            if (url.pathname === '/wp-json/jio/v1/chat') {
                if (req.method !== 'POST') return sendJson(res, 405, { error: 'method' });
                if (!/^application\/json(?:;|$)/i.test(req.headers['content-type'] || '')) return sendJson(res, 415, { error: 'content_type' });
                return await chat(req, res);
            }
            if (!['GET', 'HEAD'].includes(req.method)) return sendJson(res, 405, { error: 'method' });
            let path = decodeURIComponent(url.pathname);
            if (path === '/' || path === '/preview') { res.writeHead(302, { Location: '/preview/', 'Cache-Control': 'no-store' }).end(); return; }
            if (path === '/preview/') path = '/preview/index.html';
            if (!isPublicPath(path)) return sendJson(res, 404, { error: 'not_found' });
            const file = await realpath(normalize(join(root, path)));
            if (!file.startsWith(root + sep) || !isPublicPath('/' + file.slice(root.length + 1).replaceAll('\\', '/'))) return sendJson(res, 404, { error: 'not_found' });
            if (!(await stat(file)).isFile()) return sendJson(res, 404, { error: 'not_found' });
            const body = await readFile(file);
            res.writeHead(200, { 'Content-Type': types[extname(file).toLowerCase()] || 'application/octet-stream', 'Cache-Control': 'no-store, max-age=0', 'X-Content-Type-Options': 'nosniff', 'Referrer-Policy': 'same-origin' });
            res.end(req.method === 'HEAD' ? undefined : body);
        } catch {
            if (!res.headersSent) sendJson(res, 404, { error: 'not_found' });
            else res.end();
        }
    });
    server.requestTimeout = 35000;
    server.headersTimeout = 10000;
    return server;
}

export function startPreviewServer({ port: chosenPort = port } = {}) {
    const server = createPreviewServer();
    server.listen(chosenPort, '127.0.0.1', () => console.log(`Preview: http://localhost:${server.address().port}/preview/ (local access only)`));
    return server;
}

if (process.argv[1] && import.meta.url === pathToFileURL(resolve(process.argv[1])).href) startPreviewServer();
