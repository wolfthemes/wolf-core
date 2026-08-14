/*!
 * FullPage
 *
 * WPBakery Page Builder Extension 3.2.8
 */
/* jshint -W062 */

/* global WolfCoreJSParams, WolfCore, WolfCoreCounter, WolfCoreYTVideoBg, AOS, $f */
var WolfCoreFullPage = function( $ ) {

	'use strict';

	return {

		initFlag : false,
		isScrolling : false,
		$container : $( '.page-entry-content' ),
		rowSelector : '.wolf-core-parent-row',
		sectionNames : [],
		fpAnimTime : 900,
		fpEasing : 'swing',
		fpTransitionEffect : 'zoom',
		animationEndTimeOut : null,
		revSliderStarted : [],
		//isFirst : true,

		init : function() {

			if ( this.initFlag || ! WolfCoreJSParams.fullPage || "undefined" !== typeof elementor ) {
				return;
			}

			//console.log( WolfCoreJSParams.fullPageContainer );

			this.$container = $( WolfCoreJSParams.fullPageContainer || '[data-elementor-type="wp-page"]' );
			this.rowSelector = $( WolfCoreJSParams.fullPageSelector || '.wolf-core-parent-row' );
			this.fpAnimTime = WolfCoreJSParams.fpAnimTime;
			this.fpEasing = WolfCoreJSParams.fpEasing;
			this.fpTransitionEffect = WolfCoreJSParams.fpTransitionEffect;

			this.prepare();
			this.fullPage();

			$( window ).trigger( 'wolf_core_fullpage_loaded' );

			this.initFlag = true;
		},

		/**
		 * Prepare markup
		 */
		prepare : function() {

			setTimeout( function() {
				window.scrollTo( 0, 0 );
			}, 10 );

			var _this = this,
				initialSectionIndex;

			$( 'body' ).addClass( 'wolf-core-fullpage' );

			/* Set row class and data */
			$( this.rowSelector, this.$container ).each( function( index ) {

				var sectionName = $( this ).data( 'row-name' ) || 'Section ' + ( index + 1 );
				_this.sectionNames.push( sectionName );

				//console.log( sectionName );

				$( this ).attr( 'data-section', index + 1 );
				$( this ).addClass( 'wolf-core-scroll-lock fp-auto-height' );

				$( this ).find( '> .e-con-inner > .wolf-core-elementor-row' ).unwrap();

				/* RevSlider is there */
				if ( $( this ).find( '.wolf-core-revslider-container-fullscreen' ).length ) {
					$( this ).addClass( 'wolf-core-fp-section-has-fullwidth-revslider' );
				}
			} );

			WolfCore.delayWow( this.rowSelector );

			//WolfCore.doAOS();
			WolfCore.resetAOS();
		},

		/**
		 * fullPage
		 */
		fullPage : function () {

			var _this = this,
				$container = this.$container,
				scrollBar = false,
				noHistory = false,
				toIndex,
				hash;

			$container.fullpage( {
				slidesNavigation: true,
				sectionSelector: _this.rowSelector,
				scrollOverflow: true,
				navigation: false,
				scrollBar: scrollBar,
				scrollingSpeed: _this.fpAnimTime,
				easing: _this.fpEasing,
				verticalCentered: true,
				//anchors: noHistory ? false : _this.sectionNames,
				//recordHistory: ! noHistory,

				afterRender: function() {

					$( '.wolf-core-scroll-lock.active' ).addClass( 'wolf-core-scroll-active' );

					WolfCore.pausePlayers( false );

					//if ( _this.isMobile ) {
					//	WolfCoreCounter.init();
					//}

					WolfCore.doAOS( '.wolf-core-scroll-active' );

					/**
					 * Play first video bg if any
					 */
					_this.playActiveVideoBg();
					_this.handleRevSlider();

					$( '#wolf-core-one-page-nav a.wolf-core-fp-nav:first-child' ).addClass( 'wolf-core-bullet-active' );

					_this.navigation();
					_this.nextNavigation();

					/* Move to section if a hash is found in the URL */
					setTimeout( function() {

						hash = window.location.hash;

						if ( '' !== hash ) {
							toIndex = $( '.fp-section' ).index( $( hash ) );
							$.fn.fullpage.moveTo( toIndex + 1 );
						}

						/**
						 * Animate first slide
						 */
						WolfCore.doWow();
						Waypoint.refreshAll();
						$( '.wolf-core-scroll-active' ).find( '.lazy-hidden' ).removeClass( 'lazy-hidden' ); // force lazyload

					}, 1000 );
				},

				onLeave: function( index, nextIndex, direction ) {

					if ( this.isScrolling ) {
						return false;
					}

					this.isScrolling = true;

					//var event = new CustomEvent( 'fp-slide-leave' );
					//window.dispatchEvent( event );

					//WolfCore.delayWow( this.rowSelector );
					WolfCoreFullPage.slideLeaveAnimation( index, nextIndex, direction );

					if ( $( '.wolf-core-scroll-lock', this.$container ).eq( nextIndex + 1 ).hasClass( 'hidden-scroll' ) ) {

						if ( 'up' === direction ) {
							$.fn.fullpage.moveTo( nextIndex - 1 );
						} else {
							$.fn.fullpage.moveTo( nextIndex + 1 );
						}
						return false;
					}

					//$( '#wolf-core-one-page-nav a.wolf-core-fp-nav' ).removeClass( 'wolf-core-bullet-active' );
					//$( '#wolf-core-one-page-nav a.wolf-core-fp-nav[data-index="' + ( nextIndex - 1 ) + '"]' ).addClass( 'wolf-core-bullet-active' );
				}
			} );
		},

		/**
		 * Go to next section if any
		 */
		nextNavigation : function() {

			var _this = this,
				index;

			$( document ).on( 'click', '.wolf-core-fp-nav-next, .wolf-core-arrow-down', function( event ) {

				event.preventDefault();

				if ( _this.isScrolling ) {
					return;
				}

				index = $( this ).closest( '.wolf-core-scroll-lock' ).data( 'section' );

				$.fn.fullpage.moveTo( index + 1 );
			} );
		},

		/**
		 * Navigation
		 */
		navigation : function () {

			var _this = this,
				href,
				toIndex;

			$( document ).on( 'click', '.wolf-core-fp-nav', function( event ) {

				event.preventDefault();

				if ( _this.isScrolling ) {
					return;
				}

				href = $( this ).attr( 'href' ),
					toIndex = $( '.fp-section' ).index( $( href ) );

				$.fn.fullpage.moveTo( toIndex + 1 );
			} );
		},

		/**
		 * Play active video bg (fullpage script stoped it)
		 */
		playActiveVideoBg : function( $container ) {

			$container = $container || $( '.wolf-core-scroll-active' );

			var video, YTPlayerId, VimeoPlayerId, vimeoPlayer;

			/* HTML video */
			if ( $container.find( '.wolf-core-video-bg, .video-bg' ).length ) {

				setTimeout( function() {

					video = $container.find( '.wolf-core-video-bg, .video-bg' ).get(0);

					if ( video.paused ) {
						video.play();
					}

				}, 200 );

			/* YT video */
			} else if ( $container.find( '.wolf-core-youtube-player' ).length ) {

				setTimeout( function() {
					$container.find( '.wolf-core-youtube-player' )[0].contentWindow.postMessage( '{"event":"command","func":"' + 'playVideo' + '", "args":""}', '*' );
				}, 200 );

			/* Vimeo video */
			} else if ( $container.find( '.wolf-core-vimeo-bg' ).length ) {

				setTimeout( function() {
					vimeoPlayer = new Vimeo.Player( $container.find( '.wolf-core-vimeo-bg' )[0] );
					vimeoPlayer.play();
				}, 200 );
			}
		},

		slideLeaveAnimation : function ( index, nextIndex, direction ) {

			var _this = this,
				$currentSlide = $( '.wolf-core-scroll-lock[data-section="' + index + '"]', this.$container ),
				$nextSlide = $( '.wolf-core-scroll-lock[data-section="' + nextIndex + '"]', this.$container ),
				animationEnd = 'webkitAnimationEnd MozAnimation animationend',
				transitionEnd = 'webkitTransitionEnd MozTransition transitionend',
				effect,
				animTime = this.fpAnimTime,
				animOut,
				animIn,
				animInDelay,
				containerOff = this.$container.offset().top,
				timeout,
				dataHash = $nextSlide.attr( 'data-anchor' ),
				player, iframe;

			// effect = fade|slide|zoom|parallax|curtain

			if ( 'zoom' === this.fpTransitionEffect || 'mix' === this.fpTransitionEffect ) {

				effect = 'scaleDown';

			} else if ( 'parallax' === this.fpTransitionEffect ) {

				effect = 'moveparallax';

			} else if ( 'fade' === this.fpTransitionEffect ) {

				effect = 'opacity';

			} else if ( 'slide' === this.fpTransitionEffect ) {

				effect = 'moveslide';

			} else if ( 'curtain' === this.fpTransitionEffect ) {

				effect = 'movecurtain';

			} else {
				effect = '';
			}

			animOut = effect !== 'scaleDown' ? effect + direction : effect;
			animInDelay = effect === 'scaleDown' ? 0 : 0;

			switch( direction ) {
				case 'up':
					animIn = 'moveFromTop';
					break;
				default:
					animIn = 'moveFromBottom';
			}

			if ( 'zoom' === this.fpTransitionEffect ) {

				animOut = animIn + 'trid';
				animIn = animOut + 'In';
				animTime = animTime * 2;

			} else if ( 'fade' === this.fpTransitionEffect ) {

				animIn = effect + 'In';
				animOut = effect + 'Out';
			}

			//console.log( animIn, animOut );

			_this.playActiveVideoBg( $nextSlide );

			//if ( _this.isMobile ) {
			//	WolfCoreCounter.init();
			//}

			var $outBg = $( '.background-wrapper', $currentSlide );

			this.activateParallax( nextIndex, direction );

			WolfCore.pausePlayers( false );
			//WolfCore.delayWow( this.rowSelector );

			$nextSlide.find( '.wolf-core-revslider-container' ).show();
			_this.handleRevSlider( $nextSlide );

			//console.log( animIn );
			//console.log( animOut );

			$nextSlide
				.addClass( 'wolf-core-scroll-front' )
				.addClass( 'wolf-core-scroll-active' )
				.addClass( 'wolf-core-scroll-visible' )
				.addClass( 'wolf-core-scroll-animating-in' )
				.css( {
					'z-index': 4,
					'animation-name': animIn,
					'animation-duration': animTime + 'ms',
					'animation-delay': '',
					'animation-timing-function': _this.fpEasing,
					'animation-fill-mode': 'both',
					'transition': 'initial',
				} ).off( animationEnd )
				.on( animationEnd, function( event ) {

					if ( event.originalEvent.animationName === animIn ) {
						$( this )
							.addClass( 'wolf-core-scroll-already' )
							.removeClass( 'wolf-core-scroll-front' )
							.removeClass( 'wolf-core-scroll-animating-in' )
							.css( {
								'animation-name': '',
								'animation-duration': '',
								'animation-delay': '',
								'animation-timing-function': '',
								'animation-fill-mode': '',
								'transition': 'initial',
							} );

						$currentSlide
							.removeClass( 'wolf-core-scroll-active' )
							.add( $outBg )
							.css( {
								'animation-name': '',
								'animation-duration': '',
								'animation-delay': '',
								'animation-timing-function': '',
								'animation-fill-mode': '',
								'transition': 'initial',
							} );

						_this.animationEndAction( index, nextIndex );
					}

					if ( nextIndex > 1 ) {
						$( 'body' ).addClass( 'window-scrolled' );
					} else {
						$( 'body' ).removeClass( 'window-scrolled' );
					}
				} );

			$currentSlide
				.addClass( 'wolf-core-scroll-animating-out' )
				.removeClass( 'wolf-core-scroll-front' )
				.css( {
					'z-index': 1,
					'animation-name': animOut,
					'animation-duration': animTime + 'ms',
					'animation-delay': '',
					'animation-timing-function': _this.fpEasing,
					'animation-fill-mode': 'both',
					'transition': 'initial',
					'will-change': 'auto'
				} ).off( animationEnd )
				.on( animationEnd, function( event ) {

					/* Hide Revslider */
					$currentSlide.find( '.wolf-core-revslider-container' ).hide();

					if ( event.originalEvent.animationName === animOut ) {
						$currentSlide.removeClass( 'wolf-core-scroll-animating-out' );
					}
				} );

			$( window ).trigger( 'wolf_core_fullpage_change', [ $nextSlide ] );

			$( '#wolf-core-one-page-nav a.wolf-core-fp-nav' ).removeClass( 'wolf-core-bullet-active' );
			$( '#wolf-core-one-page-nav a.wolf-core-fp-nav[data-index="' + nextIndex + '"]' ).addClass( 'wolf-core-bullet-active' );
		},

		/**
		 * Start revolution slider or redraw it if already started
		 */
		handleRevSlider : function ( $container ) {

			$container = $container || $( '.wolf-core-scroll-active' );

			if ( $container.find( '.wolf-core-slider-revolution' ).length ) {
				var _this = this,
					revSliderId =  $container.find( '.wolf-core-slider-revolution' ).data( 'revslider-id' );

				if ( $.inArray( revSliderId, _this.revSliderStarted ) == -1 ) {

					console.log( 'start' );

					window['revapi' + revSliderId].revstart();

					_this.revSliderStarted.push( revSliderId );

					//console.log( _this.revSliderStarted );

				} else {

					console.log( 'redraw' );

					window['revapi' + revSliderId].revredraw();
				}
			}
		},

		activateParallax : function( nextIndex, direction ) {

			var $el = $( '.wolf-core-scroll-lock[data-section="' + nextIndex + '"]', this.$container ),
				$cell = $( '.fp-tableCell', $el ),
				animationEnd = 'webkitAnimationEnd MozAnimation animationend',
				cellAnim;

			switch( direction ) {
				case 'up':
					cellAnim = 'moveFromTopInner';
					break;
				default:
					cellAnim = 'moveFromBottomInner';
			}

			if ( 'fade' === this.fpTransitionEffect || 'slide' === this.fpTransitionEffect || 'curtain' === this.fpTransitionEffect ) {
				cellAnim = '';
			}

			$cell.css( {
				'animation-name': cellAnim,
				'animation-duration': this.fpAnimTime + 'ms',
				'animation-delay': '',
				'animation-timing-function': this.fpEasing,
				'animation-fill-mode': 'both',
			} ).off( animationEnd )
			.on( animationEnd, function( event ) {
				if ( event.originalEvent.animationName === cellAnim ) {
					$cell
						.css( {
							'animation-name': '',
							'animation-duration': '',
							'animation-delay': '',
							'animation-timing-function': '',
							'animation-fill-mode': '',
						} );
				}
			} );
		},

		animationEndAction : function ( index, nextIndex ) {
			var _this = this,
				$currentSlide = $( '.wolf-core-scroll-lock[data-section="' + index + '"]', this.$container ),
				$nextSlide = $( '.wolf-core-scroll-lock[data-section="' + nextIndex + '"]', this.$container ),
				player, iframe,
				event;

			$( '.no-scrolloverflow' ).removeClass( 'no-scrolloverflow' );

			WolfCore.doWow();
			Waypoint.refreshAll();
			WolfCore.doAOS();

			event = new CustomEvent( 'fp-animation-end' );
			window.dispatchEvent(event);

			clearTimeout( _this.animationEndTimeOut );

			if ( $currentSlide.find( '.wolf-core-album-disc-disc-container' ).length ) {
				$currentSlide.find( '.wolf-core-album-disc-disc-container' ).removeClass( 'animated' );
			}

			_this.animationEndTimeOut = setTimeout( function() {

				_this.isScrolling = false;
				$( window ).trigger( 'wolf_core_fullpage_changed' );

			}, 500 );
		}
	};

}( jQuery );

( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfCoreFullPage.init();
	} );

} )( jQuery );
