<?php

add_action( 'wp_enqueue_scripts', 'simplent_child_enqueue_tag_manager' );

function simplent_child_enqueue_tag_manager() {
	if ( is_user_logged_in() ) {
		return;
	}
	if ( false === simplent_child_is_production() ) {
		return;
	}

	wp_enqueue_script( 'google-analytics-gtag',
		'https://www.googletagmanager.com/gtag/js?id=UA-71731040-1',
		array(),
		null,
		true
		);

	$script_data = <<<EOL
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-71731040-1');
EOL;

	wp_add_inline_script( 'google-analytics-gtag', $script_data, 'after' );
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
		return strpos( $_SERVER['HTTP_HOST'], 'danieldeepak.com' ) >= 0 ? true : false;
	}
}

if ( function_exists( 'simplent_child_load_scripts_async' ) ) {
	function simplent_child_load_scripts_async($tag, $handle, $src) {
		$allowed_handles = [ 'jquery-core', 'jquery-migrate' ];

		if ( ! in_array( $handle, $allowed_handles, true ) ) {
			return $tag;
		}
		return str_replace( ' src', ' async="async" src', $tag );
	}
}

add_filter( 'script_loader_tag', 'simplent_child_load_scripts_async', 10, 3 );
