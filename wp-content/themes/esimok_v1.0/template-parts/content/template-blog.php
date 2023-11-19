<?php

/**
 * The blog template file.
 *
 * @package Esimok Single
 * @Esimok 1.0
 */

?>

<section class="blog">
    <?php
    $tags = wp_get_post_categories($post->ID);
    $cat_name = '';

    // Kiểm tra nếu $tags không trống và có phần tử
    if (!empty($tags) && is_array($tags)) {
        $cat_name = get_cat_name($tags[0]);
    }

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
                                                    // $cat_name = get_cat_name($tags[0]);
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
