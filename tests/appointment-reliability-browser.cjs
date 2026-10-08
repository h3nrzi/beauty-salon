const assert = require('node:assert/strict');
const fs = require('node:fs');
const {chromium} = require('playwright');
const url = process.env.NOIR_CONTACT_URL || 'http://wordpress.local/contact/';
(async () => {
 const browser = await chromium.launch({channel:'chrome'});
 try {
  for (const javaScriptEnabled of [false,true]) {
   const context = await browser.newContext({javaScriptEnabled,reducedMotion:'reduce',viewport:{width:375,height:900}});
   const page = await context.newPage();
   const form = await page.goto(url);
   assert.equal(form.status(),200);
   await page.locator('[name=name]').fill('Synthetic reliability browser');
   await page.locator('[name=phone]').fill('1234567890');
   await page.locator('[name=vehicle]').fill('Synthetic vehicle');
   const submitted = page.waitForResponse(r=>r.request().method()==='POST');
   await page.getByRole('button',{name:'Request Appointment',exact:true}).click();
   const response = await submitted;
   assert.equal(response.status(),503);
   assert(response.headers()['cache-control'].includes('no-store'));
   await page.waitForLoadState();
   assert((await page.locator('#request-errors').innerText()).includes('outcome is uncertain'));
   assert.equal(await page.locator('[name=submission_token]').count(),0);
   assert(await page.locator('.request-fallback a[href^="tel:"]').isVisible());
   assert(await page.locator('.request-fallback a[href^="mailto:"]').isVisible());
   if (javaScriptEnabled) {
    await page.evaluate(fs.readFileSync(require.resolve('axe-core/axe.min.js'),'utf8'));
    const audit = await page.evaluate(()=>axe.run(document,{runOnly:{type:'tag',values:['wcag2a','wcag2aa','wcag21aa']}}));
    assert.deepEqual(audit.violations.map(v=>v.id),[]);
   }
   let throttled;
   for (let i=0;i<25;i++) {
    const next = await page.goto(url);
    if (next.status()===429) {throttled=next;break;}
   }
   assert(throttled,'Repeated form issuance is throttled');
   assert(Number(throttled.headers()['retry-after'])>0);
   assert(throttled.headers()['cache-control'].includes('no-store'));
   assert((await page.locator('#request-errors').innerText()).includes('Too many online requests'));
   assert.equal(await page.locator('[name=submission_token]').count(),0);
   assert(await page.locator('.request-fallback a[href^="tel:"]').isVisible());
   assert(await page.evaluate(()=>document.documentElement.scrollWidth<=innerWidth));
   await context.close();
   console.log(`PASS: ${javaScriptEnabled?'JS':'no-JS'} uncertain and throttled responses preserve accessible direct-contact guidance`);
  }
 } finally {await browser.close();}
})().catch(error=>{console.error(error);process.exitCode=1;});
