import validateFile from "../../helpers/validate-file.js";

window.addEventListener( 'DOMContentLoaded', () => {
	const fields = document.querySelectorAll( '.file__field' );
	if ( ! fields ) {
		return;
	}

	fields.forEach( ( field ) => {
		const input = field.querySelector( 'input' );
		const title = field.dataset.title;
		const label = field.querySelector( 'label span' );
		const validate = input.dataset.validate;

		if ( input ){
			input.addEventListener( 'change', async () => {
				const file = input.files[0];

				const isValidated = await validateFile( field, file, validate );
				if ( ! isValidated ) {
					input.value = '';
					return false;
				}

				field.classList.add( '_loaded' );
				label.innerHTML = title + ' загружен' + ' <span>(' + file.name + ')</span>';
			} );
		}
	} );
} );
