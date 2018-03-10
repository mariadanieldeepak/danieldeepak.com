<?php

function dax_custom_header_and_background() {
	$color_scheme             = dax_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#' );
	$default_text_color       = trim( $color_scheme[3], '#' );


	add_theme_support( 'custom-background', apply_filters( 'dax_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	add_theme_support( 'custom-header', apply_filters( 'dax_custom_header_args', array(
			'default-text-color'     => $default_text_color,
			'width'                  => 1170,
			'height'                 => 280,
			'flex-height'            => true,
			'wp-head-callback'       => 'dax_header_style',
	) ) );

}
add_action( 'after_setup_theme', 'dax_custom_header_and_background' );

if ( ! function_exists( 'dax_header_style' ) ) :
function dax_header_style() {

	if ( display_header_text() ) {
		return;
	}

	?>
	<style type="text/css" id="dax-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif;

function dax_customize_register( $wp_customize ) {
	$color_scheme = dax_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'dax_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'dax_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'dax_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->remove_control( 'header_textcolor' );

	$wp_customize->add_setting( 'link_color', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Link Color', 'dax' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'main_text_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
		'label'       => __( 'Main Text Color', 'dax' ),
		'section'     => 'colors',
	) ) );

	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'       => __( 'Secondary Text Color', 'dax' ),
		'section'     => 'colors',
	) ) );

	/* Main option Settings Panel */
	$wp_customize->add_panel('dax_main_options', array(
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __('Dax Options', 'dax'),
			'description' => __('Panel to update dax theme options', 'dax'), // Include html tags such as <p>.
			'priority' => 10 // Mixed with top-level-section hierarchy.
	));


	/* dax Header Options */
	$wp_customize->add_section('dax_header_options', array(
			'title' => __('Header', 'dax'),
			'priority' => 31,
			'panel' => 'dax_main_options'
	));

	$wp_customize->add_setting('dax[sticky_header]', array(
			'default' => 0,
			'type' => 'option',
			'sanitize_callback' => 'dax_sanitize_checkbox'
	));
	$wp_customize->add_control('dax[sticky_header]', array(
			'label' => __('Sticky Header', 'dax'),
			'description' => sprintf(__('Check to show fixed header', 'dax')),
			'section' => 'dax_header_options',
			'type' => 'checkbox',
	));

	$wp_customize->add_setting('dax[nav_bg_color]', array(
			'default' => '#000000',
			'type'  => 'option',
			'sanitize_callback' => 'dax_sanitize_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dax[nav_bg_color]', array(
			'label' => __('Top nav background color', 'dax'),
			'description'   => __('Default used if no color is selected','dax'),
			'section' => 'dax_header_options',
	)));
	$wp_customize->add_setting('dax[nav_link_color]', array(
			'default' => '#ffffff',
			'type'  => 'option',
			'sanitize_callback' => 'dax_sanitize_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dax[nav_link_color]', array(
			'label' => __('Top nav item color', 'dax'),
			'description'   => __('Link color','dax'),
			'section' => 'dax_header_options',
	)));


	$wp_customize->add_setting('dax[nav_dropdown_bg]', array(
			'default' => '#ffffff',
			'type'  => 'option',
			'sanitize_callback' => 'dax_sanitize_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dax[nav_dropdown_bg]', array(
			'label' => __('Top nav dropdown background color', 'dax'),
			'description'   => __('Background of dropdown item hover color','dax'),
			'section' => 'dax_header_options',
	)));

	$wp_customize->add_setting('dax[nav_dropdown_item]', array(
			'default' => '#000000',
			'type'  => 'option',
			'sanitize_callback' => 'dax_sanitize_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dax[nav_dropdown_item]', array(
			'label' => __('Top nav dropdown item color', 'dax'),
			'description'   => __('Dropdown item color','dax'),
			'section' => 'dax_header_options',
	)));


	/* dax Footer Options */
	$wp_customize->add_section('dax_footer_options', array(
			'title' => __('Footer', 'dax'),
			'priority' => 31,
			'panel' => 'dax_main_options'
	));
	$wp_customize->add_setting('dax[footer_widget_bg_color]', array(
			'default' => '#313233',
			'type'  => 'option',
			'sanitize_callback' => 'dax_sanitize_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dax[footer_widget_bg_color]', array(
			'label' => __('Footer widget area background color', 'dax'),
			'section' => 'dax_footer_options',
	)));

	$wp_customize->add_setting('dax[footer_bg_color]', array(
			'default' => '#000000',
			'type'  => 'option',
			'sanitize_callback' => 'dax_sanitize_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dax[footer_bg_color]', array(
			'label' => __('Footer background color', 'dax'),
			'section' => 'dax_footer_options',
	)));

	$wp_customize->add_setting('dax[footer_text_color]', array(
			'default' => '#999999',
			'type'  => 'option',
			'sanitize_callback' => 'dax_sanitize_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dax[footer_text_color]', array(
			'label' => __('Footer & Widget text color', 'dax'),
			'section' => 'dax_footer_options',
	)));

	$wp_customize->add_setting('dax[footer_link_color]', array(
			'default' => '#ffffff',
			'type'  => 'option',
			'sanitize_callback' => 'dax_sanitize_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dax[footer_link_color]', array(
			'label' => __('Footer & Widget link color', 'dax'),
			'section' => 'dax_footer_options',
	)));

	$wp_customize->add_setting('dax[custom_footer_text]', array(
			'default' => '',
			'type' => 'option',
			'sanitize_callback' => 'dax_sanitize_strip_slashes'
	));
	$wp_customize->add_control('dax[custom_footer_text]', array(
			'label' => __('Footer information', 'dax'),
			'description' => sprintf(__('Copyright text in footer', 'dax')),
			'section' => 'dax_footer_options',
			'type' => 'textarea'
	));





}
add_action( 'customize_register', 'dax_customize_register', 11 );


