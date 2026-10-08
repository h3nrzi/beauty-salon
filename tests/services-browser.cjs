const assert = require("node:assert/strict");
const fs = require("node:fs");
const path = require("node:path");
const { chromium, firefox, webkit } = require("playwright");
const url = process.env.NOIR_SERVICES_URL || "http://wordpress.local/services/";
const output = process.env.NOIR_EVIDENCE_DIR || "docs/evidence/services-02";
const identities = [
  "exterior-detail",
  "interior-detail",
  "full-detail",
  "paint-correction",
  "ceramic-coating",
];
const titles = [
  "Exterior Detail",
  "Interior Detail",
  "Full Detail",
  "Paint Correction",
  "Ceramic Coating",
];
(async () => {
  fs.mkdirSync(output, { recursive: true });
  const engines = process.env.NOIR_BROWSER
    ? process.env.NOIR_BROWSER.split(",")
    : ["chrome"];
  const reports = [];
  for (const name of engines) {
    const engine =
      name === "firefox" ? firefox : name === "webkit" ? webkit : chromium;
    const browser = await engine.launch(
      name === "chrome" ? { channel: "chrome" } : {},
    );
    try {
      for (const width of [375, 768, 1024, 1440]) {
        const context = await browser.newContext({
          viewport: { width, height: 1000 },
          hasTouch: true,
        });
        const page = await context.newPage();
        const errors = [],
          remote = [];
        page.on("pageerror", (e) => errors.push(e.message));
        page.on("request", (r) => {
          if (new URL(r.url()).origin !== new URL(url).origin)
            remote.push(r.url());
        });
        await page.goto(url);
        await page.evaluate(() => document.fonts.ready);
        assert.equal(
          await page.locator("h1").textContent(),
          "STUDIO SERVICES & PACKAGES",
        );
        assert.equal(
          await page
            .locator('.desktop-nav a[aria-current="page"]')
            .textContent(),
          "Services",
        );
        assert.deepEqual(
          await page.locator(".service-card h3").allTextContents(),
          titles,
        );
        assert.deepEqual(
          await page.locator(".service-card .price").allTextContents(),
          ["$350", "$450", "$750", "$950", "$1,400"],
        );
        assert.deepEqual(
          await page
            .locator(".service-facts div:last-child dd")
            .allTextContents(),
          ["~4–6 hours", "~5–7 hours", "1–2 days", "2–3 days", "2–3 days"],
        );
        assert.equal(await page.locator(".service-inclusions li").count(), 30);
        assert.deepEqual(
          await page.locator(".service-protection").allTextContents(),
          [
            "Protection: Synthetic sealant included",
            "Protection: 6-month ceramic sealant",
            "Protection: 3–5-year protection",
          ],
        );
        assert.equal(await page.locator(".metric-grid article").count(), 4);
        assert.equal(await page.locator(".process-grid li").count(), 4);
        assert.equal(await page.locator(".faq-list details").count(), 5);
        assert.equal(await page.locator(".faq-list details[open]").count(), 1);
        assert.equal(
          await page.locator(".faq-list details").first().getAttribute("open"),
          "",
        );
        const second = page.locator(".faq-list summary").nth(1);
        await second.focus();
        await page.keyboard.press("Enter");
        assert.equal(
          await page.locator(".faq-list details[open]").count(),
          2,
          "FAQ disclosures expand independently",
        );
        await page.keyboard.press("Space");
        assert.equal(await page.locator(".faq-list details[open]").count(), 1);
        const range = page.getByRole("slider", {
          name: "Before and after comparison — reveal after image",
        });
        const imageBounds = await page
          .locator(".comparison-images")
          .boundingBox();
        const rangeBounds = await range.boundingBox();
        assert(
          rangeBounds.y >= imageBounds.y &&
            rangeBounds.y + rangeBounds.height <=
              imageBounds.y + imageBounds.height,
          "Comparison control overlays the image",
        );
        await range.focus();
        assert.equal(await range.inputValue(), "50");
        await page.keyboard.press("ArrowRight");
        assert.equal(await range.inputValue(), "49");
        await page.keyboard.press("Home");
        assert.equal(await range.inputValue(), "0");
        await page.keyboard.press("End");
        assert.equal(await range.inputValue(), "100");
        assert.equal(
          await range.getAttribute("aria-valuetext"),
          "100% after image revealed",
        );
        await range.scrollIntoViewIfNeeded();
        const box = await range.boundingBox();
        await page.touchscreen.tap(
          box.x + box.width / 4,
          box.y + box.height / 2,
        );
        assert(
          Number(await range.inputValue()) > 60 &&
            Number(await range.inputValue()) < 90,
          "Touch changes native range",
        );
        await range.click({
          position: { x: box.width * 0.75, y: box.height / 2 },
        });
        assert(
          Number(await range.inputValue()) < 40,
          "Pointer changes native range",
        );
        await range.fill("50");
        await range.dispatchEvent("input");
        await page.mouse.move(box.x + box.width / 2, box.y + box.height / 2);
        await page.mouse.down();
        await page.mouse.move(
          box.x + box.width * 0.75,
          box.y + box.height / 2,
          {
            steps: 5,
          },
        );
        await page.mouse.up();
        assert(
          Number(await range.inputValue()) < 40,
          "Dragging the handle reveals the image",
        );
        await range.focus();
        await page.keyboard.press("Home");
        await page.keyboard.press("ArrowRight");
        await range.fill("50");
        await range.dispatchEvent("input");
        const requestLinks = [];
        for (let i = 0; i < 5; i++) {
          const card = page.locator("#service-" + identities[i]);
          const link = await card
            .getByRole("link", { name: "Request Appointment — " + titles[i] })
            .getAttribute("href");
          assert.equal(
            new URL(link).searchParams.get("service"),
            identities[i],
          );
          assert.equal(new URL(link).hash, "#appointment-request");
          requestLinks.push(link);
          assert.equal(
            await page.locator(".service-index a").nth(i).getAttribute("href"),
            "#service-" + identities[i],
          );
        }
        const footer = page.getByRole("navigation", {
          name: "Services",
          exact: true,
        });
        assert.deepEqual(await footer.locator("a").allTextContents(), titles);
        assert.equal(
          await footer.locator('[aria-current="page"]').count(),
          0,
          "Service section links do not all claim to be the current page",
        );
        const footerNav = page.getByRole("navigation", {
          name: "Footer navigation",
        });
        assert.equal(
          await footerNav.locator('[aria-current="page"]').textContent(),
          "Services",
          "Real page navigation retains current state",
        );
        const request = footerNav.getByRole("link", {
          name: "Request Appointment",
        });
        const neutral = footerNav.getByRole("link", {
          name: "Home",
          exact: true,
        });
        assert.equal(
          await request.evaluate((e) => getComputedStyle(e).color),
          await neutral.evaluate((e) => getComputedStyle(e).color),
          "Footer appointment link uses the ordinary link color",
        );
        for (let i = 0; i < 5; i++)
          assert.equal(
            new URL(await footer.locator("a").nth(i).getAttribute("href")).hash,
            "#service-" + identities[i],
          );
        assert.equal(await page.locator('a[href="#"]').count(), 0);
        // Lazy image evidence must actually traverse the page before capture.
        for (
          let y = 0;
          y < (await page.evaluate(() => document.body.scrollHeight));
          y += 700
        ) {
          await page.evaluate((y) => scrollTo(0, y), y);
          await page.waitForTimeout(80);
        }
        await page
          .locator(".services-main img")
          .evaluateAll((images) => Promise.all(images.map((i) => i.decode())));
        assert(
          await page
            .locator(".services-main img")
            .evaluateAll(
              (images) =>
                images.length === 11 &&
                images.every(
                  (i) =>
                    i.naturalWidth > 0 &&
                    i.width > 0 &&
                    i.getAttribute("width") &&
                    i.getAttribute("height"),
                ),
            ),
        );
        assert(
          await page
            .locator(".service-image img,.comparison img")
            .evaluateAll(
              (images) =>
                images.length === 7 &&
                images.every(
                  (i, index) =>
                    i.srcset &&
                    i.sizes &&
                    i.loading === (index === 0 ? "eager" : "lazy") &&
                    (index !== 0 || i.getAttribute("fetchpriority") === "high"),
                ),
            ),
        );
        assert(
          await page.evaluate(
            () => document.documentElement.scrollWidth <= innerWidth,
          ),
          "No viewport overflow",
        );
        await page.addScriptTag({
          path: require.resolve("axe-core/axe.min.js"),
        });
        const accessibility = await page.evaluate(
          async () =>
            await axe.run(document, {
              runOnly: {
                type: "tag",
                values: ["wcag2a", "wcag2aa", "wcag21a", "wcag21aa"],
              },
            }),
        );
        fs.writeFileSync(
          path.join(output, `axe-${name}-${width}.json`),
          JSON.stringify(
            {
              violations: accessibility.violations,
              incomplete: accessibility.incomplete,
            },
            null,
            2,
          ) + "\n",
        );
        assert.deepEqual(
          accessibility.violations.map((v) => ({
            id: v.id,
            targets: v.nodes.map((n) => n.target),
          })),
          [],
        );
        await page.evaluate(() => scrollTo(0, 0));
        await page.screenshot({
          path: path.join(output, `services-${name}-${width}.png`),
          fullPage: true,
        });
        for (const link of requestLinks) {
          await page.goto(link);
          assert.equal(
            await page
              .locator('input[name="service-preview"]:checked')
              .inputValue(),
            new URL(link).searchParams.get("service"),
          );
        }
        await page.goto(new URL("/contact/?service=unavailable", url).href);
        assert.equal(
          await page
            .locator('input[name="service-preview"]:checked')
            .inputValue(),
          "exterior-detail",
        );
        assert.deepEqual(errors, []);
        assert.deepEqual(remote, []);
        await context.close();
        const nojs = await browser.newContext({
          javaScriptEnabled: false,
          viewport: { width, height: 1000 },
        });
        const plain = await nojs.newPage();
        await plain.goto(url);
        assert.equal(await plain.locator(".comparison figure").count(), 2);
        assert(
          await plain.locator(".comparison-before figcaption").isVisible(),
        );
        assert(await plain.locator(".comparison-after figcaption").isVisible());
        assert.equal(
          await plain.getByRole("slider").count(),
          0,
          "No empty comparison slider without JS",
        );
        await plain.locator(".faq-list summary").nth(1).click();
        assert.equal(await plain.locator(".faq-list details[open]").count(), 2);
        assert(
          await plain.evaluate(
            () => document.documentElement.scrollWidth <= innerWidth,
          ),
        );
        await nojs.close();
        console.log(
          `PASS ${name} ${width}px: canonical facts, native footer, links/preselection, independent FAQ, keyboard/pointer/touch comparison, images, axe, no-JS`,
        );
      }
      reports.push({
        browser: name,
        version: browser.version(),
        viewports: [375, 768, 1024, 1440],
        date: new Date().toISOString(),
      });
    } finally {
      await browser.close();
    }
  }
  fs.writeFileSync(
    path.join(output, `browser-results-${engines.join("-")}.json`),
    JSON.stringify(reports, null, 2) + "\n",
  );
})().catch((e) => {
  console.error(e);
  process.exitCode = 1;
});
