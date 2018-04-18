<?php
/*
Plugin Name:  MDD Wedding Timer
Plugin URI:   https://danieldeepak.com/wedding/
Description:  Show the Wedding count down.
Version:      1.0.0
Author:       Maria Daniel Deepak
Author URI:   https://danieldeepak.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  mdd-wedding-timer
Domain Path:  /languages
*/

function mdd_w_t_include_scripts() {
	if ( ! is_page( 'wedding' ) ) {
		return;
	}

	wp_enqueue_script( 'app',
		plugins_url( 'bundle.js', __FILE__ ),
		array(),
		'1.0.0',
        true
	);

	wp_enqueue_style( 'wedding',
		plugins_url( 'wedding.css', __FILE__ ),
		array(),
		'1.0.0'
	);
}

function mdd_w_t_load_mdd_wedding_timer() {
	add_action( 'wp_enqueue_scripts', 'mdd_w_t_include_scripts' );
}

add_action( 'plugins_loaded', 'mdd_w_t_load_mdd_wedding_timer' );