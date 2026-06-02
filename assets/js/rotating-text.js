/*!
 * FitText
 */
/* jshint -W062 */

var WolfCoreRotatingText = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {
			$( ".wolf-core-rotating-text" ).each( function() {
				var $this = $( this ),
					$svg = $this.find( "svg" );

				$svg.css( {
					'margin-left' : "-" + $svg.width() / 4 + "px",
					'margin-top' : "-" + $svg.width() / 4 + "px"
				} );
			} );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		//WolfCoreRotatingText.init();
	} );

	$( window ).on( 'elementor/frontend/init', function() {
	//	alert();
		elementorFrontend.hooks.addAction( "frontend/element_ready/rotating-text.default", function( $scope ) {
			if ( $scope.find(".wolf-core-rotating-text") ) {
				//WolfCoreRotatingText.init();
			}
		} );
	} );

} )( jQuery );
