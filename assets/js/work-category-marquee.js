/*!
 * Icon
 */
/* jshint -W062 */

var WolfCoreWorkCategoryMarquee = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {

			var _this = this;

			$( ".work-category-marquee-item" ).each( function() {
				var $item = $( this ),
					edge;

				$item.on( "mouseenter", function( event ) {
					edge = _this.findClosestEdge(event);

					$item.addClass( 'work-category-marquee-item-marquee-active' );

				} ).on( "mouseleave", function( event ) {
					edge = _this.findClosestEdge(event);

					$item.removeClass( 'work-category-marquee-item-marquee-active' );
				} );
			} );
		},

		findClosestEdge : function( event ) {

		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreWorkCategoryMarquee.init();
	} );

	$( document ).ready( function() {
		// if ( window.elementorFrontend && elementorFrontend !== undefined && elementorFrontend.hooks !== undefined ) {
		// 	elementorFrontend.hooks.addAction( 'frontend/element_ready/icon.default', function( $scope ) {

		// 		WolfCoreWorkCategoryMarquee.init( $scope );
		// 	} );
		// }
	} );

} )( jQuery );
