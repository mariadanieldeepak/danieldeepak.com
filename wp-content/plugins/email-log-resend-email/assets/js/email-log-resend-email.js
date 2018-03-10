/**
 * JavaScript for Email Log - Resend Email Plugin.
 *
 * http://sudarmuthu.com/wordpress/email-log
 *
 * @author: Sudar <http://sudarmuthu.com>
 */

/*jslint browser: true, devel: true*/
/*global jQuery, document*/
jQuery(document).ready(function($) {

	$( ".resend-email" ).on( 'click', function( e ) {
		var email_id = $(this).attr('id').replace('email_id_',''),
		data = {
			action: 'get_email',
			email_id: email_id
		};

		$.post( ajaxurl, data, function ( response ) {
			var email_template = wp.template( 'elre-email-form' );

			$( '#elre-email-form' ).html( email_template( response ) );
			tb_show( 'Resend Email', '#TB_inline?height=600&amp;width=500&amp;inlineId=elre-email-form' );

		}, 'json' )
		.always( function() {
			$( 'img.elre-resend-email-spinner' ).hide();
		} );

		e.preventDefault();
	});

	$( "body" ).on( 'click', '#elre-resend-email', function( e ) {

		var $form = $( '#elre-resend-email-form' ),
			data = {
			action: 'resend_email',
			to: $form.find( 'input[name=to]' ).val(),
			subject: $form.find( 'input[name=subject]' ).val(),
			message: $form.find( 'textarea[name=message]' ).val(),
			from: $form.find( 'input[name=from]' ).val(),
			cc: $form.find( 'input[name=cc]' ).val(),
			bcc: $form.find( 'input[name=bcc]' ).val(),
			reply_to: $form.find( 'input[name=reply-to]' ).val(),
			content_type: $form.find( 'input[name=content-type]' ).val(),
		},
			resendEmailBtn = $( '#' + e.target.id );

		// Disable the Resend Email button and display the loader.
		resendEmailBtn.attr( 'disabled', 'disabled' );
		$( 'img.elre-resend-email-spinner' ).show();

		$.post( ajaxurl, data, function ( response ) {
			$( '#TB_ajaxContent' ).html( response.message );
		}, 'json' );

		e.preventDefault();
	});
} );
