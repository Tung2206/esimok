<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly.

/*
 * Class: Esimok_Builder_Loader
 * 
 * @package Esimok
 * @version 1.0.2
 */
if (!class_exists('Esimok_Builder_Loader')) :
    class Esimok_Builder_Loader
    {
        /*
         * Instance
         *
         * @var $instance
         */
        private static $instance;

        /*
         * Initiator
         *
         * @version 1.0.2
         * @return object
         */
        public static function get_instance()
        {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /*
         * Constructor
         */
        public function __construct()
        {
            /*
             * Builder Core Files
             */
            require_once ESIMOK_THEME_DIR . 'inc/core/class-esimok-builder-helper.php';

        }
    }

    /*
     * Kicking this off by calling 'get_instance()' method
     */
    Esimok_Builder_Loader::get_instance();
endif;
