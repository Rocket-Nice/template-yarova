import sendRequest from '../../../helpers/ajax.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const forms = document.querySelectorAll( '.contacts-client__table-form' );

	if ( ! forms ) {
		return;
	}

	forms.forEach( ( form ) => {
		const policy = form.querySelector( 'input[name="policy"]' );
		const button = form.querySelector( '.contacts-client__table-form__btn' );

		policy.addEventListener( 'change', () => {
			button.disabled = ! policy.checked;
		} );

		button.addEventListener( 'click', () => {
			if ( button.disabled === true ) {
				return;
			}

			const $item = button.closest( '.contacts-client__table-row' );
			const id = $item.dataset.id;
			const _nonce = $item.dataset.nonce;
			const status = $item.querySelector( '.contacts-client__table-status' );
			const date = $item.querySelector( '.contacts-client__table-date' );

			if ( ! id || ! _nonce ) {
				return;
			}

			const data = {
				id: id,
				_nonce: _nonce
			};

			sendRequest( button, 'yar_profile_contacts_pay', ( result ) => {
				if ( result.success === true ) {
					if ( result.data.status ) {
						$item.querySelector( '.contacts-client__table-form' ).remove();

						status.classList.add( '_' + result.data.status );
						status.innerText = result.data.title;

						if ( result.data.date ) {
							date.innerText = result.data.date;
						}
					}

					if ( result.data.link ){
						setTimeout( () => {
							window.location = result.data.link;
						}, 4000 );
					}
				}
			}, data );
		} );
	} );
} );
