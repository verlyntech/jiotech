# Chatbot Design: JIO website assistant

The website assistant for jiotechuae.com answers enterprise and government buyers' questions about JIO's power and IT services and turns interest into a filled-in quote form. It follows the `cs-chatbot-design` skill (`.claude/skills/cs-chatbot-design/SKILL.md`): intent first, response second.

**Pipeline:** visitor message → rules → model (only if no rule matched) → dialogue manager → reply and quick replies.

1. **Rules (no model call, about 10 ms).**
   - If a quote question is pending and the message answers it (one of the options, "Skip", or free text for the size), the answer fills that slot.
   - Otherwise, if the message exactly matches a catalog example (lower case, punctuation removed), it gets that example's intent. Every chip the assistant sends matches an example, so tapping a chip never needs the model to classify it.
2. **Model (about 1 to 1.5 s).** The model returns JSON with four fields: `intent`, `slots`, `suggest` and `reply`.
   - The server checks the intent against the catalog; an unknown name becomes `fallback`.
   - It drops any slot value that isn't one of the allowed options.
   - It never shows malformed output to the visitor.
   - An exact example match outranks the model's intent guess.
3. **Dialogue manager.** Each intent has a handler:
   - `template`: a fixed, verified reply, filled in with contact details from the knowledge file.
   - `model`: the model's answer, grounded in `knowledge.json`.
   - `quote`: slot filling.
   - `fallback`: the miss ladder described under Fallback Strategy.

   Each handler also sets the quick replies (chips).

The browser sends the state back with every message: flow, pending question, filled slots and miss count. The server re-validates all of it, because it comes from the client.

| File | Role |
|---|---|
| `jio-theme/inc/intents.json` | Intent catalog, examples, chips, quote slots, fallback and handoff copy |
| `jio-theme/inc/knowledge.json` | Facts the model may use: company, a map of every page and its path, services, why choose JIO, industries and industry expertise, vendors, partnerships, process, the same 12 questions as the FAQ page, and the `not_confirmed` list it must never claim |
| `jio-theme/inc/chatbot.php` | WordPress endpoint `/wp-json/jio/v1/chat` |
| `preview/serve.mjs` | The same engine for the static preview |
| `jio-theme/assets/js/chat.js` | Widget: renders replies and chips, keeps the state, prefills the quote form |

## Intent Catalog

| Intent | Description | Example Utterances | Handler | Priority |
|---|---|---|---|---|
| `request_quote` | Wants a quote or proposal, or to continue or restart one | "Get a quote", "We need a UPS for our Dubai warehouse" | quote | H |
| `service_info` | One service: UPS, batteries, data center, cloud, security, network, CCTV, managed IT, procurement | "Do you install UPS systems", "Can you design a data center" | model | H |
| `existing_support` | Existing customer with a fault, outage or support need | "Our UPS is beeping", "The server is down" | template | H |
| `services_overview` | What JIO does overall | "What do you offer", "Who are you" | model | H |
| `contact_location` | Phone, email, WhatsApp, address | "Where is your office", "How do I contact you" | template | H |
| `talk_to_human` | Asks for a person or a call back | "Talk to a human", "Call me back" | template | H |
| `pricing_and_claims` | Prices, certifications, SLAs, clients, years: unconfirmed facts | "How much does a UPS cost", "Are you ISO certified" | model | M |
| `industries` | Sectors served, including government and SMEs | "Do you work with government", "Do you work with hospitals" | model | M |
| `vendors_brands` | Manufacturers JIO supplies | "Which brands do you supply", "Do you sell APC" | model | M |
| `process` | How an engagement runs | "How does it work", "Do you visit the site" | model | M |
| `careers_partners` | Jobs, resellers, the B2B portal | "Are you hiring", "I am a reseller" | model | L |
| `greeting` | Hello, thanks, bye | "Hi", "Salam", "Thank you" | template | L |
| `out_of_scope` | Unrelated to JIO | "Tell me a joke", "Write Python code" | model | L |
| `fallback` | Unclear or garbled | n/a | fallback | H |

Each intent has 8 to 12 examples in `intents.json`. The model sees three per intent in its prompt; the rule layer matches all of them.

## Dialogue Flows

### Quote request (multi-turn slot filling, then confirmation)

This flow can't make anything up: every question and option comes from `intents.json`, and only the visitor's own answers fill the slots.

1. User: "Get a quote" (chip or typed).
2. Bot: "Happy to set that up. A few quick questions, then I'll fill in the quote form for you. What do you need?" Chips: Power & UPS / Data center / Security & CCTV / Network / Managed IT & support / Consulting & cloud / Not sure / Skip.
3. User: "Power & UPS".
4. Bot: "Got it. Where is the site?" Chips: Abu Dhabi / Dubai / Elsewhere in the UAE / Outside the UAE / Skip.
5. User: "Sharjah". This isn't an option, so the model maps it to "Elsewhere in the UAE".
6. Bot: "Got it. Roughly how big is it? For example the load in kVA, the number of racks, users or sites." Chip: Skip.
7. User: "about 40 kVA for two server rooms". This is taken as free text, without the model.
8. Bot: "When do you need it?" Chips: Urgently / Within 3 months / Later this year / Just planning / Skip.
9. User: "Within 3 months".
10. Bot (confirmation): "Here is what I have. Open the quote form with these details?" The details are listed as bullets. Chips: **Open the quote form** (green) / Start over.
11. User taps Open the quote form.
    - If the page has the form (home, contact), the bot selects the service, writes the other details into "What do you need to keep running?", scrolls to the form and focuses First name.
    - On any other page, it carries the details to `/contact/#quote` in `sessionStorage` and fills the form there.
    - Then the bot says: "The form is filled in below. Add your name, company and email, then send it."

