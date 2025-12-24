import sendRequest from "../../../helpers/ajax.js";

window.addEventListener( 'DOMContentLoaded', () => {
	const previewForm = document.querySelector( '.profile-report__preview-actions' );
	if ( ! previewForm ) {
		return;
	}

	const previewButton = previewForm.querySelector( '.profile-report__preview-btn' );
	const previewComment = previewForm.querySelector( '.profile-report__preview-comment' );

	if ( ! previewButton ) {
		return;
	}

	const status = previewForm.querySelector( 'select[name="status"]' );

	if ( status ) {
		status.addEventListener( 'change', () => {
			if ( status.value === 'not_correctly' ){
				previewComment.classList.add( '_active' );
			} else {
				previewComment.classList.remove( '_active' );
			}
		} )
	}

	previewButton.addEventListener( 'click', () => {
		sendRequest( previewButton, 'yar_admin_report_set_status', ( result ) => {
			if ( result.success === true && result.data.redirect ){
				window.location = result.data.redirect;
			}
		} );
	} );
} );
