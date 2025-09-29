/*!
 * WooCommerce Login Form
 *
 */
/* jshint -W062 */

var WolfCoreLoginForm = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {
			$( ".wolf-core-loginform-tabs" ).each( function() {
				$( "#" + $( this ).attr( "id" ) ).tabs( {
					select: function(event, ui) {
						$( ui.panel ).animate( {opacity : 0.1} );
					},
					show: function(event, ui) {
						$( ui.panel ).animate( { opacity : 1.0 },1000 );
					}
				} );
			} );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreLoginForm.init();
	} );

} )( jQuery );
