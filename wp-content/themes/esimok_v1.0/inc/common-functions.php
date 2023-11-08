<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly.

if (!function_exists('esimok_resize_image')) :
	/*
	 * Resize image
	 *
	 * @author tungnt (tungnt@vietnamdiscovery.com)
     * @since 2023-07-19
	 * 
	 * @package Esimok
	 * @version 3.5.20
	 */
	function esimok_resize_image($thumb_path, $image_width, $image_height)
	{
		if (empty($thumb_path)) $thumb_path = ESIMOK_URL . 'wp-content/uploads/default.png';

		$params = array();
		if (!empty($image_width)) {
			$params['width'] = $image_width;
		}
		if (!empty($image_height)) {
			$params['height'] = $image_height;
		}

		$custom_img_src = bfi_thumb($thumb_path, $params);

		return $custom_img_src;
	}
endif;

if (!function_exists('esimok_pagination')) :
	/*
	 * Pagination
	 *
	 * @author tungnt (tungnt@vietnamdiscovery.com)
     * @since 2023-07-19
	 * 
	 * @package Esimok
	 * @version 1.0.0
	 */
	function esimok_pagination()
	{
		global $wp_query;

		/* Stop execution if there's only 1 page */
		if ($wp_query->max_num_pages <= 1)
			return;

		$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
		$max   = intval($wp_query->max_num_pages);

		/* Add current page to the array */
		if ($paged >= 1)
			$links[] = $paged;

		/* Add the pages around the current page to the array */
		if ($paged >= 3) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if (($paged + 2) <= $max) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<div class="esimok-pagination mg-bottom">';
		echo '<div class="container">';
		echo '<div class="row">';
		echo '<div class="col-md-12">';
		echo '<div class="dataTables_paginate paging_simple_numbers ml-5"><ul class="pagination d-flex list-unstyled justify-content-center align-items-center">' . "\n";

		/* Link to first page, plus ellipses if necessary */
		if (!in_array(1, $links)) {
			$class = 1 == $paged ? ' class="active-page"' : '';
			printf('<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

			if (!in_array(2, $links))
				echo '<li class="dots_pagination">...</li>';
		}

		/* Link to current page, plus 2 pages in either direction if necessary */
		sort($links);
		foreach ((array) $links as $link) {
			$class = $paged == $link ? ' class="active-page"' : '';
			printf('<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
		}

		/* Link to last page, plus ellipses if necessary */
		if (!in_array($max, $links)) {
			if (!in_array($max - 1, $links))
				echo '<li class="dots_pagination">...</li>' . "\n";

			$class = $paged == $max ? ' class="active-page"' : '';
			printf('<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
		}

		echo '</ul></div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo "\n";
	}

endif;

if (!function_exists('esimok_create_schema_howto')) :
	/*
	 * Tạo schema HowTo
	 *
	 * @author tungnt (tungnt@vietnamdiscovery.com)
     * @since 2023-07-19
	 */
	function esimok_create_schema_howto()
	{
		if (is_singular('post') || is_singular('page') || is_singular('embassy_city') || is_singular('requirement')) {
			global $post;

			$ht_title = get_field('ht_title', $post);
			$ht_description = get_field('ht_description', $post);
			$ht_main_image = get_field('ht_main_image', $post);

			$ht_step = get_field('ht_step', $post);
		} elseif (is_tax('how_to_get')) {
			$current_term = get_queried_object();

			$ht_title = get_field('ht_title', $current_term);
			$ht_description = get_field('ht_description', $current_term);
			$ht_main_image = get_field('ht_main_image', $current_term);

			$ht_step = get_field('ht_step', $current_term);
		} else {
			return false;
		}

		$schema_str = '';

		if (!empty($ht_title) || !empty($ht_description) || !empty($ht_main_image) || !empty($ht_step)) {
			$schema_str .= '<script type="application/ld+json">{';
			$schema_str .= '"@context": "http://schema.org",';
			$schema_str .= '"@type": "HowTo",';
			if (!empty($ht_title)) {
				$schema_str .= '"name": "' . $ht_title . '",';
			}
			if (!empty($ht_description)) {
				$schema_str .= '"description": "' . $ht_description . '",';
			}
			if (!empty($ht_main_image)) {
				$schema_str .= '"image": {';
				$schema_str .= '"@type": "ImageObject",';
				$schema_str .= '"url": "' . $ht_main_image . '"';
				$schema_str .= '},';
			}
			$schema_str .= '"step": [';
			if (!empty($ht_step)) {
				foreach ($ht_step as $key => $value) {
					$comma_last = ($key == count($ht_step) - 1) ? '' : ',';
					$schema_str .= '{';
					$schema_str .= '"@type": "HowToStep",';
					if (!empty($value['ht_sub_name'])) {
						$schema_str .= '"name": "' . $value['ht_sub_name'] . '",';
					}
					$schema_str .= '"itemListElement": [';
					if (!empty($value['ht_sub_step'])) {
						foreach ($value['ht_sub_step'] as $key_sub => $value_sub) {
							$comma_last_sub = ($key_sub == count($value['ht_sub_step']) - 1) ? '' : ',';

							if (!empty($value['ht_sub_image']) || !empty($value_sub['htst_description'])) {
								$schema_str .= '{';
								$schema_str .= '"@type": "HowToDirection",';
								$schema_str .= '"text": "' . $value_sub['htst_description'] . '"';
								$schema_str .= '}' . $comma_last_sub;
							}
						}
					}
					if (empty($value['ht_sub_image'])) {
						$schema_str .= ']';
					} else {
						$schema_str .= '],';
						$schema_str .= '"image": {';
						$schema_str .= '"@type": "ImageObject",';
						$schema_str .= '"url": "' . $value['ht_sub_image'] . '"';
						$schema_str .= '}';
					}
					$schema_str .= '}' . $comma_last;
				}
			}
			$schema_str .= ']';
			$schema_str .= '}</script>';
		}

		return $schema_str;
	}
endif;

function excerpt($limit)
{
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
	return $excerpt;
}

//add class active menu
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);
function special_nav_class($classes, $item)
{
	if (
		in_array('current-menu-item', $classes) ||
		in_array('current-menu-ancestor', $classes) ||
		in_array('current-menu-parent', $classes) ||
		in_array('current_page_parent', $classes) ||
		in_array('current_page_ancestor', $classes)
	) {

		$classes[] = "active_menu";
	}
	return $classes;
}