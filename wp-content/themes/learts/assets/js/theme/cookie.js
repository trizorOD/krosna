(
	function( $ ) {
		"use strict";

		learts.cookie = function() {

			if ( Cookies.get( 'learts_cookie_notice_accepted' ) == 'yes' ) {
				return;
			}

			var $cookieWrapper = $( '.cookie-wrapper' ),
				expires        = parseInt( $cookieWrapper.attr( 'data-expires' ) );

			setTimeout( function() {

				$cookieWrapper.addClass( 'animated fadeInUp' );

				$cookieWrapper.on( 'click', '.cookie-accept-btn', function( e ) {

					e.preventDefault();
					$cookieWrapper.removeClass( 'fadeInUp' ).addClass( 'fadeOutDown' );
					acceptCookie( expires );
				} );
			}, 500 );

			var acceptCookie = function( expires ) {
				Cookies.set( 'learts_cookie_notice_accepted', 'yes', {
					expires: expires,
					path   : '/'
				} );
			};
		};
	}
)( jQuery );
