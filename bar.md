# Bar: Schneider Electric homepage (se.com/ww/en)

Checked against the live page on 2026-11-01. Measurements come from computed styles on the page. Visual items come from screenshots.

Client rules override anything below: no rounded corners, no gradients (except the JIO logo), no monospace, Source Sans 3 only, white base with green `#4CBB17` and blue `#5F9BC6`. Where the bar and the client rules conflict, the client rules win.

1. **The hero is an image band, with the headline below it.** The first screen is a full-width photograph or render on a dark green band. The headline sits on a light band under the image and is not placed on top of it.
2. **Body text is 14 to 16px, and headings are 18 to 25px.** Measured on the page. The headings are only about 1.5 to 1.8 times the body size, so the hierarchy comes from weight and whitespace rather than scale. This is a modest bar, and our headlines can go larger than this and still pass.
3. **Headings are bold (700) and body text is regular (400).** Measured. Two weights only.
4. **Product tiles are image blocks with a caption over the image.** The title sits in white on the lower-left of the image. A one-line description follows below it. This is visible on the "What's Next in Energy Tech" tiles.
5. **Carousels use paired outline arrows below the content.** Two small outline buttons, with the left one dimmed at the start. Seen on the hero carousel.

**Caveats for the critics**

- The top of the page is the consumer "Schneider Home" carousel, not enterprise content. The enterprise sections (featured products, corporate, sustainability) sit further down.
- The page opens with a location-picker overlay. I hid it in the viewer to see the content and did not accept or decline anything on the client's behalf.
- Mechanisms 4 and 5 describe rounded-looking tiles and arrows on the bar. Our build keeps those elements square, as the client's rules require.
- I didn't measure whitespace or motion timing, so I've left those out of the bar rather than guess.
