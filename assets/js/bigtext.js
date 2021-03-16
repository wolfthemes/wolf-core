/*!
 * BigText
 */
/* jshint -W062 */

var WolfCoreBigText = function( $ ) {

	'use strict';

	return {

		/**
		 * Init UI
		 */
		init : function () {

			var _this = this;

			_this.bigText();

			$( window ).on( 'wolf_core_resized', function () {
				_this.bigText();
			} );
		},

		bigText : function() {
			$( '.wolf-core-bigtext' ).each( function() {
				$( this ).bigtext();
			} );
		}
	};

}( jQuery );

( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfCoreBigText.init();
		window.dispatchEvent( new Event( 'resize' ) );
	} );

	$( window ).on( 'elementor/frontend/init', function () {
		//WolfCoreBigText.init();
        elementorFrontend.hooks.addAction('frontend/element_ready/bigtext.default', WolfCoreBigText.init() );
    })

} )( jQuery );
