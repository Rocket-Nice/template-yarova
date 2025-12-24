import sendRequest from '../../../helpers/ajax.js';

export default class Steps {
	body = null;
	data = {
		step: null,
		settings: {}
	};
	active = null;
	activeButton = null;

	menuItems = null;
	stepItems = null;

	constructor() {
		this.body = document.querySelector( '.upload-car__form' );
		this.active = this.getActive();
		this.stepItems = document.querySelectorAll( '.upload-car__step' );
		this.menuItems = document.querySelectorAll( '.upload-car__menu-item' );

		this.clickMenuItem();
	}

	getActive(){
		return this.body.querySelector( '.upload-car__step._active' );
	}

	clickMenuItem(){
		this.menuItems.forEach( ( button ) => {
			button.addEventListener( 'click', () => {
				const id = button.dataset.id;
				const step = document.querySelector( '.upload-car__step[data-id="' + id + '"]' );
				if ( ! step ){
					return;
				}

				this.open( id );
			} );
		} );
	}

	// get() {
	// 	const findStep = document.querySelector( '.upload-car__step[data-id="' + this.data.step + '"]' );
	// 	if ( findStep ) {
	// 		this.open( this.data.step );
	// 		return false;
	// 	}
	//
	// 	sendRequest( this.activeButton, 'yar_profile_upload_get_step', ( result ) => {
	// 		if ( result.success === true ) {
	// 			if ( result.data.step ){
	// 				this.append( result.data.step );
	// 				this.open( this.data.step );
	// 			}
	// 		}
	// 	}, this.data );
	// }

	open( id ){
		this.hide();

		const step = document.querySelector( '.upload-car__step[data-id="' + id + '"]' );
		const menu = document.querySelector( '.upload-car__menu-item[data-id="' + id + '"]' );

		step.classList.add( '_active' );
		menu.classList.add( '_active' );
		menu.removeAttribute( 'disabled' );

		this.active = step;
	}

	// append( step ){
	// 	this.active.insertAdjacentHTML( 'afterend', step );
	// 	this.stepItems = document.querySelectorAll( '.upload-car__step' );
	// }

	hide(){
		[ ...this.stepItems, ...this.menuItems ].forEach( ( item ) => item.classList.remove( '_active' ) );
	}
}
