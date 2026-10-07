const assert = require("node:assert/strict");
const fs = require("node:fs");
const path = require("node:path");
const { chromium, firefox, webkit } = require("playwright");
const url = process.env.NOIR_CONTACT_URL || "http://wordpress.local/contact/";
const output = process.env.NOIR_EVIDENCE_DIR || "docs/evidence/contact-01";
(async () => {
  fs.mkdirSync(output, { recursive: true });
  const reports = [];
  const engines = process.env.NOIR_BROWSER
    ? process.env.NOIR_BROWSER.split(",")
    : ["chrome"];
  for (const name of engines) {
    const engine =
      name === "firefox" ? firefox : name === "webkit" ? webkit : chromium;
    const launch = name === "chrome" ? { channel: "chrome" } : {};
    if (process.env.NOIR_BROWSER_EXECUTABLE)
      launch.executablePath = process.env.NOIR_BROWSER_EXECUTABLE;
    const browser = await engine.launch({ ...launch, headless: true });
    try {
      for (const width of [375, 768, 1024, 1440]) {
        const context = await browser.newContext({
          viewport: { width, height: 1000 },
        });
        const page = await context.newPage();
        const errors = [],
          remote = [];
        page.on("pageerror", (error) => errors.push(error.message));
        page.on("request", (req) => {
          if (new URL(req.url()).origin !== new URL(url).origin)
            remote.push(req.url());
        });
        await page.goto(url);
        await page.evaluate(() => document.fonts.ready);
        assert.equal(await page.locator("h1").count(), 1);
        assert.equal(
          await page
            .locator('.desktop-nav a[aria-current="page"]')
            .textContent(),
          "Contact",
        );
        assert.equal(
          await page
            .locator('.site-footer a[aria-current="page"]')
            .first()
            .textContent(),
          "Contact",
        );
        assert.equal(await page.locator(".service-grid label").count(), 5);
        assert.equal(await page.locator(".process li").count(), 4);
        assert.equal(await page.locator('a[href="#"]').count(), 0);
        assert.equal(
          await page.locator('a[href^="tel:"]').first().getAttribute("href"),
          "tel:+18004926647",
        );
        assert.equal(
          await page.locator('a[href^="mailto:"]').first().getAttribute("href"),
          "mailto:studio@noirautodetailing.com",
        );
        assert(await page.locator("#appointment-unavailable").isVisible());
        assert(
          await page.evaluate(
            () => document.documentElement.scrollWidth <= innerWidth,
          ),
        );
        assert(
          await page.evaluate(
            () =>
              document.fonts.check("600 24px Syne") &&
              document.fonts.check("400 14px Inter"),
          ),
        );
        await page.keyboard.press(name === "webkit" ? "Alt+Tab" : "Tab");
        assert.equal(
          await page.locator(":focus").getAttribute("class"),
          "skip-link",
        );
        await page.keyboard.press("Enter");
        assert.equal(
          await page.locator(":focus").getAttribute("id"),
          "main-content",
        );
        if (width < 1024) {
          const toggle = page.getByRole("button", {
            name: "Toggle navigation",
          });
          await toggle.click();
          assert.equal(await toggle.getAttribute("aria-expanded"), "true");
          await page.locator("#mobile-navigation a").first().focus();
          await page.keyboard.press("Escape");
          assert.equal(await toggle.getAttribute("aria-expanded"), "false");
          assert(await toggle.evaluate((el) => el === document.activeElement));
          assert(await page.locator("#mobile-navigation").isHidden());
          await toggle.click();
          await page.locator('.fact a[href^="mailto:"]').focus();
          await page.keyboard.press("Escape");
          assert.equal(
            await toggle.getAttribute("aria-expanded"),
            "false",
            "Escape dismisses open disclosure after focus moves outside",
          );
          await toggle.click();
          await page.locator("#mobile-navigation a").last().focus();
          await page.setViewportSize({ width: 1024, height: 1000 });
          await page.waitForFunction(
            () =>
              document
                .querySelector(".nav-toggle")
                .getAttribute("aria-expanded") === "false",
          );
          assert.equal(
            await page.locator(".nav-toggle").getAttribute("aria-expanded"),
            "false",
          );
          await page.setViewportSize({ width, height: 1000 });
        }
        // Audit/capture a fresh baseline after keyboard hash navigation and viewport changes.
        // WebKit can replace its execution context while settling those history entries.
        await page.goto(url);
        await page.evaluate(() => document.fonts.ready);
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
        await page.screenshot({
          path: path.join(output, `contact-${name}-${width}.png`),
          fullPage: true,
        });
        assert.deepEqual(errors, []);
        assert.deepEqual(remote, []);
        await context.close();
        const nojs = await browser.newContext({
          javaScriptEnabled: false,
          viewport: { width, height: 1000 },
        });
        const plain = await nojs.newPage();
        await plain.goto(url);
        if (width < 1024)
          assert(
            await plain.locator("#mobile-navigation a").first().isVisible(),
          );
        assert(await plain.locator('.fact a[href^="mailto:"]').isVisible());
        assert(
          await plain.evaluate(
            () => document.documentElement.scrollWidth <= innerWidth,
          ),
        );
        await nojs.close();
        console.log(
          `PASS ${name} ${width}px: navigation, keyboard, no-JS, local assets, reflow`,
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
