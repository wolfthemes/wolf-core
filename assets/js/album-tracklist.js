/*!
 * Album tracklist
 *
 * WPBakery Page Builder Extension 3.2.8
 */
/* jshint -W062 */

var WolfCoreAlbumTracklist = function( $ ) {

	'use strict';

	return {

		/**
		 * Init UI
		 */
		init : function () {

			var _this = this;

			_this.playButton();

			$( window ).resize( function() {
				_this.widthClass();
			} ).resize();
		},

		playButton : function() {

			var _this = this;

			$( document ).on( 'click', '.wolf-core-ati-play-button', function( event ) {
				event.preventDefault();

				var $btn = $( this ),
					$container = $btn.parents( '.wolf-core-album-tracklist' ),
					$audio = $btn.next( '.wolf-core-ati-audio' ),
					audioId = $audio.attr( 'id' ),
					audio = document.getElementById( audioId );

				if ( ! $btn.hasClass( 'wolf-core-ati-track-playing' ) ) {

					_this.pauseAllPlayers();
					$container.find( '.wolf-core-album-tracklist-item' ).removeClass( 'wolf-core-album-tracklist-item-active' );
					$btn.closest( '.wolf-core-album-tracklist-item' ).addClass( 'wolf-core-album-tracklist-item-active' );
					$btn.addClass( 'wolf-core-ati-track-playing' );
					audio.play();

				} else {

					$btn.removeClass( 'wolf-core-ati-track-playing' );
					audio.pause();
				}
			} );

			$( '.wolf-core-ati-audio' ).bind( 'ended', function() {
				$( this ).prev( '.wolf-core-ati-play-button' ).removeClass( 'wolf-core-ati-track-playing' );
			} );
		},

		pauseAllPlayers : function() {
			$( '.wolf-core-ati-audio-cell' ).each( function() {
				var $btn = $( this ).find( '.wolf-core-ati-play-button' ),
					$audio = $btn.next( '.wolf-core-ati-audio' ),
					audioId = $audio.attr( 'id' ),
					audio = document.getElementById( audioId );

				$btn.removeClass( 'wolf-core-ati-track-playing' );
				audio.pause();
			} );
		},

		widthClass : function() {
			$( '.wolf-core-album-tracklist' ).each( function() {
				var width = $( this ).width();

				if ( 500 > width && 380 < width  ) {
					$( this ).addClass( 'wolf-core-album-tracklist-500' );
					$( this ).removeClass( 'wolf-core-album-tracklist-380' );

				} else if ( 380 > width ) {
					$( this ).removeClass( 'wolf-core-album-tracklist-500' );
					$( this ).addClass( 'wolf-core-album-tracklist-380' );
				} else {
					$( this ).removeClass( 'wolf-core-album-tracklist-500' );
					$( this ).removeClass( 'wolf-core-album-tracklist-380' );
				}
			} );
		}
	};
}( jQuery );

( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfCoreAlbumTracklist.init();
	} );

} )( jQuery );
