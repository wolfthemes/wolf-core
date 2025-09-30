/*!
 * Vivus
 *
 * Wolf Core 1.0.0
 */
/* jshint -W062 */

/* global Vivus */
var WolfCoreVivus = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {

			$( ".wolf-core-vivus" ).each( function() {
				var $svg = $( this ),
					svgId = $svg.attr( "id" ),
					file = $svg.data( "file" ),
					duration = $svg.data( "animation-duration" ) || 100;

				new Vivus( svgId, {
					type: "delayed",
					duration: duration,
					file: file,
					onReady: function () {
						$svg.css( { "visibility" : "visible" } );
					}
				} );
			} );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$(window).on("pageshow", function() {
		WolfCoreVivus.init();
	} );

} )( jQuery );
