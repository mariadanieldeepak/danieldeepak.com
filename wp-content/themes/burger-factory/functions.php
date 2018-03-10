<?php
/**
 * Burger Factory functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Burger_Factory
 */

if ( ! function_exists( 'burger_factory_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function burger_factory_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Burger Factory, use a find and replace
	 * to change 'burger-factory' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'burger-factory', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'burger-factory' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'burger_factory_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'burger_factory_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function burger_factory_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'burger_factory_content_width', 720 );
}
add_action( 'after_setup_theme', 'burger_factory_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function burger_factory_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'burger-factory' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'burger-factory' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'After Entry', 'burger-factory' ),
		'id'            => 'after-entry',
		'description'   => esc_html__( 'These widgets output after a single post.', 'burger-factory' ),
		'before_widget' => '<div class="widget after-entry-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'burger_factory_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function burger_factory_scripts() {
	wp_enqueue_style( 'burger-factory-fonts', '//fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i' );
	wp_enqueue_style( 'burger-factory-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'burger_factory_scripts' );


/**
 * There's some copy in the CSS for Previous / Next post labels. This is here so we can translate
 * them.
 */
function burger_factory_translatable_css() {
    ?>
        <style>
			.post-navigation .nav-previous::after
			{
				content: "<?php echo __('Previous', 'burger-factory'); ?>";
			}
			.post-navigation .nav-next::after
			{
				content: "<?php echo __('Next', 'burger-factory'); ?>";
			}
        </style>
    <?php
}
add_action( 'wp_head', 'burger_factory_translatable_css' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
