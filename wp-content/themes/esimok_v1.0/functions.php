<?php
/*
 * Esimok functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * 
 * @version 1.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly.

/*
 * Define Constants
 */
define('ESIMOK_DIR', trailingslashit(ABSPATH));
define('ESIMOK_URL', trailingslashit(esc_url(home_url())));

define('VNBWPTHEME_TEXTDOMAIN', 'vnbwptheme');

$my_theme = wp_get_theme();
define('ESIMOK_THEME_NAME', sanitize_title($my_theme->get('Name')));
define('ESIMOK_THEME_VERSION', $my_theme->get('Version'));
define('ESIMOK_THEME_SETTINGS', 'esimok-settings');
define('ESIMOK_THEME_DIR', trailingslashit(get_template_directory()));
define('ESIMOK_THEME_URL', trailingslashit(esc_url(get_template_directory_uri())));

define('BFITHUMB_UPLOAD_DIR', 'thumbnail');

/*
 * Setup helper functions of Esimok
 */
require_once ESIMOK_THEME_DIR . 'inc/common-functions.php';
require_once ESIMOK_THEME_DIR . 'inc/core/class-esimok-theme-options.php';

/*
 * Register Post Types.
 */
require_once ESIMOK_THEME_DIR . 'inc/class-esimok-post-types.php';

/*
 * Compatibility
 */
require_once ESIMOK_THEME_DIR . 'inc/builder/class-esimok-builder-loader.php';

/*
 * Functions and definitions.
 */
require_once ESIMOK_THEME_DIR . 'inc/class-esimok-after-setup-theme.php';
require_once ESIMOK_THEME_DIR . 'inc/class-esimok-enqueue-scripts.php';
require_once ESIMOK_THEME_DIR . 'inc/class-esimok-optimize-theme.php';
require_once ESIMOK_THEME_DIR . 'inc/ajax.php';
require_once ESIMOK_THEME_DIR . 'third-parties/BFI_Thumb.php';
