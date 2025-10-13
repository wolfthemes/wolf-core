/*!
 * FitText
 */
/* jshint -W062 */

var WolfCoreFitText = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {
			$( ".wolf-core-fittext" ).each( function() {
				var maxFontSize = $( this ).data( "max-font-size" ) || 60,
					minFontSize = $( this ).data( "min-font-size" ) || 18,
					compression = $( this ).data( "font-compression" ) || 1.2;


				$( this ).find( ".elementor-heading-title" ).fitText( compression, { minFontSize: minFontSize + "px", maxFontSize: maxFontSize + "px" } );
			} );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreFitText.init();
	} );

} )( jQuery );
