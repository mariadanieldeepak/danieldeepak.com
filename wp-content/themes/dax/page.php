<?php
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="col-md-8 site-main leftSidebar" role="main">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/content', 'page' );

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

		endwhile;
		?>

	</main>

	<?php get_sidebar( 'content-bottom' ); ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
