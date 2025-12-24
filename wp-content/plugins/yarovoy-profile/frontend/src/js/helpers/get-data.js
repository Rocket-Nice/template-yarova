export default function getData( form, data, exclude = [] ) {
	if ( data instanceof FormData ) {
		return data;
	}

	const params = new FormData();

	if ( form ) {
		form.querySelectorAll(
			'input, select, textarea'
		).forEach( ( input ) => {
			const name = input.getAttribute( 'name' );
			const type = input.getAttribute( 'type' );

			let value = input.value;

			if ( exclude.indexOf( name ) !== -1 || ! name ){
				return;
			}

			if ( type === 'checkbox' || type === 'radio' ) {
				if ( input.checked ){
					params.append( name, value );
				}
			} else if ( type === 'file' && input.files[0] ) {
				params.append( name, input.files[0] );
			} else {
				params.append( name, value );
			}
		} );
	}

	if ( data ){
		for ( const key in data ){
			params.append( key, data[key] );
		}
	}

	return params;
};
