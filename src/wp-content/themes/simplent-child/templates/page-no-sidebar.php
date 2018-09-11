<?php
/* Template Name: No Sidebar */

get_header();

/**
 * Simplent Layout Options
 */
$simplent_layout_class = 'col-md-8 col-sm-12 col-md-offset-2';
?>

	<div id="primary" class="content-area row">
		<main id="main" class="site-main <?php echo esc_attr($simplent_layout_class); ?>" role="main">



			<?php
			// Start the loop
			while( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// End of the loop.
			endwhile;

			?>


		</main><!-- .site-main -->
	</div><!-- content-area -->

<?php get_footer(); ?>