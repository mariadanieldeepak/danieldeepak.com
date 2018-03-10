
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php dax_excerpt(); ?>
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

	<?php dax_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'dax' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'dax' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'templates/biography' );
			}
		?>
	</div>


</article>
