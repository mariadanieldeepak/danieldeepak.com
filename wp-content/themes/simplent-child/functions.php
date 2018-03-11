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

add_shortcode( 'blog_subscription_email_campaign', 'blog_subscription_email_campaign_callback' );

function blog_subscription_email_campaign_callback( $atts ) {
	?>
	<div class="email-campaign" style="background: #fff7eb; padding: 15px;">
		<form action="https://www.getdrip.com/forms/560057161/submissions" method="post"
			  data-drip-embedded-form="560057161">
			<h4 class="widget-title" data-drip-attribute="headline">Become a better developer, the Kaizen way!</h4>
			<div data-drip-attribute="description">Join my weekly newsletter where I share everything that I do, to get
				better 1% each day, to move my career forward!
			</div>
			<br/>
			<div class="form-group">
				<label for="drip-email">Email Address</label>
				<input type="email" id="drip-email" name="fields[email]" value="" style="background: #fff"/>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Sign Up" data-drip-attribute="sign-up-button"/>
			</div>
		</form>
	</div>
	<?php
}

?>