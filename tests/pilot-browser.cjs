const assert = require('node:assert/strict');
const fs = require('node:fs');
const os = require('node:os');
const {chromium, firefox, webkit} = require('playwright');
const origin = process.env.NOIR_SITE_URL || 'http://wordpress.local';
const output = process.env.NOIR_EVIDENCE_DIR || 'docs/evidence/pilot-07';
(async () => {
 fs.mkdirSync(output,{recursive:true});
 const results=[];
 for (const name of (process.env.NOIR_BROWSER || 'chrome,firefox,webkit').split(',')) {
  const engine=name==='firefox'?firefox:name==='webkit'?webkit:chromium;
  const browser=await engine.launch(name==='chrome'?{channel:'chrome'}:{});
  try {
   for (const route of ['/', '/services/', '/gallery/', '/contact/']) {
    const context=await browser.newContext({viewport:{width:320,height:812},reducedMotion:'reduce'});
    try {
     // Simulate complete enhancement download failure. Public content must remain usable.
     await context.route('**/*.js*', r=>r.abort());
     const page=await context.newPage(); const remote=[],failedImages=[];
     page.on('request',request=>{if (new URL(request.url()).origin!==new URL(origin).origin) remote.push(request.url());});
     page.on('response',response=>{if(response.request().resourceType()==='image' && response.status()>=400) failedImages.push(response.url());});
     await page.goto(origin+route);
     await page.evaluate(()=>document.fonts.ready);
     for (const image of await page.locator('img').all()) { if (await image.isVisible()) await image.scrollIntoViewIfNeeded(); }
     await page.locator('footer').scrollIntoViewIfNeeded();
     await page.waitForFunction(()=>Array.from(document.images).filter(img=>img.getClientRects().length>0).every(img=>img.complete));
     assert.deepEqual(remote,[],'No remote prototype dependencies');
     assert.deepEqual(failedImages,[],'No failed photos/icons');
     assert.equal(await page.evaluate(()=>Array.from(document.images).filter(img=>img.getClientRects().length>0).every(img=>img.naturalWidth>0)),true);
     assert.equal(await page.evaluate(()=>document.documentElement.scrollWidth<=innerWidth+1),true,'320px reflow');
     assert.equal(await page.evaluate(()=>matchMedia('(prefers-reduced-motion: reduce)').matches),true);
     assert.equal(await page.locator('h1').count(),1);
     const links=await page.locator('a[href]').evaluateAll(links=>links.map(link=>link.getAttribute('href')));
     assert(links.some(link=>link.includes('/contact/')));
     await page.addScriptTag({path:require.resolve('axe-core/axe.min.js')});
     const axe=await page.evaluate(async()=>axe.run(document,{runOnly:{type:'tag',values:['wcag2a','wcag2aa','wcag21aa']}}));
     assert.deepEqual(axe.violations,[]);
     const label=route==='/'?'home':route.split('/')[1];
     fs.writeFileSync(`${output}/reflow-${label}-${name}-axe.json`,JSON.stringify({violations:axe.violations,incomplete:axe.incomplete.map(item=>({id:item.id,impact:item.impact,help:item.help}))},null,2));
     results.push({engine:name,version:browser.version(),os:`${os.type()} ${os.release()} ${os.arch()}`,page:label,viewport:320,reducedMotion:true,enhancementRequestsBlocked:true,externalRequests:remote,brokenImages:failedImages,axeViolations:0});
    } finally { await context.close(); }
   }
  } finally { await browser.close(); }
 }
 fs.writeFileSync(`${output}/supplemental-browser-results.json`,JSON.stringify({checkedAt:new Date().toISOString(),results},null,2));
 console.log(JSON.stringify(results,null,2));
})().catch(error=>{console.error(error);process.exitCode=1;});
