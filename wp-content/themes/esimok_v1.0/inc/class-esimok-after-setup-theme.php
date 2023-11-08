<?php
/*
 * Khởi tạo lại khi theme active
 *
 * @author hiennguyenduy (nickanhem@gmail.com)
 * @since 2018-12-14
 */
function vnbwptheme_setup()
{
	// Make theme available for translation.
	load_theme_textdomain(VNBWPTHEME_TEXTDOMAIN);

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	));
}
add_action('after_setup_theme', 'vnbwptheme_setup');

/*
 * Đăng ký menu
 *
 * @author hiennguyenduy (nickanhem@gmail.com)
 * @since 2019-12-23
 */
function vnbwptheme_register_menu()
{
	register_nav_menus(array(
		'main_menu' => __('Main Menu', VNBWPTHEME_TEXTDOMAIN),
		'footer_menu' => __('Footer', VNBWPTHEME_TEXTDOMAIN),
	));
}
add_action('after_setup_theme', 'vnbwptheme_register_menu', 0);

/*
 * Đăng ký widget
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @author hiennguyenduy (hiennd@ancu.com)
 * @since 2021-07-12
 */
function vnbwptheme_sidebar_registration()
{
	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Sidebar Mặc Định 
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __('Sidebar Mặc Định', VNBWPTHEME_TEXTDOMAIN),
				'id'          => 'sidebar-1',
				'description' => __('', VNBWPTHEME_TEXTDOMAIN),
			)
		)
	);
	
}
add_action('widgets_init', 'vnbwptheme_sidebar_registration');
