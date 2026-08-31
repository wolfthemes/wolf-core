/*!
 * FitText
 */
/* jshint -W062 */

var WolfCoreMarquee = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {
			$( ".wolf-core-marquee-text" ).marquee({
				direction: "left",
				duration: ($(window).width() < 768 ? 5000 : 20000),
				gap: 0,
				delayBeforeStart: 0,
				duplicated: true,
				startVisible: true
			});
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreMarquee.init();
	} );

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( "frontend/element_ready/marquee-text.default", function( $scope ) {

			if ( $scope.find(".wolf-core-marquee-text") ) {
				WolfCoreMarquee.init();
			}
		} );
	} );

} )( jQuery );
