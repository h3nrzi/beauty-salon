const assert = require("node:assert/strict");
const fs = require("node:fs");
const path = require("node:path");
const { chromium, firefox, webkit } = require("playwright");
const url = process.env.NOIR_HOME_URL || "http://wordpress.local/";
const output = process.env.NOIR_EVIDENCE_DIR || "docs/evidence/home-04";
const projects = [
  "Porsche 911 GT3 (992)",
  "Aston Martin DB12",
  "Range Rover SV",
];
(async () => {
  fs.mkdirSync(output, { recursive: true });
  const reports = [];
  const engines = (process.env.NOIR_BROWSER || "chrome").split(",");
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
        const remote = [],
          errors = [];
        page.on("request", (r) => {
          if (new URL(r.url()).origin !== new URL(url).origin)
            remote.push(r.url());
        });
        page.on("pageerror", (e) => errors.push(e.message));
        await page.goto(url);
        await page.evaluate(() => document.fonts.ready);
        assert.match(
          await page.locator("h1").textContent(),
          /The Art of.*Automotive.*Preservation/s,
        );
        assert.deepEqual(
          await page.locator(".home-service h3").allTextContents(),
          ["Paint Correction", "Ceramic Coating", "Full Detail"],
        );
        assert.deepEqual(
          await page.locator("[data-home-project] h3").allTextContents(),
          projects,
        );
        assert.equal(
          await page.locator(".home-testimonial-grid blockquote").count(),
          3,
        );
        assert.equal(
          await page
            .getByText("Rated 5 out of 5 stars", { exact: true })
            .count(),
          3,
        );
        assert.deepEqual(
          await page
            .locator(".home-main > section")
            .evaluateAll((s) => s.map((s) => s.className)),
          [
            "home-hero",
            "services-section home-philosophy",
            "services-section home-services",
            "services-section home-projects",
            "services-section home-benefits",
            "services-section home-testimonials",
            "services-section home-final",
          ],
        );
        assert.match(
          await page
            .locator('[data-home-service="paint-correction"]')
            .textContent(),
          /2–3 days/,
        );
        assert.match(
          await page
            .locator('[data-home-service="ceramic-coating"]')
            .textContent(),
          /3–5-year protection/,
        );
        assert.equal(await page.locator('a[href="#"]').count(), 0);
        assert(
          !/98\.5%|Provenance Registry|3 to 5 Year Warranty/.test(
            await page.locator("main").textContent(),
          ),
        );
        assert.equal(
          await page
            .locator('.desktop-nav a[aria-current="page"]')
            .textContent(),
          "Home",
        );
        // Actual destination pages must contain the stable target and preselection.
        for (const id of [
          "paint-correction",
          "ceramic-coating",
          "full-detail",
        ]) {
          const card = page.locator(`[data-home-service="${id}"]`);
          const detail = card.getByRole("link", { name: "Explore Package" });
          const href = await detail.getAttribute("href");
          assert.equal(new URL(href).hash, `#service-${id}`);
          const destination = await context.newPage();
          await destination.goto(href);
          assert.equal(await destination.locator(`#service-${id}`).count(), 1);
          const appointment = await card
            .getByRole("link", { name: /Request Appointment/ })
            .getAttribute("href");
          assert.equal(new URL(appointment).searchParams.get("service"), id);
          await destination.goto(appointment);
          assert.equal(
            await destination
              .locator('input[name="service-preview"]:checked')
              .getAttribute("value"),
            id,
          );
          await destination.close();
        }
        const links = await page
          .locator("[data-home-project] .text-link")
          .evaluateAll((a) => a.map((a) => a.href));
        assert.equal(new URL(links[0]).hash, "#project-porsche-911-gt3-992");
        assert.equal(new URL(links[1]).hash, "");
        assert.equal(new URL(links[2]).hash, "");
        const destination = await context.newPage();
        await destination.goto(links[0]);
        assert.equal(
          await destination.locator("#project-porsche-911-gt3-992").count(),
          1,
        );
        await destination.close();
        const slider = page.getByRole("slider");
        await slider.focus();
        await page.keyboard.press("Home");
        assert.equal(await slider.inputValue(), "0");
        await page.keyboard.press("End");
        assert.equal(await slider.inputValue(), "100");
        assert.equal(
          await slider.getAttribute("aria-valuetext"),
          "100% after image revealed",
        );
        await page.keyboard.press("ArrowRight");
        assert.equal(await slider.inputValue(), "99");
        await slider.fill("50");
        await slider.dispatchEvent("input");
        const geometry = await page
          .locator(".comparison figure img")
          .evaluateAll((images) =>
            images.map((i) => {
              const r = i.getBoundingClientRect();
              return { x: r.x, y: r.y, w: r.width, h: r.height };
            }),
          );
        assert.deepEqual(geometry[0], geometry[1]);
        await slider.scrollIntoViewIfNeeded();
        const box = await slider.boundingBox();
        await page.touchscreen.tap(
          box.x + box.width * 0.25,
          box.y + box.height / 2,
        );
        assert(Number(await slider.inputValue()) > 60);
        await slider.fill("50");
        await slider.dispatchEvent("input");
        for (const img of await page.locator(".home-main img").all()) {
          await img.scrollIntoViewIfNeeded();
          await img.evaluate(
            (i) =>
              new Promise((resolve, reject) => {
                if (i.complete && i.naturalWidth) return resolve();
                const timer = setTimeout(
                  () => reject(new Error("Image did not load: " + i.src)),
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
                i.addEventListener("error", () => reject(new Error(i.src)), {
                  once: true,
                });
              }),
          );
        }
        assert(
          await page
            .locator(".home-main img:not(.icon)")
            .evaluateAll(
              (images) =>
                images.length === 8 &&
                images.every(
                  (i) =>
                    i.naturalWidth &&
                    i.srcset &&
                    i.sizes &&
                    i.width &&
                    i.height,
                ),
            ),
        );
        assert.equal(
          await page.locator(".home-hero-image > img").getAttribute("loading"),
          "eager",
        );
        assert.equal(
          await page
            .locator(".home-hero-image > img")
            .getAttribute("fetchpriority"),
          "high",
        );
        assert(
          await page
            .locator(".home-main img:not(.icon):not(.home-hero-image > img)")
            .evaluateAll((images) => images.every((i) => i.loading === "lazy")),
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
        const audit = await page.evaluate(() =>
          axe.run(document, {
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
          path: path.join(output, `home-${name}-${width}.png`),
          fullPage: true,
        });
        assert.deepEqual(remote, []);
        assert.deepEqual(errors, []);
        await context.close();
        for (const mode of ["nojs", "blocked-comparison"]) {
          const plainContext = await browser.newContext({
            javaScriptEnabled: mode !== "nojs",
            viewport: { width, height: 1000 },
          });
          if (mode !== "nojs")
            await plainContext.route("**/assets/comparison.js*", (r) =>
              r.abort(),
            );
          const plain = await plainContext.newPage();
          await plain.goto(url);
          assert.deepEqual(
            await plain.locator("[data-home-project] h3").allTextContents(),
            projects,
          );
          assert(
            await plain.locator(".comparison-before figcaption").isVisible(),
          );
          assert(
            await plain.locator(".comparison-after figcaption").isVisible(),
          );
          assert.equal(await plain.getByRole("slider").count(), 0);
          assert(
            await plain.evaluate(
              () => document.documentElement.scrollWidth <= innerWidth,
            ),
          );
          const link = plain
            .locator(".home-hero-copy")
            .getByRole("link", { name: "View Services" });
          await link.focus();
          await Promise.all([
            plain.waitForURL("**/services/"),
            plain.keyboard.press("Enter"),
          ]);
          assert.equal(new URL(plain.url()).pathname, "/services/");
          await plainContext.close();
        }
        console.log(
          `PASS ${name} ${width}px: Home order, canonical facts, CTA destinations/preselection, keyboard/touch, geometry, responsive local media, axe, no-JS and partial enhancement`,
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
