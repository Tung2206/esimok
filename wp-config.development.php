<?php
/*
 * Development environment config settings
 *
 * Enter any WordPress config settings that are specific to this environment
 * in this file.
 *
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    2.0.0
 * @author     Studio 24 Ltd  <hello@studio24.net>
 */

// ** MySQL settings - You can get this info from your web host ** //
/* The name of the database for WordPress */
define('DB_NAME', 'wp_esimok_v1_blog');

/* MySQL database username */
// define('DB_USER', 'hub_vidi_v1');
define('DB_USER', 'esimok_v1_blog');

/* MySQL database password */
// define('DB_PASSWORD', 'GrV8LiAEpGAJfaaLRq');
define('DB_PASSWORD', 'jZ1VikwjSKAduutFGc');

/* MySQL hostname */
define('DB_HOST', 'localhost');

/* MySQL database password - set in wp-config.local.php */

/*
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
// define('WP_DEBUG_DISPLAY', false);
// define('WP_DEBUG_LOG', true);

/*
 * Không cho phép tự ý cài đặt hoặc upgrade wordpress + themes + plugins
 * added by hiennguyenduy (hiennd@ancu.com) at 2019-03-28
 */
// cho phép upgrade
// define('FS_METHOD', 'direct');

// không cho phép upgrade
define( 'DISALLOW_FILE_MODS', true );
define( 'DISALLOW_FILE_EDIT', true );
