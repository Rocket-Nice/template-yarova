window.addEventListener( 'DOMContentLoaded', () => {
	const showPasswords = document.querySelectorAll( '.input__show' );

	if ( ! showPasswords ) {
		return;
	}

	showPasswords.forEach( ( button ) => {
		button.addEventListener( 'click', () => {
			const cell = button.closest( '.input' );
			const input = cell.querySelector( 'input' );

			if ( input ) {
				if ( input.getAttribute( 'type' ) === 'text' ) {
					input.setAttribute( 'type', 'password' );
					return;
				}
				input.setAttribute( 'type', 'text' );
			}
		} );
	} );
} );
