import sendRequest from '../../../helpers/ajax.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const orderButton = document.querySelector( '.upload-car__order button' );
	if ( ! orderButton ){
		return;
	}

	orderButton.addEventListener( 'click', () => {
		const data = new FormData();
		const _nonce = orderButton.dataset.nonce;

		if ( ! _nonce ) {
			return;
		}

		data.append( '_nonce', _nonce );

		sendRequest( orderButton, 'yar_profile_upload_car_send_order', ( result ) => {
			if ( result.success === true ){
				// if ( result.data && result.data.options ){
				// 	fillSelect( fill, result.data.options );
				// }
			}
		}, data );
	} );
} );
