<?php
/*
 * Template Name: Blog page
 * 
 * @author tungnt (tungnt@vietnamdiscovery.com)
 * @since 2023-10-31
 * 
 * @package Esimok
 * @version 3.5.1
 */

get_header();

$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
$post_type = get_post_type('post');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$posts_per_page = 15;

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

<div class="section1" id="blogs">
    <div class="container">
        <div class="relative">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-posts-container">
                        <div class="wrap-blog">
                            <?php
                            $args = array(
                                'paged' => $paged,
                                'posts_per_page' => $posts_per_page,
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'post_type' => $post_type,
                                'post_status' => 'publish',
                                'cat' => $term_id,
                            );

                            $wp_query = new WP_Query($args);
                            if ($wp_query->have_posts()) :
                                while ($wp_query->have_posts()) : $wp_query->the_post();
                                    $post_in = $post;
                                    $thumb = get_the_post_thumbnail_url($post_in->ID);
                                    $categories = get_the_category();
                                    $cat_name = '';
                                    if (!empty($categories)) {
                                        $cat_name = $categories[0]->name;
                                    }
                            ?>
                                    <div class="blogList">
                                        <div class="thumb">
                                            <a href="<?php echo esc_url(the_permalink()); ?>">
                                                <img src="<?php echo esimok_resize_image($thumb, 280 * 1.5, 180 * 1.5); ?>" alt="<?php echo the_title(); ?>" class="img-fluid thumb-blog">
                                            </a>
                                        </div>
                                        <div class="item-blog">
                                            <div class="cate_name">
                                                <?php echo $cat_name; ?>
                                            </div>
                                            <h3 class="title_handbook heading-6-dest">
                                                <a href="<?php echo esc_url(the_permalink()); ?>"><?php echo the_title(); ?></a>
                                            </h3>
                                            <p class="post_description">
                                                <?php echo get_the_excerpt(); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                            else :
                                ?>
                                <div class="col-md-12">
                                    <div class="_1blockthumb">
                                        <p>Silence is golden!</p>
                                    </div>
                                </div>
                            <?php endif; ?>


                        </div>
                        <?php
                        if (function_exists("esimok_pagination")) :
                            // Call func
                            esimok_pagination();

                            // Load CSS
                            wp_enqueue_style('esimok-component-pagination');
                        endif;

                        wp_reset_query();
                        ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php
// Load CSS
wp_enqueue_style('esimok-component-blog');

get_footer(); ?>