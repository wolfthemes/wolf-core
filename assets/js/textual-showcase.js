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
					offsetLeft = $media.offset().left,
					offsetTop = $media.offset().top;

				$item.on( "mousemove", function( e ) {

					console.log( "translate3d(" + (e.clientX - offsetLeft) + "px, " + ( e.clientY - offsetTop) + "px, 0)" );

					$media.css( {
						"transform": "translate3d(" + (e.clientX - offsetLeft) + "px, " + (e.clientY - offsetTop) + "px, 0)"
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

} )( jQuery );
