import sendRequest from '../../../helpers/ajax.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const form = document.querySelector( '.profile-password' );

	if ( ! form ) {
		return;
	}

	const button = form.querySelector( '.profile-password__btn' );

	button.addEventListener( 'click', () => {
		sendRequest( button, 'yar_profile_update_password', ( result ) => {
			if ( result.success === true ){
				window.location = '/login/';
			}
		} );
	} );
} );
