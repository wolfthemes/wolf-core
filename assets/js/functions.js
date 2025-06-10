/*!
 * Front end plugin methods
 *
 * WPBakery Page Builder Extension 3.2.8
 */
/* jshint -W062 */
/* global DocumentTouch,
WolfCoreJSParams,
WolfCoreFitText,
WolfCoreFullPage,
WolfCoreBigText,
WolfCoreYTVideoBg,
WolfCoreSliders,
WolfCoreAccordion,
WolfCoreTabs,
WolfCoreToggles,
WolfCoreButtons,
WolfCoreCounter,
WolfCoreMailchimp,
WolfCoreTyped,
WolfCoreCountdown,
WolfCoreCarousels,
WolfCoreTwentyTwenty,
WolfCoreMessage,
WolfCoreVivus,
WolfCoreParticles,
WolfCoreGmaps,
WolfCoreProgressBar,
WolfCoreProcess,
WolfCoreVideoPreview,
WolfCoreGalleries,
WolfCorePie,
WolfCoreInteractiveLinks,
WolfCoreInteractiveOverlays,
WolfCoreAlbumTracklist,
WolfCoreAudioButton,
WolfCoreShowaseVerticalCarousel,
WolfCoreLoginForm,
WolfCoreModalWindow,
WolfCorePrivacyPolicyMessage,
WolfFrameworkJSParams,
WOW,
AOS,
lity,
Vimeo,
objectFitImages,
Event
*/
var WolfCore = (function ($) {
	"use strict";


	return {
		body: $("body"),
		isMobile: false,
		isEdge: navigator.userAgent.match(/(Edge)/i) ? true : false,
		isApple:
			navigator.userAgent.match(/(Safari)|(iPad)|(iPhone)|(iPod)/i) &&
			navigator.userAgent.indexOf("Chrome") === -1 &&
			navigator.userAgent.indexOf("Android") === -1
				? true
				: false,
		supportSVG:
			!!document.createElementNS &&
			!!document.createElementNS("https://www.w3.org/2000/svg", "svg")
				.createSVGRect,
		isTouch:
			"ontouchstart" in window ||
			(window.DocumentTouch && document instanceof DocumentTouch),
		fireAnimation: true,
		videBgResizedOnLoad: false,
		allowScrollEvent: true,

		/**
		 * Init functions
		 */
		init: function () {

			this.isMobile = WolfCoreJSParams.isMobile;

			var _this = this;

			this.setClasses();

			//this.setAnimationMasks();

			this.videoBackground();
			this.playButton();

			this.muteButton(); // mute video backgrounds

			this.fullHeightSection();

			this.rowCosmetic();
			this.rowMargins();
			//this.rowPostFeaturedImgBg();

			this.parallax();

			this.fluidVideos();

			this.lightbox();

			this.scrollDownArrow();

			this.smoothScroll();

			this.relGalleryAttr();

			this.maps();

			this.lazyLoad();

			this.onePager();

			this.stickElement();
			this.stickElementResize();

			this.objectFitfallback();

			//this.videoLightbox();

			//this.scrollDownMousewheel();

			this.addResizedEvent();
			this.twitterToX();

			/**
			 * Trigger resize event when an accordion or toggle elementi is open
			 */
			this.smoothScrollAccordionQuickFix();

			if ( this.allowScrollEvent ) {
				// Scroll event
				$(window).scroll(function () {
					var scrollTop = $(window).scrollTop();
					_this.setActiveOnePagerBullet(scrollTop);
					//_this.setOnePagerBulletSkin();
				});
			}

			/**
			 * Resize event
			 */
			$(window)
				.resize(function () {
					_this.winWidthElement();
					_this.fullHeightSection();

					if (!_this.videBgResizedOnLoad) {
						_this.videoBackground();
						_this.videBgResizedOnLoad = true;
					}

					_this.scrollDownArrowDisplay();
					_this.rowMargins();
				})
				.resize();

			$(window).on("wolf_core_resized", function () {
				_this.videoBackground();
			});
		},

		/**
		 * Check if IE
		 */
		isIE: function () {
			var ua = window.navigator.userAgent,
				msie = ua.indexOf("MSIE "),
				trident = ua.indexOf("Trident/");

			if (msie > 0) {
				return true;
			}

			if (trident > 0) {
				// IE 11 (or newer) => return version number
				return true;
			}

			// other browser
			return false;
		},

		setClasses: function () {
			if (this.supportSVG) {
				$("html").addClass("wolf-core-svg");
			}

			if (this.isTouch) {
				$("html").addClass("wolf-core-touch");
			} else {
				$("html").addClass("wolf-core-no-touch");
			}

			// if (this.isMobile) {
			// 	this.body.addClass("wolf-core-is-mobile");
			// } else {
			// 	this.body.addClass("wolf-core-is-desktop");
			// }

			if (
				(this.isMobile || 800 > $(window).width()) &&
				!WolfCoreJSParams.forceAnimationMobile
			) {
				this.body.addClass("wolf-core-no-animations");
			}

			if (this.isApple) {
				this.body.addClass("wolf-core-is-apple");
			}

			if (this.isEdge) {
				//this.body.addClass( 'wolf-core-is-edge' ); // done with PHP :)
			}
		},

		/**
		 * Set mask to animated divs that require one
		 */
		setAnimationMasks: function () {
			var animDelay = 0;

			$(".uncoverXLeft").each(function () {
				$(this).css({ "animation-delay": "" });
				$(this)
					.removeClass("wolf-core-wow uncoverXLeft")
					.append('<span class="wolf-core-animation-mask wolf-core-wow uncoverXLeft" />')
					.show();

				if ($(this).css("animation-delay")) {
					$(this).css({ "animation-delay": 0 });
					$(this)
						.find(".wolf-core-animation-mask")
						.css({ "animation-delay": animDelay + "ms" });
					animDelay = animDelay + 200;
				}
			});

			$(".uncoverXRight").each(function () {
				$(this).css({ "animation-delay": "" });
				$(this)
					.removeClass("wolf-core-wow uncoverXRight")
					.append('<span class="wolf-core-animation-mask wolf-core-wow uncoverXRight" />')
					.show();

				if ($(this).css("animation-delay")) {
					$(this).css({ "animation-delay": 0 });
					$(this)
						.find(".wolf-core-animation-mask")
						.css({ "animation-delay": animDelay + 200 + "ms" });
				}
			});

			$(".uncoverYTop").each(function () {
				$(this).css({ "animation-delay": "" });
				$(this)
					.removeClass("wolf-core-wow uncoverYTop")
					.append('<span class="wolf-core-animation-mask wolf-core-wow uncoverYTop" />')
					.show();

				if ($(this).css("animation-delay")) {
					$(this).css({ "animation-delay": 0 });
					$(this)
						.find(".wolf-core-animation-mask")
						.css({ "animation-delay": animDelay + 200 + "ms" });
				}
			});

			$(".uncoverYBottom").each(function () {
				$(this).css({ "animation-delay": "" });
				$(this)
					.removeClass("wolf-core-wow uncoverYBottom")
					.append('<span class="wolf-core-animation-mask wolf-core-wow uncoverYBottom" />')
					.show();

				if ($(this).css("animation-delay")) {
					$(this).css({ "animation-delay": 0 });
					$(this)
						.find(".wolf-core-animation-mask")
						.css({ "animation-delay": animDelay + 200 + "ms" });
				}
			});
		},

		/**
		 * Detect transition ending
		 */
		transitionEventEnd: function () {
			var t,
				el = document.createElement("transitionDetector"),
				transEndEventNames = {
					WebkitTransition: "webkitTransitionEnd", // Saf 6, Android Browser
					MozTransition: "transitionend", // only for FF < 15
					transition: "transitionend", // IE10, Opera, Chrome, FF 15+, Saf 7+
				};

			for (t in transEndEventNames) {
				if (el.style[t] !== undefined) {
					return transEndEventNames[t];
				}
			}
		},

		/**
		 * Detect animation ending
		 */
		animationEventEnd: function () {
			var t,
				el = document.createElement("animationDetector"),
				animations = {
					animation: "animationend",
					OAnimation: "oAnimationEnd",
					MozAnimation: "animationend",
					WebkitAnimation: "webkitAnimationEnd",
				};

			for (t in animations) {
				if (el.style[t] !== undefined) {
					return animations[t];
				}
			}
		},

		/**
		 * Get admin toolbar offset
		 */
		getToolBarOffset: function () {
			var scrollOffset = 0;

			if ($("body").is(".admin-bar")) {
				if (782 < $(window).width()) {
					scrollOffset = 32;
				} else {
					scrollOffset = 46;
				}
			}

			return parseInt(scrollOffset, 10);
		},

		/**
		 * Set element height to full screen
		 */
		fullHeightSection: function () {
			var _this = this,
				scrollOffset = _this.getToolBarOffset(),
				bleed = 0;

			if (
				$("body").hasClass("is-wpm-bar-player") &&
				WolfCoreJSParams.fullHeightRowDoWPMOffsset
			) {
				scrollOffset += $(".wpm-sticky-playlist-container").height();
			}

			$(".wolf-core-row-full-height, .fp-section").each(function () {
				$(this).css({
					"min-height": $(window).height() - scrollOffset + bleed,
				});
			});
		},

		winWidthElement: function () {
			$(".wolf-core-winwidth, .wolf-core-row-bigtext-marquee .wolf-core-element").each(
				function () {
					$(this).css({ width: $(window).width() });
				}
			);
		},

		/**
		 * rowMaring
		 */
		rowMargins: function () {
			if (800 < $(window).width()) {
				// Row gap
				$(".wolf-core-row").each(function () {
					var $row = $(this),
						gap = $row.data("column-gap"),
						columnBaseWidthInt,
						newWidth,
						gutter;

					//console.log( gap );

					if (
						"" !== gap &&
						"undefined" !== typeof gap &&
						$row.hasClass("wolf-core-row-layout-column")
					) {
						gutter = gap / 2;

						$row.find("> .wolf-core-row-wrapper > .wolf-core-row-content").css({
							width: "calc(100% + " + gap + "px )",
							"margin-left": -gutter,
						});

						$row
							.find(
								"> .wolf-core-row-wrapper > .wolf-core-row-content > .wolf-core-columns-container > .wolf-core-column"
							)
							.each(function () {
								columnBaseWidthInt = $(this).data("base-width-int");

								newWidth = (columnBaseWidthInt * 100) / 12;

								//console.log( newWidth );

								$(this).css({
									width: "calc(" + newWidth + "% - " + gap + "px)",
									"margin-left": gutter + "px",
									"margin-right": gutter + "px",
								});
							});
					}
				});

				// Inner Row Gap
				$(".wolf-core-row-inner").each(function () {
					var $row = $(this),
						gap = $row.data("column-gap"),
						columnBaseWidthInt,
						newWidth,
						gutter;

					if ("" !== gap) {
						gutter = gap / 2;

						$row.find("> .wolf-core-row-inner-wrapper > .wolf-core-row-inner-content").css({
							width: "calc(100% + " + gutter + "px )",
							"margin-left": -gutter / 2,
						});

						$row
							.find(
								"> .wolf-core-row-inner-wrapper > .wolf-core-row-inner-content > .wolf-core-column"
							)
							.each(function () {
								columnBaseWidthInt = $(this).data("base-width-int");
								newWidth = (columnBaseWidthInt * 100) / 12;

								$(this).css({
									width: "calc(" + newWidth + "% - " + gap + "px)",
									"margin-left": gutter + "px",
									"margin-right": gutter + "px",
								});
							});
					}
				});
			} else {
				$(".wolf-core-row-content, .wolf-core-row-inner-content, .wolf-core-column").css({
					width: "",
					"margin-left": "",
					"margin-right": "",
				});
			}
		},

		rowPostFeaturedImgBg : function () {

			$( '.wolf-core-row-post-featured-img-bg' ).each( function() {
				var bgUrl = $( this ).data( 'post-bg-image-url' );
				$( this ).css( {
					'background-image' : 'url(' + bgUrl + ')'
				} );
			} );
		},

		/**
		 * Row settings adjustment
		 */
		rowCosmetic: function () {
			// Add class to row if only one column
			$(".wolf-core-col-12").each(function () {
				var $col = $(this);

				if ($col.closest(".wolf-core-row").hasClass("wolf-core-parent-row")) {
					$col.closest(".wolf-core-row").addClass("wolf-core-row-one-column");
				}
			});

			// Force no equal height for blocks with a sticky column
			$(".wolf-core-stick-it.wolf-core-column-container")
				.parents(".wolf-core-row-layout-block")
				.addClass("wolf-core-no-equal-height");

			// Add class to 4 columns row
			$(".wolf-core-columns-container").each(function () {
				if (4 === $(this).find(".wolf-core-col-3").length) {
					$(this).addClass("wolf-core-columns-container-4-cols");
				} else if (6 === $(this).find(".wolf-core-col-2").length) {
					$(this).addClass("wolf-core-columns-container-6-cols");
				}
			});
		},

		/**
		 * Fluid Video wrapper
		 */
		fluidVideos: function (container) {
			container = container || $(".wolf-core-row");

			var videoSelectors = [
				'iframe[src*="player.vimeo.com"]',
				'iframe[src*="youtube.com"]',
				'iframe[src*="youtube-nocookie.com"]',
				'iframe[src*="youtu.be"]',
				'iframe[src*="kickstarter.com"]',
				'iframe[src*="screenr.com"]',
				'iframe[src*="blip.tv"]',
				'iframe[src*="dailymotion.com"]',
				'iframe[src*="viddler.com"]',
				'iframe[src*="qik.com"]',
				'iframe[src*="revision3.com"]',
				'iframe[src*="hulu.com"]',
				'iframe[src*="funnyordie.com"]',
				'iframe[src*="flickr.com"]',
				'embed[src*="v.wordpress.com"]',
				'iframe[src*="videopress.com"]',
			];

			container
				.find($(videoSelectors.join(",")).not(".wolf-core-vimeo-bg, .vimeo-bg"))
				.wrap('<span class="wolf-core-fluid-video" />');
			$(".rev_slider_wrapper").find(videoSelectors.join(",")).unwrap(); // disabled for revslider videos
			$(".elementor-wrapper").find(videoSelectors.join(",")).unwrap(); // disabled for revslider videos
			$(".wolf-core-fluid-video").parent().addClass("wolf-core-fluid-video-container");
		},

		/**
		 * Video Background
		 */
		videoBackground: function () {
			var _this = this;

			$(".wolf-core-video-bg-container").each(function () {
				var videoContainer = $(this),
					containerWidth = $(this).width(),
					containerHeight = $(this).height(),
					ratioWidth = 640,
					ratioHeight = 360,
					//ratio = ratioWidth/ratioHeight,
					$video = $(this).find(".wolf-core-video-bg"),
					//video = document.getElementById( $video.attr( 'id' ) ),
					newHeight,
					newWidth,
					newMarginLeft,
					newMarginTop,
					newCss;

				if (
					videoContainer.hasClass("wolf-core-youtube-video-bg-container") ||
					videoContainer.hasClass("wolf-core-vimeo-video-bg-container")
				) {
					$video = videoContainer.find("iframe");
					ratioWidth = 560;
					ratioHeight = 315;
				} else {
					//if ( _this.isMobile ) {
					// console.log( this.isTouch );
					//videoContainer.find( '.wolf-core-video-bg-fallback' ).css( { 'z-index' : 1 } );
					//$video.remove();
					//return;
					//} else {
					// Safari fix deprecated
					//$video.prop( 'muted', true );
					// setTimeout( function () {
					// 	$video.get(0).play();
					// }, 500 );
					//}
					return;
				}

				/* Landscape */
				if (containerWidth / containerHeight >= 1.8) {
					newWidth = containerWidth;

					// console.log( containerWidth / containerHeight );

					newHeight =
						Math.ceil((containerWidth / ratioWidth) * ratioHeight) + 2;
					newMarginTop = -(Math.ceil(newHeight - containerHeight) / 2);
					newMarginLeft = -(Math.ceil(newWidth - containerWidth) / 2);

					newCss = {
						width: newWidth,
						height: newHeight,
						marginTop: newMarginTop,
						marginLeft: newMarginLeft,
					};

					$video.css(newCss);

					/* Portrait */
				} else {
					newHeight = containerHeight;
					newWidth = Math.ceil((containerHeight / ratioHeight) * ratioWidth);
					newMarginLeft = -(Math.ceil(newWidth - containerWidth) / 2);

					newCss = {
						width: newWidth,
						height: newHeight,
						marginLeft: newMarginLeft,
						marginTop: 0,
					};

					$video.css(newCss);
				}
			});
		},

		/**
		 * Video play button
		 */
		playButton: function () {
			$(".wolf-core-video-bg-play-button").on("click", function () {
				var $button = $(this),
					$section = $button.parents(".wolf-core-section"),
					$video = $section.find(".wolf-core-video-bg"),
					videoId = $video.attr("id"),
					video = document.getElementById(videoId),
					videoSelector = $video;

				if (videoSelector.hasClass("paused")) {
					video.play();
					videoSelector.removeClass("paused");
					$button.removeClass("pause");
				} else {
					video.pause();
					videoSelector.addClass("paused");
					$button.addClass("pause");
				}
			});
		},

		/**
		 * Video mute button
		 */
		muteButton: function () {
			$(".wolf-core-bg-video-mute-equalizer").each(function () {
				$(this).html(
					'<div class="wolf-core-bg-video-mute-equalizer-bar-1 wolf-core-bg-video-mute-equalizer-bar"></div>\
				<div class="wolf-core-bg-video-mute-equalizer-bar-2 wolf-core-bg-video-mute-equalizer-bar"></div>\
				<div class="wolf-core-bg-video-mute-equalizer-bar-3 wolf-core-bg-video-mute-equalizer-bar"></div>\
				<div class="wolf-core-bg-video-mute-equalizer-bar-4 wolf-core-bg-video-mute-equalizer-bar"></div>'
				);
			});

			$(".wolf-core-row-video-bg-mute-button").on("click", function () {
				var $button = $(this),
					$row = $button.parents(".wolf-core-parent-row"),
					$video,
					video,
					YTPlayerId,
					VimeoPlayerId;

				if ($button.hasClass("wolf-core-row-v-bg-mute-sh")) {
					$video = $row.find(".wolf-core-video-bg");
					video = $video[0];

					if (video.muted) {
						video.muted = false;
					} else {
						video.muted = true;
					}

					$row.toggleClass("wolf-core-video-bg-is-unmute wolf-core-video-bg-is-mute");
				} else if ($button.hasClass("wolf-core-row-v-bg-mute-yt")) {
					($video = $row.find(".wolf-core-youtube-bg")),
						(YTPlayerId = $video.parent().data("yt-bg-element-id"));

					if ($row.hasClass("wolf-core-video-bg-is-mute")) {
						if ("undefined" !== typeof WolfCoreYTVideoBg) {
							WolfCoreYTVideoBg.players[YTPlayerId].unMute();
						}
					} else {
						if ("undefined" !== typeof WolfCoreYTVideoBg) {
							WolfCoreYTVideoBg.players[YTPlayerId].mute();
						}
					}

					$row.toggleClass("wolf-core-video-bg-is-unmute wolf-core-video-bg-is-mute");
				} else if ($button.hasClass("wolf-core-row-v-bg-mute-vimeo")) {
					$video = $row.find(".wolf-core-vimeo-bg");
					(video = $video[0]),
						(VimeoPlayerId = $video.data("vimeo-bg-element-id"));

					if ($row.hasClass("wolf-core-video-bg-is-mute")) {
						if ("undefined" !== typeof WolfCoreVimeo) {
							WolfCoreVimeo.players[VimeoPlayerId].setVolume(1);
						}
					} else {
						if ("undefined" !== typeof WolfCoreVimeo) {
							WolfCoreVimeo.players[VimeoPlayerId].setVolume(0);
						}
					}

					$row.toggleClass("wolf-core-video-bg-is-unmute wolf-core-video-bg-is-mute");
				}
			});
		},

		/**
		 * Use AOS plugin to reveal animation on page scroll (new)
		 */
		AOS: function (selector) {
			var wowAnimate,
				doWow =
					WolfCoreJSParams.forceAnimationMobile ||
					(!this.isMobile && 800 < $(window).width()),
				disable = !doWow;

			selector = selector || "#content";

			if ("undefined" !== typeof AOS) {

				$(selector)
					.find(".aos-disabled")
					.each(function () {
						//$( this ).removeClass( 'aos-disabled' );
					});

				AOS.init({
					//offset: 500,
					//delay: 1000
					disable: disable,
				});
			}
		},

		/**
		 * reset AOS
		 */
		resetAOS: function (selector) {
			selector = selector || "#content";

			$(selector)
				.find(".aos-animate")
				.each(function () {
					$(this).removeClass("aos-init aos-animate");
					$(this).addClass("aos-disabled");
				});
		},

		/**
		 * reinit AOS
		 */
		doAOS: function (selector) {
			//selector = selector || '#content';

			if ("undefined" !== typeof AOS) {
				//console.log( 'doAOS' );
				$(selector).find(".aos-disabled").removeClass("aos-disabled");
				AOS.refresh();
			}
		},

		/**
		 * Use Wow plugin to reveal animation on page scroll
		 */
		wowAnimate: function () {
			var wowAnimate,
				doWow =
					WolfCoreJSParams.forceAnimationMobile ||
					(!this.isMobile && 800 < $(window).width());

			//if ("undefined" !== typeof WOW && doWow) {
			if ("undefined" !== typeof WOW) {
				wowAnimate = new WOW({
					boxClass: "wolf-core-wow",
					offset: WolfCoreJSParams.WOWAnimationOffset,
				}); // init wow for CSS animation
				wowAnimate.init();
			}
		},

		/**
		 *  Parallax Background
		 */
		parallax: function () {
			var smallScreen =
				(800 > $(window).width() || this.isMobile) &&
				WolfCoreJSParams.parallaxNoSmallScreen;

			/*
			@todo
			https://github.com/nk-o/jarallax/#disable-on-mobile-devices
			*/

			if (!smallScreen && typeof jarallax !== "undefined") {
				$(".wolf-core-parallax").jarallax();
				$( '.wolf-core-video-parallax' ).jarallax();

				// $(".wolf-core-video-parallax").each(function () {
				// 	var videoStartTime = $(this).data("video-start-time") || 0,
				// 		videoEndTime = $(this).data("video-end-time") || 0;

				// 	$(this).find( '.elementor-background-video-container' ).jarallax({
				// 		videoStartTime: videoStartTime,
				// 		videoEndTime: videoEndTime,
				// 	});
				// });
			}
		},

		/**
		 *  Lightbox
		 */
		lightbox: function () {

			if ( typeof swipebox !== "undefined") {
				$(".wolf-core-lightbox:not(.wolf-core-disabled)").swipebox();
			}

			// add rel attribute for galleries
			$(".wolf-core-gallery .wolf-core-lightbox").each(function () {
				$(this).attr("rel", "gallery");
			});
		},

		/**
		 * Trick to customize the embed tweet
		 */
		loadTwitter: function () {
			var tweet = $(".twitter-tweet-rendered"),
				tweetItems = $(".post.is-tweet");

			setTimeout(function () {
				if (tweet.length) {
					tweet.each(function () {
						$(this)
							.removeAttr("style")
							.attr("height", "auto")
							.animate({ opacity: 1 });
					});
				}

				if (tweetItems.length) {
					tweetItems.each(function () {
						$(this).animate({ opacity: 1 });
					});
				}
			}, 500);
		},

		/**
		 * Instagrams fade in
		 */
		loadInstagram: function () {
			var instagramItems = $(".post-item.is-instagram");

			if (instagramItems.length) {
				instagramItems.each(function () {
					$(this).animate({ opacity: 1 });
				});
			}
		},

		/**
		 * Hide the scroll down arrow if height is too small
		 */
		scrollDownArrowDisplay: function () {
			var $arrow,
				$section,
				$sectionInner,
				sectionInnerHeight = 0,
				marginOffset = 250;

			$(".wolf-core-arrow-down").each(function () {
				($arrow = $(this)),
					($section = $arrow.parent()),
					($sectionInner = $section.find(".wolf-core-section-inner")),
					(sectionInnerHeight = 0);

				$sectionInner.find(".wolf-core-row").each(function () {
					sectionInnerHeight += $(this).height();
				});

				//console.log( 'innder ' + sectionInnerHeight );
				//console.log( 'win ' + $( window ).height() );

				if ($(window).height() <= sectionInnerHeight + marginOffset) {
					$arrow.hide();
				} else {
					$arrow.show();
				}
			});
		},

		/**
		 * Smooth scroll
		 */
		smoothScroll: function () {
			var _this = this;

			$(document).on(
				"click",
				".wolf-core-nav-scroll a, .wolf-core-scroll, .wolf-core-scroll a",
				function (event) {
					event.preventDefault();
					event.stopPropagation();

					var menuOffset = 0,
						toolBarOffset = _this.getToolBarOffset(),
						$this = $(this),
						href = $this.attr("href"),
						$targetSection,
						hash;

					if (href && href.indexOf("#") !== -1) {
						hash = href.substring(href.indexOf("#") + 1);

						$targetSection = $("#" + hash);

						if ($targetSection.hasClass("wolf-core-row-full-height")) {
							menuOffset = 0;

							//console.log( 'no offset' );
						} else {
							menuOffset = _this.getMenuOffsetFromTheme();

							//console.log( 'do offset' );
						}

						if ($targetSection.length) {
							$("body").addClass("wolf-core-scrolling");

							$("html, body")
								.stop()
								.animate(
									{
										scrollTop:
											$targetSection.offset().top - toolBarOffset - menuOffset,
									},
									parseInt(WolfCoreJSParams.smoothScrollSpeed, 10),
									WolfCoreJSParams.smoothScrollEase,
									function () {
										if ("" !== hash) {
											// push hash
											history.pushState(null, null, "#" + hash);
											//window.location.hash = hash;
										}

										setTimeout(function () {
											$("body").removeClass("wolf-core-scrolling");
											$(window).trigger("wolf_core_has_scrolled");
										}, 500);
									}
								);
						}
					}
				}
			);
		},

		/**
		 * Display an arrow to scroll to the next section
		 */
		scrollDownArrow: function () {
			var _this = this,
				$this,
				$arrow,
				rowClass = ".wolf-core-parent-row",
				$section = $(rowClass),
				$nextSection,
				$targetSection,
				menuOffset = 0,
				toolBarOffset = 0,
				sectionOffsetTop,
				hash;

			$section.each(function (i) {
				($this = $(this)),
					($arrow = $this.find(".wolf-core-arrow-down, .wolf-core-scroll-next-row")),
					($nextSection = $section.eq(i + 1)),
					(toolBarOffset = _this.getToolBarOffset());

				if ($arrow && 0 < $nextSection.length) {
					$this.addClass("wolf-core-has-next-section");

					$arrow.on("click", function (event) {
						event.preventDefault();
						event.stopPropagation();

						_this.scrollToNextSection($(this).closest(rowClass));
					});
				} else {
					$this.addClass("wolf-core-no-next-section");
				}
			});
		},

		/**
		 * Scroll to next section
		 */
		scrollToNextSection: function ($currentRow, callback) {

			var _this = this,
				sectionOffsetTop,
				toolBarOffset = this.getToolBarOffset(),
				callback = callback || function () {},
				menuOffset,
				hash,
				$targetSection;

			// Find next row in the DOM
			$targetSection = $(".wolf-core-parent-row").eq(
				$(".wolf-core-parent-row").index($currentRow) + 1
			);
			sectionOffsetTop = parseInt($targetSection.offset().top, 10);

			//console.log( $targetSection );

			if ($targetSection.hasClass("wolf-core-row-full-height")) {
				menuOffset = 0;

				// console.log( 'no offset' );
			} else {
				menuOffset = _this.getMenuOffsetFromTheme();

				// console.log( 'do offset' );
			}

			if ($targetSection.attr("id")) {
				hash = $targetSection.attr("id");
			}

			$("body").addClass("wolf-core-scrolling");

			$("html, body")
				.stop()
				.animate(
					{
						scrollTop: sectionOffsetTop - toolBarOffset - menuOffset,
					},
					parseInt(WolfCoreJSParams.smoothScrollSpeed, 10),
					WolfCoreJSParams.smoothScrollEase,
					function () {
						if ("" !== hash && "undefined" !== typeof hash) {
							// push hash
							history.pushState(null, null, "#" + hash);
							//window.location.hash = hash;
						}

						setTimeout(function () {
							$("body").removeClass("wolf-core-scrolling");
							$(window).trigger("wolf_core_has_scrolled");
						}, 500);

						callback();
					}
				);
		},

		/**
		 * Get menu offset from Theme if available
		 */
		getMenuOffsetFromTheme: function () {
			var menuOffset = 0;

			if ("undefined" !== typeof WolfFrameworkJSParams) {
				// if mobile
				if (
					WolfFrameworkJSParams.menuOffsetMobile &&
					$("body").hasClass("mobile")
				) {
					menuOffset = WolfFrameworkJSParams.menuOffsetMobile;

					// if tablet
				} else if (
					WolfFrameworkJSParams.menuOffsetBreakpoint &&
					!$("body").hasClass("desktop")
				) {
					menuOffset = WolfFrameworkJSParams.menuOffsetBreakpoint;

					// if desktop
				} else if (WolfFrameworkJSParams.menuOffsetDesktop) {
					menuOffset = WolfFrameworkJSParams.menuOffsetDesktop;

					// if default
				} else if (WolfFrameworkJSParams.menuOffset) {
					menuOffset = WolfFrameworkJSParams.menuOffset;
				}
			}

			// console.log( menuOffset );

			return parseInt(menuOffset, 10);
		},

		/**
		 * Set gallery rel attribute for HTML validation
		 */
		relGalleryAttr: function () {
			$(
				".wolf-images-gallery .wolf-core-image-inner, .wolf-core-item-price-image-container a"
			).each(function () {
				if ($(this).data("wolf-core-rel")) {
					$(this).attr("rel", $(this).data("wolf-core-rel"));
				}
			});
		},

		/**
		 * Google map fix to avoid scroll
		 */
		maps: function () {
			$(".wolf-core-map-container").click(function () {
				$(".wolf-core-map-container iframe").css("pointer-events", "auto");
			});

			$(".wolf-core-map-container").mouseleave(function () {
				$(".wolf-core-map-container iframe").css("pointer-events", "none");
			});
		},

		/**
		 * Lazy load gallery image
		 */
		lazyLoad: function () {
			$("img.wolf-core-lazy-hidden").lazyLoadXT();
		},

		/**
		 * Provide compatibility for browser unsupported features
		 */
		objectFitfallback: function () {
			if (this.isEdge && "undefined" !== typeof objectFitImages) {
				objectFitImages();
			}
		},

		/**
		 * One Pager
		 */
		onePager: function () {

			if ($("body").hasClass("wolf-core-one-pager")) {
			//if (1 === 1) {
				$("body").prepend('<div id="wolf-core-one-page-nav" />');

				var bulletClass = "wolf-core-scroll wolf-core-one-page-nav-bullet",
					onePageSelector = WolfCoreJSParams.onePageSelector || '.wolf-core-parent-row',
					i = 0;

				if (WolfCoreJSParams.fullPage) {
					bulletClass = "wolf-core-fp-nav wolf-core-one-page-nav-bullet";
				}

				$( onePageSelector + "[data-row-name]" ).each(function (index) {
					i++;

					var $row = $(this),
						id = $row.attr("id"),
						name = $row.data("row-name");

					if (id) {
						$("#wolf-core-one-page-nav").append(
							'<a data-index="' +
								i +
								'" class="' +
								bulletClass +
								'" href="#' +
								id +
								'"><span class="wolf-core-one-page-nav-bullet-tip">' +
								name +
								"</span></a>"
						);
					}
				});
			} else {
				//console.log( 'nope' );
				$("#wolf-core-one-page-nav").remove();
			}
		},

		/**
		 * Set active menu item
		 */
		setActiveOnePagerBullet: function (scrollTop) {
			if (WolfCoreJSParams.fullPage) {
				return;
			}

			var bulletItems = $("#wolf-core-one-page-nav a"),
				bulletItem,
				sectionOffset,
				threshold = 150,
				i;

			for (i = 0; i < bulletItems.length; i++) {
				bulletItem = $(bulletItems[i]);

				if ($(bulletItem.attr("href")).length) {
					sectionOffset = $(bulletItem.attr("href")).offset().top;

					//console.log( sectionOffset );

					if (
						scrollTop > sectionOffset - threshold &&
						scrollTop < sectionOffset + threshold
					) {
						bulletItems.removeClass("wolf-core-bullet-active");
						bulletItem.addClass("wolf-core-bullet-active");
					}
				}
			}
		},

		/**
		 * Set one page bullets skin
		 */
		setOnePagerBulletSkin: function () {
			if (
				!$("#wolf-core-one-page-nav").length ||
				$("body").hasClass("wolf-core-fullpage")
			) {
				return;
			}

			var $body = $("body");

			if ($(".wolf-core-row-visible").first().hasClass("wolf-core-font-dark")) {
				$body.addClass("page-nav-bullet-dark wolf-core-page-nav-bullet-dark");
			} else {
				$body.removeClass("page-nav-bullet-dark wolf-core-page-nav-bullet-dark");
			}
		},

		/**
		 * Stick element
		 */
		stickElement: function () {
			if (this.isMobile) {
				return;
			}

			if ($.isFunction($.fn.stick_in_parent) && !this.isMobile) {
				var _this = this,
					offset;

				$(".wolf-core-stick-it").each(function () {
					if ($(this).closest(".wolf-core-row").hasClass("wolf-core-row-layout-column")) {
						offset = 35 + _this.getToolBarOffset();
					} else {
						offset = _this.getToolBarOffset();
					}

					$(this).stick_in_parent({
						offset_top: offset,
						parent: ".wolf-core-row-content",
						spacer: ".wolf-core-column",
						bottoming: true,
						inner_scrolling: false,
					});
				});
			}
		},

		/**
		 * Reset sticky elements on resize
		 */
		stickElementResize: function () {
			var _this = this;

			if (this.isMobile) {
				return;
			}

			setTimeout(function () {
				$(window).on("resize", function () {
					if (800 < $(window).width()) {
						$(".wolf-core-stick-it").parent().attr("style", "");
						_this.stickElement();
						$(".wolf-core-stick-it").trigger("sticky_kit:recalc");
					} else {
						$(".wolf-core-stick-it").trigger("sticky_kit:detach");
						$(".wolf-core-stick-it").parent().attr("style", "");
					}
				});
			}, 1000);
		},

		/**
		 * Video Opener
		 */
		videoLightbox: function () {

			var selectors = ".wolf-core-video-opener, .wolf-core-video-opener-container a";

			if ("undefined" !== typeof lity) {
				$(document).on("click", ".wolf-core-video-opener, .wolf-core-video-opener-container a", lity);
			}
		},

		/**
		 * Pause other players when clicking on particular links
		 *
		 * Freeze every players
		 */
		pausePlayers: function (pauseAudio) {
			pauseAudio = typeof pauseAudio !== "undefined" ? pauseAudio : true;

			var iframe, player, YTPlayerId, VimeoPlayerId;

			/* Stop HTML video expect video bg */
			$("video:not(.wolf-core-video-bg):not(.video-bg)").trigger("pause");

			/* Stop YT iframe */
			$(".wolf-core-yt iframe").each(function () {
				this.contentWindow.postMessage(
					'{"event":"command","func":"' + "pauseVideo" + '", "args":""}',
					"*"
				);
			});

			/* Stop Vimeo iframe */
			$(".wolf-core-vimeo iframe").each(function () {
				//$f( this ).api( 'pause' );
				VimeoPlayerId = $(this).data("vimeo-bg-element-id");
				if (
					"undefined" !== typeof WolfCoreVimeo &&
					WolfCoreVimeo.players[VimeoPlayerId]
				) {
					WolfCoreVimeo.players[VimeoPlayerId].pause();
				}
			});

			/* Stop HTML5 BG */
			if ($(".wolf-core-video-bg").length) {
				$(".wolf-core-video-bg").each(function () {
					$(this).trigger("pause").addClass("wolf-core-vbg-paused");
				});
			}

			/* Stop YT BG */
			if ($(".wolf-core-youtube-bg").length) {
				$(".wolf-core-youtube-bg").each(function () {
					YTPlayerId = $(this).parent().data("yt-bg-element-id");
					if (
						"undefined" !== typeof WolfCoreYTVideoBg &&
						WolfCoreYTVideoBg.players[YTPlayerId]
					) {
						WolfCoreYTVideoBg.players[YTPlayerId].pauseVideo();
					}
				});
			}

			/* Stop Vimeo BG */
			if ($(".wolf-core-vimeo-bg").length) {
				$(".wolf-core-vimeo-bg").each(function () {
					//$f( $( this )[0] ).api( 'pause' );
					VimeoPlayerId = $(this).data("vimeo-bg-element-id");
					if (
						"undefined" !== typeof WolfCoreVimeo &&
						WolfCoreVimeo.players[VimeoPlayerId]
					) {
						WolfCoreVimeo.players[VimeoPlayerId].pause();
					}
				});
			}

			if (pauseAudio) {
				/* Pause all audio */
				$("audio:not(.nav-player)").trigger("pause");

				/* Album tracklist button class */
				$(".wolf-core-ati-play-button").removeClass("wolf-core-ati-track-playing");
			}

			/* Pause audio button anyway */
			$(".wolf-core-audio-button").each(function () {
				var defaultText = $(this).data("text");

				$(this).removeClass("wolf-core-audio-button-player-playing");
				$(this).find("span").html(defaultText);
			});
		},

		/**
		 * Restart video BG
		 */
		restartVideoBackgrounds: function () {
			/* HTML5 video */
			if ($(".wolf-core-video-bg").length) {
				$(".wolf-core-video-bg").each(function () {
					$(this).trigger("play").removeClass("wolf-core-vbg-paused");
				});
			}

			/* YT */
			if ($(".wolf-core-youtube-bg").length) {
				$(".wolf-core-youtube-bg").each(function () {
					if ("undefined" !== typeof WolfCoreYTVideoBg) {
						WolfCoreYTVideoBg.players[
							$(this).parent().data("yt-bg-element-id")
						].playVideo();
					}
				});
			}

			/* Vimeo BG */
			if ($(".wolf-core-vimeo-bg").length) {
				$(".wolf-core-vimeo-bg").each(function () {
					//$f( $( this )[0] ).api( 'play' );
					if ("undefined" !== typeof WolfCoreVimeo) {
						WolfCoreVimeo.players[$(this).data("vimeo-bg-element-id")].play();
					}
				});
			}
		},

		/**
		 * Pause other players when clicking on particular links
		 */
		pausePlayersButton: function () {
			var _this = this,
				selectors = ".wolf-core-embed-video-play-button";

			$(document).on("click", selectors, function () {
				_this.pausePlayers();
			});
		},

		/**
		 * Scroll down on mousewheel down for full height header
		 */
		scrollDownMousewheel: function () {
			if (this.isMobile) {
				return;
			}

			var _this = this;

			// $( '.wolf-core-row-mousewheel-scroll-down:first-child' ).each( function() {
			// 	$( this ).bind( 'mousewheel', function( e ) {
			// 		if ( e.originalEvent.wheelDelta / 120 <  0) {
			// 			_this.scrollToNextSection( $( this ) );
			// 		}
			// 	} );
			// } );

			$(".wolf-core-row-mousewheel-scroll-down:first-child").on(
				"mousewheel DOMMouseScroll",
				function (e) {
					//$( 'body' ).on( 'mousewheel DOMMouseScroll', function( e ) {
					if (
						typeof e.originalEvent.detail == "number" &&
						e.originalEvent.detail !== 0
					) {
						if (e.originalEvent.detail > 0) {
							//console.log('Down');
							_this.scrollToNextSection($(this));
						} else if (e.originalEvent.detail < 0) {
							//console.log('Up');
						}
					} else if (typeof e.originalEvent.wheelDelta == "number") {
						if (e.originalEvent.wheelDelta < 0) {
							//console.log('Down');
							_this.scrollToNextSection($(this));
						} else if (e.originalEvent.wheelDelta > 0) {
							//console.log('Up');
						}
					}
				}
			);

			// $( '.wolf-core-row-mousewheel-scroll-down:first-child' ).on( 'mousewheel', function(event) {
			// 	console.log(event.deltaX, event.deltaY, event.deltaFactor);

			// 	// if (  ) {
			// 		//_this.scrollToNextSection( $( this ) );
			// 	// }
			// } );
		},

		/**
		 * Unset animations
		 */
		delayWow: function (selector) {
			var doWow =
				WolfCoreJSParams.forceAnimationMobile ||
				(!this.isMobile && 800 < $(window).width());

			selector = selector || "#content";

			if (doWow) {
				$(selector).each(function () {
					$(selector)
						.find(
							".wolf-core-wow, .wow, .wolf-core-delayed-wow, .items .entry:not([data-aos])"
						)
						.each(function () {
							$(this)
								.removeClass("wolf-core-wow animated")
								.addClass("wolf-core-delayed-wow")
								.css({
									visibility: "hidden",
								});
						});
				});
			}
		},

		/**
		 * Reset Animations
		 */
		doWow: function () {
			var wowAnimate,
				doWow =
					WolfCoreJSParams.forceAnimationMobile ||
					(!this.isMobile && 800 < $(window).width());

			if ("undefined" !== typeof WOW && doWow) {
				wowAnimate = new WOW({
					boxClass: "wolf-core-delayed-wow",
					offset: WolfCoreJSParams.WOWAnimationOffset,
				}); // init wow for CSS animation
				wowAnimate.init();
			}
		},

		/**
		 * Function to fire on page load
		 */
		pageLoad: function () {
			this.loadInstagram();
			this.loadTwitter();

			window.dispatchEvent(new Event("scroll"));
			window.dispatchEvent(new Event("resize"));

			this.fullHeightSection();

			$("body").addClass("wolf-core-loaded");

			if (this.fireAnimation) {
				this.setVisibleRowClass();
				this.wowAnimate();
				this.AOS();
			}
		},

		twitterToX : function() {
			var svg = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>';
			$( '.fa-x, .fa-twitter' ).each( function() {
				$( this ).append( svg ).css( 'fill', 'currentColor' );
			} );
		},

		/**
		 * Add resized event
		 */
		addResizedEvent: function () {
			var resizeTimer = 0;

			$(window)
				.resize(function () {
					clearTimeout(resizeTimer);
					resizeTimer = setTimeout(function () {
						$(window).trigger("wolf_core_resized");
					}, 750);
				})
				.resize();
		},

		/**
		 * Set visible row class
		 */
		setVisibleRowClass: function () {

			$(".wolf-core-elementor-row").on("inview", function (event, isInView) {
				if (isInView && !$(this).parent().hasClass("wolf-core-modal-window") && ! $( this ).find( ".elementor-inner-section" ).length ) {

					$(this).addClass("wolf-core-row-visible");
					$(this).addClass("wolf-core-row-appeared");

				} else {
					$(this).removeClass("wolf-core-row-visible");
				}
			});

			$(".elementor-inner-section").on("inview", function (event, isInView) {
				if ( isInView ) {

					$(this).addClass("wolf-core-row-visible");
					$(this).addClass("wolf-core-row-appeared");

				} else {
					$(this).removeClass("wolf-core-row-visible");
				}
			});
		},

		smoothScrollAccordionQuickFix : function () {
			// Target all Elementor accordion items
			var $accordionItems = $('.e-n-accordion-item-title, .wcs-timetable__agenda-nav-item');

			// Listen for click events on accordion titles
			$accordionItems.on('click', function() {
				// Small delay to ensure panel is fully opened
				setTimeout(function() {
					// Trigger window resize event

					console.log( "resize" );
					$(window).trigger('resize');
					window.dispatchEvent(new Event('resize'));
					// If you have any specific components that need resizing
					// you can also trigger custom events for them here
				}, 1000); // Adjust timeout as needed
			});
		},

		/**
		 * AJAX Callback
		 *
		 * Reinitiate all plugins.
		 * This function can be called after an AJAX request to restore all JS functionality
		 */
		ajaxCallback: function () {
			this.init();
			this.fullHeightSection();
			this.onePager();

			//this.rowCosmetic();
			//this.rowMargins();

			// Responsive
			if ("undefined" !== typeof WVCResponsive) {
				WolfCoreResponsive.init();
			}

			// YouTube
			if ("undefined" !== typeof WolfCoreYTVideoBg) {
				WolfCoreYTVideoBg.init();
			}

			// Vimeo
			if ("undefined" !== typeof WolfCoreVimeo) {
				WolfCoreVimeo.init();
			}

			// FitText
			if ("undefined" !== typeof WolfCoreFitText) {
				WolfCoreFitText.init();
			}

			// FullPage
			if ("undefined" !== typeof WolfCoreFullPage) {
				WolfCoreFullPage.init();
			}

			// BigText
			if ("undefined" !== typeof WolfCoreBigText) {
				WolfCoreBigText.init();
			}

			// Sliders
			if ("undefined" !== typeof WolfCoreSliders) {
				WolfCoreSliders.init();
			}

			// Accordion
			if ("undefined" !== typeof WolfCoreAccordion) {
				WolfCoreAccordion.init();
			}

			// Tabs
			if ("undefined" !== typeof WolfCoreTabs) {
				WolfCoreTabs.init();
			}

			// Toggles
			if ("undefined" !== typeof WolfCoreToggles) {
				WolfCoreToggles.init();
			}

			// Buttons and calls to action
			if ("undefined" !== typeof WolfCoreButtons) {
				WolfCoreButtons.init();
			}

			// Counter
			if ("undefined" !== typeof WolfCoreCounter) {
				WolfCoreCounter.init();
			}

			// Mailchimp
			if ("undefined" !== typeof WolfCoreMailchimp) {
				WolfCoreMailchimp.init();
			}

			// Typed
			if ("undefined" !== typeof WolfCoreTyped) {
				WolfCoreTyped.init();
			}

			// Count down
			if ("undefined" !== typeof WolfCoreCountdown) {
				WolfCoreCountdown.init();
				$(".wolf-core-countdown-container").addClass(
					"wolf-core-countdown-container-loaded"
				);
			}

			// Carousels
			if ("undefined" !== typeof WolfCoreCarousels) {
				WolfCoreCarousels.init();
			}

			// Cocoen
			if ("undefined" !== typeof WolfCoreTwentyTwenty) {
				WolfCoreTwentyTwenty.init();
			}

			// Message
			if ("undefined" !== typeof WolfCoreMessage) {
				WolfCoreMessage.init();
			}

			// Vivus
			if ("undefined" !== typeof WolfCoreVivus) {
				WolfCoreVivus.init();
			}

			// Particles
			if ("undefined" !== typeof WolfCoreParticles) {
				WolfCoreParticles.init();
			}

			// Gmaps
			if ("undefined" !== typeof WolfCoreGmaps) {
				WolfCoreGmaps.init();
			}

			// Pie
			if ("undefined" !== typeof WolfCorePie) {
				WolfCorePie.init();
			}

			// ProgressBar
			if ("undefined" !== typeof WolfCoreProgressBar) {
				WolfCoreProgressBar.init();
			}

			// Process
			if ("undefined" !== typeof WolfCoreProcess) {
				WolfCoreProcess.init();
			}

			// InteractiveLinks
			if ("undefined" !== typeof WolfCoreInteractiveLinks) {
				WolfCoreInteractiveLinks.init();
			}

			// InteractiveOverlays
			if ("undefined" !== typeof WolfCoreInteractiveOverlays) {
				WolfCoreInteractiveOverlays.init();
			}

			// Embed Video
			if ("undefined" !== typeof WolfCoreEmbedVideo) {
				WolfCoreEmbedVideo.init();
			}

			// Galleries
			if ("undefined" !== typeof WolfCoreGalleries) {
				WolfCoreGalleries.init();
			}

			// Album tracklist
			if ("undefined" !== typeof WolfCoreAlbumTracklist) {
				WolfCoreAlbumTracklist.init();
			}

			// Audio button
			if ("undefined" !== typeof WolfCoreAudioButton) {
				WolfCoreAudioButton.init();
			}

			// Showcase vertical carousel
			if ("undefined" !== typeof WolfCoreShowaseVerticalCarousel) {
				WolfCoreShowaseVerticalCarousel.init();
			}

			// BMIC
			if ("undefined" !== typeof WolfCoreBMIC) {
				WolfCoreBMIC.init();
			}

			// Loginform
			if ("undefined" !== typeof WolfCoreLoginForm) {
				WolfCoreLoginForm.init();
			}

			// ModalWindow
			if ("undefined" !== typeof WolfCoreModalWindow) {
				WolfCoreModalWindow.init();
			}

			// PrivacyPolicyMessage
			if ("undefined" !== typeof WolfCorePrivacyPolicyMessage) {
				WolfCorePrivacyPolicyMessage.init();
			}

			// Print
			if ("undefined" !== typeof WolfCorePrint) {
				WolfCorePrint.init();
			}
		},
	};
})(jQuery);

(function ($) {
	"use strict";

	$(document).ready(function () {
		WolfCore.init();
	});

	$(window).load(function () {
		WolfCore.pageLoad();
	});
})(jQuery);
