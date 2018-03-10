<?php

function mdd_recent_posts_function( $atts ) {

	extract( shortcode_atts( array(
		'posts' => 1,
	), $atts) );

	$return_string = '<ul>';

	query_posts( array( 'orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts ) );
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			$return_string .= '<li><a href="'.get_permalink().'">'. get_the_title() .'</a></li>';
		endwhile;
	endif;

	$return_string .= '</ul>';

	wp_reset_query();
	return $return_string;
}

function mdd_register_shortcodes() {
	/**
	 * Define the recent-posts shortcode.
	 */
	add_shortcode( 'recent-posts', 'mdd_recent_posts_function' );
}
/**
 * Register recent posts short on init.
 */
add_action( 'init', 'mdd_register_shortcodes' );

/**
 * Inserts Google Analytics tracking script for all logged out users.
 */
function mdd_google_analytics() {
	if ( ! is_user_logged_in() || ! defined( 'MDD_GOOGLE_ANALYTICS_DISABLED' ) ||
		( defined( 'MDD_GOOGLE_ANALYTICS_DISABLED' ) && MDD_GOOGLE_ANALYTICS_DISABLED !== true ) ) {
		wp_enqueue_script( 'google-analytics',
			get_stylesheet_directory_uri() . '/assets/js/src/google-analytics.js',
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
}

add_action( 'wp_enqueue_scripts', 'mdd_google_analytics' );

/** Login via WordPress.com **/
//add_filter( 'jetpack_sso_bypass_login_forward_wpcom', '__return_true' );

/** Add adsense code */
function mdd_google_adsense() {
	if ( ! is_user_logged_in() || ! defined( 'WP_DEBUG' ) || ( defined( 'WP_DEBUG' ) && false === WP_DEBUG ) ) {
		wp_enqueue_script( 'google-adsense-syndication',
			'//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js',
			array(),
			false,
			false
		);
	}
}

add_action( 'wp_enqueue_scripts', 'mdd_google_adsense' );

function add_async_attribute( $tag, $handle ) {
	if ( 'google-adsense-syndication' !== $handle) {
		return $tag;
	} else {
		return str_replace(' src', ' async="async" src', $tag);
	}
}

apply_filters( 'script_loader_tag', 'add_async_attribute' );