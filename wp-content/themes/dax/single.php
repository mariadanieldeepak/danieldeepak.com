<?php
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="col-md-8 site-main leftSidebar" role="main">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/content', 'single' );

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			if ( is_singular( 'attachment' ) ) {
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'dax' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'dax' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'dax' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'dax' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'dax' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}

		endwhile;
		?>

	</main>

	<?php get_sidebar( 'content-bottom' ); ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
