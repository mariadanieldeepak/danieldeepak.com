<?php

function bfc_enqueue_styles() {
	wp_enqueue_style( 'parent-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme()->get('Version')
	);
}

add_action( 'wp_enqueue_scripts', 'bfc_enqueue_styles' );

require_once ( 'inc/extras.php' );