<div class="entry-bio">
    <div class="author-box">
        <div class="author-avatar">
            <?php
             $author_id = get_post_field('post_author', $post_id);
                echo get_avatar($author_id);
            ?>
        </div>
        <div class="author-info">
            <div class="author-title">
                <?php
                    $author_id = get_post_field('post_author', $post_id);
                    $display_name = get_the_author_meta('display_name', $author_id);
                    echo 'By ' . $display_name;
                ?>
            </div>
            <div class="author-post-time">
                <?php echo get_the_modified_date('M d, Y')?>
            </div>   
        </div>
    </div>
</div>
<?php
	wp_enqueue_style('esimok-component-author');
?>