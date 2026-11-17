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

test('office location and embedded map agree on the updated Abu Dhabi address', async () => {
  for (const page of ['index', 'contact']) {
    const html = await (await fetch(base + '/preview/' + page + '.html')).text();
    assert.match(html, /Abdullah Bin Darwish Building, Office No\. 304/);
    assert.match(html, /<iframe[^>]+src="https:\/\/maps\.google\.com\/maps\?/);
    assert.match(html, /<iframe[^>]+loading="lazy"/);
    assert.match(html, /https:\/\/www\.google\.com\/maps\/search\/\?api=1&amp;query=JIO\+Technologies/);
    assert.doesNotMatch(html, /data-map-load|Al Muroor Road/);
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


test('IAM and EDR pages render distinct images that resolve through the preview server', async () => {
  for (const [slug, heading] of [['identity-access-management', 'Identity &amp; access management (IAM)'], ['endpoint-detection-response', 'Endpoint detection &amp; response (EDR)']]) {
    const response = await fetch(base + '/preview/service-' + slug + '.html');
    assert.equal(response.status, 200);
    const html = await response.text();
    assert.ok(html.includes(heading), slug);
    assert.doesNotMatch(html, /class="media-placeholder"/);
    const images = [...html.matchAll(/src="([^" ]*service-(?:iam|edr)-(?:hero|detail)\.webp)"/g)].map(m => m[1]);
    assert.equal(images.length, 2, slug);
    assert.equal(new Set(images).size, 2, slug);
    for (const image of images) {
      const asset = await fetch(new URL(image, base + '/preview/'));
      assert.equal(asset.status, 200, image);
      assert.match(asset.headers.get('content-type'), /^image\/webp/);
    }
    assert.doesNotMatch(html, /\{\{|<\?php|src="[^"]*assets\/img\/"/);
    const services = await (await fetch(base + '/preview/solutions.html')).text();
    assert.ok(services.includes('href="service-' + slug + '.html"'));
  }
});

test('website quote choices match their server allowlist and retain the legacy power value', async () => {
  const allowed = JSON.parse(await readFile(join(root, 'jio-theme/inc/quote-form-options.json'), 'utf8'));
  const html = await (await fetch(base + '/preview/index.html')).text();
  const decode = value => value.replaceAll('&amp;', '&');
  const choices = [...html.matchAll(/<option\b([^>]*)>(.*?)<\/option>/g)]
    .filter(m => m[2] !== 'Choose one')
    .map(m => ({ label: decode(m[2]), value: decode(m[1].match(/value="([^"]*)"/)?.[1] ?? m[2]) }));
  assert.deepEqual(choices.map(c => c.value), allowed);
  assert.equal(choices[0].label, 'Power (UPS and batteries)');
  assert.equal(choices[0].value, 'Power & energy (UPS, batteries, renewables)');
  for (const label of ['Identity & access management (IAM)', 'Endpoint detection & response (EDR)']) {
    assert.ok(choices.some(c => c.label === label));
  }
});

test('rendered pages offer power without renewable copy or old solar illustrations', async () => {
  const { readdir } = await import('node:fs/promises');
  for (const file of (await readdir(join(root, 'preview'))).filter(f => f.endsWith('.html'))) {
    const html = await readFile(join(root, 'preview', file), 'utf8');
    const text = html.replace(/<[^>]*>/g, ' ').replaceAll('BPC Energy', 'BPC');
    assert.doesNotMatch(text, /\b(?:renewable\w*|solar|energy)\b/i, file);
    assert.doesNotMatch(html, /(?:company-vision-campus|service-power-hero|home-service-power-equipment|service-consulting-detail|service-consulting-hero|careers-learning-lab)\.webp/, file);
  }
});
