/*!
 * Elementor Pgae Settings to Post Meta
 *
 * Wolf Core 1.0.0
 */
/* jshint -W062 */

var WolfCorePostMeta = function( $ ) {

	"use strict";

	return {

		/**
		 * Init UI
		 */
		init : function () {
			if ( elementor !== undefined && elementor !== elementor.settings && elementor !== elementor.settings.page ) {

				elementor.settings.page.addChangeCallback( "loading_animation_type", this.handleMenuLayout );
				elementor.settings.page.addChangeCallback( "menu_layout", this.handleMenuLayout );
				elementor.settings.page.addChangeCallback( "menu_style", this.handleMenuStyle );
				elementor.settings.page.addChangeCallback( "hero_font_tone", this.handleHeroFontTone );
				elementor.settings.page.addChangeCallback( "after_header_block", this.handleAfterHeaderBlock );
				elementor.settings.page.addChangeCallback( "pre_footer_block", this.handlePreFooterBlock );
			}
		},

		/**
		 * Update menu layout meta
		 */
		handleloadingAnimationType : function ( newValue ) {

			//alert( self );

			/* AJAX save */
			$.post( WolfCoreJSParams.ajaxUrl, {
				postId : elementor.$previewContents.find( "body" ).data( "post-id" ),
				action : "wolf_core_ajax_update_loading_animation_type_post_meta",
				security : WolfCoreJSParams.ajaxNonce,
				loadingAnimationType : newValue
			}, function (
				response
			) {

				if ("OK" === response) {
					elementor.reloadPreview();
				}
			});
		},

		/**
		 * Update menu layout meta
		 */
		handleMenuLayout : function ( newValue ) {

			/* AJAX save */
			$.post( WolfCoreJSParams.ajaxUrl, {
				postId : elementor.$previewContents.find( "body" ).data( "post-id" ),
				action : "wolf_core_ajax_update_menu_layout_post_meta",
				security : WolfCoreJSParams.ajaxNonce,
				menuLayout : newValue
			}, function (
				response
			) {

				if ("OK" === response) {
					elementor.reloadPreview();
				}
			});
		},

		/**
		 * Update menu layout meta
		 */
		handleMenuStyle : function ( newValue ) {

			/* AJAX save */
			$.post( WolfCoreJSParams.ajaxUrl, {
				postId : elementor.$previewContents.find( "body" ).data( "post-id" ),
				action : "wolf_core_ajax_update_menu_style_post_meta",
				security : WolfCoreJSParams.ajaxNonce,
				menuStyle : newValue
			}, function (
				response
			) {

				if ("OK" === response) {
					elementor.reloadPreview();
				}
			});
		},

		/**
		 * Update menu layout meta
		 */
		handleHeroFontTone : function ( newValue ) {

			/* AJAX save */
			$.post( WolfCoreJSParams.ajaxUrl, {
				postId : elementor.$previewContents.find( "body" ).data( "post-id" ),
				action : "wolf_core_ajax_update_hero_font_tone_post_meta",
				security : WolfCoreJSParams.ajaxNonce,
				heroFontTone : newValue
			}, function (
				response
			) {

				if ("OK" === response) {
					elementor.reloadPreview();
				}
			});
		},

		/**
		 * Update menu layout meta
		 */
		handleAfterHeaderBlock : function ( newValue ) {

			/* AJAX save */
			$.post( WolfCoreJSParams.ajaxUrl, {
				postId : elementor.$previewContents.find( "body" ).data( "post-id" ),
				action : "wolf_core_ajax_update_after_header_block_post_meta",
				security : WolfCoreJSParams.ajaxNonce,
				afterHeaderBlock : newValue
			}, function (
				response
			) {

				console.log( data );

				if ("OK" === response) {
					elementor.reloadPreview();
				}
			});
		},

		/**
		 * Update menu layout meta
		 */
		handlePreFooterBlock : function ( newValue ) {

			/* AJAX save */
			$.post( WolfCoreJSParams.ajaxUrl, {
				postId : elementor.$previewContents.find( "body" ).data( "post-id" ),
				action : "wolf_core_ajax_update_pre_footer_block_post_meta",
				security : WolfCoreJSParams.ajaxNonce,
				preFooterBlock : newValue
			}, function (
				response
			) {

				if ("OK" === response) {
					elementor.reloadPreview();
				}
			});
		}
	};

}( jQuery );

( function( $ ) {

	"use strict";

	$( document ).ready( function() {
		WolfCorePostMeta.init();
	} );

} )( jQuery );
