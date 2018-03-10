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
	if ( ! defined( 'MDD_GOOGLE_ANALYTICS_DISABLED' ) ||
		( defined( 'MDD_GOOGLE_ANALYTICS_DISABLED' ) && MDD_GOOGLE_ANALYTICS_DISABLED !== true ) ) {
		wp_enqueue_script( 'google-analytics',
			get_stylesheet_directory_uri() . '/assets/js/src/google-analytics.js',
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
}

add_action( 'wp_enqueue_scripts', 'mdd_google_analytics' );