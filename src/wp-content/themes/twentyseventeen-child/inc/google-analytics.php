<?php

function twentyseventeen_child_add_google_analytics_tag() {
	// Include Google analytics only in Production.
	if ( strpos( home_url(), 'danieldeepak.com' ) === false ) {
		return;
	}
	?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-71731040-1"></script>
	<script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-71731040-1');
	</script>
	<?php
}

add_action( 'wp_footer', 'twentyseventeen_child_add_google_analytics_tag' );