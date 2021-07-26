/*!
 * Icon
 */
/* jshint -W062 */

var WolfCoreTextImageHover = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function ( $scope ) {
			$( ".wolf-core-text-hover-image" ).each( function() {

				var $item = $( this ),
					$img = $item.find( ".hover-reveal" ),
					offsetLeft = $img.offset().left,
					offsetTop = $img.offset().top;

				$item.on( "mousemove", function( e ) {

					//console.log( "translate3d(" + (e.clientX - offsetLeft) + "px, " + ( e.clientY - offsetTop) + "px, 0)" );

					$img.css( {
						"transform": "translate3d(" + (e.clientX - offsetLeft) + "px, " + (e.clientY - offsetTop) + "px, 0)"
					} );
				} );

				$item.on( "mouseenter", function() {
					$img.addClass( "wolf-core-text-hover-image-active" );

				} ).on( "mouseleave", function() {
					$img.removeClass( "wolf-core-text-hover-image-active" );
				} );

				$( window ).scroll( function() {
					if ( $img.hasClass( "wolf-core-text-hover-image-active" ) && ( $img.offset().top < $item.offset().top || $img.offset().top > $item.offset().top + $item.outerHeight() ) ) {
						$img.removeClass( "wolf-core-text-hover-image-active" );
					}
				} );
			} );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreTextImageHover.init();
	} );

} )( jQuery );
