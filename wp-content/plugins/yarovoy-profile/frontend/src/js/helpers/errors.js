export default class Errors {
	form = null;

	constructor( form ) {
		this.form = form;
		if ( ! this.form ) {
			return false;
		}
	}

	create( error ) {
		const errorMessage = document.createElement( "div" );

		errorMessage.classList.add( 'form__error' );
		errorMessage.innerText = error;

		return errorMessage;
	}

	add( errors ) {
		if ( ! errors ) {
			return false;
		}

		for ( let key in errors ){
			const messages = errors[key];

			for ( let message in messages ){
				const error = messages[ message ];
				if (  error.hasOwnProperty( 'files' ) || error.hasOwnProperty( 'file_message' ) ){
					this.outFiles( key, error );
				}
			}

			this.outText( key, messages[0] );
		}
	}

	outText( key, message ) {
		if ( ! message ){
			return;
		}

		const input = this.form.querySelector( '[name="' + key + '"]' );
		if ( ! input ){
			return;
		}

		input.classList.add( '_error' );

		let inputParent = input.closest( '.input' );
		if ( ! inputParent ) {
			inputParent = input.closest( '.preview' );
		}

		if ( ! inputParent ) {
			inputParent = input.closest( '.file__field' );
		}

		if ( inputParent ) {
			inputParent.append( this.create( message ) );
		}
	}

	outFiles( key, error ) {
		const $block = document.querySelector( '.profile-image[data-type="' + key + '"]' );

		if ( error.hasOwnProperty( 'files' ) ) {
			for ( let item in error['files'] ) {
				const $item = $block.querySelector( '[data-name="' + item + '"]' );
				if ( ! $item ) {
					continue;
				}

				$item.appendChild( this.create( error['files'][item] ) );
			}
		}

		if ( error.hasOwnProperty( 'file_message' ) ) {
			$block.parentNode.insertBefore( this.create( error['file_message'] ), $block );
		}
	}

	remove(){
		if ( ! this.form ){
			return false;
		}

		this.form.querySelectorAll( '._error' ).forEach( ( input ) => {
			input.classList.remove( '_error' );;
		} );

		this.form.querySelectorAll( '.form__error' ).forEach( ( input ) => {
			input.remove();
		} );

		return true;
	}

	addMessage( message = 'Необходимо заполнить все обязательные поля' ){
		if ( ! this.form ) {
			return false;
		}

		const formMessage = this.form.querySelector( '.form__message--error' );
		if ( formMessage ) {
			formMessage.innerHTML = message;
			formMessage.style.display = 'block';
		}
	}

	hideMessage(){
		if ( ! this.form ){
			return false;
		}

		const formMessage = this.form.querySelector( '.form__message--error' );
		if ( formMessage ) {
			formMessage.style.display = 'none';
		}
	}
}
