<?php
/**
 * Plugin Name: Email Log - Resend Email
 * Plugin Script: email-log-resend-email.php
 * Plugin URI: https://wpemaillog.com/addons/resend-email/
 * Description: Resend Email add-on for Email Log plugin.
 * Version: 2.0.1
 * License: GPL-2.0+
 * Author: Sudar
 * Author URI: http://sudarmuthu.com
 * Text Domain: email-log
 */

/**
 * Copyright 2010 - Present Sudar Muthu  (email : sudar@sudarmuthu.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * Load Email Log Resend Email Add-on.
 *
 * @since 2.0
 */
function load_email_log_resend_email_addon() {
	if ( ! class_exists( 'EmailLogAddonActivator' ) ) {
		require_once 'vendor/email-log/email-log-addon-activator/src/EmailLogAddonActivator.php';
	}

	$addon_activator = new EmailLogAddonActivator( __FILE__ );

	if ( $addon_activator->requirement_met() ) {
		load_email_log_addon( '\EmailLog\Addon\ResendEmailAddon', __FILE__ );
	}
}

add_action( 'plugins_loaded', 'load_email_log_resend_email_addon', 100 );
