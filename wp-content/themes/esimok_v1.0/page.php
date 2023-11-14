<?php

/**
 * The template for displaying all pages.
 *
 * @package          Gigagocom\Templates
 * @gigagocom-version 3.16.0
 */


get_header();
?>
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile;
				?>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();

?>