<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly.

/*
 * Class: Esimok_Shortcode_eSim_Search
 *
 * @package Esimok
 * @version 1.0.2
 */
if (!class_exists('Esimok_Shortcode_eSim_Search')) :
    class Esimok_Shortcode_eSim_Search
    {
        /*
		 * Instance
		 *
		 * @var $instance
		 */
        private static $instance;

        /*
		 * Shortcode: label
		 *
		 * @var string
		 */
        private static $shortcode_label = 'VNB eSim Search';

        /*
		 * Shortcode: slug
		 *
		 * @var string
		 */
        private static $shortcode_slug = 'vnb-esim-search';

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
            // Lazyblock: shortcode instance
            lazyblocks()->add_block(
                array(
                    'title' => self::$shortcode_label,
                    'icon' => Esimok_Builder_Helper::$lazyblock_icon,
                    'slug' => 'lazyblock/' . self::$shortcode_slug,
                    'description' => '',
                    'category' => 'layout',
                    'category_label' => 'layout',
                    'supports' => Esimok_Builder_Helper::$lazyblock_supports,
                    'controls' => array(),
                    'code' => Esimok_Builder_Helper::$lazyblock_code,
                    'condition' => Esimok_Builder_Helper::$lazyblock_condition,
                )
            );

            // Lazyblock: show shortcode for content developer uses
            add_filter('lazyblock/' . self::$shortcode_slug . '/editor_callback', array($this, 'output_editor'), 10, 2);

            // Lazyblock: register shortcode
            add_filter('lazyblock/' . self::$shortcode_slug . '/frontend_callback', array($this, 'register_shortcode'), 10, 2);

            // Lazyblock: render shortcode
            add_shortcode('gigago_esim_search', array($this, 'render_shortcode'));
        }

        /*
		 * Output editor
		 */
        public static function output_editor()
        {


            $shortcode = '[gigago_esim_search]';

            return Esimok_Builder_Helper::render_shortcode_attention($shortcode);
        }

        /*
		 * Register shortcode
		 */
        public static function register_shortcode()
        {
            $shortcode = '[gigago_esim_search]';

            return $shortcode;
        }

        /*
		 * Render shortcode
		 */
        public static function render_shortcode()
        {
            ob_start();
            // Create HTML code
            get_template_part(
                'template-parts/listing/esim-search',
                null
            );
            $markup_html = ob_get_contents();
            ob_end_clean();
            return $markup_html;
        }
    }

    /*
	 * Kicking this off by calling 'get_instance()' method
	 */
    Esimok_Shortcode_eSim_Search::get_instance();
endif;
