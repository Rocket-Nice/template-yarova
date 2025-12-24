window.addEventListener( 'DOMContentLoaded', () => {
	const videoButtons = document.querySelectorAll( '.profile-report__video-play' ) ;
	if ( ! videoButtons ){
		return;
	}

	const videoModal = document.querySelector( '#popup-video' );
	const video = videoModal.querySelector( 'video' );
	const videoSource = video.querySelector( 'source' );

	videoButtons.forEach( ( videoButton ) => {
		videoButton.addEventListener( 'click', () => {
			const url = videoButton.dataset.url;

			if ( ! url ){
				return;
			}

			videoSource.src = url;


			video.load();
			video.play();
		} )
	} );

	const modalCloses = videoModal.querySelectorAll( '.popup__bg, .popup__close' );
	modalCloses.forEach( ( modalClose ) => {
		modalClose.addEventListener( 'click', () => {
			video.pause();

			videoSource.src = '';
			videoSource.type = '';
		} )
	} )
} );
