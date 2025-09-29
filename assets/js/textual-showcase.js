/*!
 * Icon
 */
/* jshint -W062 */

var WolfCoreTexualShowcase = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function ( $scope ) {
			$( ".wolf-core-tsi-text_hover_media" ).each( function() {

				var $item = $( this ),
					$media = $item.find( ".wolf-core-tsi-hover-reveal" ),
					offsetLeft = $item.offset().left + ($item.width() / 2),
					offsetTop = $item.offset().top + ($item.height() / 2);

				// Init position
				$media.css( {
					"--translate": "translate3d(" + offsetLeft + "px, " + offsetTop + "px, 0)"
				} );

				$item.on( "mousemove", function( e ) {

					$media.css( {
						"--translate": "translate3d(" + e.clientX + "px, " + e.clientY + "px, 0)"
					} );
				} );

				$item.on( "mouseenter", function() {
					$media.addClass( "wolf-core-tsi-text_hover_media-active" );

				} ).on( "mouseleave", function() {
					$media.removeClass( "wolf-core-tsi-text_hover_media-active" );
				} );

				$( window ).scroll( function() {
					if ( $media.hasClass( "wolf-core-tsi-text_hover_media-active" ) && ( $media.offset().top < $item.offset().top || $media.offset().top > $item.offset().top + $item.outerHeight() ) ) {
						$media.removeClass( "wolf-core-tsi-text_hover_media-active" );
					}
				} );
			} );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreTexualShowcase.init();
	} );

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( "frontend/element_ready/textual-showcase.default", function( $scope ) {
			WolfCoreTexualShowcase.init();
		} );
	} );

} )( jQuery );
