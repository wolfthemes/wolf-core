jQuery( document ).ready( function( $ ) {
	$( '.wolf-core-update-db-btn' ).on( 'click', function( e ) {
		e.preventDefault();
		var $btn = $( this );

		$btn.addClass( 'updating-message' ).text( WolfCoreAdminParams.updatingDBMessage );
		console.log( "Updating..." );

		updateDB();
	} );

	var updateDBTimeout;
	var continueLoop = true;

	function updateDB() {

		if ( ! continueLoop ) {
			return;
		}

		$.ajax({
            type    : 'POST',
			url     : ajaxurl,
			async: false,
			data    : {
				action   : 'wolf_core_update_db',
				security : WolfCoreAdminParams.updatingDBNonce,
			},
			success : function( response ) {

				console.log( response );

				if ( 'OK' === response ) {

					console.log( "stop" );
					continueLoop = false;

					updateDone();

				} else {
					//console.log( "continue" );
					updateDBTimeout = setTimeout(function(){
						updateDB();
					}, 1000);
				}
			},
			complete: function( response ){


            },
			error   : function( xhr, ajaxOptions, thrownError ){
				console.log(thrownError);
			}
		});
	}

	function updateDone() {
		console.log('Finalizing...');

		setTimeout( function() {
			$( '.wolf-core-update-db-btn' ).text( WolfCoreAdminParams.updatingDBRedirectingMessage );
			window.location.href = WolfCoreAdminParams.updatingDBRedirectURL;
		}, 1000 );
	}

} );
