<?php namespace EmailLog\Addon;

use EmailLog\Util\EmailHeaderParser;
use EmailLog\Util as Util;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * ResendEmail Addon.
 *
 * @since 2.0
 */
class ResendEmailAddon extends EmailLogAddon {

	/**
	 * Set Add-on data.
	 */
	protected function initialize() {
		$this->addon_name = 'Resend Email';
		$this->addon_version = '2.0.1';
	}

	/**
	 * Setup hooks and load the add-on.
	 */
	public function load() {
		parent::load();
		add_filter( 'el_row_actions', array( $this, 'add_row_action' ), 10, 2 );
		add_filter( 'el_load_log_list_page', array( $this, 'include_assets_on_log_list_page' ), 10, 2 );
		add_action( 'el_admin_footer', array( $this, 'print_template' ) );
		add_action( 'wp_ajax_get_email', array( $this, 'get_email_callback' ) );
		add_action( 'wp_ajax_resend_email', array( $this, 'resend_email_callback' ) );
	}

	/**
	 * Add additional row action.
	 *
	 * @since 1.0
	 *
	 * @param array  $actions
	 * @param object $item
	 *
	 * @return array $actions
	 */
	public function add_row_action( $actions, $item ) {
		$actions['resend'] = sprintf( '<a href="#" class="resend-email" id="email_id_%1$s">%2$s</a>',
			$item->id,
			__( 'Resend Email', 'email-log' )
		);

		return $actions;
	}

	/**
	 * Includes scripts on the Logs List page.
	 *
	 * @param string $log_list_page Log List page.
	 */
	public function include_assets_on_log_list_page( $log_list_page ) {
		add_action( 'admin_print_scripts-' . $log_list_page, array( $this, 'include_assets' ) );
	}

	/**
	 * Include JavaScript files.
	 *
	 * @since 1.0
	 */
	public function include_assets() {
		wp_enqueue_script( 'wp-util' );
		wp_enqueue_script( 'email-log-resend-email', plugins_url( '/assets/js/email-log-resend-email.js', $this->addon_file ), array(
			'jquery',
			'wp-util'
		), $this->addon_version, true );

		wp_enqueue_style( 'email-log-resend-email', plugins_url( '/assets/css/email-log-resend-email.css', $this->addon_file ), array(), $this->addon_version );
	}

	/**
	 * Print the Underscore template.
	 *
	 * @since 1.0
	 */
	public function print_template() {
		?>
		<div id="elre-email-form" style="display:none;"></div>

		<script type="text/html" id="tmpl-elre-email-form">
			<form id="elre-resend-email-form" method="post">
				<fieldset>
					<legend><?php _e( 'Email Details', 'email-log' ); ?></legend>

					<label>
						<span>To</span><input type="text" name="to" value="{{{ data.to }}}">
					</label>

					<label>
						<span>Subject</span> <input type="text" name="subject" value="{{{ data.subject }}}">
					</label>

					<label>
						<span>Message</span><textarea name="message" rows="5">{{{ data.message }}}</textarea>
					</label>
				</fieldset>

				<fieldset>
					<legend><?php _e( 'Additional Details', 'email-log' ); ?></legend>

					<label>
						<span><?php _e( 'From', 'email-log' ); ?></span><input type="text" name="from" value="{{{ data.from }}}">
					</label>

					<label>
						<span><?php _e( 'CC', 'email-log' ); ?></span><input type="text" name="cc" value="{{{ data.cc }}}">
					</label>

					<label>
						<span><?php _e( 'BCC', 'email-log' ); ?></span><input type="text" name="bcc" value="{{{ data.bcc }}}">
					</label>

					<label>
						<span><?php _e( 'Reply To', 'email-log' ); ?></span><input type="text" name="reply-to" value="{{{ data.reply_to }}}">
					</label>

					<label>
						<span><?php _e( 'Content Type', 'email-log' ); ?></span><input type="text" name="content-type" value="{{{ data.content_type }}}">
					</label>
				</fieldset>

				<input type="button" id="elre-resend-email" value="<?php _e( 'Resend Email', 'email-log' ); ?>" class="button button-primary">
				<img class="elre-resend-email-spinner" src="<?php echo admin_url( 'images/loading.gif' ); ?>" />
			</form>
		</script>
		<?php
	}

	/**
	 * AJAX callback for displaying email content
	 *
	 * @since 1.0
	 */
	public function get_email_callback() {
		$email_log = email_log();

		$email_id   = absint( $_POST['email_id'] );
		$email      = $email_log->table_manager->fetch_log_items_by_id( array( $email_id ) );
		$data       = array();

		if ( is_array( $email ) && ! empty( $email ) ) {
			$data = array(
				'to'      => esc_attr( $email[0]['to_email'] ),
				'subject' => esc_attr( $email[0]['subject'] ),
				'message' => esc_attr( $email[0]['message'] ),
				'headers' => esc_attr( $email[0]['headers'] ),
			);

			$parser = new EmailHeaderParser();
			$data   = array_merge( $data, $parser->parse_headers( $email[0]['headers'] ) );
		}

		echo wp_json_encode( $data );
		die(); // this is required to return a proper result
	}

	/**
	 * AJAX callback for sending email.
	 *
	 * @since 1.0
	 */
	public function resend_email_callback() {

		$to      = Util\sanitize_email( $_POST['to'] );
		$subject = stripslashes( $_POST['subject'] );
		$message = stripslashes( $_POST['message'] );

		$data = array(
			'from'         => Util\sanitize_email( $_POST['from'], false ),
			'cc'           => Util\sanitize_email( $_POST['cc'] ),
			'bcc'          => Util\sanitize_email( $_POST['bcc'] ),
			'reply_to'     => Util\sanitize_email( $_POST['reply_to'], false ),
			'content_type' => sanitize_text_field( $_POST['content_type'] ),
		);

		$parser  = new EmailHeaderParser();
		$headers = $parser->join_headers( $data );

		$response  = array();
		$mail_sent = wp_mail( $to, $subject, $message, $headers );

		if ( $mail_sent ) {
			$response['message'] = __( 'Email was successfully resent', 'email-log' );
		} else {
			$response['message'] = __( 'There was some problem in sending the email', 'email-log' );
		}

		echo wp_json_encode( $response );

		die(); // this is required to return a proper result
	}
}