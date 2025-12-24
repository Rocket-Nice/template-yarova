import validateFile from "../../../helpers/validate-file.js";

let images = [];

window.addEventListener( 'DOMContentLoaded', () => {
	const gallery = document.querySelector( '.upload-car__gallery' );
	if ( ! gallery ) {
		return;
	}

	const list = gallery.querySelector( '.upload-car__gallery-list' );
	const items = gallery.querySelectorAll( '.upload-car__gallery-item' );
	const inputOut = gallery.querySelector( '.upload-car__gallery-input' );
	const inputFile = inputOut.querySelector( '.upload-car__gallery-input input' );
	const removeData = [];

	if ( items ){
		items.forEach( ( item ) => {
			const button = item.querySelector( '.upload-car__gallery-remove' );
			if ( button ) {
				button.addEventListener( 'click', ( event ) => {
					remove( event );
				} );
			}
		} )
	}

	const remove = ( event ) => {
		const item = event.target.closest( '.upload-car__gallery-item' );
		if ( ! item ) {
			return;
		}

		const id = item.dataset.id;
		const imageId = item.dataset.imageId;

		if ( id && imageId ){
			removeData.push( { key: id, image: imageId } );

			let input = gallery.querySelector( 'input[name="gallery_removed"]' );
			if ( ! input ) {
				const create = document.createElement( 'input' );
				create.setAttribute( 'type', 'hidden' );
				create.setAttribute( 'name', 'gallery_removed' );
				create.classList.add( 'gallery__removed' )

				gallery.appendChild( create );
				input = create;
			}

			input.value = JSON.stringify( removeData );
		}

		images.splice( id, 1 );
		item.remove();
	};

	const create = () => {
		const file = inputFile.files[0];
		if ( ! file ){
			return;
		}

		const element = document.createElement( 'div' );
		element.classList.add( 'upload-car__gallery-item' );

		const removeElement = document.createElement( 'button' );
		removeElement.classList.add( 'upload-car__gallery-remove', 'profile__icon-remove' );
		removeElement.addEventListener( 'click', remove );
		element.appendChild( removeElement );

		const reader = new FileReader();
		reader.onload = ( e ) => {
			element.style.backgroundImage = 'url(' + e.target.result + ')';
		};
		reader.readAsDataURL( file );

		if ( file.name ) {
			const name = document.createElement( 'div' );
			name.classList.add( 'upload-car__gallery-name' );
			name.innerText = file.name;
			element.appendChild( name );
		}

		const id = images.push( file );
		element.dataset.id = ( id - 1 );

		list.classList.add( '_active' );
		list.appendChild( element );

		inputFile.value = '';
	};

	inputFile.addEventListener( 'change', () => {
		const validate = inputFile.dataset.validate;

		if ( ! validateFile( inputOut, inputFile.files[0], validate ) ) {
			inputFile.value = '';
			return false;
		}

		create();
	} );
} );

export default function get(){
	return images;
}
