import sendRequest from "../../../helpers/ajax.js";

window.addEventListener( 'DOMContentLoaded', () => {
	const form = document.querySelector( '.profile-report-search__form' );
	const list = document.querySelector( '.profile-report-search__list' );
	if ( ! form ) {
		return;
	}

	const button = form.querySelector( '.profile-report-search__btn' );

	button.addEventListener( 'click', () => {
		sendRequest( button, 'yar_profile_report_search', ( result ) => {
			if ( result.success === true && result.data ){
				if ( result.data.list ){
					list.innerHTML = result.data.list;
				}
			}
		} );
	} );
} );
