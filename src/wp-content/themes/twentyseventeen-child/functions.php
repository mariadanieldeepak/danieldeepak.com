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
