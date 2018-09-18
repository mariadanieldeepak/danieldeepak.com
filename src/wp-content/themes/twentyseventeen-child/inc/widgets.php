<?php

class Quote_Widget extends WP_Widget {
	public function __construct() {
		// Actual widget processes.
		parent::__construct(
			'quote_widget', // Base ID
			'Twenty Seventeen Child Quote', // Name
			array( 'description' => __( 'Shows the latest Quote.', 'text_domain' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		// Outputs the content of the widget.
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$quote_args = array(
			'post_type'   => 'quote',
			'numberposts' => '1',
		);
		$quotes     = get_posts( $quote_args );
		?>
		<div class="textwidget">
			<?php foreach ( $quotes as $quote ) : ?>
				<?php echo wp_kses_post( $quote->post_content ); ?>
			<?php endforeach; ?>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		// Outputs the options form in the admin.
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Title', 'twentyseventeen-child' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title:', 'twentyseventeen-child' ); ?>
			</label>

			<input
					class="widefat"
					id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
					type="text"
					value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		// Processes widget options to be saved.
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}

/**
 * Register Quote Widget.
 *
 * @since 1.0.0
 */
function twentyseventeen_child_add_quote_widget() {
	register_widget( 'Quote_Widget' );
}

add_action( 'widgets_init', 'twentyseventeen_child_add_quote_widget' );
