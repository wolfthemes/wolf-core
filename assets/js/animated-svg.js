/*!
 * BigText
 */
/* jshint -W062 */

var WolfCoreAnimatedSVG = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {

			$( ".wolf-core-svg" ).each( function() {

				var $container = $( this ),
					$svg = $( this ).find( "svg" ),
					width = $container.data( "width" ) || $container.width(),
					strokeWidth = $container.data( "stroke-width" ) || 5,
					color = $container.data( "path-color" ) || WolfCoreJSParams.accentColor,
						animationDuration = $container.data( "animation-duration" ) || 5,
						animationDelay = $container.data( "animation-delay" ) || 0;

					$svg.css({
						"width": width + "px"
					});

				$svg.find( "path" ).each( function ( index ) {

					var $path = $( this ),
						length = $path[ 0 ].getTotalLength();

					$path.css( {
						"stroke-width": $path.data( "stroke-width" ) || strokeWidth,
						"stroke-dasharray": length,
	  					"stroke-dashoffset": length,
						"stroke": $path.data( "color" ) || color,
						"animation-duration" : $path.data( "animation-duration" ) || animationDuration + "s",
						"animation-delay" : $path.data( "animation-delay" ) || animationDelay + "s"
					} );
				} );
			} );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreAnimatedSVG.init();
	} );

	$( document ).ready( function() {
		if (  window.elementorFrontend !== undefined && elementorFrontend !== undefined && elementorFrontend.hooks !== undefined ) {

			elementorFrontend.hooks.addAction( 'init', function() {
				WolfCoreAnimatedSVG.init();
			} );
			elementorFrontend.hooks.addAction( "frontend/element_ready/animated-svg.default", function() {
				WolfCoreAnimatedSVG.init();
			} );
		}
	} );

} )( jQuery );
