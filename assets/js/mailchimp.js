/*!
 * Mailchimp
 *
 * Wolf Core 1.0.0
 */
/* jshint -W062 */
/* global WolfCoreMailchimpParams */

var WolfCoreMailchimp = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {

			var _this = this;

			this.submitButton();

			$(window)
                .resize(function () {
					_this.sizeClasses();
			});
		},

		submitButton : function () {
			$( ".wolf-core-mailchimp-submit" ).on( "click", function( event ) {
				event.preventDefault();

				var message = "",
					$submit = $( this ),
					$form = $submit.parents( ".wolf-core-mailchimp-form" ),
					$result = $form.find( ".wolf-core-mailchimp-result" ),
					list_id = $form.find( ".wolf-core-mailchimp-list" ).val(),
					firstName = $form.find( ".wolf-core-mailchimp-f-name" ).val(),
					lastName = $form.find( ".wolf-core-mailchimp-l-name" ).val(),
					hasName = $form.find( ".wolf-core-mailchimp-has-name" ).val(),
					email = $form.find( ".wolf-core-mailchimp-email" ).val(),
					data = {

						action : "wolf_core_mailchimp_ajax",
						list_id : list_id,
						firstName : firstName,
						lastName : lastName,
						email : email,
						hasName : hasName
					};

				$result.animate( { "opacity" : 0 } );

				$.post( WolfCoreMailchimpParams.ajaxUrl, data, function( response ) {

					if ( response ) {

						message = response;

						console.log( message );

						if ( "OK" === response ) {

							message = WolfCoreMailchimpParams.subscriptionSuccessfulMessage;

							/* Use to track subscription event */
							$( window ).trigger( "wolf_core_mc_subscribe" );
						}

					} else {

						message = WolfCoreMailchimpParams.unknownError;
					}

					$result.html( message ).animate( { "opacity" : 1 } );

					setTimeout( function() {
						$result.animate( { "opacity" : 0 } );
					}, 3000 );
				} );
			} );
		},

		sizeClasses : function () {

			$( ".wolf-core-mailchimp-show-name-yes.wolf-core-mailchimp-size-large" ).each( function() {
				if ( 600 > $( this ).width() ) {
					$( this ).addClass( "wolf-core-mailchimp-smaller" );
				} else {
					$( this ).removeClass( "wolf-core-mailchimp-smaller" );
				}
			} );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreMailchimp.init();
	} );

} )( jQuery );
