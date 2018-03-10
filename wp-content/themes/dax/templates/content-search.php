
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

	<?php dax_post_thumbnail(); ?>

	<?php dax_excerpt(); ?>

	<?php if ( 'post' === get_post_type() ) : ?>

		<footer class="entry-footer">
			<?php dax_entry_meta(); ?>
			<?php
				edit_post_link(
					sprintf(
						__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'dax' ),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer>

	<?php else : ?>

		<?php
			edit_post_link(
				sprintf(
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'dax' ),
					get_the_title()
				),
				'<footer class="entry-footer"><span class="edit-link">',
				'</span></footer>'
			);
		?>

	<?php endif; ?>
</article>

