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
 * Rewrites `quote` post permalinks as
 *
 * Quote single  /quote/{id}
 * Quote archive /quotes/
 *               /quotes/page/{paged}
 *               /quotes/{year}/page/{paged}
 *               /quotes/{year}/{monthnum}
 *               /quotes/{year}/{monthnum}/page/{paged}
 *
 * @since 1.0.0
 */
function twentyseventeen_child_quote_rewrite_permalink_rules() {
	add_rewrite_rule( '^quotes/?$', 'index.php?post_type=quote', 'top' );
	add_rewrite_rule( '^quotes/page/([0-9]+)/?$', 'index.php?post_type=quote&paged=$matches[1]', 'top' );
	add_rewrite_rule( '^quotes/([0-9]{4,})/([0-9]{2,})/?$', 'index.php?post_type=quote&year=$matches[1]&monthnum=$matches[2]', 'top' );
	add_rewrite_rule( '^quotes/([0-9]{4,})/([0-9]{2,})/page/([0-9]+)/?$', 'index.php?post_type=quote&year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]', 'top' );
	add_rewrite_rule( '^quote/([0-9]+)/?$', 'index.php?post_type=quote&p=$matches[1]', 'top' );
}

add_action( 'init', 'twentyseventeen_child_quote_rewrite_permalink_rules' );

/**
 * Updates the Quote permalink to new structure when `get_permalink()` is used.
 *
 * @since 1.0.0
 *
 * @param string $url
 * @param WP_Post $post
 *
 * @return string
 */
function twentyseventeen_child_quote_update_get_permalink( $url, $post ) {
	if ( ! ( $post instanceof  WP_Post ) ) {
		return $url;
	}

	if ( 'quote' !== $post->post_type ) {
		return $url;
	}

	return trailingslashit( get_home_url() . "/quote/{$post->ID}" );
}

add_filter( 'post_type_link', 'twentyseventeen_child_quote_update_get_permalink', 10, 2 );

/**
 * Widgets
 */
require_once 'inc/widgets.php';