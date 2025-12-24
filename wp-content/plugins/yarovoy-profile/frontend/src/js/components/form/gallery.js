import validateFile from '../../helpers/validate-file.js';

let images = {};

class Gallery {
	gallery = null;
	firstItem = null;
	inputFile = null;

	file = null;
	name = null;
	validate = null;
	pushID = 0;

	removeData = [];

	constructor( gallery ) {
		this.gallery = gallery;
		if ( ! this.gallery ) {
			return false;
		}

		this.firstItem = this.gallery.querySelector( '.profile-image__item:first-child' );
		this.inputFile = this.firstItem.querySelector( 'input' );

		this.inputFile.addEventListener( 'change', async () => {
			this._changeInput();
		} );

		const items = this.gallery.querySelectorAll( '.profile-image__remove' );
		if ( items ) {
			items.forEach( ( item ) => {
				item.addEventListener( 'click', this._removeItem.bind( this ) );
			} )
		}
	}

	_generateID() {
		let result = '';
		const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		const charactersLength = characters.length;
		let counter = 0;
		while ( counter < 10 ) {
			result += characters.charAt( Math.floor( Math.random() * charactersLength ) );
			counter += 1;
		}
		return result;
	}

	async _changeInput() {
		for ( let item in [ ...this.inputFile.files ] ) {
			this.file = this.inputFile.files[item];
			this.name = this.inputFile.getAttribute( 'name' );
			this.rules = this.inputFile.dataset.validate;

			const isValidated = await validateFile( this.firstItem, this.file, this.rules, this.name, images );
			if ( this.rules && ! isValidated ) {
				this.file = '';

				return false;
			}

			this._push();
			this._clone();
		}

		this.inputFile.value = '';
	}

	_push() {
		if ( ! images.hasOwnProperty( this.name ) ) {
			images[this.name] = [];
		}

		const id = this._generateID() + '-' + this.file.name.trim();
		this.file.uuid = id;
		this.file.rotate = 0;
		images[this.name].push( this.file );

		this.pushID = id;
	}

	_createCloneItem() {
		const clone = this.firstItem.cloneNode( true );
		clone.querySelector( 'input' ).remove();
		clone.dataset.id = this.pushID;
		clone.dataset.name = this.file.name;
		clone.classList.add( '_selected' );

		const del = document.createElement( 'button' );
		del.classList.add( 'profile__icon-remove', 'profile-image__remove' );
		del.addEventListener( 'click', this._remove.bind( this ) );
		clone.appendChild( del );

		const image = this._createImage();
		if ( ! image ) {
			return;
		}

		clone.appendChild( this._createName() );
		clone.appendChild( this._createRotate() );
		clone.appendChild( image );

		return clone;
	}

	_createName() {
		if ( ! this.file.name ) {
			return;
		}

		const name = document.createElement( 'div' );
		name.classList.add( 'profile-image__name' );
		name.innerText = this.file.name;

		return name;
	}

	_createImage() {
		const image = document.createElement( 'img' );
		image.classList.add( 'profile-image__pic' );

		const reader = new FileReader();
		reader.onload = ( e ) => {
			image.src = e.target.result;
		};

		reader.readAsDataURL( this.file );

		return image;
	}

	_createRotate() {
		const rotate = document.createElement( 'button' );
		rotate.classList.add( 'profile-image__rotate' );
		rotate.addEventListener( 'click', this._rotate.bind( this ) );

		return rotate;
	}

	_rotate() {
		const current = event.currentTarget.closest( '.profile-image__item' );
		const rotate = parseInt( current.dataset.rotate ) || 0;
		const image = current.querySelector( 'img' );
		const type = this.gallery.dataset.type;
		const id = current.dataset.id;

		let count = ( rotate + 90 );

		if ( count >= 360 ) {
			count = 0;
		}

		image.style.transform = 'rotate( '+count+'deg )';
		current.dataset.rotate = count;

		for ( let image in images[type] ) {
			if ( images[type][image].uuid === id ) {
				images[type][image].rotate = count;
			}
		}
	}

	_clone() {
		if ( ! this.pushID ) {
			return;
		}

		const create = this._createCloneItem();
		if ( ! create ) {
			return;
		}

		this.gallery.append( create );
	}

	_remove() {
		const item = event.currentTarget.closest( '.profile-image__item' );
		const type = this.gallery.dataset.type;
		if ( ! item || ! type ) {
			return;
		}

		const id = item.dataset.id;
		if ( ! id ) {
			return;
		}

		for ( let image in images[type] ) {
			if ( images[type][image].uuid === id ) {
				images[type].splice( image, 1 );
			}
		}

		item.remove();
	}

	_removeItem() {
		const current = event.currentTarget.closest( '.profile-image__item' );
		if ( ! current ) {
			return;
		}

		const type = this.gallery.dataset.type;
		const key = current.dataset.imageKey;
		const id = current.dataset.imageId;

		if ( ! type || key === undefined || ! id ) {
			return;
		}

		this.removeData.push( id );

		if ( this.removeData ) {
			let input = this.gallery.querySelector( '.profile-image__removed' );
			if ( ! input ) {
				const create = document.createElement( 'input' );
				create.setAttribute( 'type', 'hidden' );
				create.setAttribute( 'name', type + '_removed' );
				create.classList.add( 'profile-image__removed' );

				this.gallery.appendChild( create );
				input = create;
			}

			input.value = JSON.stringify( this.removeData );
			current.remove();
		}
	}
}

window.addEventListener( 'DOMContentLoaded', () => {
	const galleries = document.querySelectorAll( '.profile-image' );
	if ( ! galleries ) {
		return;
	}

	galleries.forEach( ( gallery ) => {
		new Gallery( gallery );
	} )
} );

export default function () {
	return images;
}
