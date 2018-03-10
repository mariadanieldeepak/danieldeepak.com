
<?php if ( is_active_sidebar( 'sidebar' )  ) : ?>
	<aside id="secondary" class="col-md-4 sidebar widget-area rightSidebar" role="complementary">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside>
<?php endif; ?>
