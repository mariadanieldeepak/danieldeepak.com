<?php

add_action( 'wp_footer', 'simplent_child_enqueue_tag_manager' );

function simplent_child_enqueue_tag_manager() {
	if ( is_user_logged_in() ) {
		return;
	}
	if ( ! simplent_child_is_production() ) {
		return;
	}
	include( get_stylesheet_directory() . '/assets/js/simplent-child-tag-manager.js' );
}

add_action( 'wp_enqueue_scripts', 'simplent_child_enqueue_styles' );

function simplent_child_enqueue_styles() {
	if ( function_exists( 'simplent_theme_enqueue' ) ) {
		simplent_theme_enqueue();
	}
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

if ( ! function_exists( 'simplent_child_is_production' ) ) {
	function simplent_child_is_production() {
		return (boolean) strpos( WP_SITEURL, 'danieldeepak.com' );
	}
}