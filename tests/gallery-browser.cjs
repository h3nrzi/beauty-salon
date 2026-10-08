const assert = require("node:assert/strict");
const fs = require("node:fs");
const path = require("node:path");
const { chromium, firefox, webkit } = require("playwright");
const url = process.env.NOIR_GALLERY_URL || "http://wordpress.local/gallery/";
const output = process.env.NOIR_EVIDENCE_DIR || "docs/evidence/gallery-03";
const ids = [
  "porsche-911-gt3-992",
  "ferrari-f8-tributo",
  "aston-martin-dbs-superleggera",
  "mercedes-benz-300sl-1955",
  "bmw-m3-touring",
  "lamborghini-huracan-sto",
];
const titles = [
  "Porsche 911 GT3 (992)",
  "Ferrari F8 Tributo",
  "Aston Martin DBS Superleggera",
  "Mercedes-Benz 300SL",
  "BMW M3 Touring",
  "Lamborghini Huracán STO",
];
const filters = {
  all: ids,
  "paint-correction": [ids[0], ids[2], ids[4]],
  ceramic: [ids[1], ids[2], ids[5]],
  "full-detail": [ids[4]],
  exotic: [ids[0], ids[1], ids[2], ids[5]],
  vintage: [ids[3]],
};
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
        await page.evaluate(() =>
          Promise.race([
            document.fonts.ready,
            new Promise((_, reject) =>
              setTimeout(
                () => reject(new Error("Fonts did not settle")),
                10000,
              ),
            ),
          ]),
        );
        assert.equal(
          await page.locator("h1").textContent(),
          "PORTFOLIO & RECENT WORK",
        );
        assert.equal(
          await page
            .locator('.desktop-nav a[aria-current="page"]')
            .textContent(),
          "Gallery",
        );
        assert.deepEqual(
          await page.locator("[data-project] h2").allTextContents(),
          titles,
        );
        assert.equal(await page.locator(".equipment-grid article").count(), 4);
        assert.equal(await page.locator(".project-metrics > div").count(), 3);
        for (const [filter, expected] of Object.entries(filters)) {
          const button = page.locator(`[data-filter="${filter}"]`);
          await button.focus();
          await page.keyboard.press("Enter");
          assert(
            await button.evaluate((b) => b === document.activeElement),
            "Filter retains keyboard focus",
          );
          assert.equal(await button.getAttribute("aria-pressed"), "true");
          assert.equal(
            await page.locator('[data-filter][aria-pressed="true"]').count(),
            1,
          );
          assert.deepEqual(
            await page
              .locator("[data-project]:visible")
              .evaluateAll((cards) =>
                cards.map((c) => c.id.replace(/^project-/, "")),
              ),
            expected,
          );
          assert.equal(
            await page.locator("[data-project][hidden]").count(),
            6 - expected.length,
          );
          assert.equal(
            await page.getByRole("article").count(),
            expected.length + 4,
            "Hidden cards leave the accessible navigation tree",
          );
          assert.equal(
            await page.getByRole("status").textContent(),
            `Showing ${expected.length} of 6 Projects`,
          );
        }
        await page
          .getByRole("button", { name: "All Projects", exact: true })
          .click();
        assert.deepEqual(
          await page.locator("[data-project]:visible h2").allTextContents(),
          titles,
          "All resets baseline order",
        );
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
          "Shared comparison control stays over Gallery images",
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
        let box = await range.boundingBox();
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
        const geometry = await page
          .locator(".comparison figure img")
          .evaluateAll((images) =>
            images.map((i) => {
              const r = i.getBoundingClientRect();
              return { x: r.x, y: r.y, width: r.width, height: r.height };
            }),
          );
        assert.deepEqual(
          geometry[0],
          geometry[1],
          "Before and after images retain aligned geometry",
        );
        if (name === "chrome") {
          const image = page.locator(".comparison-before img");
          await image.scrollIntoViewIfNeeded();
          const r = await image.boundingBox();
          const x = r.x + r.width / 2;
          const y = Math.min(850, Math.max(300, r.y + r.height / 2));
          const previous = await page.evaluate(() => scrollY);
          const cdp = await context.newCDPSession(page);
          await cdp.send("Input.dispatchTouchEvent", {
            type: "touchStart",
            touchPoints: [{ x, y }],
          });
          for (let i = 1; i <= 6; i++)
            await cdp.send("Input.dispatchTouchEvent", {
              type: "touchMove",
              touchPoints: [{ x, y: y - i * 35 }],
            });
          await cdp.send("Input.dispatchTouchEvent", {
            type: "touchEnd",
            touchPoints: [],
          });
          await page.waitForTimeout(300);
          assert(
            (await page.evaluate(() => scrollY)) > previous,
            "Vertical touch gesture scrolls the page over comparison imagery",
          );
          await cdp.detach();
        }
        // Allow each lazy image to remain in view until WebKit starts its request.
        // Racing through long cards can leave offscreen native lazy requests deferred.
        for (const image of await page.locator(".gallery-main img").all()) {
          await image.scrollIntoViewIfNeeded();
          await image.evaluate(
            (i) =>
              new Promise((resolve, reject) => {
                if (i.complete && i.naturalWidth > 0) return resolve();
                const timer = setTimeout(
                  () =>
                    reject(
                      new Error("Visible Gallery image did not load: " + i.src),
                    ),
                  10000,
                );
                i.addEventListener(
                  "load",
                  () => {
                    clearTimeout(timer);
                    resolve();
                  },
                  { once: true },
                );
                i.addEventListener(
                  "error",
                  () => {
                    clearTimeout(timer);
                    reject(new Error("Gallery image failed: " + i.src));
                  },
                  { once: true },
                );
              }),
          );
        }
        await page
          .locator(".gallery-main img")
          .evaluateAll((images) =>
            Promise.race([
              Promise.all(images.map((i) => i.decode())),
              new Promise((_, reject) =>
                setTimeout(
                  () =>
                    reject(
                      new Error(
                        "Gallery images did not decode: " +
                          JSON.stringify(
                            images.map((i) => ({
                              src: i.getAttribute("src"),
                              complete: i.complete,
                              width: i.naturalWidth,
                            })),
                          ),
                      ),
                    ),
                  15000,
                ),
              ),
            ]),
          );
        assert(
          await page
            .locator(".project-visual img")
            .evaluateAll(
              (images) =>
                images.length === 7 &&
                images.every(
                  (i) =>
                    i.naturalWidth > 0 &&
                    i.srcset &&
                    i.sizes &&
                    i.getAttribute("width") &&
                    i.getAttribute("height"),
                ),
            ),
          "Gallery uses decoded responsive attachment images with intrinsic dimensions",
        );
        assert.equal(
          await page
            .locator(".comparison-before img")
            .getAttribute("fetchpriority"),
          "high",
        );
        assert(
          await page
            .locator(".project-visual > img")
            .evaluateAll((images) => images.every((i) => i.loading === "lazy")),
        );
        assert(
          await page.evaluate(
            () => document.documentElement.scrollWidth <= innerWidth,
          ),
          "No responsive viewport overflow",
        );
        await page.addScriptTag({
          path: require.resolve("axe-core/axe.min.js"),
        });
        const audit = await page.evaluate(
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
            { violations: audit.violations, incomplete: audit.incomplete },
            null,
            2,
          ) + "\n",
        );
        assert.deepEqual(
          audit.violations.map((v) => ({
            id: v.id,
            targets: v.nodes.map((n) => n.target),
          })),
          [],
        );
        await page.evaluate(() => scrollTo(0, 0));
        await page.screenshot({
          path: path.join(output, `gallery-${name}-${width}.png`),
          fullPage: true,
        });
        // Validate the rendered document before following its native anchor.
        const detail = page.getByRole("link", { name: "View Project Details" });
        const destination = new URL(await detail.getAttribute("href"));
        assert.equal(destination.pathname, new URL(url).pathname);
        assert.equal(destination.hash, "#project-" + ids[0]);
        await Promise.all([
          page.waitForURL(destination.href, { waitUntil: "load" }),
          detail.click(),
        ]);
        assert.equal(new URL(page.url()).hash, destination.hash);
        assert.equal(await page.locator('a[href="#"]').count(), 0);
        assert.deepEqual(errors, []);
        assert.deepEqual(remote, []);
        await context.close();
        for (const failure of ["nojs", "gallery-script", "comparison-script"]) {
          const plainContext = await browser.newContext({
            javaScriptEnabled: failure !== "nojs",
            viewport: { width, height: 1000 },
          });
          if (failure !== "nojs")
            await plainContext.route(
              `**/assets/${failure === "gallery-script" ? "gallery" : "comparison"}.js*`,
              (route) => route.abort(),
            );
          const plain = await plainContext.newPage();
          await plain.goto(url);
          assert.deepEqual(
            await plain.locator("[data-project]:visible h2").allTextContents(),
            titles,
            "All baseline work survives absent/partial enhancement",
          );
          if (failure !== "comparison-script")
            assert.equal(
              await plain
                .getByRole("group", { name: "Filter completed Projects" })
                .count(),
              0,
              "Unused filters are hidden without successful enhancement",
            );
          if (failure !== "gallery-script") {
            assert(
              await plain.locator(".comparison-before figcaption").isVisible(),
            );
            assert(
              await plain.locator(".comparison-after figcaption").isVisible(),
            );
            assert.equal(
              await plain.getByRole("slider").count(),
              0,
              "Two labelled figures without unused range",
            );
          }
          assert(
            await plain.evaluate(
              () => document.documentElement.scrollWidth <= innerWidth,
            ),
          );
          await plainContext.close();
        }
        console.log(
          `PASS ${name} ${width}px: exact filters/count/reset/focus, comparison keyboard/pointer/touch, images, axe, no-JS and partial scripts`,
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
})().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