function dax_customize_partial_blogname() {
	bloginfo( 'name' );
}

function dax_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function dax_get_color_schemes() {
	return apply_filters( 'dax_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'dax' ),
			'colors' => array(
				'#f7f7f7',
				'#ffffff',
				'#007acc',
				'#1a1a1a',
				'#686868',
			),
		),

	) );
}

if ( ! function_exists( 'dax_get_color_scheme' ) ) :
function dax_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = dax_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif;

if ( ! function_exists( 'dax_get_color_scheme_choices' ) ) :
function dax_get_color_scheme_choices() {
	$color_schemes                = dax_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif;


if ( ! function_exists( 'dax_sanitize_color_scheme' ) ) :
function dax_sanitize_color_scheme( $value ) {
	$color_schemes = dax_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}

	return $value;
}
endif;

function dax_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = dax_get_color_scheme();

	$color_textcolor_rgb = dax_hex2rgb( $color_scheme[3] );

	if ( empty( $color_textcolor_rgb ) ) {
		return;
	}

	$colors = array(
		'background_color'      => $color_scheme[0],
		'page_background_color' => $color_scheme[1],
		'link_color'            => $color_scheme[2],
		'main_text_color'       => $color_scheme[3],
		'secondary_text_color'  => $color_scheme[4],
		'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),

	);

	$color_scheme_css = dax_get_color_scheme_css( $colors );

	wp_add_inline_style( 'dax-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'dax_color_scheme_css' );

function dax_customize_control_js() {
	wp_enqueue_script( 'dax-color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20160816', true );
	wp_localize_script( 'dax-color-scheme-control', 'dax-colorScheme', dax_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'dax_customize_control_js' );

function dax_customize_preview_js() {
	wp_enqueue_script( 'dax-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160816', true );
}
add_action( 'customize_preview_init', 'dax_customize_preview_js' );

function dax_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'      => '',
		'page_background_color' => '',
		'link_color'            => '',
		'main_text_color'       => '',
		'secondary_text_color'  => '',
		'border_color'          => '',
	) );

	return <<<CSS

	body {
		background-color: {$colors['background_color']};
	}


	.site {

	}

	mark,
	ins,
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination .prev,
	.pagination .next,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.pagination .nav-links:before,
	.pagination .nav-links:after,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus {
		color: {$colors['page_background_color']};
	}

	/* Link Color */
	.menu-toggle:hover,
	.menu-toggle:focus,
	a,
	.main-navigation a:hover,
	.main-navigation a:focus,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus,
	.social-navigation a:hover:before,
	.social-navigation a:focus:before,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.site-branding .site-title a:hover,
	.site-branding .site-title a:focus,
	.entry-title a:hover,
	.entry-title a:focus,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .comment-edit-link:hover,
	.pingback .comment-edit-link:focus,
	.comment-reply-link,
	.comment-reply-link:hover,
	.comment-reply-link:focus,
	.required,
	.site-info a:hover,
	.site-info a:focus {
		color: {$colors['link_color']};
	}

	mark,
	ins,
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['link_color']};
	}

	input[type="date"]:focus,
	input[type="time"]:focus,
	input[type="datetime-local"]:focus,
	input[type="week"]:focus,
	input[type="month"]:focus,
	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	input[type="tel"]:focus,
	input[type="number"]:focus,
	textarea:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.menu-toggle:hover,
	.menu-toggle:focus {
		border-color: {$colors['link_color']};
	}

	/* Main Text Color */
	body,
	blockquote cite,
	blockquote small,
	.main-navigation a,
	.menu-toggle,
	.dropdown-toggle,
	.social-navigation a,
	.post-navigation a,
	.pagination a:hover,
	.pagination a:focus,
	.widget-title,
	.widget-title a,
	.site-branding .site-title a,
	.entry-title a,
	.page-links > .page-links-title,
	.comment-author,
	.comment-reply-title small a:hover,
	.comment-reply-title small a:focus {
		color: {$colors['main_text_color']};
	}

	blockquote,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.page-header,
	.page-links a,
	.comments-title,
	.comment-reply-title {
		border-color: {$colors['main_text_color']};
	}

	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination:before,
	.pagination:after,
	.pagination .prev,
	.pagination .next,
	.page-links a {
		background-color: {$colors['main_text_color']};
	}

	/* Secondary Text Color */

	/**
	 * IE8 and earlier will drop any block with CSS3 selectors.
	 * Do not combine these styles with the next block.
	 */
	body:not(.search-results) .entry-summary {
		color: {$colors['secondary_text_color']};
	}

	blockquote,
	.post-password-form label,
	a:hover,
	a:focus,
	a:active,
	.post-navigation .meta-nav,
	.image-navigation,
	.comment-navigation,
	.widget_recent_entries .post-date,
	.widget_rss .rss-date,
	.widget_rss cite,
	.site-description,
	.author-bio,
	.entry-footer,
	.entry-footer a,
	.sticky-post,
	.taxonomy-description,
	.entry-caption,
	.comment-metadata,
	.pingback .edit-link,
	.comment-metadata a,
	.pingback .comment-edit-link,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.site-info,
	.site-info a,
	.wp-caption .wp-caption-text,
	.gallery-caption,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['secondary_text_color']};
	}

	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus {
		background-color: {$colors['secondary_text_color']};
	}

	/* Border Color */
	fieldset,
	pre,
	abbr,
	acronym,
	table,
	th,
	td,
	input[type="date"],
	input[type="time"],
	input[type="datetime-local"],
	input[type="week"],
	input[type="month"],
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="tel"],
	input[type="number"],
	textarea,
	.main-navigation li,
	.main-navigation .primary-menu,
	.menu-toggle,
	.dropdown-toggle:after,
	.social-navigation a,
	.image-navigation,
	.comment-navigation,
	.tagcloud a,
	.entry-content,
	.entry-summary,
	.page-links a,
	.page-links > span,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-reply-link,
	.no-comments,
	.widecolumn .mu_register .mu_alert {
		border-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}

	hr,
	code {
		background-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}

	@media screen and (min-width: 56.875em) {
		.main-navigation li:hover > a,
		.main-navigation li.focus > a {
			color: {$colors['link_color']};
		}

		.main-navigation ul ul,
		.main-navigation ul ul li {
			border-color: {$colors['border_color']};
		}

		.main-navigation ul ul:before {
			border-top-color: {$colors['border_color']};
			border-bottom-color: {$colors['border_color']};
		}

		.main-navigation ul ul li {
			background-color: {$colors['page_background_color']};
		}

		.main-navigation ul ul:after {
			border-top-color: {$colors['page_background_color']};
			border-bottom-color: {$colors['page_background_color']};
		}
	}

