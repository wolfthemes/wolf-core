module.exports = {

	lib: {

		options : {
			//banner : '/*! <%= app.name %> Wordpress Plugin v<%= app.version %> */ \n'
			//preserveComments : 'some'
		},

		files: {
			'<%= app.jsPath %>/lib/parallax.min.js': [ '<%= app.jsPath %>/lib/parallax.js'],
			//'<%= app.jsPath %>/lib/jarallax.min.js': [ '<%= app.jsPath %>/lib/jarallax.js'],
			'<%= app.jsPath %>/lib/jquery.parallax-scroll.min.js': [ '<%= app.jsPath %>/lib/jquery.parallax-scroll.js'],
			'<%= app.jsPath %>/lib/jquery.fittext.min.js': [ '<%= app.jsPath %>/lib/jquery.fittext.js'],
			'<%= app.jsPath %>/lib/jquery.flexslider.min.js': [ '<%= app.jsPath %>/lib/jquery.flexslider.js'],
			'<%= app.jsPath %>/lib/jquery.bigtext.min.js': [ '<%= app.jsPath %>/lib/bigtext.js'],
			'<%= app.jsPath %>/lib/jquery.event.move.min.js': [ '<%= app.jsPath %>/lib/jquery.event.move.js'],
			'<%= app.jsPath %>/lib/scrolloverflow.min.js': [ '<%= app.jsPath %>/lib/scrolloverflow.js'],
			'<%= app.jsPath %>/lib/jquery.twentytwenty.min.js': [ '<%= app.jsPath %>/lib/jquery.twentytwenty.js'],
			'<%= app.jsPath %>/lib/player.min.js': [ '<%= app.jsPath %>/lib/player.js'],
		}
	},

	files: {

		options : {
			//banner : '/*! <%= app.name %> Wordpress Plugin v<%= app.version %> */ \n'
			//preserveComments : 'some'
		},

		files: {
			'<%= app.jsPath %>/min/responsive.min.js': [ '<%= app.jsPath %>/responsive.js'],
			'<%= app.jsPath %>/min/bigtext.min.js': [ '<%= app.jsPath %>/bigtext.js'],
			'<%= app.jsPath %>/min/fittext.min.js': [ '<%= app.jsPath %>/fittext.js'],
			'<%= app.jsPath %>/min/accordion.min.js': [ '<%= app.jsPath %>/accordion.js'],
			'<%= app.jsPath %>/min/audio-button.min.js': [ '<%= app.jsPath %>/audio-button.js'],
			'<%= app.jsPath %>/min/autotyping.min.js': [ '<%= app.jsPath %>/autotyping.js'],
			'<%= app.jsPath %>/min/sliders.min.js': [ '<%= app.jsPath %>/sliders.js'],
			'<%= app.jsPath %>/min/advanced-slider.min.js': [ '<%= app.jsPath %>/advanced-slider.js'],
			'<%= app.jsPath %>/min/anything-slider.min.js': [ '<%= app.jsPath %>/anything-slider.js'],
			'<%= app.jsPath %>/min/carousels.min.js': [ '<%= app.jsPath %>/carousels.js'],
			'<%= app.jsPath %>/min/mailchimp.min.js': [ '<%= app.jsPath %>/mailchimp.js'],
			'<%= app.jsPath %>/min/twentytwenty.min.js': [ '<%= app.jsPath %>/twentytwenty.js'],
			'<%= app.jsPath %>/min/countdown.min.js': [ '<%= app.jsPath %>/countdown.js'],
			'<%= app.jsPath %>/min/counter.min.js': [ '<%= app.jsPath %>/counter.js'],
			'<%= app.jsPath %>/min/tabs.min.js': [ '<%= app.jsPath %>/tabs.js'],
			'<%= app.jsPath %>/min/toggles.min.js': [ '<%= app.jsPath %>/toggles.js'],
			'<%= app.jsPath %>/min/YT-video-bg.min.js': [ '<%= app.jsPath %>/YT-video-bg.js'],
			'<%= app.jsPath %>/min/vimeo.min.js': [ '<%= app.jsPath %>/vimeo.js'],
			'<%= app.jsPath %>/min/message.min.js': [ '<%= app.jsPath %>/message.js'],
			'<%= app.jsPath %>/min/vivus.min.js': [ '<%= app.jsPath %>/vivus.js'],
			'<%= app.jsPath %>/min/particles.min.js': [ '<%= app.jsPath %>/particles.js'],
			'<%= app.jsPath %>/min/gmaps.min.js': [ '<%= app.jsPath %>/gmaps.js'],
			'<%= app.jsPath %>/min/google-maps.min.js': [ '<%= app.jsPath %>/google-maps.js'],
			'<%= app.jsPath %>/min/progress-bar.min.js': [ '<%= app.jsPath %>/progress-bar.js'],
			'<%= app.jsPath %>/min/process.min.js': [ '<%= app.jsPath %>/process.js'],
			'<%= app.jsPath %>/min/embed-video.min.js': [ '<%= app.jsPath %>/embed-video.js'],
			'<%= app.jsPath %>/min/galleries.min.js': [ '<%= app.jsPath %>/galleries.js'],
			'<%= app.jsPath %>/min/album-tracklist.min.js': [ '<%= app.jsPath %>/album-tracklist.js'],
			'<%= app.jsPath %>/min/interactive-links.min.js': [ '<%= app.jsPath %>/interactive-links.js'],
			'<%= app.jsPath %>/min/interactive-overlays.min.js': [ '<%= app.jsPath %>/interactive-overlays.js'],
			'<%= app.jsPath %>/min/video-switcher.min.js': [ '<%= app.jsPath %>/video-switcher.js'],
			'<%= app.jsPath %>/min/fullpage.min.js': [ '<%= app.jsPath %>/fullpage.js'],
			'<%= app.jsPath %>/min/pie.min.js': [ '<%= app.jsPath %>/pie.js'],
			'<%= app.jsPath %>/min/loginform.min.js': [ '<%= app.jsPath %>/loginform.js'],
			'<%= app.jsPath %>/min/modal-window.min.js': [ '<%= app.jsPath %>/modal-window.js'],
			'<%= app.jsPath %>/min/privacy-policy-message.min.js': [ '<%= app.jsPath %>/privacy-policy-message.js'],
			'<%= app.jsPath %>/min/showcase-vertical-carousel.min.js': [ '<%= app.jsPath %>/showcase-vertical-carousel.js'],
			'<%= app.jsPath %>/min/bmic.min.js': [ '<%= app.jsPath %>/bmic.js'],
			'<%= app.jsPath %>/min/print.min.js': [ '<%= app.jsPath %>/print.js'],
			'<%= app.jsPath %>/min/functions.min.js': [ '<%= app.jsPath %>/functions.js']
		}
	},

	concatLib: {
		options : {
			banner : '/*! <%= app.name %> libraries Wordpress Plugin v<%= app.version %> */ \n',
			//preserveComments : 'some'
		},

		files: {

			'<%= app.jsPath %>/min/lib.min.js': [
				'<%= app.jsPath %>/lib/bigtext.js',
				'<%= app.jsPath %>/lib/jquery.event.move.min.js',
				'<%= app.jsPath %>/lib/jquery.twentytwenty.min.js',
				'<%= app.jsPath %>/lib/jquery.countdown.min.js',
				'<%= app.jsPath %>/lib/countUp.min.js',
				'<%= app.jsPath %>/lib/jquery.fittext.js',
				'<%= app.jsPath %>/lib/flickity.pkgd.min.js',
				'<%= app.jsPath %>/lib/typed.min.js',
				'<%= app.jsPath %>/lib/wow.min.js',
				'<%= app.jsPath %>/lib/aos.js',
				'<%= app.jsPath %>/lib/lity.min.js',
				'<%= app.jsPath %>/lib/vivus.min.js',
				'<%= app.jsPath %>/lib/froogaloop.js',
				'<%= app.jsPath %>/lib/player.js',
				'<%= app.jsPath %>/lib/scrolloverflow.js',
				'<%= app.jsPath %>/lib/jquery.fullpage.min.js',
				'<%= app.jsPath %>/lib/jquery.easypiechart.min.js',
				'<%= app.jsPath %>/lib/jquery.fullpage.extensions.min.js',
				'<%= app.jsPath %>/lib/jquery.mousewheel.min.js',
				'<%= app.jsPath %>/lib/jquery.inview.min.js',
				'<%= app.jsPath %>/lib/jQuery.print.js',
			],
		}
	},

	concat: {

		options : {
			banner : '/*! <%= app.name %> Wordpress Plugin v<%= app.version %> */ \n'
			// preserveComments : 'some'
		},

		files: {

			'<%= app.jsPath %>/min/scripts.min.js': [
				'<%= app.jsPath %>/responsive.js',
				'<%= app.jsPath %>/bigtext.js',
				'<%= app.jsPath %>/fittext.js',
				'<%= app.jsPath %>/accordion.js',
				'<%= app.jsPath %>/audio-button.js',
				'<%= app.jsPath %>/autotyping.js',
				'<%= app.jsPath %>/advanced-slider.js',
				'<%= app.jsPath %>/anything-slider.js',
				'<%= app.jsPath %>/buttons.js',
				'<%= app.jsPath %>/carousels.js',
				'<%= app.jsPath %>/twentytwenty.js',
				'<%= app.jsPath %>/countdown.js',
				'<%= app.jsPath %>/counter.js', // new
				'<%= app.jsPath %>/icons.js',
				'<%= app.jsPath %>/pie.js',
				//'<%= app.jsPath %>/mailchimp.js', // need JS global var so need to be enqueued separately
				'<%= app.jsPath %>/sliders.js',
				'<%= app.jsPath %>/tabs.js',
				'<%= app.jsPath %>/toggles.js',
				'<%= app.jsPath %>/youtube.js',
				'<%= app.jsPath %>/YT-video-bg.js',
				'<%= app.jsPath %>/message.js',
				'<%= app.jsPath %>/vivus.js',
				'<%= app.jsPath %>/particles.js',
				'<%= app.jsPath %>/gmaps.js',
				'<%= app.jsPath %>/google-maps.js',
				'<%= app.jsPath %>/progress-bar.js',
				'<%= app.jsPath %>/process.js',
				'<%= app.jsPath %>/embed-video.js',
				'<%= app.jsPath %>/galleries.js',
				'<%= app.jsPath %>/album-tracklist.js',
				'<%= app.jsPath %>/interactive-links.js',
				'<%= app.jsPath %>/interactive-overlays.js',
				'<%= app.jsPath %>/video-switcher.js',
				'<%= app.jsPath %>/showcase-vertical-carousel.js',
				'<%= app.jsPath %>/bmic.js',
				'<%= app.jsPath %>/print.js',
				'<%= app.jsPath %>/loginform.js',
				'<%= app.jsPath %>/modal-window.js',
				'<%= app.jsPath %>/privacy-policy-message.js',
				'<%= app.jsPath %>/fullpage.js',
				'<%= app.jsPath %>/functions.js'
			],
		}
	},

	build: {

		options : {
			banner : '/*! <%= app.name %> Wordpress Plugin v<%= app.version %> */ \n'
			// preserveComments : 'some'
		},

		files: {

			'<%= app.jsPath %>/min/app.min.js': [
			//	'<%= app.jsPath %>/lib/jquery.swipebox.min.js',
				//'<%= app.jsPath %>/lib/jquery.haParallax.min.js',
				'<%= app.jsPath %>/lib/wow.min.js',
				'<%= app.jsPath %>/lib/waypoints.min.js',
				'<%= app.jsPath %>/lib/YT-video-bg.js',
				'<%= app.jsPath %>/lib/functions.js'
			],
		}
	}
};