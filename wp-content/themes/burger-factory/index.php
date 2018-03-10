<?php
/**
 * The template for displaying blog and archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Burger_Factory
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main row" role="main">

		<div class="col-3 sidebar">
			<?php get_sidebar(); ?>
		</div>

		<div class="col-9 archive-entry-list">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_search() ) : ?>
				<header class="page-header">
					<h1 class="front-page-category">
						<?php printf( esc_html__( 'Search Results for: %s', 'burger-factory' ), '<span>' . get_search_query() . '</span>' ); ?>
					</h1>
				</header>
			<?php elseif ( is_archive() ): ?>
				<header class="page-header">
				<?php
				the_archive_title( '<h1 class="front-page-category">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
				</header><!-- .page-header -->
			<?php endif; ?>

			<div class="entry-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h2 class="entry-title">
							<?php
							$title = get_the_title();
							if( !empty( $title ) ) :
								the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' );
							else:
								echo sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ) . "Untitled" . '</a>';
							endif;
							?>
							</h2>
							<?php if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">
								<?php burger_factory_entry_category(); ?>
							</div>
							<?php endif; ?>
						</header>

						<div class="entry-summary">
							<?php if ( ! has_excerpt() && !is_search() ) :
								the_content(esc_html__( 'More', 'burger-factory' ));
								wp_link_pages();
							else :
								the_excerpt();
							endif;
							?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php

			the_posts_navigation();

		else : ?>

			<section class="no-results not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'burger-factory' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<?php
					if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

						<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'burger-factory' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

					<?php elseif ( is_search() ) : ?>

						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'burger-factory' ); ?></p>
						<?php
							get_search_form();

					else : ?>

						<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'burger-factory' ); ?></p>
						<?php
							get_search_form();

					endif; ?>
				</div><!-- .page-content -->
			</section><!-- .no-results -->
		<?php endif; ?>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
