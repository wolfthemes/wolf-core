/*!
 * BigText
 */
/* jshint -W062 */

var WolfCoreBigText = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {

			var _this = this;

			_this.bigText();

			$( window ).on( "wolf_core_resized", function () {
				_this.bigText();
			} );

			if ( $( 'body' ).hasClass( 'elementor-editor-active' ) || $( 'body' ).hasClass( 'vc-frontend' ) ) {
				_this.editor();
			}
		},

		bigText : function() {
			$( ".wolf-core-bigtext" ).each( function() {
				$( this ).bigtext();
			} );
		},

		editor : function () {
			var _this = this;
			setInterval( function() {
				_this.bigText();
			}, 3000 );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreBigText.init();
		window.dispatchEvent( new Event( "resize" ) );
	} );

	$( window ).on( "elementor/frontend/init", function () {
        window.dispatchEvent( new Event( "resize" ) );
    });

} )( jQuery );
