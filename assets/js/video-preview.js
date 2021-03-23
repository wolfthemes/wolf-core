/*!
 * Plugin Video Preview
 *
 * Wolf Core 1.0.0
 */
/* jshint -W062 */

var WolfCoreVideoPreview = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {

			$( document ).on( "click", ".wolf-core-youtube-play-button", function() {
 				var $this = $( this ),
 					$container = $this.parent().parent(),
					$iframe = $container.find( "iframe" );

				$iframe[0].src += "&autoplay=1";
				$container.find( ".wolf-core-youtube-cover" ).delay( 500 ).fadeOut();
				$container.addClass( "wolf-core-youtube-playing" );
			} );

			$( document ).on( "click", ".wolf-core-embed-video-play-button", function() {
 				var $this = $( this ),
 					$container = $this.parent().parent(),
					$iframe = $container.find( "iframe" );

				$iframe[0].src += "&autoplay=1";
				$container.find( ".wolf-core-embed-video-cover" ).delay( 500 ).fadeOut();
				$container.addClass( "wolf-core-embed-video-playing" );
			} );
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreVideoPreview.init();
	} );

} )( jQuery );
