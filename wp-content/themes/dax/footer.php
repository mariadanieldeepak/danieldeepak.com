
		</div>
</div>
		<?php if ( is_active_sidebar( 'footer-widget-1' )||is_active_sidebar( 'footer-widget-2'  )||is_active_sidebar( 'footer-widget-3'  )) : ?>
		<div id="footer-widget">
					<div class="footer-widget-area">
						<div class="container">
							<div class="footer-widget-content">
						<div class="col-sm-4 widget-col">
							<?php if ( is_active_sidebar( 'footer-widget-1' )  ) : ?>
								<aside id="footer-widget" class="footer widget-area" role="complementary">
									<?php dynamic_sidebar( 'footer-widget-1' ); ?>
								</aside>
							<?php endif; ?>
						</div>
						<div class="col-sm-4 widget-col">
							<?php if ( is_active_sidebar( 'footer-widget-2' )  ) : ?>
								<aside id="footer-widget" class="footer widget-area" role="complementary">
									<?php dynamic_sidebar( 'footer-widget-2' ); ?>
								</aside>
							<?php endif; ?>
						</div>
						<div class="col-sm-4 widget-col">
							<?php if ( is_active_sidebar( 'footer-widget-3' )  ) : ?>
								<aside id="footer-widget" class="footer widget-area" role="complementary">
									<?php dynamic_sidebar( 'footer-widget-3' ); ?>
								</aside>
							<?php endif; ?>
						</div>
								</div>
							</div>
					</div>
		</div>
		<?php endif; ?>
		<footer id="colophon" class="site-footer" role="contentinfo">
            <div class="footer-wrap">
				<div class="site-info">
				<?php
					do_action( 'dax_credits' );
				?>
					<?php echo esc_html(dax_get_option( 'custom_footer_text' )); ?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<a href="<?php echo esc_url( __( 'https://wpdia.com/', 'dax' ) ); ?>"><?php printf( __( 'Theme by %s', 'dax' ), 'WPdia' ); ?></a>
			</div>
            </div>
		</footer>

</div>

<?php wp_footer(); ?>
</body>
</html>
