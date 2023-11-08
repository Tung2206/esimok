<?php
/*
 * WordPress Multi-Environment Config - Load config settings
 *
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    2.0.0
 * @author     Studio 24 <hello@studio24.net>
 */


function s24_load_environment_config()
{
    /**
     * Setup environment
     */

    // We need to set $argv as global to be able to access it
    global $argv;

    // Set env if set via environment variable
    if (getenv('VNB_ENV') !== false && !empty(getenv('VNB_ENV'))) {
        define('VNB_ENV', preg_replace('/[^a-z]/', '', getenv('VNB_ENV')));
    }

    // Set env via --env=<environment> argument if running via WP-CLI
    if (!defined('VNB_ENV') && PHP_SAPI == "cli" && defined('WP_CLI_ROOT')) {
        foreach ($argv as $arg) {
            if (preg_match('/--env=(.+)/', $arg, $m)) {
                define('VNB_ENV', $m[1]);
                break;
            }
        }
        // Also support via .env file in config directory
        if (!defined('VNB_ENV')) {
            if (file_exists(__DIR__ . '/.env')) {
                $environment = trim(file_get_contents(__DIR__ . '/.env'));
                $value = preg_replace('/[^a-z]/', '', $environment);
                if (!empty($value)) {
                    define('VNB_ENV', $value);
                }
            }
        }
    }

    // Define site host
    if (isset($_SERVER['HTTP_X_FORWARDED_HOST']) && !empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
        $hostname = strtolower(filter_var($_SERVER['HTTP_X_FORWARDED_HOST'], FILTER_SANITIZE_STRING));
    } elseif (isset($_SERVER['HTTP_HOST'])) {
        $hostname = strtolower(filter_var($_SERVER['HTTP_HOST'], FILTER_SANITIZE_STRING));
    }

    if (!defined('VNB_ENV') && empty($hostname)) {
        throw new Exception("Cannot determine current environment via VNB_ENV or hostname");
    }

    // Load environments
    require  __DIR__ . '/wp-config.env.php';

    /*
     * If the hostname isn't already defined (if we are interacting with WordPress
     * via the CLI for example) then get the Hostname using the VNB_ENV environment
     * variable
     */
    if (empty($hostname) && isset($env[VNB_ENV])) {
        if (is_array($env[VNB_ENV]['domain'])) {
            // Take first defined domain if config has an array of domains
            $hostname = $env[VNB_ENV]['domain'][0];
        } else {
            $hostname = $env[VNB_ENV]['domain'];
        }
    }

    if (empty($hostname)) {
        throw new Exception("Cannot determine current WordPress domain");
    }

    foreach ($env as $environment => $env_vars) {
        if (!isset($env_vars['domain'])) {
            throw new Exception('You must set the domain value in your environment array, see wp-config.env.php');
        }
        $domain = $env_vars['domain'];
        if (!is_array($domain)) {
            $domain = [$domain];
        }
        foreach ($domain as $domain_name) {
            $wildcard = (strpos($domain_name, '*') !== false) ? true : false;
            if ($wildcard) {
                $match = '/' . str_replace('*', '([^.]+)', preg_quote($domain_name, '/')) . '/';
                if (preg_match($match, $hostname, $m)) {
                    if (!defined('VNB_ENV')) {
                        define('VNB_ENV', $environment);
                    }
                    define('VNB_ENV_DOMAIN', str_replace('*', $m[1], $domain_name));
                    if (isset($env_vars['ssl'])) {
                        define('VNB_ENV_SSL', (bool) $env_vars['ssl']);
                    }
                    if (isset($env_vars['path'])) {
                        define('VNB_ENV_PATH', trim($env_vars['path'], '/'));
                    }
                    break;
                }
            } elseif ($hostname === $domain_name) {
                if (!defined('VNB_ENV')) {
                    define('VNB_ENV', $environment);
                }
                define('VNB_ENV_DOMAIN', $domain_name);
                if (isset($env_vars['ssl'])) {
                    define('VNB_ENV_SSL', (bool) $env_vars['ssl']);
                }
                if (isset($env_vars['path'])) {
                    define('VNB_ENV_PATH', trim($env_vars['path'], '/'));
                }
                break;
            }
        }
    }

    /**
     * Define WordPress Site URLs
     */
    if (!defined('VNB_ENV_SSL')) {
        define('VNB_ENV_SSL', false);
    }
    if (VNB_ENV_SSL && (!defined('FORCE_SSL_ADMIN'))) {
        define('FORCE_SSL_ADMIN', true);
    }
    $protocol = (VNB_ENV_SSL) ? 'https://' : 'http://';
    $path = (defined('VNB_ENV_PATH')) ? '/' . trim(VNB_ENV_PATH, '/') : '';

    if (!defined('WP_SITEURL')) {
        define('WP_SITEURL', $protocol . trim($hostname, '/') . $path);
    }
    if (!defined('WP_HOME')) {
        define('WP_HOME', $protocol . trim($hostname, '/') . $path);
    }
}
s24_load_environment_config();

/**
 * Load config
 */
// 1st - Load default config
require  __DIR__ . '/wp-config.default.php';

// 2nd - Load config file for current environment
require  __DIR__ . '/wp-config.' . VNB_ENV . '.php';

// 3rd - Load local config file with any sensitive settings
if (file_exists(__DIR__ . '/wp-config.local.php')) {
    require  __DIR__ . '/wp-config.local.php';
}
