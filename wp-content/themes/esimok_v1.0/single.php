<?php

/**
 * The blog template file.
 *
 * @package Esimok Single
 * @Esimok 1.0
 */

get_header();
global $post;

// Breadcrumb: create HTML code
get_template_part(
	'template-parts/header/breadcrumb',
	null,
	array(
		'type' => 'post',
		'object_id' => $post->ID,
		'object_type' => null
	)
);
?>

<div id="content" class="blog-wrapper blog-single page-wrapper">
	<div class="main-content-single">
		<div class="container">
			<div class="relative">
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<div class="main-table-content">
							<?php
							echo do_shortcode('[ez-toc]');
							?>
						</div>
					</div>
					<div class="col-sm-12 col-md-8">
						<div class="main-content esimok-right-content">
							<h1><?php the_title(); ?></h1>
							<?php get_template_part('template-parts/author-bio'); ?>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	$tags = wp_get_post_categories($post->ID);
	$category_link = get_category_link($tags[0]);
	if ($tags) :
		$args = array(
			'category__in' => $tags,
			'post__not_in' => array($post->ID),
			'posts_per_page' => 6,
			'ignore_sticky_posts' => 1
		);
		$my_query = new WP_Query($args);
		if ($my_query->post_count > 0) :
	?>
			<div class="releat-content-single">
				<div class="container">
					<div class="relative">
						<div class="row">
							<div class="col-md-12">
								<div class="releat-content">
									<div class="item-list-releat">
										<h3 class="sub-title"><?php echo esc_html__('Blog', 'vnbwptheme'); ?></h3>
										<div class="des-releat-conent">
											<div class="desc">
												<?php echo esc_html__('We’ve curated some amazing experiences to help you find your next getaway.', 'vnbwptheme'); ?>
											</div>
											<div class="view-link">
												<a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html__('View all experiences', 'vnbwptheme'); ?></a>
											</div>
										</div>
										<div class="list-blog-releat">
											<div class="<?php echo ($my_query->post_count > 4) ? 'owl-carousel owl-theme owl-3' : 'row'; ?> ">
												<?php
												if ($my_query->have_posts()) :
													while ($my_query->have_posts()) : $my_query->the_post();
														$post_in = $post;
														$title_temp = get_the_title($post_in->ID);
														$link_temp = get_the_permalink($post_in->ID);
														$img = get_the_post_thumbnail_url($post_in->ID);
														$cat_name = get_cat_name($tags[0]);
												?>
														<div class="<?php echo ($my_query->post_count > 4) ? 'item' : 'item col-12 col-md-3'; ?>">
															<div class="thumb">
																<a href="<?php echo $link_temp; ?>">
																	<img src="<?php echo esimok_resize_image($img, 380 * 1.5, 280 * 1.5); ?>" class="attachment-thumbnail size-thumbnail wp-post-image fadein img-responsive" alt="<?php echo $title_temp; ?>" title="<?php echo $title_temp; ?>">
																</a>
															</div>
															<div class="item-releat-content">
																<div class="cate_name">
																	<?php echo $cat_name; ?>
																</div>
																<h4 class="title_handbook heading-6-dest">
																	<a href="<?php echo $link_temp; ?>" title="<?php echo $title_temp; ?>">
																		<?php echo the_title($post_in->ID) ?>
																	</a>
																</h4>
																<p class="post_description">
																	<?php echo get_the_excerpt(); ?>
																</p>
															</div>
														</div>
												<?php endwhile;
												endif;
												wp_reset_query(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

	<?php
		endif;
	endif;
	?>
	<script>
		// Scrol active nội dung tương ứng của table off content
		window.addEventListener('DOMContentLoaded', () => {
			const tocItems = document.querySelectorAll('nav li a[href^="#"]');
			const headerElements = document.querySelectorAll('h2, h3');

			function checkScroll() {
				const scrollPosition = window.scrollY;
				let activeTocLink = null;
				// Tìm mục con được active cuối cùng
				for (const headerElement of headerElements) {
					const id = headerElement.querySelector('.ez-toc-section').getAttribute('id');
					const tocLink = document.querySelector(`nav li a[href="#${id}"]`);

					if (headerElement.offsetTop <= scrollPosition) {
						activeTocLink = tocLink;
					} else {
						break;
					}
				}

				// Loại bỏ active trên tất cả các mục
				tocItems.forEach(tocItem => {
					tocItem.parentElement.classList.remove('active');
				});

				if (activeTocLink) {
					// Đánh dấu mục cha và các mục con là active
					let tocItemElement = activeTocLink.parentElement;
					while (tocItemElement) {
						tocItemElement.classList.add('active');
						tocItemElement = tocItemElement.parentElement.closest('li.ez-toc-page-1');
					}
				}
			}

			window.addEventListener('scroll', checkScroll);

			// Kiểm tra khi trang vừa tải xong
			checkScroll();
		});
			
	</script>
</div>

<?php
// Load CSS
wp_enqueue_style('esimok-component-single');
wp_enqueue_style('esimok-component-slide-blog');
wp_enqueue_style('esimok-component-table-content');
wp_enqueue_style('esimok-third-party-owl-carousel');

// Load JS
wp_enqueue_script('esimok-third-party-owl-carousel');
wp_enqueue_script('esimok-js-carosel');
get_footer();

?>