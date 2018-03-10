<?php


if ( ! function_exists( 'dax_setup' ) ) :
function dax_setup() {

	load_theme_textdomain( 'dax', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	add_theme_support( 'post-thumbnails' );


	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'dax' ),
	) );

	add_theme_support( 'html5', array(

		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	add_editor_style( array( 'css/editor-style.css', dax_fonts_url() ) );

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'starter-content' ) ;
}
endif;
add_action( 'after_setup_theme', 'dax_setup' );

function dax_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dax_content_width', 840 );
}
add_action( 'after_setup_theme', 'dax_content_width', 0 );

function dax_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'dax' ),
		'id'            => 'sidebar',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'dax' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'dax' ),
		'id'            => 'footer-widget-1',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'dax' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'dax' ),
		'id'            => 'footer-widget-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'dax' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
			'name'          => __( 'Footer Widget 3', 'dax' ),
			'id'            => 'footer-widget-3',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'dax' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dax_widgets_init' );

if ( ! function_exists( 'dax_fonts_url' ) ) :
function dax_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

		if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'dax' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'dax' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'dax' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

function dax_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'dax_javascript_detection', 0 );

function dax_scripts() {

	wp_enqueue_style( 'dax-fonts', dax_fonts_url(), array(), null );

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(  ), '3.3.7' );

	wp_enqueue_style( 'dax-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'dax-customizer', get_template_directory_uri() . '/js/customizer.js', array('jquery'), '' );

	wp_enqueue_script( 'dax-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'dax-script', 'screenReaderText', array(
			'expand'   => __( 'expand child menu', 'dax' ),
			'collapse' => __( 'collapse child menu', 'dax' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'dax_scripts' );

function dax_body_classes( $classes ) {
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'dax_body_classes' );

function dax_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/customizer.php';


function dax_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'dax_content_image_sizes_attr', 10 , 2 );

function dax_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'dax_post_thumbnail_sizes_attr', 10 , 3 );

function dax_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'dax_widget_tag_cloud_args' );


// custom get option
if ( ! function_exists( 'dax_get_option' ) ) :
	function dax_get_option( $name, $default = false ) {

		$option_name = '';
		// Get option settings from database
		$options = get_option( 'dax' );

		// Return specific option
		if ( isset( $options[$name] ) ) {
			return $options[$name];
		}

		return $default;
	}
endif;



//dax nav fallback
function dax_nav_fallback(){
	if( is_user_logged_in() ) {
		echo '<ul><li class="nav-fallback"><a href="' . esc_url(admin_url('nav-menus.php')) . '">' . __('Add a menu', 'dax') . '</a></li></ul>';
	}

}