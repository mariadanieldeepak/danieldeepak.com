<?php

get_header(); ?>

	<section id="primary" class="col-md-8 content-area leftSidebar">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'dax' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
			</header>

			<?php

			while ( have_posts() ) : the_post();

				get_template_part( 'templates/content', 'search' );

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
	</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
