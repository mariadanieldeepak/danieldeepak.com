<?php

get_header(); ?>

	<div id="primary" class="col-md-12 <?php if ( is_active_sidebar( 'sidebar' )  ){echo 'col-md-8';} ?> content-area leftSidebar">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php

			while ( have_posts() ) : the_post();

				get_template_part( 'templates/content', get_post_format() );

			endwhile;

			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'dax' ),
				'next_text'          => __( 'Next page', 'dax' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'dax' ) . ' </span>',
			) );

		else :
			get_template_part( 'templates/content', 'none' );

		endif;
		?>

		</main>
	</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
