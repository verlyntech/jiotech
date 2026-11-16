// Local launch entry point. The shared server owns static-file protection and the chat API.
import { watch } from 'node:fs';
import { execFileSync } from 'node:child_process';
import { fileURLToPath } from 'node:url';
import { join } from 'node:path';
import { startPreviewServer } from './preview/serve.mjs';

const root = fileURLToPath(new URL('.', import.meta.url));
function build() {
	try { execFileSync(process.execPath, [join(root, 'preview/build.mjs')], { cwd: root, stdio: 'inherit' }); }
	catch { console.error('Preview build failed.'); }
}
build();
const server = startPreviewServer();
let debounce;
const watcher = watch(join(root, 'jio-theme'), { recursive: true }, (_, filename) => {
	if (filename && /\.(?:php|css|js|json)$/.test(filename)) {
		clearTimeout(debounce);
		debounce = setTimeout(build, 200);
	}
});
server.on('close', () => { clearTimeout(debounce); watcher.close(); });