**Shortcuts and detours:**

- **One-message request.** "We need a UPS for our Dubai warehouse, quote please" fills service and site in one turn, and the bot only asks what's missing.
- **Side question mid-flow.** The bot answers the question and keeps the quote paused: a **Continue my quote** chip leads the reply.
- **Personal details.** The assistant never collects name, email or phone; the visitor types those into the form themselves.

### Information question (single turn)

1. User: "Do you work with hospitals?"
2. Bot: the direct answer first, drawn only from `knowledge.json`: one or two sentences for a simple question, short bullets for a list.
3. Chips offer the next step for that intent. For example, after `service_info` they are: **Get a quote for this** (which starts the quote flow with the service already filled in), Which brands?, and 24/7 support.

### Support and handoff

1. User: "Our UPS is beeping".
2. Bot (template): for an outage or urgent fault, call +971 55 344 0144 (support runs 24/7); for anything less urgent, use the client support page or email.
3. Chips: Call (a `tel:` link), Client support page, WhatsApp.

`talk_to_human` works the same way with Call, Email and Get a quote.

## Fallback Strategy

- **After 1 miss:** "I'm not sure I understood that. Did you mean one of these?" The bot offers up to three chips for the intents the model thinks were most likely meant, or by default: What do you offer?, Get a quote, Contact details.
- **After 2 misses in a row:** the bot hands off: "A person can help: call or email." Chips: Call, Email the team, WhatsApp. The miss count then resets, and any recognised turn also resets it.
- **Model unavailable** (all three free models busy or over quota):
  - Template intents and the whole quote flow keep working, because they don't need the model.
  - A message that exactly matches an example of a model-answered intent gets that intent's `offline` answer from `intents.json`, written from `knowledge.json`. For example, "What do you do" still gets an overview.
  - Anything else hands off with the same chips. A paused quote keeps its Continue chip.
- **Visitor over the hourly limit** (20 model calls an hour): same handoff, with an HTTP 429 status.
- **Arabic:** messages in Arabic script always go to the model, which replies in Arabic. Chips and form fields stay in English. Arabic service isn't confirmed by JIO yet; see `not_confirmed`.

## Response Design

- Answers link to the site. A service answer offers **View the service page**, picked from the service the visitor asked about (the `pages` map on the quote form's service question in `intents.json`); it is dropped when no single service was named. Overview, industries and careers or partner answers offer All services, the Industries page, and the Careers and Partnerships pages. In the preview, site paths are turned into the preview's files, so the same buttons work there. When the site gains a page, add it to `pages` in `knowledge.json` and, if it needs a button, to `chips` in `intents.json`.

- The format fits the question. A simple question (yes or no, or a single fact) gets one or two plain sentences. Bullets are only for several items or steps: up to four, about 15 words each. Every reply stays under about 60 words, with the answer first and no closing pleasantries. Fixed replies (contact, support, handoff) are plain sentences. The client asked for short, pointed replies, so this overrides the skill's "acknowledge first" principle for model answers. Templated flow steps do acknowledge ("Got it.").
- The tone is plain, professional and specific, with no hype, matching the site copy.
- Next steps are offered as chips rather than written out as "Anything else?".
- The bot never claims anything on the `not_confirmed` list: prices, certifications, licences, ratings, SLAs, clients or founding year.

## Metrics Targets

| Metric | Target | How it is measured |
|---|---|---|
| Intent accuracy | > 85% | Weekly sample of 30 turns from the log, labelled by hand |
| Containment | > 60% | Conversations that end in an answer or a filled form, without the handoff template |
| Fallback rate | < 15% | `intent:fallback` divided by `turns` in `jio_chat_stats` |
| Quote completion | > 40% | Flows that reach "Open the quote form" divided by `request_quote` entries |
| Resolution time | < 2 minutes | Quote flow is 5 to 6 taps, mostly rule-routed |

## Conversation Logs

The WordPress endpoint keeps two non-autoloaded options:

- `jio_chat_stats`: per-day counts of turns, `intent:<name>`, `via:rule` or `via:model`, and `handoff`. It keeps 60 days.
- `jio_chat_misses`: the last 50 messages that fell back, with email addresses and long digit runs masked.

```bash
wp option get jio_chat_stats --format=json
```

```bash
wp option get jio_chat_misses --format=json
```

**Weekly review:**

- Add real phrasings from `jio_chat_misses` as examples in `intents.json`.
- When a missed topic keeps coming up, add a new intent for it.
- When an answer is missing, add the fact to `knowledge.json`, but only after JIO confirms it.

The preview server prints one `[chat] intent=… via=…` line per turn instead.

## Before Launch

- Set `JIO_OPENROUTER_KEY` in `wp-config.php` and rotate the key that was shared in chat.
- The free tier allows 50 requests a day across all models, and testing alone used it up. Add OpenRouter credits (which raises the limit to 1,000 a day) or switch to a paid model.
- Test with ten or more real buyers, not the team, and review the first week of logs.
- The WordPress PHP path has not been run. There is no PHP on the build machine, so only the preview engine has been exercised.
