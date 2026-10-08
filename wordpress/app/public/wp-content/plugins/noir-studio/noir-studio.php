<?php
/**
 * Plugin Name: NOIR Studio
 * Description: Canonical Studio content, shared settings and validated Appointment Requests.
 * Version: 0.4.0
 * Requires at least: 6.4
 * Requires PHP: 8.0
 * Text Domain: noir-studio
 */
defined('ABSPATH') || exit;
require_once __DIR__ . '/includes/fields.php';
require_once __DIR__ . '/includes/contact.php';
require_once __DIR__ . '/includes/settings.php';
require_once __DIR__ . '/includes/services.php';
require_once __DIR__ . '/includes/services-page.php';
require_once __DIR__ . '/includes/projects.php';
require_once __DIR__ . '/includes/gallery-page.php';
require_once __DIR__ . '/includes/home-page.php';

require_once __DIR__ . '/includes/appointment.php';

if (defined('WP_CLI') && WP_CLI) { require_once __DIR__ . '/includes/bootstrap.php'; }
