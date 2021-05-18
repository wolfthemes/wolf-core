/*!
 * Galleries
 *
 * WPBakery Page Builder Extension 3.2.8
 */
/* jshint -W062 */
/* global DocumentTouch, WolfCore */
var WolfCoreGalleries = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {

			var _this = this;

			this.masonry();

			$( window ).resize( function() {
				_this.masonry();
			} );

			this.justify();
		},

		masonry : function () {

			if ( ! $( ".wolf-core-gallery-masonry" ).length && ! $( ".wolf-core-gallery-metro" ).length ) {
				return;
			}

			var $window = $( window ).width();

			// Disable isotope on mobile
			if ( 800 > $window ) {

				if ( $( ".wolf-core-gallery-isotope" ).length ) {

					$( ".wolf-core-gallery-isotope" ).isotope( "destroy" ).removeClass( "wolf-core-gallery-isotope" );
				}

			} else {

				$( ".wolf-core-gallery-masonry" ).imagesLoaded( function() {

					if ( ! $( ".wolf-core-gallery-masonry" ).hasClass( "wolf-core-gallery-isotope" ) ) {

						$( ".wolf-core-gallery-masonry" ).addClass( "wolf-core-gallery-isotope" );

						$( ".wolf-core-gallery-masonry" ).isotope( {
							itemSelector : ".wolf-core-img-masonry",
							animationEngine : "best-available",
							layoutMode : "masonry"
						} );


					} else {

						$( ".wolf-core-gallery-masonry" ).isotope( "layout" );

					}
				} );

				$( ".wolf-core-gallery-metro" ).imagesLoaded( function() {
					if ( ! $( ".wolf-core-gallery-metro" ).hasClass( "wolf-core-gallery-isotope" ) ) {

						$( ".wolf-core-gallery-metro" ).addClass( "wolf-core-gallery-isotope" );

						$( ".wolf-core-gallery-metro" ).isotope( {
							itemSelector : ".wolf-core-img-metro",
							animationEngine : "none",
							layoutMode : "packery"
						} );

					} else {

						$( ".wolf-core-gallery-metro" ).isotope( "layout" );

					}
				} );

			}
		},

		justify : function () {
			if ( $( ".wolf-core-gallery-justified" ).length ) {

				$( ".wolf-core-gallery-justified" ).imagesLoaded( function() {
					//console.log( "set mosaic" );
					$( ".wolf-core-gallery-justified" ).flexImages( {
						rowHeight: 350,
						container: ".wolf-core-img-justified"
					} );
				} );
			}
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCoreGalleries.init();
	} );

	$( document ).ready( function() {
		if ( window.elementorFrontend && elementorFrontend !== undefined && elementorFrontend.hooks !== undefined ) {
			elementorFrontend.hooks.addAction( "frontend/element_ready/gallery.default", function( $scope ) {
				WolfCoreGalleries.init();
				WolfCore.lazyLoad();
				WolfCore.AOS();
			} );
		}
	} );

} )( jQuery );
