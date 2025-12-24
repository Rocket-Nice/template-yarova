import getData from './get-data.js';
import Errors from './errors.js';

const openPopupMessage = ( result ) => {
	const popup = document.querySelector( '#popup-message' );
	const popupData = result.data.popup;
	if ( popup ) {
		const popupTitle = popup.querySelector( '.popup-message__title' );
		const popupText = popup.querySelector( '.popup-message__text' );

		popup.classList.remove( '_error' );

		popupTitle.innerHTML = '';
		popupText.innerHTML = '';

		if ( popupData.title ) {
			popupTitle.innerHTML = popupData.title;
		}

		if ( popupData.message ) {
			popupText.innerHTML = popupData.message;
		}

		if ( result.success === false ) {
			popup.classList.add( '_error' );
		}

		// TODO: Заменить функционал на чистый JS
		if ( window.openPopup !== undefined ){
			window.openPopup( 'popup-message' );
		}
	}
};

export default function request( button, action, callback = '', data = {}, type = 'json' ) {
	let form;

	if ( Object.keys( data ).length === 0 ){
		form = button.closest( '.form' );
	}

	const errors = new Errors( form );
	if ( form ) {
		errors.remove();
		errors.hideMessage();
	}

	data = getData( form, data );
	if ( ! data ){
		return;
	}

	data.append( 'action', action );

	if ( form ) {
		form.classList.add( '_loading' );
	}

	button.classList.add( '_active' );
	button.disabled = true;

	fetch( '/wp-admin/admin-ajax.php', {
		method: "POST",
		body: data,
	} )
	.then( response => {
		if ( type === 'html' ) {
			return response.text();
		} else {
			return response.json();
		}
	} )
	.then( ( result ) => {
		if ( type === 'json' ) {
			if ( result.success === true ) {

			} else {
				if ( result.data && result.data.errors ) {
					errors.add( result.data.errors );
				}

				if ( result.data ){
					errors.addMessage( result.data.message ? result.data.message : '' );
				}
			}

			if ( result.data && result.data.popup ){
				openPopupMessage( result );
			}

			if ( typeof ( callback ) == 'function' ) {
				callback( result );
			}
		}

		button.classList.remove( '_active' );
		button.disabled = false;

		if ( form ) {
			form.classList.remove( '_loading' );
		}
	} );
}
