
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'dax' ); ?></span>
		<?php endif; ?>
		<?php dax_post_thumbnail(); ?>

	</header>
	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>


	<?php echo dax_excerpt(); ?>

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


	<div class="entry-content">
		<?php
		if ( get_theme_mod( 'dax_excerpts' ) != 1 ) :
			the_excerpt();?>
			<p><a class="btn btn-default read-more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e( 'Read More', 'dax' ); ?></a></p>
		<?php else :
			the_content();
		endif;
		?>
		<?php

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'dax' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'dax' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div>


</article>
