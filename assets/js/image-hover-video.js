/*!
 * Imahe Hover Video
 */
/* jshint -W062 */

/* global WVC, WVCParams, WVCYTVideoBg, WolcVimeo, Vimeo */
var WolfCoreImagHoverVideo = (function ($) {
	"use strict";

	return {
		/**
		 * Init UI
		 */
		init: function () {

			if ( WolfCoreJSParams.isMobile ) {
				return;
			}

			$( document ).on( 'mouseover', '.wolf-core-image-hover-video', function() {
				if ( $( this ).find( 'video' ).length ) {
					$( this ).find( 'video' )[0].play();
				}

			} ).on( "mouseout", function( event ) {
				if ( $( this ).find( 'video' ).length ) {
					var media = $( this ).find( 'video' ).get(0);
					media.pause();
					media.currentTime = 0;
				}
			} );
		}
	};
})(jQuery);

(function ($) {
	"use strict";

	$(document).ready(function () {
		WolfCoreImagHoverVideo.init();
	});

	$( window ).on( 'elementor/frontend/init', function() {

		elementorFrontend.hooks.addAction( "frontend/element_ready/image-hover-video.default", function() {
			//WolfCoreImagHoverVideo.init();
		} );
	} );
})(jQuery);
