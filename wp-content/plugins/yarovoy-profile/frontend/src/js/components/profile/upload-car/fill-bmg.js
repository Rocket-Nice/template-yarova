import sendRequest from '../../../helpers/ajax.js';

window.addEventListener( 'DOMContentLoaded', () => {
	const fillSelects = document.querySelectorAll( '.upload-car__step [data-fill]' );

	if ( ! fillSelects ){
		return;
	}

	const getSiblings = ( elm, withTextNodes ) => {
		if ( ! elm || ! elm.parentNode ) return

		let siblings = [ ...elm.parentNode[withTextNodes ? 'childNodes' : 'children'] ],
			idx = siblings.indexOf( elm );

		siblings.before = siblings.slice( 0, idx )
		siblings.after = siblings.slice( idx + 1 )

		return siblings
	}

	const clearSelect = ( select ) => {
		const options = select.querySelectorAll( 'option:not(:first-child)' );
		if ( options ) {
			select.selectedIndex = 0;

			options.forEach( ( option ) => option.remove() );
		}
	};

	const fillSelect = ( fill, options ) => {
		const findSelect = document.querySelector( 'select[name="' + fill + '"]' );
		if ( findSelect ) {
			clearSelect( findSelect );

			options.forEach( ( option ) => {
				const element = document.createElement( 'option' );
				element.setAttribute( 'value', option.id );
				element.innerText = option.value;

				findSelect.appendChild( element );
			} );
		}
	};

	const clearAfterSelects = ( select ) => {
		const next = getSiblings( select.parentNode, false );
		if ( next.after.length ){
			next.after.forEach( ( elm ) => {
				if ( elm.classList.contains( 'is-fill' ) ){
					const item = elm.querySelector( 'select' );
					clearSelect( item );
				}
			} );
		}
	}

	fillSelects.forEach( ( select ) => {
		select.addEventListener( 'change', () => {
			const fill = select.dataset.fill;
			const value = select.value;
			const type = select.getAttribute( 'name' );

			clearAfterSelects( select );

			sendRequest( select, 'yar_profile_upload_car_fill', ( result ) => {
				if ( result.success === true ){
					if ( result.data && result.data.options ){
						fillSelect( fill, result.data.options );
					}
				}

			}, {
				type: type,
				fill: fill,
				id: value
			} );
		} );
	} );
} );
