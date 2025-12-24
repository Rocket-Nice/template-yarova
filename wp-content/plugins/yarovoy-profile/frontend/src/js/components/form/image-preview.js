window.addEventListener( 'DOMContentLoaded', () => {
	const previews = document.querySelectorAll( '.preview' );
	if ( ! previews ) {
		return;
	}

	previews.forEach( ( preview ) => {
		const input = document.querySelector( 'input[type="file"]' );
		const output = preview.querySelector( '.preview__output' );

		input.addEventListener( 'change', () => {
			const file = input.files[0];
			if ( ! file ) {
				return;
			}

			const reader = new FileReader();
			reader.onload = ( e ) => {
				if ( output ){
					output.style.backgroundImage = 'url(' + e.target.result + ')';
				}
			};

			reader.readAsDataURL( file );
		} );
	} );
} );
