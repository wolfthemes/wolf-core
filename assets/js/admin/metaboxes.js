/**
 *  Metabox Tabs
 */

;( function( $ ) {

	"use strict";

	var colorpickerOptions = {

		palettes: WolfMetaboxesAdminParams.defaultPalette
	};

	if ( {} !== WolfMetaboxesAdminParams && WolfMetaboxesAdminParams.defaultPalette ) {
		$( ".wolf-core-metabox-colorpicker" ).wpColorPicker( colorpickerOptions );
	} else {
		$( ".wolf-core-metabox-colorpicker" ).wpColorPicker();
	}

	$( document ).ready( function() {
		$( ".wolf-core-metabox-metabox-tabs-panel" ).tabs();

		$( ".has-dependency" ).each( function () {

			var $this = $( this ),
				selectValue,
				relatedElement = $( this ).data( "dependency-element" ),
				values = $( this ).data( "dependency-values" );

			selectValue = $( ".option-section-" + relatedElement ).find( "select" ).val();

			if ( $.inArray( selectValue, values )  !== -1 ) {
				$this.show();
			} else {
				$this.hide();
			}

			$( ".option-section-" + relatedElement ).find( "select" ).on( "change", function() {
				selectValue = $( this ).val();

				if ( $.inArray( selectValue, values )  !== -1 ) {
					$this.show();
				} else {
					$this.hide();
				}
			} );
		} );

			$( document ).on( "click", ".wolf-core-metabox-set-img, .wolf-core-metabox-set-bg", function( e ) {
				e.preventDefault();
				var $el = $( this ).parent(),
					selection, attachment,
					uploader = wp.media({
						title : WolfMetaboxesAdminParams.chooseImage,
						library : { type : "image"},
						multiple : false
					} )
					.on( "select", function(){
						selection = uploader.state().get( "selection" );
						attachment = selection.first().toJSON();
						$( "input", $el ).val( attachment.id );
						$( "img", $el ).attr( "src", attachment.url ).show();
					} )
				.open();
			} );

			/**
			 * make sure the previews are sortable
			 */
			$( ".wolf-core-metabox-images-set" ).sortable( {
				update : function() {
					$( this ).parent().find( "input" ).val( $( this ).sortable( "toArray", { attribute: "data-attachment-id" } ) );
				},
				helper: "clone",
				items: ".wolf-core-metabox-image"
			} );

			/**
			 * activate media uploader to select multiple images for a slideshow
			 */
			$( document ).on( "click", ".wolf-core-metabox-param-set-multiple-img", function( e ) {
				e.preventDefault();

				var frame = frame || null,
					$el = $( this ).parent(),
					input = $el.find( "input" );

				/* if there is a frame created, use it */
				if ( frame ) {
					frame.open();
					return;
				}

				/* open the wp.media frame with our localised title */
				frame = wp.media.frames.file_frame = wp.media( {
					title : WolfMetaboxesAdminParams.chooseMultipleImage,
					library : { type : "image" },
					multiple : "add",
					button : { text : WolfMetaboxesAdminParams.chooseMultipleImage }
				} );

				frame.on( "close", function() {
					/* get the selection object */
					var selection = frame.state().get( "selection" ),
						/* array variable to hold new image IDs */
						imageIDs = [],
						/* variable to hold new HTML for the preview */
						newImages = "";
						//length = selection.length,
						//images = selection.models;
						//ids = [];

					/* maps a function to each selected image which constructs the preview and saves the ID */
					selection.map( function( attachment ) {
						var image = attachment.toJSON(),
							imageID,
							imageURL = ( image.sizes && image.sizes.thumbnail ) ? image.sizes.thumbnail.url : image.url;

						if ( image.id ) {

							imageID = image.id;

							if ( imageURL ) {

								imageIDs.push( imageID );

								/* jshint multistr: true */
								newImages += '<span class="wolf-core-metabox-image" data-attachment-id="' + imageID + '">\
									<span class="wolf-core-metabox-remove-img"></span>\
									<img src="' + imageURL + '">\
								</span>';
							}
						}
					} );

					// inser image IDs list in hidden input
					$( "input", $el ).val( imageIDs );

					if ( imageIDs.length ) {
						/* populate hidden input and preview */
						$el.find( ".wolf-core-metabox-images-set" ).html( newImages ).sortable( "refresh" );
					}
				} );

				/* opens the wp.media frame and selects the appropriate images */
				frame.on( "open", function() {

					/* get the image IDs from the hidden input */
					var imgIDs = input.val().split( "," ),
						/* get the selection object for the wp.media frame */
						selection = frame.state().get( "selection" ),
						attachment;

					if ( imgIDs && imgIDs.length ) {

						/* add each image to the selection */
						$.each( imgIDs, function( idx, val ) {

							if ( $.isNumeric( val ) ) {
								attachment = wp.media.attachment( val );
							}

							if ( attachment ) {
								attachment.fetch();
								selection.add( attachment ? [ attachment ] : [] );
							}
						} );
					}
				} );
				frame.open();
			} );

			/**
			 * Remove all images from gallery
			 */
			$( document ).on( "click", ".wolf-core-metabox-param-reset-all-img", function( e ) {
				e.preventDefault();

				if ( confirm( WolfMetaboxesAdminParams.confirmRemoveAllImages ) ) {
					$( this ).parent().find( "input" ).val( "" );
					$( this ).parent().find( ".wolf-core-metabox-images-set" ).empty();
				}
			} );

			/**
			 * Remove image from images set
			 */
			$( document ).on( "click", ".wolf-core-metabox-remove-img", function( e ) {
				e.preventDefault();
				var newImages = "",
					$el = $( this ).parent(),
					$imagesSet = $el.parent(),
					$input = $imagesSet.parent().find( "input" ),
					id = $el.data( "attachment-id" );

				$el.fadeOut( "fast", function() {

					$( this ).remove();

					$.each( $imagesSet.find( ".wolf-core-metabox-image" ), function() {

						if ( id !== $( this ).data( "attachment-id" ) ) {
							newImages += $( this ).data( "attachment-id" ) + ",";
						}
					} );

					$input.val( newImages );
					$imagesSet.sortable( "refresh" );
				} );
			} );

			$( document ).on( "click", ".wolf-core-metabox-set-file", function(e){
				e.preventDefault();
				var $el = $( this ).parent(),
					uploader = wp.media({
					title : WolfMetaboxesAdminParams.chooseFile,
					multiple : false
				} )
				.on( "select", function(){
					var selection = uploader.state().get( "selection" ),
						attachment = selection.first().toJSON();
					$( "input", $el ).val( attachment.url );
					//$( "span", $el ).html( attachment.url ).show();
				} )
				.open();
			} );

			$( document ).on( "click", ".wolf-core-metabox-set-video-file", function(e){
				e.preventDefault();
				var $el = $( this ).parent(),
					uploader = wp.media( {
					title : WolfMetaboxesAdminParams.chooseFile,
					library : { type : "video"},
					multiple : false

				} )
				.on( "select", function(){
					var selection = uploader.state().get( "selection" ),
						attachment = selection.first().toJSON();
					$( "input", $el ).val( attachment.url );
					$( "span", $el ).html( attachment.url ).show();
				} )
				.open();
			} );

			$( document ).on( "click", ".wolf-core-metabox-reset-img, .wolf-core-metabox-reset-bg", function(){

				$( this ).parent().find( "input" ).val( "" );
				$( this ).parent().find( ".wolf-core-metabox-img-preview" ).hide();
				return false;

			} );

			$( document ).on( "click", ".wolf-core-metabox-reset-file", function(){

				$( this ).parent().find( "input" ).val( "" );
				$( this ).parent().find( "span" ).empty();
				return false;
			} );

			$( '.wolf-core-metabox-datepicker' ).datepicker( { dateFormat: 'dd-mm-yy' } );
	} );

} )( jQuery );
