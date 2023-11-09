<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly.

/*
 * Theme Enqueue Scripts
 */
if (!class_exists('Esimok_Enqueue_Scripts')) :
	class Esimok_Enqueue_Scripts
	{
		/*
		 * Instance
		 *
		 * @var $instance
		 */
		private static $instance;

		/*
		 * Class styles.
		 *
		 * @access public
		 * @var $styles Enqueued styles.
		 */
		public static $styles;

		/*
		 * Class scripts.
		 *
		 * @access public
		 * @var $scripts Enqueued scripts.
		 */
		public static $scripts;

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
			add_action('init', array($this, 'front_end_deregister_enqueue_assets'));

			add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'), 1);
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 5);

            add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 10);
            add_action('admin_enqueue_scripts', array($this, 'admin_style'), 1);

		}

		/*
		 * Enqueue Styles Admin
		 */
		public function admin_style()
		{	
			wp_enqueue_style('esimok-style-admin', ESIMOK_THEME_URL . 'assets/css/style-admin.css', false, ESIMOK_THEME_VERSION, 'all');
		}

		/*
		 * Enqueue Styles
		 */
		public function enqueue_styles()
		{	
			wp_enqueue_style('esimok-bootstrap', ESIMOK_THEME_URL . 'assets/css/bootstrap.min.css', false, ESIMOK_THEME_VERSION, 'all');
			// Google Fonts Default
			wp_enqueue_style('esimok-vn-fonts', $this->google_fonts(), array(), null);
			wp_enqueue_style('esimok-typography', ESIMOK_THEME_URL . 'assets/css/typography/typography.css', false, ESIMOK_THEME_VERSION, 'all');

		}
		
		/*
		 * Enqueue Scripts
		 * true => FOOTER
		 * false => HEADER
		 */
		public function enqueue_scripts()
		{	
			wp_enqueue_script('esimok-third-party-jquery', ESIMOK_THEME_URL . 'assets/js/jquery.min.js', false, ESIMOK_THEME_VERSION, false);
			wp_enqueue_script('esimok-bootstrap-min', ESIMOK_THEME_URL . 'assets/js/bootstrap.min.js', false, '5.1.3', false);
			wp_enqueue_script('esimok-third-party-bootstrap-bundle', ESIMOK_THEME_URL . 'assets/js/bootstrap.bundle.min.js', false, '5.1.3', false);
		}

		/*
		 * Regiter style/script
		 * true => FOOTER
		 * false => HEADER
		 */
		public function register_scripts()
		{
			/*
			 * Regiter: stylesheets
			 */
			wp_register_style('esimok-component-single', ESIMOK_THEME_URL . 'assets/css/components/single.css', false, ESIMOK_THEME_VERSION, 'all');
			wp_register_style('esimok-component-slide-blog', ESIMOK_THEME_URL . 'assets/css/components/slide-blog.css', false, ESIMOK_THEME_VERSION, 'all');
			wp_register_style('esimok-component-author', ESIMOK_THEME_URL . 'assets/css/components/author.css', false, ESIMOK_THEME_VERSION, 'all');
			wp_register_style('esimok-vn-breadcrumb', ESIMOK_THEME_URL . 'assets/css/components/breadcrumb.css', false, ESIMOK_THEME_VERSION, 'all');
			wp_register_style('esimok-component-blog', ESIMOK_THEME_URL . 'assets/css/components/blog.css', false, ESIMOK_THEME_VERSION, 'all');
			wp_register_style('esimok-component-home', ESIMOK_THEME_URL . 'assets/css/components/home.css', false, ESIMOK_THEME_VERSION, 'all');
			wp_register_style('esimok-component-pagination', ESIMOK_THEME_URL . 'assets/css/components/pagination.css', false, ESIMOK_THEME_VERSION, 'all');
			wp_register_style('esimok-component-header', ESIMOK_THEME_URL . 'assets/css/components/header.css', false, ESIMOK_THEME_VERSION, 'all');
			wp_register_style('esimok-component-footer', ESIMOK_THEME_URL . 'assets/css/components/footer.css', false, ESIMOK_THEME_VERSION, 'all');
			wp_register_style('esimok-third-party-owl-carousel', ESIMOK_THEME_URL . 'assets/css/owl.carousel.min.css', false, '2.3.4', 'all');
			wp_register_style('esimok-component-banner-home', ESIMOK_THEME_URL . 'assets/css/components/banner-home.css', false, '2.3.4', 'all');
			wp_register_style('esimok-component-taxonomy-esim', ESIMOK_THEME_URL . 'assets/css/components/taxonomy-esim.css', false, '2.3.4', 'all');
			wp_register_style('esimok-component-single-esim', ESIMOK_THEME_URL . 'assets/css/components/single-esimok.css', false, '2.3.4', 'all');

			/*
			 * Regiter: scripts
			 */
			// Components
			wp_register_script('esimok-third-party-owl-carousel', ESIMOK_THEME_URL . 'assets/js/owl.carousel.min.js', false, '2.3.4', true);			
			wp_register_script('esimok-js-carosel', ESIMOK_THEME_URL . 'assets/js/custom-carosel.js', false, ESIMOK_THEME_VERSION, 'all');
		
		}	

		public static function front_end_deregister_enqueue_assets()
		{
			if (!is_admin()) {
				wp_deregister_script('brb-wpac-time-js');
				wp_deregister_script('blazy-js');
				wp_deregister_script('swiper-js');
				wp_deregister_script('rplg-js');
				wp_deregister_script('google-recaptcha');

				wp_register_script('brb-wpac-time-js', false);
				wp_register_script('blazy-js', false);
				wp_register_script('swiper-js', false);
				wp_register_script('rplg-js', false);
				wp_register_script('google-recaptcha', false);

				wp_deregister_style('awsm-ead-public');
				wp_deregister_style('contact-form-7');
				wp_deregister_style('toc-screen');
				wp_deregister_style('rplg-css');
				wp_deregister_style('swiper-css');
			}
		}
		/*
		 * Trim CSS
		 *
		 * @version 1.0.2
		 * @param string $css CSS content to trim.
		 * @return string
		 */
		public static function trim_css($css = '')
		{
			// Trim white space for faster page loading.
			if (!empty($css)) {
				$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
				$css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
				$css = str_replace(', ', ',', $css);
			}

			return $css;
		}

		/*
		 * Hook: styles
		 *
		 * @author tungnt (tungnt@vietnamdiscovery.com)
     	 * @since 2023-07-19
		 * 
		 * @package Wowcher
		 * @version 1.0.3
		 */
		public static function hook_styles($file_name = '', $type = 'components')
		{
			if ($file_name == '' || !in_array($type, ['components', 'shortcodes'])) return;

			if ($type == 'components') {
				// Load CSS
				wp_enqueue_style('esimok-components');
				wp_add_inline_style('esimok-components', file_get_contents(ESIMOK_THEME_DIR . 'assets/css/components/' . $file_name . '.css'));
			} elseif ($type == 'shortcodes') {
				// Load CSS
				wp_enqueue_style('esimok-shortcodes');
				wp_add_inline_style('esimok-shortcodes', file_get_contents(ESIMOK_THEME_DIR . 'assets/css/shortcodes/' . $file_name . '.css'));
			} else {
				return;
			}
		}

		/**
         * Register Google fonts.
         *
         * @return string Google fonts URL for the theme.
         * value : 'londrina-solid' => 'Londrina+Solid:300,400,900',
         * @since 2.4.0
         */
        public function google_fonts()
        {
            $google_fonts = apply_filters('seafarertran_google_font_families',
                [
                    'Inter' => 'Inter:400,500,600,700'
                ]
            );

            if (count($google_fonts) <= 0) {
                return false;
            }

            $query_args = array(
                'family' => implode('|', $google_fonts),
                'subset' => rawurlencode('latin,latin-ext'),
                'display' => 'swap',
            );

            $fonts_url = add_query_arg($query_args, '//fonts.googleapis.com/css');

            return $fonts_url;
        }
	}

	/*
	 * Kicking this off by calling 'get_instance()' method
	 */
	Esimok_Enqueue_Scripts::get_instance();
endif;
