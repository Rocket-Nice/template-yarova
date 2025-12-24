import getData from '../../../helpers/get-data.js';
import sendRequest from '../../../helpers/ajax.js';
import getImages from '../../form/gallery.js';
import getServices from '../../form/services.js';
import validateFile from "../../../helpers/validate-file.js";

window.addEventListener( 'DOMContentLoaded', () => {
	const settingsForm = document.querySelector( '.profile-settings__form' );

	if ( ! settingsForm ) {
		return;
	}

	const settingsFormButton = settingsForm.querySelector( '.profile-settings__btn' );

	settingsFormButton.addEventListener( 'click', () => {
		const data = getData( settingsForm, {}, [ 'documents', 'portfolio', 'service' ] );
		const images = getImages();
		const services = getServices();

		if ( images ) {
			for ( let image in images ) {
				for ( let imageKey in images[image] ){
					data.append( image + '[]', images[image][imageKey] );
				}
			}
		}

		if ( services.length ){
			for ( let item in services ){
				data.append( 'services[]', services[ item ] );
			}
		}

		sendRequest( settingsFormButton, 'yar_profile_save_settings', ( result ) => {
			if ( result.success === true ){
				setTimeout( () => {
					window.location.reload();
				}, 1000 );
			}
		}, data );
	} );

	const preview = document.querySelector( '.preview' );
	if ( preview ){
		const previewInput = document.querySelector( '.preview__input' );

		previewInput.addEventListener( 'change', async () => {
			const file = previewInput.files[0];
			const validate = previewInput.dataset.validate;

			const isValidated = await validateFile( preview, file, validate );
		} );
	}
} );
