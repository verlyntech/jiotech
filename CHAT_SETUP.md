# Website assistant: Groq backend

## Local testing

Test on the Local site (http://jio.local); the static preview server was removed when the pages moved to Elementor. Set the key the same way as on the host (see WordPress hosting below).

The browser calls only `/wp-json/jio/v1/chat`. Only the backend reads the key and sends it in an Authorization header to `https://api.groq.com/openai/v1/chat/completions`. There is no browser-to-Groq request and no credential in JavaScript, HTML, prompts or API replies. Both upstream errors and credentials are filtered from visitor-facing responses. Cross-origin requests, unsupported content types, forged hostnames, oversized requests and privileged conversation roles are rejected. Model calls have bounded timeouts and per-visitor limits.

`inc/chat-config.json` sets the Groq answer order to `openai/gpt-oss-120b`, `openai/gpt-oss-20b`, then `qwen/qwen3.8-27b`. GPT-OSS uses strict JSON Schema. Qwen uses JSON mode and a smaller output budget for its quota. The backend validates replies from all three. A timeout, model error or unusable answer tries the next model. Rate-limited models pause according to `Retry-After`, capped at one hour. If the whole chain is unavailable, page links and guided quote steps still work. Questions that need an answer model use the existing contact fallback.

## Same assistant features

The existing widget, question-and-answer scrolling, quick replies, service-page buttons, contact/WhatsApp actions, quote slots and form handoff are retained. Approved explicit navigation requests also return links to Company, Partnerships, Industries, service pages and legal pages. Page links come from backend-owned mappings, never arbitrary model URLs; the widget rejects unsafe URL schemes and unrelated external hosts.

The backend supplies the current text of the published pages for every model conversation, alongside the company reference. The pages are built in Elementor, so `jio_chat_page_chunks()` in `inc/chat-security.php` renders each published page once and caches its text until the page is next saved. Scripts, forms and shortcodes are excluded. Only published WordPress pages are read; there is no arbitrary filesystem or URL fetch controlled by a visitor.

`inc/chat-policy.json` holds the boundaries the WordPress implementation applies. Clearly unsafe or instruction-extraction requests are refused before a model call. The model also classifies nuanced unsafe requests; those classifications use a fixed refusal and clear the quote flow. Unrelated subjects get a fixed redirect to JIO. A stop request ends the current quote without another sales question. Legitimate defensive security, IAM and EDR enquiries remain allowed. These are layered safeguards, not a claim that every adversarial phrasing can be detected perfectly.

## WordPress hosting

Deploy the updated `jio-theme` files, including `inc/chatbot.php`, `inc/chat-security.php`, `inc/chat-config.json`, `inc/chat-policy.json`, the catalogues and widget. Never deploy a real `.env` inside the theme or public WordPress directory.

Set `GROQ_API_KEY` in the hosting process environment, or keep a private `.env` outside **both** `ABSPATH` and the server document root. By default the loader checks the parent of `ABSPATH`. To use another private location, set `JIO_ENV_FILE` to its absolute path in `wp-config.php`. A `JIO_GROQ_KEY` constant in private server configuration is also supported. The loader refuses a `.env` located in either public root. Restrict file permissions to the hosting account/PHP process and keep backups private.

The `inc/.htaccess` file denies direct HTTP access to backend files on Apache-compatible hosting. On Nginx, configure the equivalent deny rule for the theme's `/inc/` location; `.htaccess` is not used there. The hosting environment must support WordPress HTTPS outbound calls to Groq. Test the actual WordPress REST route on the host before deployment is considered verified; a local Node test or PHP syntax parse does not run WordPress.

## Validation

There is no automated test suite (the Node tests covered the removed preview copy of the assistant). On Local, check through the widget: a greeting and the quote flow with form handoff, a service question with its page button, explicit navigation to Company and Privacy, an unsafe request (refused before any model call), and a missing or invalid key (contact handoff, no error details shown). Live checks use Groq quota. Never print the real `.env` or an Authorization header during diagnostics.

Provider reference: [Groq Chat API](https://console.groq.com/docs/api-reference), [strict structured outputs](https://console.groq.com/docs/structured-outputs).
