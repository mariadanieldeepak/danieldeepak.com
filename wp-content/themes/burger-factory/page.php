<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Burger_Factory
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main row" role="main">
		<div class="col-3 sidebar">
			<?php get_sidebar(); ?>
		</div>
		<div class="col-9">
			<?php
			while ( have_posts() ) : the_post();
			?>

				<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="post-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div><!-- .post-thumbnail -->

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							the_content( sprintf(
								/* translators: %s: Name of current post. */
								wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'burger-factory' ), array( 'span' => array( 'class' => array() ) ) ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							) );

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'burger-factory' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php burger_factory_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-## -->

				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				if ( is_active_sidebar( 'after-entry' ) ) :
					?><div class="after-entry-widgets"><?php
					dynamic_sidebar( 'after-entry' );
					?></div><?php
				endif;

			endwhile; // End of the loop.
			?>
		</div>
		</main><!-- #main -->

	</div><!-- #primary -->
<?php
get_footer();
