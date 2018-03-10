<?php
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="col-md-8 site-main leftSidebar" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'dax' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'dax' ); ?></p>

					<?php get_search_form(); ?>
				</div>
			</section>

		</main>

		<?php get_sidebar( 'content-bottom' ); ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
