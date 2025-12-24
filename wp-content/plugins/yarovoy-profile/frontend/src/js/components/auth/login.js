import request from '../../helpers/ajax.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const loginButton = document.querySelector( '.login__form-btn' );

	if ( ! loginButton ) {
		return;
	}

	loginButton.addEventListener( 'click', () => {
		request( loginButton, 'yar_profile_login', ( result ) => {
			if ( result.success === true && result.data.redirect ){
				window.location = result.data.redirect;
			}
		} );
	} );
} );
