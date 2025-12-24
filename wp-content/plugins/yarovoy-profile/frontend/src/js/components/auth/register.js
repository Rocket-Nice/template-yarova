import sendAjax from '../../helpers/ajax.js';
import startTimer from '../../helpers/code-timer.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const registerForm = document.querySelector( '.register__form' );
	const registerButton = document.querySelector( '.register__form-btn' );

	if ( ! registerForm ) {
		return;
	}

	registerButton.addEventListener( 'click', () => {
		sendAjax( registerButton, 'yar_profile_registration', ( result ) => {
			if ( result.success === true ){
				if ( result.data ) {
					if ( result.data.code_popup ) {
						document.querySelector( 'body' ).innerHTML += result.data.code_popup;
						if ( window.openPopup !== undefined ){
							window.openPopup( 'popup-code' );

							const display = document.querySelector( '.input__timer' );
							if ( display ){
								startTimer( 100, display, () => {
									repeatCode();
								} );
							}

							const confirmCodeButton = document.querySelector( '.popup-code__btn' );
							if ( confirmCodeButton ){
								confirmCodeButton.addEventListener( 'click', confirmCode );
							}
						}
					}
				}
			}
		} );
	} );

	function confirmCode( event ){
		sendAjax( event.currentTarget, 'yar_profile_confirm_code', ( result ) => {
			if ( result.success === true ) {
				if ( result.data && result.data.redirect ){
					setTimeout( () => {
						window.location = result.data.redirect;
					}, 2000 )
				}
			}
		} );
	}

	function repeatCode() {
		const repeatButton = document.querySelector( '.code__repeat button' );
		const repeatForm = document.querySelector( '.popup-code__form' );
		const repeatCodeOut = document.querySelector( '.popup-code__code' );

		if ( ! repeatButton ) {
			return;
		}

		repeatButton.addEventListener( 'click', () => {
			sendAjax( repeatButton, 'yar_profile_repeat_code', ( result ) => {
				if ( result.success === true ) {
					const display = repeatForm.querySelector( '.input__timer' );
					if ( display ){
						startTimer( 100, display, () => {
							repeatCode();
						} );
					}

					repeatCodeOut.innerText = result.data.code;
				}
			} );
		} );
	}

} );
