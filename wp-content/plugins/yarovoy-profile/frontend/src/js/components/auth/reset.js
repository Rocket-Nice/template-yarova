import sendRequest from '../../helpers/ajax.js';
import startTimer from "../../helpers/code-timer.js";

window.addEventListener( 'DOMContentLoaded', () => {
	const appendModal = ( modal ) => {
		const old = document.querySelector( '#popup-code' );
		if ( old ) {
			old.remove();
		}

		document.querySelector( 'body' ).innerHTML += modal;
		if ( window.openPopup !== undefined ){
			window.openPopup( 'popup-code' );

			initRepeat();

			const confirmCodeButton = document.querySelector( '.popup-code__btn' );
			if ( confirmCodeButton ){
				confirmCodeButton.addEventListener( 'click', confirm );
			}
		}
	}

	const initRepeat = () => {
		const display = document.querySelector( '.input__timer' );
		if ( display ){
			startTimer( 60, display, () => {
				repeat();
			} );
		}
	}

	const repeat = () => {
		const repeatButton = document.querySelector( '.code__repeat button' );;

		if ( ! repeatButton ) {
			return;
		}

		repeatButton.addEventListener( 'click', () => {
			sendRequest( repeatButton, 'yar_profile_reset_password_repeat', ( result ) => {
				if ( result.success === true ) {
					initRepeat();
				}
			} );
		} );
	}

	const confirm = ( event ) => {
		sendRequest( event.currentTarget, 'yar_profile_reset_password_confirm', ( result ) => {
			if ( result.success === true ) {
				if ( result.data && result.data.key ){
					window.location = '/forgot?key=' + result.data.key;
				}
			}
		} );
	}

	const button = document.querySelector( '.forgot__form-btn' );
	if ( button ) {
		button.addEventListener( 'click', () => {
			sendRequest( button, 'yar_profile_reset_password', ( result ) => {
				if ( result.success === true ) {
					if ( result.data ) {
						if ( result.data.code_popup ) {
							appendModal( result.data.code_popup );
						}
					}
				}
			} );
		} );
	}

	const save = document.querySelector( '.forgot__form-save' );
	if ( save ) {
		save.addEventListener( 'click', () => {
			sendRequest( save, 'yar_profile_reset_password_save', ( result ) => {
				if ( result.success === true ){
					setTimeout( () => {
						window.location = '/login/';
					}, 2000 )
				}
			} );
		} );
	}
} );