CSS;
}


function dax_color_scheme_css_template() {
	$colors = array(
		'background_color'      => '{{ data.background_color }}',
		'page_background_color' => '{{ data.page_background_color }}',
		'link_color'            => '{{ data.link_color }}',
		'main_text_color'       => '{{ data.main_text_color }}',
		'secondary_text_color'  => '{{ data.secondary_text_color }}',
		'border_color'          => '{{ data.border_color }}',
	);
	?>
	<script type="text/html" id="tmpl-dax-color-scheme">
		<?php echo dax_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'dax_color_scheme_css_template' );

function dax_page_background_color_css() {
	$color_scheme          = dax_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */
		.site {

		}

		mark,
		ins,
		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination .prev,
		.pagination .next,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.pagination .nav-links:before,
		.pagination .nav-links:after,
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.page-links a,
		.page-links a:hover,
		.page-links a:focus {
			color: %1$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul li {
				background-color: %1$s;
			}

			.main-navigation ul ul:after {
				border-top-color: %1$s;
				border-bottom-color: %1$s;
			}
		}
	';

	wp_add_inline_style( 'dax-style', sprintf( $css, $page_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'dax_page_background_color_css', 11 );

function dax_link_color_css() {
	$color_scheme    = dax_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = get_theme_mod( 'link_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link Color */
		.menu-toggle:hover,
		.menu-toggle:focus,
		a,
		.main-navigation a:hover,
		.main-navigation a:focus,
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.social-navigation a:hover:before,
		.social-navigation a:focus:before,
		.post-navigation a:hover .post-title,
		.post-navigation a:focus .post-title,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.site-branding .site-title a:hover,
		.site-branding .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-footer a:hover,
		.entry-footer a:focus,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.pingback .comment-edit-link:hover,
		.pingback .comment-edit-link:focus,
		.comment-reply-link,
		.comment-reply-link:hover,
		.comment-reply-link:focus,
		.required,
		.site-info a:hover,
		.site-info a:focus {
			color: %1$s;
		}

		mark,
		ins,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.widget_calendar tbody a,
		.page-links a:hover,
		.page-links a:focus {
			background-color: %1$s;
		}

		input[type="date"]:focus,
		input[type="time"]:focus,
		input[type="datetime-local"]:focus,
		input[type="week"]:focus,
		input[type="month"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="number"]:focus,
		textarea:focus,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.menu-toggle:hover,
		.menu-toggle:focus {
			border-color: %1$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation li:hover > a,
			.main-navigation li.focus > a {
				color: %1$s;
			}
		}
	';

	wp_add_inline_style( 'dax-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'dax_link_color_css', 11 );

function dax_main_text_color_css() {
	$color_scheme    = dax_get_color_scheme();
	$default_color   = $color_scheme[3];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );

	if ( $main_text_color === $default_color ) {
		return;
	}

	$main_text_color_rgb = dax_hex2rgb( $main_text_color );

	if ( empty( $main_text_color_rgb ) ) {
		return;
	}

	$border_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $main_text_color_rgb );

	$css = '
		/* Custom Main Text Color */
		body,
		blockquote cite,
		blockquote small,
		.main-navigation a,
		.menu-toggle,
		.dropdown-toggle,
		.social-navigation a,
		.post-navigation a,
		.pagination a:hover,
		.pagination a:focus,
		.widget-title,
		.widget-title a,
		.site-branding .site-title a,
		.entry-title a,
		.page-links > .page-links-title,
		.comment-author,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus {
			color: %1$s
		}

		blockquote,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.post-navigation,
		.post-navigation div + div,
		.pagination,
		.page-header,
		.page-links a,
		.comments-title,
		.comment-reply-title {
			border-color: %1$s;
		}

		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination:before,
		.pagination:after,
		.pagination .prev,
		.pagination .next,
		.page-links a {
			background-color: %1$s;
		}

		/* Border Color */
		fieldset,
		pre,
		abbr,
		acronym,
		table,
		th,
		td,
		input[type="date"],
		input[type="time"],
		input[type="datetime-local"],
		input[type="week"],
		input[type="month"],
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="tel"],
		input[type="number"],
		textarea,
		.main-navigation li,
		.main-navigation .primary-menu,
		.menu-toggle,
		.dropdown-toggle:after,
		.social-navigation a,
		.image-navigation,
		.comment-navigation,
		.tagcloud a,
		.entry-content,
		.entry-summary,
		.page-links a,
		.page-links > span,
		.comment-list article,
		.comment-list .pingback,
		.comment-list .trackback,
		.comment-reply-link,
		.no-comments,
		.widecolumn .mu_register .mu_alert {
			border-color: %1$s; /* Fallback for IE7 and IE8 */
			border-color: %2$s;
		}

		hr,
		code {
			background-color: %1$s; /* Fallback for IE7 and IE8 */
			background-color: %2$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul,
			.main-navigation ul ul li {
				border-color: %2$s;
			}

			.main-navigation ul ul:before {
				border-top-color: %2$s;
				border-bottom-color: %2$s;
			}
		}
	';

	wp_add_inline_style( 'dax-style', sprintf( $css, $main_text_color, $border_color ) );
}
add_action( 'wp_enqueue_scripts', 'dax_main_text_color_css', 11 );

function dax_secondary_text_color_css() {
	$color_scheme    = dax_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );

	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Secondary Text Color */

		/**
		 * IE8 and earlier will drop any block with CSS3 selectors.
		 * Do not combine these styles with the next block.
		 */
		body:not(.search-results) .entry-summary {
			color: %1$s;
		}

		blockquote,
		.post-password-form label,
		a:hover,
		a:focus,
		a:active,
		.post-navigation .meta-nav,
		.image-navigation,
		.comment-navigation,
		.widget_recent_entries .post-date,
		.widget_rss .rss-date,
		.widget_rss cite,
		.site-description,
		.author-bio,
		.entry-footer,
		.entry-footer a,
		.sticky-post,
		.taxonomy-description,
		.entry-caption,
		.comment-metadata,
		.pingback .edit-link,
		.comment-metadata a,
		.pingback .comment-edit-link,
		.comment-form label,
		.comment-notes,
		.comment-awaiting-moderation,
		.logged-in-as,
		.form-allowed-tags,
		.site-info,
		.site-info a,
		.wp-caption .wp-caption-text,
		.gallery-caption,
		.widecolumn label,
		.widecolumn .mu_register label {
			color: %1$s;
		}

		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'dax-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'dax_secondary_text_color_css', 11 );


// Nav background color
if ( ! function_exists( 'dax_nav_bg_color' ) ) :
function dax_nav_bg_color() {

   $color = dax_get_option('nav_bg_color');

	if(dax_get_option('nav_bg_color')!=="") {
		$custom_css = "
		/* Custom header background color */
           .site-header,.header-fixed {
                background-color: {$color};
           }";
		wp_add_inline_style('dax-style', $custom_css);
	}
}

add_action( 'wp_enqueue_scripts', 'dax_nav_bg_color',12 );
endif;

// Nav link text color
if ( ! function_exists( 'dax_nav_link_color' ) ) :
function dax_nav_link_color() {

	$color = dax_get_option('nav_link_color');

	if(dax_get_option('nav_link_color')!=="") {
		$custom_css = "
		/* Custom Nav link color */
           .site-branding .site-title a,.main-navigation a{
			color: {$color};
		}";
		wp_add_inline_style('dax-style', $custom_css);
	}
}

add_action( 'wp_enqueue_scripts', 'dax_nav_link_color',12 );
endif;

// Nav dropdown text color
if ( ! function_exists( 'dax_nav_dropdown_color' ) ) :
function dax_nav_dropdown_color() {

	$color = dax_get_option('nav_dropdown_item');

	if(dax_get_option('nav_dropdown_item')!=="") {
		$custom_css = "
		/* Custom Nav dropdown text color */
		@media screen and (min-width: 56.875em){
			.main-navigation ul ul a{
				color: {$color};
			}
		}";
		wp_add_inline_style('dax-style', $custom_css);
	}
}

add_action( 'wp_enqueue_scripts', 'dax_nav_dropdown_color',12 );
endif;

// Nav dropdown background color
if ( ! function_exists( 'dax_nav_dropdown_bg_color' ) ) :
function dax_nav_dropdown_bg_color() {

	$color = dax_get_option('nav_dropdown_bg');

	if(dax_get_option('nav_dropdown_bg')!=="") {
		$custom_css = "
		/* Custom Nav dropdown background color */
		@media screen and (min-width: 56.875em){
			.main-navigation ul ul li{
				background-color: {$color};
			}
			.main-navigation ul ul:after{
				border-top-color: {$color};
				border-bottom-color: {$color};
			}
		}";
		wp_add_inline_style('dax-style', $custom_css);
	}
}

add_action( 'wp_enqueue_scripts', 'dax_nav_dropdown_bg_color',12 );
endif;

// Footer & Widget text color
if ( ! function_exists( 'dax_footer_text_color' ) ) :
function dax_footer_text_color() {

	$color = dax_get_option('footer_text_color');

	if(dax_get_option('footer_text_color')!=="") {
		$custom_css = "
		/* Custom footer text color */
		#footer-widget,#footer-widget .widget-title,.site-info{
			color:{$color};
		}";
		wp_add_inline_style('dax-style', $custom_css);
	}
}

add_action( 'wp_enqueue_scripts', 'dax_footer_text_color',12 );
endif;

// Footer widget background color
if ( ! function_exists( 'dax_footer_widget_bg_color' ) ) :
function dax_footer_widget_bg_color() {

	$color = dax_get_option('footer_widget_bg_color');

	if(dax_get_option('footer_widget_bg_color')!=="") {
		$custom_css = "
		/* Custom footer widget background color */
        #footer-widget {
			background-color:{$color};
		}
		.footer-widget-area .widget-col .widget {
			background-color:{$color};
			box-shadow: none;
		}";
		wp_add_inline_style('dax-style', $custom_css);
	}
}

