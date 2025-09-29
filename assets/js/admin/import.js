jQuery( document ).ready( function( $ ) {

	$( '.wolf-core-notice .btn-get-ocdi' ).on( 'click', function( e ) {
		e.preventDefault();
		var $btn = $( this );

		$btn.addClass( 'updating-message' ).text( wolfCoreImportPlugins.installingPluginsMessage );

		console.log( "Installing..." );


		installPlugins(Object.entries(wolfCoreImportPlugins.requiredPlugins));
	} );

	function installPlugins(plugins) {

		//var plugins = Object.entries(wolfCoreImportPlugins.requiredPlugins) || plugins;

		if (plugins.length > 0) {
			// pop function remove the last entry from the arraay
			let current = plugins.pop(); // return the removed entry
			// pop returns rentry like ['slug', 'url']

	        $.ajax({
	            type    : 'POST',
				url     : ajaxurl,
				data    : {
					action   : 'import_external_plugin',
					slug   : current[0],
					security : wolfCoreImportPlugins.installNonce,
				},
				success : function( response ) {
					console.log( response );

					if ( 0 === plugins.length ) {
						$( '.wolf-core-install-import-plugin-btn' ).text( wolfCoreImportPlugins.activatingPluginsMessage );
						console.log( "Activating..." );
						activatePlugins(Object.entries(wolfCoreImportPlugins.requiredPlugins));
					}
				},
				error   : function( xhr, ajaxOptions, thrownError ){
					console.log(thrownError);
				}
	        })
	        .done(function (result) {
	            installPlugins(plugins);
	        });
	    }
	}

	// Recursive function so the plugins are activated one by one
	function activatePlugins(plugins) {
		//var plugins = Object.entries(wolfCoreImportPlugins.requiredPlugins) || plugins;
		if (plugins.length > 0) {
			// pop functino remove the last entry from the arraay
			let current = plugins.pop(); // return the removed entry
			// pop returns rentry like ['slug', 'path']
			//return;
	        $.ajax({
	            type    : "POST",
				url     : ajaxurl,
				data    : {
					action   : 'activate_all_plugins',
					slug   : current[0],
					security : wolfCoreImportPlugins.activateNonce,
				},

				success : function( response ) {
					console.log( response );

					if ( 0 === plugins.length ) {
						$( '.wolf-core-install-import-plugin-btn' ).text( wolfCoreImportPlugins.redirectingMessage );
						dismiss_and_redirect();
					}
				},
				error   : function( xhr, ajaxOptions, thrownError ){
					console.log(thrownError);
				}
	        })
	        .done(function (result) {
	            activatePlugins(plugins);
	        });
	    }
	}

	function dismiss_and_redirect() {

		//console.log('redirecting');
		//return;
		$.ajax( {
			type:'POST',
			url: ajaxurl,
			data: {
				action: 'plugin_install_dismiss_notice',
				security: wolfCoreImportPlugins.dismissNonce
			},
			success : function( response ) {
				console.log('Redirecting...');
				setTimeout( function() {
					window.location.href = wolfCoreImportPlugins.redirectUrl;
				}, 1000 );
			},
			error: function( xhr, ajaxOptions, thrownError ){
				console.log(thrownError);
			}
		} )
	}

	$( '.btn-get-ocdi-discard' ).on( 'click', function ( e ) {
		e.preventDefault();
		$.ajax( {
			type:'POST',
			url: ajaxurl,
			data: {
				action: 'plugin_install_dismiss_notice',
				security: wolfCoreImportPlugins.dismissNonce
			},
			success : function( response ) {
				//console.log( response );
				window.location.href = wolfCoreImportPlugins.adminUrl;
			},
			error: function( xhr, ajaxOptions, thrownError ){
				console.log(thrownError);
			}
		} )
	} );
} );
