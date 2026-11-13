import test, { before, after } from 'node:test';
import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import { once } from 'node:events';
import { fileURLToPath } from 'node:url';
import { resolve, join } from 'node:path';
import { createPreviewServer, isPublicPath } from '../preview/serve.mjs';

const root = resolve(fileURLToPath(new URL('..', import.meta.url)));
let server, base;
before(async () => {
  server = createPreviewServer();
  server.listen(0, '127.0.0.1');
  await once(server, 'listening');
  base = 'http://127.0.0.1:' + server.address().port;
});
after(() => new Promise(done => { server.closeAllConnections(); server.close(done); }));

test('all generated service pages open as HTML through the local preview server', async () => {
  const { pages } = JSON.parse(await readFile(join(root, 'jio-theme/inc/service-pages.json'), 'utf8'));
  for (const { slug } of pages) {
    const path = '/preview/service-' + slug + '.html';
    const response = await fetch(base + path);
    assert.equal(response.status, 200, path);
    assert.match(response.headers.get('content-type'), /^text\/html/, path);
    assert.match(await response.text(), /<h1[ >]/, path);
    const head = await fetch(base + path, { method: 'HEAD' });
    assert.equal(head.status, 200, path);
    assert.equal(await head.text(), '', path);
  }
});

test('Careers and Partnerships previews open too', async () => {
  for (const page of ['careers', 'partnerships']) {
    const response = await fetch(base + '/preview/' + page + '.html');
    assert.equal(response.status, 200, page);
    assert.match(response.headers.get('content-type'), /^text\/html/);
  }
});

test('unknown routes and private backend paths stay unavailable', async () => {
  for (const path of ['/preview/service-not-a-service.html', '/preview/private.html', '/.env', '/.git/config', '/preview/chat.mjs', '/jio-theme/inc/chat-config.json', '/jio-theme/functions.php']) {
    assert.equal(isPublicPath(path), false, path);
    assert.equal((await fetch(base + path)).status, 404, path);
  }
});


test('legal pages and privacy consent links resolve to real pages', async () => {
  for (const page of ['privacy-policy', 'terms-conditions']) {
    const response = await fetch(base + '/preview/' + page + '.html');
    assert.equal(response.status, 200, page);
    const html = await response.text();
    assert.match(html, /<main id="main" class="legal-page">/);
    assert.equal((html.match(/class="legal-section"/g) || []).length, 7);
    assert.doesNotMatch(html, /<\?php/);
  }
  for (const page of ['index', 'contact', 'client-support']) {
    const html = await (await fetch(base + '/preview/' + page + '.html')).text();
    assert.match(html, /href="privacy-policy\.html"/);
    assert.doesNotMatch(html, /href="#(?:privacy-policy|terms-conditions)"/);
  }
});

test('office location is shared and the map stays unloaded until requested', async () => {
  for (const page of ['index', 'contact']) {
    const html = await (await fetch(base + '/preview/' + page + '.html')).text();
    assert.match(html, /data-map-load/);
    assert.match(html, /<iframe[^>]+data-src="https:\/\/maps\.google\.com\/maps\?/);
    assert.doesNotMatch(html, /<iframe[^>]+\ssrc=/);
    assert.match(html, /https:\/\/maps\.app\.goo\.gl\/xPxPg9DrjFnqj5Fr6/);
  }
});

test('GitHub chatbot greeting still uses its checked intent reply', async () => {
  const response = await fetch(base + '/wp-json/jio/v1/chat', {
    method: 'POST', headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ messages: [{ role: 'user', content: 'hello' }] })
  });
  assert.equal(response.status, 200);
  const data = await response.json();
  assert.equal(data.intent, 'greeting');
  assert.match(data.reply, /power, IT, security and support/);
  assert.ok(data.chips.length);
});
