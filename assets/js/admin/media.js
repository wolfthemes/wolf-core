/**
 *  Upload image
 */
 /* global WolfCoreAdminParams */
;( function( $ ) {

	$( document ).on( "click", ".wolf-core-set-img, .wolf-core-set-bg", function( e ) {
		e.preventDefault();
		var $el = $( this ).parent(),
			selection, attachment,
			uploader = wp.media({
				title : WolfCoreAdminParams.chooseImage,
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

	$( document ).on( "click", ".wolf-core-set-file", function(e){
		e.preventDefault();
		var $el = $( this ).parent();
		var uploader = wp.media({
			title : WolfCoreAdminParams.chooseFile,
			multiple : false
		} )
		.on( "select", function(){
			var selection = uploader.state().get( "selection" );
			var attachment = selection.first().toJSON();
			$( "input", $el ).val( attachment.url );
			$( "span", $el ).html( attachment.url ).show();
		} )
		.open();
	} );

	$( document ).on( "click", ".wolf-core-set-video-file", function(e){
		e.preventDefault();
		var $el = $( this ).parent();
		var uploader = wp.media({
			title : WolfCoreAdminParams.chooseFile,
			library : { type : "video"},
			multiple : false

		} )
		.on( "select", function(){
			var selection = uploader.state().get( "selection" );
			var attachment = selection.first().toJSON();
			$( "input", $el ).val(attachment.url);
			$( "span", $el ).html(attachment.url).show();
		} )
		.open();
	} );

	$( document ).on( "click", ".wolf-core-set-audio-file", function(e){
		e.preventDefault();
		var $el = $( this ).parent();
		var uploader = wp.media({
			title : WolfCoreAdminParams.chooseFile,
			library : { type : "audio"},
			multiple : false

		} )
		.on( "select", function(){
			var selection = uploader.state().get( "selection" );
			var attachment = selection.first().toJSON();
			$( "input", $el ).val(attachment.url);
			$( "span", $el ).html(attachment.url).show();
		} )
		.open();
	} );

	$( document ).on( "click", ".wolf-core-reset-img, .wolf-core-reset-bg", function(){

		$( this ).parent().find( "input" ).val( "" );
		$( this ).parent().find( ".wolf-core-img-preview" ).hide();
		return false;

	} );

	$( document ).on( "click", ".wolf-core-reset-file", function(){

		$( this ).parent().find( "input" ).val( "" );
		$( this ).parent().find( "span" ).empty();
		return false;

	} );

} )( jQuery );
