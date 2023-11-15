<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly.

/*
 * Class: Esimok_Builder_Helper
 * 
 * @package Esimok
 * @version 1.0.2
 */
if (!class_exists('Esimok_Builder_Helper')) :
    final class Esimok_Builder_Helper
    {
        /*
		 * Instance
		 *
		 * @var $instance
		 */
        private static $instance;

        /*
         * Lazyblock Icon
         *
         * @var string
         */
        public static $lazyblock_icon = 'dashicons dashicons-smiley';

        /*
         * Lazyblock Condition
         *
         * @var string[]
         */
        public static $lazyblock_condition = array();

        /*
         * Lazyblock Code
         *
         * @var string[]
         */
        public static $lazyblock_code = array(
            'editor_html' => '',
            'editor_callback' => '',
            'editor_css' => '',
            'frontend_html' => '',
            'frontend_callback' => '',
            'frontend_css' => '',
            'show_preview' => 'always',
            'single_output' => false,
        );

        /*
         * Lazyblock Supports
         *
         * @var string[][]
         */
        public static $lazyblock_supports = array(
            'customClassName' => true,
            'anchor' => false,
            'align' => array(
                0 => 'wide',
                1 => 'full',
            ),
            'html' => false,
            'multiple' => true,
            'inserter' => true,
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
         * Hiển thị code shortcode cho content developer sử dụng
         *
         * @author tungnt (tungnt@vietnamdiscovery.com)
         * @since 2023-11-15
         * 
         * @package esimok
         * @version 1.0
         */
        public static function render_shortcode_attention($content)
        {
            ob_start();
            $id = uniqid(); ?>

            <div class="gigago-vn-shortcode-attention">
                <p><?php echo esc_html(esimok_default_strings('shortcode-attention', false)); ?></p>
                <style>
                    .d-flex {
                        display: flex;
                    }

                    .flex-wrap {
                        flex-wrap: wrap;
                    }

                    .algin-items-center {
                        align-items: center;
                    }

                    .m-0 {
                        margin: 0 !important;
                    }

                    .code-<?= $id ?> {
                        display: none;
                        width: 100%;
                        padding: 10px;
                        font-size: 11px;
                        background-color: #eadcc2;
                    }

                    .btn-tabs-toggle {
                        display: block !important;
                        background-color: #eadcc2 !important;
                        width: 16px !important;
                        height: 16px !important;
                        border: 1px solid #eadcc2 !important;
                        margin-left: 5px !important;
                        outline: none !important;
                        border: none !important;
                    }

                    .btn-tabs-toggle:checked+code {
                        display: block;
                    }
                </style>

                <div class="d-flex flex-wrap algin-items-center">
                    <label class="m-0" for="id-<?= $id ?>">Hiển thị code</label>
                    <input id="id-<?= $id ?>" class="btn-tabs-toggle m-0" type="checkbox" value="Show">
                    <code class="code-<?= $id ?>"><?= $content ?></code>
                </div>
            </div>

            <?php
            $attention_html = ob_get_contents();
            ob_end_clean();

            return $attention_html;
        }
    }

    /*
	 * Kicking this off by calling 'get_instance()' method
	 */
    Esimok_Builder_Helper::get_instance();
endif;