add_action( 'wp_enqueue_scripts', 'dax_footer_widget_bg_color',12 );
endif;

// Footer & Widget link color
if ( ! function_exists( 'dax_footer_link_color' ) ) :
function dax_footer_link_color() {

	$color = dax_get_option('footer_link_color');

	if(dax_get_option('footer_link_color')!=="") {
		$custom_css = "
		/* Custom footer link color */
       .footer-widget-area .widget-col li a,.site-footer .site-title:after{
			color:{$color};
		}
		.footer-widget-area .tagcloud a,.site-footer a{
			color:{$color};
		}";
		wp_add_inline_style('dax-style', $custom_css);
	}
}

add_action( 'wp_enqueue_scripts', 'dax_footer_link_color',12 );
endif;

// Footer background color
if ( ! function_exists( 'dax_footer_bg_color' ) ) :
function dax_footer_bg_color() {

	$color = dax_get_option('footer_bg_color');

	if(dax_get_option('footer_bg_color')!="") {
		$custom_css = "
		/* Custom footer background color */
       .site-footer{
			background:{$color};
		}";
		wp_add_inline_style('dax-style', $custom_css);
	}
}

add_action( 'wp_enqueue_scripts', 'dax_footer_bg_color',12 );
endif;


/**
 * Adds sanitization callback function: colors
 */
function dax_sanitize_color($color) {
	if ($unhashed = sanitize_hex_color_no_hash($color))
		return '#' . $unhashed;
	return $color;
}

/**
 * Sanitzie checkbox for WordPress customizer
 */
function dax_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Adds sanitization callback function: Sanitize Text area
 */
function dax_sanitize_textarea($input) {
	return sanitize_text_field($input);
}

/**
 * Adds sanitization callback function: Strip Slashes
 */
function dax_sanitize_strip_slashes($input) {
	return wp_kses_stripslashes($input);
}