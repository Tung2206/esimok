<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly.

/*
 * Default Strings
 */
if (!function_exists('esimok_default_strings')) :
	/*
	 * Default Strings
	 *
	 * @version 1.0.2
	 * @param  string  $key  String key.
	 * @param  boolean $echo Print string.
	 * @return mixed        Return string or nothing.
	 */
	function esimok_default_strings($key, $echo = true)
	{
		$defaults = apply_filters(
			'esimok_default_strings',
			array(
				// Admin Strings.
				'shortcode-attention' => __('Shortcode (applicable to places where the block editor cannot be used)', 'vnbwptheme'),
				'shortcode-validate' => __('Shortcode has not been passed parameters.', 'vnbwptheme'),
				'shortcode-note' => __('The data area has not been entered.', 'vnbwptheme'),
			)
		);

		$output = isset($defaults[$key]) ? $defaults[$key] : '';

		/*
		 * Print or return
		 */
		if ($echo) {
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $output;
		}
	}
endif;
