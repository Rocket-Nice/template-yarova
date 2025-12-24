window.addEventListener( 'DOMContentLoaded', () => {
	const add = document.querySelector( '.profile-service__add' );
	if ( ! add ) {
		return;
	}

	const selected = [];
	const row = document.querySelector( '.profile-service__row' );
	const template = document.querySelector( '.profile-service__template' );
	const items = [ ...document.querySelectorAll( '.profile-service__item' ) ];

	add.addEventListener( 'click', () => {
		if ( ! validate() ) {
			return false;
		}

		create();
	} );

	const disableSelects = () => {
		items.forEach( ( item ) => {
			const options = item.querySelectorAll( 'select option' );
			options.forEach( ( option ) => {
				if ( selected.includes( option.value ) ){
					option.disabled = true;
				} else {
					option.disabled = false;
				}
			} );
		} );
	}

	const removePrevValue = ( value ) => {
		if ( value ){
			const index = selected.findIndex( item => parseInt( item ) === parseInt( value ) );
			if ( index !== false ){
				selected.splice( index, 1 );
			}
		}
	}

	const create = () => {
		const clone = template.cloneNode( true );

		// Reset
		clone.style.display = 'flex';
		clone.querySelector( 'select option:first-child' ).setAttribute( 'selected', 'selected' );
		clone.classList.remove( 'profile-service__template' );

		const select = clone.querySelector( 'select' );
		let prevValue = 0;

		select.addEventListener( 'change', () => {
			selected.push( select.value );

			removePrevValue( prevValue );

			disableSelects();
			prevValue = select.value;
		} );

		const id = items.push( clone );
		const buttonRemove = clone.querySelector( '.profile-service__remove' );
		if ( buttonRemove ){
			buttonRemove.addEventListener( 'click', () => remove( clone, id ) );
		}

		row.appendChild( clone );
	};

	const validate = () => {
		const element = row.querySelector( '.profile-service__item:last-child' );
		if ( ! element ) {
			return true;
		}

		const select = element.querySelector( 'select' );
		const selectValue = Number( select.value );

		select.classList.remove( '_error' );

		if ( ! selectValue ) {
			select.classList.add( '_error' );
			return false;
		}

		return true;
	};

	const remove = ( item, key ) => {
		if ( ! item ) {
			return false;
		}

		const selectValue = item.querySelector( 'select' ).value;
		if ( selectValue ){
			for ( let item in selected ){
				if ( selectValue === selected[ item ] ){
					selected.splice( item, 1 );
				}
			}

			disableSelects();
		}

		items.splice( key, 1 );
		item.remove();
	};

	if ( items.length ) {
		items.forEach( ( item, key ) => {
			const button = item.querySelector( '.profile-service__remove' );
			const select = item.querySelector( 'select' );
			if ( ! button ) {
				return;
			}

			button.addEventListener( 'click', () => remove( item, key ) );

			if ( select ){
				let prevValue = 0;

				if ( parseInt( select.value ) ){
					selected.push( select.value );
					prevValue = select.value;
				}

				select.addEventListener( 'change', () => {
					removePrevValue( prevValue );

					selected.push( select.value );
					disableSelects();
				} );

				disableSelects();
			}
		} );
	}
} );

export default function getServices() {
	const items = document.querySelectorAll( '.profile-service__item' );
	let data = [];

	if ( ! items ) {
		return data;
	}

	items.forEach( ( service ) => {
		if ( service.classList.contains( 'profile-service__template' ) ){
			return;
		}

		const select = service.querySelector( 'select' );
		if ( ! select || ! select.value ) {
			return;
		}

		data.push( select.value );
	} );

	return data;
};
