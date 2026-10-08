const assert = require("node:assert/strict");
const { chromium } = require("playwright");
(async () => {
  const browser = await chromium.launch({ channel: "chrome" });
  try {
    const context = await browser.newContext({ javaScriptEnabled: false });
    const page = await context.newPage();
    await page.goto(
      process.env.NOIR_GALLERY_URL || "http://wordpress.local/gallery/",
    );
    assert.deepEqual(
      await page.locator("[data-project] h2").allTextContents(),
      [
        "Porsche 911 GT3 (992)",
        "Ferrari F8 Tributo",
        "Aston Martin DBS Superleggera",
        "Mercedes-Benz 300SL",
        "BMW M3 Touring",
        "Lamborghini Huracán STO",
      ],
      "All six baseline Gallery Projects remain discoverable without JavaScript",
    );
    await context.close();
  } finally {
    await browser.close();
  }
})().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
