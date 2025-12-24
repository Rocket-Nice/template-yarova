import sendRequest from '../../../helpers/ajax.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const solds = document.querySelectorAll( '.profile-upload__car-sold' );

	if ( ! solds ) {
		return;
	}

	solds.forEach( ( sold ) => {
		sold.addEventListener( 'click', () => {
			const data = new FormData();
			const postID = sold.dataset.id;
			const nonce = sold.dataset.nonce;

			if ( ! postID || ! nonce ) {
				return;
			}

			data.append( 'post_id', postID );
			data.append( 'nonce', nonce );

			sendRequest( sold, 'yar_profile_client_car_sold', ( result ) => {
				if ( result.success === true ){
					setTimeout( () => {
						window.location.reload();
					}, 1000 );
				}
			}, data );

		} );
	} );
} );
