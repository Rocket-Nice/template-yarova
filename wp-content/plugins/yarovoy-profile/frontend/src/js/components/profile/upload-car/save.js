import sendRequest from '../../../helpers/ajax.js';
import getGallery from './gallery.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const form = document.querySelector( '.upload-car__steps' );
	if ( ! form ){
		return;
	}

	const buttons = form.querySelectorAll( '.upload-car__actions-button' );
	const buttonSave = form.querySelector( '.upload-car__actions-save' );

	const menu = form.querySelectorAll( '.upload-car__menu-item' );
	const items = form.querySelectorAll( '.upload-car__step' );

	if ( ! form ) {
		return;
	}

	const hide = () => {
		[ ...menu, ...items ].forEach( ( item ) => item.classList.remove( '_active' ) );
	}

	const openStep = ( id ) => {
		hide();

		const step = document.querySelector( '.upload-car__step[data-id="' + id + '"]' );
		const menu = document.querySelector( '.upload-car__menu-item[data-id="' + id + '"]' );

		step.classList.add( '_active' );
		menu.classList.add( '_active' );
		menu.removeAttribute( 'disabled' );
	}

	const getData = () => {
		const inputs = [
			...form.querySelectorAll( '.input__cell' ),
			...form.querySelectorAll( '.colors__select-item input:checked' ),
			...form.querySelectorAll( '.checkbox__field-input:checked' ),
			...form.querySelectorAll( '.file__field-input' ),
			...form.querySelectorAll( '.gallery__removed' ),
		];

		const gallery = getGallery();
		const data = new FormData();

		inputs.forEach( ( input ) => {
			let value = input.value;

			if ( input.type === 'checkbox' ) {
				if ( input.checked === true ) {
					value = parseInt( input.value );
				} else {
					value = 0;
				}
			}

			if ( input.type === 'file' && input.files.length > 0 ) {
				value = input.files[0];
			}

			if ( input.type === 'select-one' && input.value ) {
				value = parseInt( input.value );
			}

			data.append( input.name, value );
		} );

		if ( gallery.length ) {
			gallery.forEach( ( item ) => {
				data.append( 'gallery[]', item );
			} )
		}

		return data;
	}

	const validate = ( button, currentStep, nextStep ) => {
		if ( button.classList.contains('upload-car__actions--prev') ){
			openStep( nextStep );
			return false;
		}

		const data = getData();
		data.append( 'current_step',currentStep );

		sendRequest( button, 'yar_profile_upload_validate', ( result ) => {
			if ( result.success === true ) {
				openStep( nextStep );
			}
		}, data );
	}

	const save = () => {
		const data = getData();
		const _nonce = form.querySelector( 'input[name="_nonce"]' ).value;
		if ( ! data || ! _nonce ) {
			return;
		}

		const car_action = form.querySelector( 'input[name="car_action"]' );
		const car_id = form.querySelector( 'input[name="car_id"]' );

		if ( car_id && car_action ) {
			data.append( 'car_id', car_id.value );
			data.append( 'car_action', car_action.value );
		}

		data.append( '_nonce', _nonce );

		sendRequest( buttonSave, 'yar_profile_upload_save', ( result ) => {
			if ( result.success === true ) {
				if ( result.data.redirect ) {
					setTimeout( () => {
						window.location = result.data.redirect;
					}, 2000 )
				}
			}
		}, data );
	}

	// Open next steps
	buttons.forEach( ( button ) => {
		button.addEventListener( 'click', () => {
			const currentStep = button.closest( '.upload-car__step' ).dataset.id;
			const nextStep = button.dataset.openStep;

			validate( button, currentStep, nextStep );
		} );
	} )

	// Open step on menu item
	menu.forEach( ( item ) => {
		item.addEventListener( 'click', () => {
			const currentStep = document.querySelector( '.upload-car__step._active' ).dataset.id;
			const nextStep = item.dataset.id;

			openStep( nextStep );

			//validate( item, currentStep, nextStep )
		} );
	} );

	// Save form
	buttonSave.addEventListener( 'click', () => save() );
} );
