<?php
/**
 * Twenty Seventeen Child functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */

/**
 * Enqueues Parent theme & Child theme stylesheets.
 *
 * @since 1.0.0
 */
function twentyseventeen_child_enqueue_styles() {
	$parent_style = 'twentyseventeen-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'twentyseventeen_child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);

}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_child_enqueue_styles' );

/**
 * Show Quotes post type in Blog page.
 *
 * @since 1.0.0
 */
function twentyseventeen_child_include_quotes( $query ) {
	if ( ! is_main_query() ) {
		return;
	}
	// Conditional functions are not set in `pre_get_posts`.
	// Refer https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
	if ( 'blog' !== $query->query['pagename'] ) {
		return;
	}
	set_query_var( 'post_type', array( 'post', 'quote' ) );
}
add_action( 'pre_get_posts', 'twentyseventeen_child_include_quotes' );
