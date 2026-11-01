// Static preview server for D:\JIO with caching disabled, so reviewers never measure a stale build.
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

createServer(async (req, res) => {
	try {
		let path = decodeURIComponent(new URL(req.url, 'http://x').pathname);
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
