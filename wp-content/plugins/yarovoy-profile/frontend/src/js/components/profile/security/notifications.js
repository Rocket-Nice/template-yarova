import sendRequest from '../../../helpers/ajax.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const form = document.querySelector( '.profile-notifications' );

	if ( ! form ) {
		return;
	}

	const button = form.querySelector( '.profile-notifications__btn' );

	button.addEventListener( 'click', () => {
		sendRequest( button, 'yar_expert_update_notifications' );
	} );
} );
