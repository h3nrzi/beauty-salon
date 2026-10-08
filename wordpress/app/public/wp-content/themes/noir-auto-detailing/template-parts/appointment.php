<?php
defined('ABSPATH') || exit;
if (function_exists('noir_appointment_form')) { noir_appointment_form(); }
else { get_template_part('template-parts/appointment-unavailable'); }
