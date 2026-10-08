const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const {chromium, firefox, webkit} = require('playwright');
const url = process.env.NOIR_CONTACT_URL || 'http://wordpress.local/contact/';
const output = process.env.NOIR_EVIDENCE_DIR || 'docs/evidence/appointment-05';
// Enable the documented temporary Local fixture before running accepted-mail checks.
const mailpit = process.env.NOIR_MAILPIT_URL;
async function captured() { return (await (await fetch(mailpit + '/api/v1/messages')).json()).messages; }
(async () => {
 fs.mkdirSync(output,{recursive:true});
 const reports=[];
 for (const engineName of (process.env.NOIR_BROWSER || 'chrome').split(',')) {
  const engine=engineName==='firefox'?firefox:engineName==='webkit'?webkit:chromium;
  const browser=await engine.launch(engineName==='chrome'?{channel:'chrome'}:{});
  try {
   for (const javaScriptEnabled of [true,false]) {
    for (const width of [375,768,1024,1440]) {
     const context=await browser.newContext({javaScriptEnabled,reducedMotion:'reduce',viewport:{width,height:1000}});
     const page=await context.newPage();
     await page.goto(url+'?service=full-detail');
     assert.equal(await page.locator('[name=service_id]:checked').inputValue(),'full-detail');
     await page.locator('[name=name]').fill('Appointment browser fixture');
     await page.locator('[name=phone]').fill('123');
     await page.locator('[name=vehicle]').fill('Fixture vehicle');
     // Exercise server-side validation even though native guidance is available.
     await page.locator('form.appointment-form').evaluate(form=>form.noValidate=true);
     const response=page.waitForResponse(r=>r.request().method()==='POST');
     await page.getByRole('button',{name:'Request Appointment',exact:true}).click();
     assert.equal((await response).status(),422);
     assert.equal(await page.locator('[name=vehicle]').inputValue(),'Fixture vehicle');
     assert.equal(await page.locator('[name=phone]').getAttribute('aria-invalid'),'true');
     assert(await page.locator('#request-errors').isVisible());
     assert(!/Warning:|Fatal error:/.test(await page.locator('body').innerText()));
     assert.equal(await page.locator('#wpadminbar').count(),0);
     if (javaScriptEnabled) {
      await page.waitForFunction(()=>document.activeElement?.id==='request-errors');
      await page.locator('#request-errors a[href="#request-phone"]').click();
      assert.equal(await page.locator(':focus').getAttribute('id'),'request-phone');
     }
     assert(await page.evaluate(()=>document.documentElement.scrollWidth<=innerWidth));
     let audit={violations:[]};
     if (javaScriptEnabled) {
     await page.evaluate(fs.readFileSync(require.resolve('axe-core/axe.min.js'),'utf8'));
     audit=await page.evaluate(async()=>await axe.run(document,{runOnly:{type:'tag',values:['wcag2a','wcag2aa','wcag21aa']}}));
     assert.deepEqual(audit.violations.map(v=>({id:v.id,targets:v.nodes.map(n=>n.target)})),[]);
     }
     await page.screenshot({path:path.join(output,`error-${engineName}-${width}-${javaScriptEnabled?'js':'nojs'}.png`),fullPage:true});
     await page.locator('[name=phone]').fill('+1 (310) 555-0100');
     await page.locator('[name=email]').fill('customer@example.test');
     await page.locator('[name=notes]').fill('Local mail capture fixture\nSecond line');
     if (mailpit) {
      const before=(await captured()).map(m=>m.ID);
      const post=page.waitForResponse(r=>r.request().method()==='POST');
      await page.getByRole('button',{name:'Request Appointment',exact:true}).click();
      assert.equal((await post).status(),303);
      await page.waitForURL(/status=sent/);
      assert(await page.getByText('Your appointment request has been accepted for sending.',{exact:false}).isVisible());
      assert(!page.url().includes('Fixture'));
      const messages=(await captured()).filter(m=>!before.includes(m.ID));
      assert.equal(messages.length,1);
      const mail=await (await fetch(mailpit+'/api/v1/message/'+messages[0].ID)).json();
      assert.equal(mail.To.length,1);
      assert.equal(mail.To[0].Address,'studio@example.test');
      assert.equal(mail.From.Address,'requests@noir.example.test');
      assert.equal(mail.ReplyTo[0].Address,'customer@example.test');
      for (const line of ['Appointment browser fixture','+1 (310) 555-0100','Fixture vehicle','Full Detail (full-detail)','Not supplied','Second line','America/Los_Angeles','Request time:']) assert(mail.Text.includes(line),line);
      assert.equal((mail.Cc||[]).length,0); assert.equal((mail.Bcc||[]).length,0); assert.equal((mail.Attachments||[]).length,0);
      await page.reload();
      assert(await page.getByText('Your appointment request has been accepted for sending.',{exact:false}).isVisible());
      assert.equal((await captured()).filter(m=>!before.includes(m.ID)).length,1);
      const receipt=await context.cookies();
      assert(receipt.find(c=>c.name==='noir_receipt').httpOnly);
      assert(receipt.find(c=>c.name==='noir_visitor').httpOnly);
      if (javaScriptEnabled) {
      await page.evaluate(fs.readFileSync(require.resolve('axe-core/axe.min.js'),'utf8'));
      const successAudit=await page.evaluate(async()=>await axe.run(document,{runOnly:{type:'tag',values:['wcag2a','wcag2aa','wcag21aa']}}));
      assert.deepEqual(successAudit.violations.map(v=>v.id),[]);
      }
      await page.screenshot({path:path.join(output,`accepted-${engineName}-${width}-${javaScriptEnabled?'js':'nojs'}.png`),fullPage:true});
     }
     reports.push({engine:engineName,version:browser.version(),width,javaScriptEnabled,axeViolations:javaScriptEnabled?audit.violations.length:null,mailCaptured:!!mailpit});
     await context.close();
     console.log(`PASS ${engineName} ${width}px ${javaScriptEnabled?'JS':'no-JS'}: validation, safe values, linked errors${javaScriptEnabled?', axe':''}${mailpit?', accepted PRG and real mail capture':''}`);
    }
   }
  } finally {await browser.close();}
 }
 fs.writeFileSync(path.join(output,'browser-results.json'),JSON.stringify(reports,null,2));
})().catch(error=>{console.error(error);process.exitCode=1;});
