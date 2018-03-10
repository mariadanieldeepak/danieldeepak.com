<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">
		<div class="<?php if( dax_get_option('sticky_header' )) echo 'header-fixed';  ?>">
		<div class="site-header-main container">
			<div class="site-branding">


				<?php if( get_custom_logo() != '' ) : ?>
				<div id="logo">
					<?php dax_the_custom_logo(); ?>
				</div><!-- end of #logo -->
				<?php else: ?>
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>
				<?php endif; ?>
			</div>

				<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'dax' ); ?></button>

				<div id="site-header-menu" class="site-header-menu">
						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'dax' ); ?>">
							<?php
							wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_class'     => 'primary-menu',
									'fallback_cb'     => 'dax_nav_fallback',
							) );
							?>
						</nav>
				</div>
		</div>
		</div>
	</header>
	<?php if ( get_header_image() ) : ?>
		<?php
		$custom_header_sizes = apply_filters( 'dax_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
		?>
		<div class="header-image">
			<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			</a>
			</div>
		</div><!-- .header-image -->
	<?php endif; // End header image check. ?>
	<div class="site-inner container">


		<div id="content" class="site-content">
