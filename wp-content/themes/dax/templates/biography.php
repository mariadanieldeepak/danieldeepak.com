
<div class="author-info">
	<div class="author-avatar">
		<?php
		$author_bio_avatar_size = apply_filters( 'dax_author_bio_avatar_size', 60 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div>

	<div class="author-description">
		<h2 class="author-title"><span class="author-heading"><?php _e( 'Author:', 'dax' ); ?></span> <?php echo get_the_author(); ?></h2>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s', 'dax' ), get_the_author() ); ?>
			</a>
		</p>
	</div>
</div>
