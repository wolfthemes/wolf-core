/*!
 * Interactive LInks
 *
 * WPBakery Page Builder Extension 3.2.8
 */
/* jshint -W062 */

/* global WVC, WVCParams, WVCYTVideoBg, WolcVimeo, Vimeo */
var WolfCoreInteractiveLinks = (function ($) {
	"use strict";

	return {
		/**
		 * Init UI
		 */
		init: function () {

			$( document ).on( 'mouseover', '.wolf-core-interactive-link', function() {
				var index = $( this ).data( 'panel-index' );

				$( '.wolf-core-interactive-link' ).removeClass( 'link-active' );
				$( this ).addClass( 'link-active' );

				$( '.wolf-core-interactive-link-bg' ).removeClass( 'panel-current' );
				$( '#wolf-core-interactive-link-bg-' + index ).addClass( 'panel-current' );
			} );

		}
	};
})(jQuery);

(function ($) {
	"use strict";

	$(document).ready(function () {
		WolfCoreInteractiveLinks.init();
	});
})(jQuery);
