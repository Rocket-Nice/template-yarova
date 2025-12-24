import sendRequest from '../../../helpers/ajax.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const contactItems = document.querySelectorAll( '.contacts-expert__item' );

	if ( ! contactItems ) {
		return;
	}

	contactItems.forEach( ( item ) => {
		const button = item.querySelector( '.contacts-expert__cancel' );

		if ( ! button ) {
			return;
		}

		button.addEventListener( 'click', () => {
			if ( button.disabled === true ) {
				return;
			}

			const id = item.dataset.id;
			const _nonce = item.dataset.nonce;

			if ( ! id || ! _nonce ) {
				return;
			}

			const data = {
				id: id,
				_nonce: _nonce
			};

			sendRequest( button, 'yar_profile_expert_request_contact', ( result ) => {
				if ( result.success === true ) {
					button.remove();
				}
			}, data );
		} );
	} );
} );
