<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly.

/*
 * Post types Class.
 */
if (!class_exists('Visana_Post_Types')) :
    class Visana_Post_Types
    {
        /*
		 * Instance
		 *
		 * @var $instance
		 */
        private static $instance;

        /*
		 * Supports
		 *
		 * @var string[][]
		 */
        private static $supports = array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'comments'
        );

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
		 * Hook in methods.
		 */
        public function __construct()
        {


            // Post Type: Esimok List
            register_post_type(
                'esimok',
                array(
                    'label' => __('Esimok', 'esimok'),
                    'labels' => array(
                        'name' => __('Esimok', 'esimok'),
                        'singular_name' => __('Esimok', 'esimok'),
                        'menu_name' => __('Esimok', 'esimok'),
                    ),
                    'description' => 'Thêm danh sách Esimok',
                    'public' => true,
                    'hierarchical'  => true,
                    'query_var'     => true,
                    'show_in_rest' => true,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'delete_with_user' => false,
                    'rest_base' => '',
                    'rest_controller_class' => 'WP_REST_Posts_Controller',
                    'has_archive' => false,
                    'show_in_menu' => true,
                    'show_in_nav_menus' => true,
                    'menu_position' => 10,
                    'exclude_from_search' => false,
                    'capability_type' => 'post',
                    'map_meta_cap' => true,
                    'hierarchical' => true,
                    'rewrite' => array(
                        'slug' => 'esimok',
                        'with_front' => true
                    ),
                    'query_var' => true,
                    'menu_icon' => 'dashicons-index-card',
                    'supports' => self::$supports,
                )
            );

            register_post_type(
                'template-esim',
                array(
                    'label' => __('Template esimok', 'esimok'),
                    'labels' => array(
                        'name' => __('Template esimok', 'esimok'),
                        'singular_name' => __('Template esimok', 'esimok'),
                        'menu_name' => __('Template esimok', 'esimok'),
                    ),
                    'description' => 'Thêm template esimok',
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'delete_with_user' => false,
                    'rest_base' => '',
                    'rest_controller_class' => 'WP_REST_Posts_Controller',
                    'has_archive' => false,
                    'show_in_menu' => true,
                    'show_in_nav_menus' => true,
                    'menu_position' => 10,
                    'exclude_from_search' => false,
                    'capability_type' => 'post',
                    'map_meta_cap' => true,
                    'hierarchical' => true,
                    'rewrite' => array(
                        'slug' => 'template-esimok',
                        'with_front' => true
                    ),
                    'query_var' => true,
                    'menu_icon' => 'dashicons-index-card',
                    'supports' => self::$supports,
                    'show_in_rest' => true,
                )
            );

            // Taxonomy: Esimok Categories
            register_taxonomy(
                'esimok_categories',
                array('esimok'),
                array(
                    'label' => __('Các nước Esimok', 'esimok'),
                    'labels' => array(
                        'name' => __('Các nước Esimok', 'esimok'),
                        'singular_name' => __('Các nước Esimok', 'esimok'),
                    ),
                    'public' => true,
                    'publicly_queryable' => true,
                    'hierarchical'  => true,
                    'show_in_rest' => true,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_nav_menus' => true,
                    'query_var' => true,
                    'rewrite' => array(
                        'slug' => 'country',
                        'with_front' => true,
                        'hierarchical' => true
                    ),
                    'show_admin_column' => true,
                    'rest_base' => 'esimok_categories',
                    'rest_controller_class' => 'WP_REST_Terms_Controller',
                    'show_in_quick_edit' => true,
                )
            );
        }
    }

    /*
	 * Kicking this off by calling 'get_instance()' method
	 */
    Visana_Post_Types::get_instance();
endif;
