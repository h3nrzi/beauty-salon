<?php defined('ABSPATH') || exit; ?>
<div class="appointment-preview" aria-describedby="appointment-unavailable">
<fieldset disabled class="preview-fields"><legend class="screen-reader-text"><?php esc_html_e('Appointment Request preview — online submission unavailable','noir-auto-detailing'); ?></legend>
<div class="field-pair"><div class="field"><label for="request-name"><?php esc_html_e('Full Name *','noir-auto-detailing'); ?></label><input id="request-name" type="text" placeholder="e.g. Julian Vance" autocomplete="name" maxlength="100"></div><div class="field"><label for="request-phone"><?php esc_html_e('Phone Number *','noir-auto-detailing'); ?></label><input id="request-phone" type="tel" placeholder="(310) 000-0000" autocomplete="tel" maxlength="40"></div></div>
<div class="field"><label for="request-email"><?php esc_html_e('Email Address (Optional)','noir-auto-detailing'); ?></label><input id="request-email" type="email" placeholder="client@domain.com" autocomplete="email" maxlength="254"></div>
<div class="field"><label for="request-vehicle"><?php esc_html_e('Vehicle Make & Model *','noir-auto-detailing'); ?></label><input id="request-vehicle" type="text" placeholder="e.g. 2024 Porsche 911 GT3" maxlength="160"></div>
<fieldset class="service-choices"><legend><?php esc_html_e('Service of Interest *','noir-auto-detailing'); ?></legend><div class="service-grid">
<?php
$choices = function_exists('noir_services') ? noir_services() : [];
$interest = isset($_GET['service']) && is_string($_GET['service']) ? wp_unslash($_GET['service']) : '';
$selected = function_exists('noir_service') && noir_service($interest) ? $interest : ($choices[0]['service_id']??'');
foreach ($choices as $choice) : $key=$choice['service_id']; ?><label><input class="screen-reader-text" type="radio" name="service-preview" value="<?php echo esc_attr($key); ?>" <?php checked($key,$selected); ?>><span><?php echo esc_html($choice['title']); ?></span></label><?php endforeach; ?>
</div></fieldset>
<div class="field"><label for="request-date"><?php esc_html_e('Preferred Date (Optional)','noir-auto-detailing'); ?></label><input id="request-date" type="date"></div>
<div class="field"><label for="request-notes"><?php esc_html_e('Message / Notes (Optional)','noir-auto-detailing'); ?></label><textarea id="request-notes" rows="4" maxlength="2000" placeholder="<?php esc_attr_e('Tell us about your vehicle, any specific concerns, or timeline requirements...','noir-auto-detailing'); ?>"></textarea></div>
</fieldset>
<div class="request-explanation"><?php noir_icon('info'); ?><p class="muted"><?php esc_html_e('An Appointment Request does not confirm an appointment. Our team will contact you within 1 business day by phone or email to discuss availability, provide an accurate estimate, and agree the next steps.','noir-auto-detailing'); ?></p></div>
<div class="request-fallback"><p id="appointment-unavailable"><?php esc_html_e('Online appointment requests are not available yet. Please contact the Studio directly to request an appointment.','noir-auto-detailing'); ?></p><div class="fallback-actions"><?php noir_public_contacts(); noir_email_link(); ?></div></div>
<p class="follow-up small-label"><?php esc_html_e('• Prompt 1-Business-Day Follow-Up • Complimentary Consultation','noir-auto-detailing'); ?></p>
</div>
