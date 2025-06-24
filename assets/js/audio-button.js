/*!
 * Audio Button
 */
/* jshint -W062 */
var WolfCoreAudioButton = function( $ ) {
	"use strict";
	return {
		/**
		 * Init UI
		 */
		init : function ( $scope ) {

			this.autoPlay();
			this.btnClick();

		},

		autoPlay : function() {
			$(".wolf-core-audio-button").each(function() {
			   var $btn = $(this),
				   $container = $btn.parent(),
				   $audio = $btn.find(".wolf-core-audio-button-player"),
				   audioId = $audio.attr("id"),
				   autoPlay = $btn.data( "autoplay" ) || false,
				   audio = document.getElementById(audioId);

				// console.log( autoPlay );

				if ( audio && autoPlay ) {
					// audio.muted = false;
					// audio.play().catch(e => console.log('Autoplay blocked:', e));
				}

			   // if (audio) {
			   //  setTimeout(() => {
			   //   audio.play().catch(e => console.log('Autoplay blocked:', e));
			   //   $container.addClass("wolf-core-audio-button-playing");
			   //   $btn.attr("title", WolfCoreJSParams.l10n.pauseText || 'Pause');
			   //  }, 1000);
			   // }
			});
		},

		btnClick : function() {

			$(document).on("click", ".wolf-core-audio-button", function () {
				event.preventDefault();

				var $btn = $(this),
					$container = $btn.parent(),
					$audio = $btn.find(".wolf-core-audio-button-player"),
					audioId = $audio.attr("id"),
					audio = document.getElementById(audioId),
					$icon = $btn.find('.wolf-core-audio-button-icon'),
					playText = WolfCoreJSParams.l10n.playText || 'Play',
					pauseText = WolfCoreJSParams.l10n.pauseText || 'Pause';

				if (!$container.hasClass("wolf-core-audio-button-playing")) {
					$("video, audio").trigger("pause");
					$btn.attr("title", pauseText);
					$container.removeClass("wolf-core-audio-button-playing");
					$container.addClass("wolf-core-audio-button-playing");
					audio.play();
				} else {
					$container.removeClass("wolf-core-audio-button-playing");
					audio.pause();
					$btn.attr("title", playText);
				}
			});

		}
	};
}( jQuery );

( function( $ ) {
	"use strict";
	$( document ).ready( function() {
		WolfCoreAudioButton.init();
	} );
} )( jQuery );
