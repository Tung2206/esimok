<?php
/*
 * Template Name: Home page
 * 
 * @author tungnt (tungnt@vietnamdiscovery.com)
 * @since 2023-10-31
 * 
 * @package Visana
 * @version 3.5.1
 */

get_header();
// Load CSS
wp_enqueue_style('esimok-component-home');
global $post;

?>
<div id="home">
    <section class="section1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="esim-setion1">
                        <h1 class="text-center text-white">Find the best prepaid eSIM plans for your travel
                            destination
                        </h1>
                        <form class="position-relative mb-3">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.12075 1.93477C6.31611 1.83702 6.53155 1.78613 6.75 1.78613C6.96845 1.78613 7.18389 1.83702 7.37925 1.93477L11.124 3.80827C11.2035 3.84727 11.2965 3.84727 11.376 3.80827L14.2778 2.35702C14.4921 2.24992 14.7303 2.19937 14.9697 2.21019C15.2091 2.22101 15.4418 2.29283 15.6456 2.41883C15.8495 2.54484 16.0178 2.72085 16.1345 2.93016C16.2512 3.13946 16.3125 3.37513 16.3125 3.61477V12.9785C16.3125 13.511 16.0117 13.9985 15.5347 14.2363L11.8785 16.064C11.6833 16.1615 11.4682 16.2123 11.25 16.2123C11.0318 16.2123 10.8167 16.1615 10.6215 16.064L6.876 14.1913C6.83689 14.1717 6.79375 14.1615 6.75 14.1615C6.70625 14.1615 6.66311 14.1717 6.624 14.1913L3.723 15.6425C3.50859 15.7498 3.27031 15.8005 3.0308 15.7898C2.79129 15.779 2.55851 15.7072 2.35455 15.5812C2.1506 15.4552 1.98225 15.2791 1.8655 15.0697C1.74875 14.8603 1.68748 14.6245 1.6875 14.3848V5.02102C1.6875 4.48852 1.98825 4.00102 2.4645 3.76327L6.12075 1.93552V1.93477ZM6.75 4.49977C6.89918 4.49977 7.04226 4.55904 7.14775 4.66453C7.25324 4.77001 7.3125 4.91309 7.3125 5.06227V11.2498C7.3125 11.399 7.25324 11.542 7.14775 11.6475C7.04226 11.753 6.89918 11.8123 6.75 11.8123C6.60082 11.8123 6.45774 11.753 6.35225 11.6475C6.24676 11.542 6.1875 11.399 6.1875 11.2498V5.06227C6.1875 4.91309 6.24676 4.77001 6.35225 4.66453C6.45774 4.55904 6.60082 4.49977 6.75 4.49977ZM11.8125 6.74977C11.8125 6.60059 11.7532 6.45751 11.6477 6.35203C11.5423 6.24654 11.3992 6.18727 11.25 6.18727C11.1008 6.18727 10.9577 6.24654 10.8523 6.35203C10.7468 6.45751 10.6875 6.60059 10.6875 6.74977V12.9373C10.6875 13.0865 10.7468 13.2295 10.8523 13.335C10.9577 13.4405 11.1008 13.4998 11.25 13.4998C11.3992 13.4998 11.5423 13.4405 11.6477 13.335C11.7532 13.2295 11.8125 13.0865 11.8125 12.9373V6.74977Z" fill="#389E0D" />
                            </svg>
                            <input class="rounded-4" type="text" placeholder="Search by countrie name..." />
                        </form>
                        <p class="text-center text-white">Search and compare 2000+ data plans from 25+ eSIM
                            providers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-dark esimok-title">Asia</h2>
                    <div class="list-Popular">
                        <?php
                        $asia_term = get_term_by('name', 'Asia', 'esimok_categories');
                        if ($asia_term) {
                            $args = array(
                                'taxonomy' => 'esimok_categories',
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => true, // Không hiển thị những bài không có nội dung
                                'parent' => $asia_term->term_id,
                            );
                            $cats = get_terms($args);
                            foreach ($cats as $category) {
                                $category_image = get_field('esimok_image_category', 'esimok_categories_' . $category->term_id);
                        ?>
                                <a href="<?php echo get_term_link($category); ?>" class="item-Popular">
                                    <img src="<?php echo $category_image; ?>" alt="<?php echo $category->name; ?>">
                                    <h3 class="item-title"><?php echo $category->name; ?></h3>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="blog">
        <?php
        $tags = wp_get_post_categories($post->ID);
        $category_link = get_category_link(4);
        $args = array(
            'post_type'  => 'post',
            'category' => 4,
            'posts_per_page' => 6,
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
        ?>
    </section>


</div>

<?php

wp_enqueue_style('esimok-component-slide-blog');
wp_enqueue_style('esimok-component-banner-home');
wp_enqueue_style('esimok-third-party-owl-carousel');

// Load JS
wp_enqueue_script('esimok-third-party-owl-carousel');
wp_enqueue_script('esimok-js-carosel');

get_footer(); ?>