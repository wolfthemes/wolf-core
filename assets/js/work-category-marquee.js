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
					el_pos,
					edge;

				$item.on( "mouseenter", function( event ) {
					el_pos = $( this ).offset(),
					edge = _this.closestEdge( event.pageX - el_pos.left, event.pageY - el_pos.top, $item.width(), $item.height() );

					$item.removeClass( 'out-from-top out-from-bottom over-from-top over-from-bottom' );

				//	console.log( 'enter ' + edge );

					if ( 'top' === edge ) {

						$( this ).addClass( 'over-from-top' ).on( WolfCore.animationEventEnd(), function() {
							$( this ).addClass( 'work-category-marquee-item-marquee-active' );
						} );

					} else if ( 'bottom' === edge ) {

						$( this ).addClass( 'over-from-bottom' ).on( WolfCore.animationEventEnd(), function() {
							$( this ).addClass( 'work-category-marquee-item-marquee-active' );
						} );
					} else {
						$( this ).addClass( 'over-from-top' ).on( WolfCore.animationEventEnd(), function() {
							$( this ).addClass( 'work-category-marquee-item-marquee-active' );
						} );
					}


				} ).on( "mouseleave", function( event ) {
					el_pos = $( this ).offset(),
					edge = _this.closestEdge( event.pageX - el_pos.left, event.pageY - el_pos.top, $item.width(), $item.height() );

					//console.log( 'out ' + edge );

					if ( 'top' === edge ) {

						$( this ).addClass( 'out-from-top' ).on( WolfCore.animationEventEnd(), function() {
							$( this ).removeClass( 'work-category-marquee-item-marquee-active' );
						} );

					} else if ( 'bottom' === edge ) {

						$( this ).addClass( 'out-from-bottom' ).on( WolfCore.animationEventEnd(), function() {
							$( this ).removeClass( 'work-category-marquee-item-marquee-active' );
						} );
					} else {
						$( this ).addClass( 'out-from-bottom' ).on( WolfCore.animationEventEnd(), function() {
							$( this ).removeClass( 'work-category-marquee-item-marquee-active' );
						} );
					}
				} );
			} );
		},

		closestEdge : function ( x,y,w,h ) {
			var topEdgeDist = this.distMetric( x,y,w/2,0 );
			var bottomEdgeDist = this.distMetric( x,y,w/2,h );
			var leftEdgeDist = this.distMetric( x,y,0,h/2 );
			var rightEdgeDist = this.distMetric( x,y,w,h/2 );

			var min = Math.min( topEdgeDist, bottomEdgeDist, leftEdgeDist, rightEdgeDist );
			switch ( min ) {
				case leftEdgeDist:
					return 'left';
				case rightEdgeDist:
					return 'right';
				case topEdgeDist:
					return 'top';
				case bottomEdgeDist:
					return 'bottom';
			}
		},

		distMetric : function ( x,y,x2,y2 ) {
			var xDiff = x - x2,
				yDiff = y - y2;
			return ( xDiff * xDiff ) + ( yDiff * yDiff );
		},
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreWorkCategoryMarquee.init();
	} );

	$( window ).on( 'elementor/frontend/init', function() {

		elementorFrontend.hooks.addAction( "frontend/element_ready/work-category-marquee.default", function() {
			WolfCoreWorkCategoryMarquee.init();
		} );
	} );

} )( jQuery );
