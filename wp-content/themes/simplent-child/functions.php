<?php

add_action( 'wp_footer', 'simplent_child_enqueue_tag_manager' );

function simplent_child_enqueue_tag_manager() {
	//var_dump(file_exists(get_stylesheet_directory() . '/assets/js/simplent-child-tag-manager.js')); die;
	include( get_stylesheet_directory() . '/assets/js/simplent-child-tag-manager.js' );
}


add_action( 'wp_enqueue_scripts', 'simplent_child_enqueue_styles' );

function simplent_child_enqueue_styles() {
	if ( function_exists( 'simplent_theme_enqueue' ) ) {
		simplent_theme_enqueue();
	}
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
