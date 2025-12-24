import getImages from "../../form/gallery.js";
import sendRequest from "../../../helpers/ajax.js";

class ReportSave {
	form = null;

	constructor() {
		this.form = document.querySelector( '.report-form' );
	}

	_getData(){
		const data = {
			owners: {
				fields: this._getTextFields( 'owners' ),
				json: false
			},
			features: {
				fields: this._getTextFields( 'features' ),
				json: false
			},
			vin: {
				fields: this._getInspectionFields( 'vin' ),
				json: true
			},
			gallery: {
				fields: this._getGallery().files,
				array: true
			},
			documents: {
				fields: this._getDocuments().files,
				array: true
			},
			// files: {
			// 	fields: this._getDocuments(),
			// 	json: false
			// },
			video: {
				fields: this._getVideo(),
				json: false
			},
			gallery_removed: {
				fields: this._getGallery().removed,
				array: false
			},
			documents_removed: {
				fields: this._getDocuments().removed,
				array: false
			},
			body_inspection: {
				fields: this._getInspectionFields( 'body_inspection' ),
				json: true
			},
			dashboard: {
				fields: this._getCustomCheckboxFields( 'dashboard' ),
				json: true
			},
			interior_inspection: {
				fields: this._getInspectionFields( 'interior_inspection' ),
				json: true
			},
			interior_equipment: {
				fields: this._getTextFields( 'interior_equipment' ),
				json: false
			},
			summary: {
				fields: this._getInspectionFields( 'summary' ),
				json: true
			},
			// total: {
			// 	fields: this._getTotal(),
			// 	json: false
			// }
		};

		const formData = new FormData();
		for ( let key in data ) {
			const fields = data[key].fields;
			const json = data[key].json || false;
			const array = data[key].array || false;

			if ( json === true ) {
				formData.append( key, JSON.stringify( fields ) )
			} else {
				if ( key === 'gallery_removed' || key === 'documents_removed' ){
					formData.append( key, fields );
					continue;
				}

				for ( let field in fields ) {
					formData.append( ( array ? key + '[]' : field ), fields[field] );
				}
			}
		}

		return formData;
	}

	_getTotal() {
		const $total = this.form.querySelector( '[data-total]' );
		const $isTotal = $total.querySelector( 'input[type="radio"]' );
		const $message = $total.querySelector( 'textarea' ).value;

		let isTotal = 0;

		if ( $isTotal.checked === true ) {
			isTotal = $isTotal.value;
		}

		return {
			total: isTotal,
			total_comment: $message
		}
	}

	_getCheckboxFields( type ) {
		let data = [];

		const fields = this.form.querySelectorAll( '[data-type="' + type + '"] .checkbox__field-input' );
		if ( fields ) {
			fields.forEach( ( input ) => {
				if ( input.checked === true ) {
					data.push( input.value );
				}
			} )
		}

		return data;
	}

	_getGallery() {
		const gallery = getImages().gallery;
		const galleryRemoved = this.form.querySelector( 'input[name="gallery_removed"]' );
		const data = {
			files: [],
			removed: {}
		};

		if ( gallery && gallery.length ) {
			data.files = gallery;
		}

		if ( galleryRemoved ) {
			data.removed = galleryRemoved.value;
		}

		return data;
	}

	_getDocuments() {
		const gallery = getImages().documents;
		const galleryRemoved = this.form.querySelector( 'input[name="documents_removed"]' );
		const data = {
			files: [],
			removed: {}
		};

		if ( gallery && gallery.length ) {
			data.files = gallery;
		}

		if ( galleryRemoved ) {
			data.removed = galleryRemoved.value;
		}

		return data;
	}

	_getTextFields( type ) {
		const inputs = this.form.querySelectorAll( '[data-type="' + type + '"] .input__cell' );
		let data = {};
		if ( inputs ) {
			inputs.forEach( ( input ) => {
				data[input.name] = input.value;
			} )
		}
		return data;
	}

	_getInspectionFields( type ) {
		let data = {
			fields: {}
		};

		const $block = this.form.querySelector( '[data-type="' + type + '"]' );
		const $additionalComment = $block.querySelector( '.inspection__field-comment textarea' );

		if ( $additionalComment ) {
			if ( $additionalComment.value ) {
				data.additional_comment = $additionalComment.value;
			} else {
				data.additional_comment = '';
			}
		}

		const $fields = $block.querySelectorAll( '.inspection__field' );
		if ( $fields ) {
			$fields.forEach( ( field ) => {
				if ( field.dataset.exclude ) {
					return;
				}

				const position = field.dataset.position;
				const inspectionId = field.dataset.inpectionId;
				const $status = field.querySelector( 'input[type="radio"]:checked' );
				const $weight = field.querySelector( 'input[name="weight"]' );
				const $comment = field.querySelector( 'textarea' );


				data.fields[position] = {
					inspection_id: inspectionId,
					status: 0,
					comment: '',
				};

				if ( $weight ) {
					if ( $weight.value ) {
						data.fields[position].thickness = $weight.value;
					} else {
						data.fields[position].thickness = '';
					}
				}

				if ( $status && $status.checked === true ) {
					data.fields[position].status = parseInt( $status.value );
				}

				if ( $comment ) {
					data.fields[position].comment = $comment.value;
				}
			} );
		}

		return data;
	}

	_addInspectionErrors( errors, type ) {
		const block = document.querySelector( '.report-form__block[data-type="' + type + '"]' );
		for ( let item in errors ) {
			const row = block.querySelector( '[data-position="' + item + '"]' );
			const error = document.createElement( 'div' );

			error.classList.add( 'form__error' );
			error.innerText = errors[item];

			row.classList.add( '_error' );
			row.appendChild( error );
		}
	}

	_removeInspectionErrors() {
		const fields = this.form.querySelectorAll( '.inspection__field' );
		if ( ! fields ) {
			return;
		}

		fields.forEach( ( field ) => {
			field.classList.remove( '_error' );

			const error = field.querySelector( '.form__error' );
			if ( error ){
				error.remove();
			}
		} )
	}


	_getCustomCheckboxFields( type ) {
		let data = {};

		const checkboxes = this.form.querySelectorAll( '[data-type="' + type + '"] .checkbox__custom' );
		if ( checkboxes ) {
			checkboxes.forEach( ( checkbox ) => {
				const input = checkbox.querySelector( 'input' );
				if ( input.checked === true ) {
					data[input.name] = parseInt( input.value );
				} else {
					data[input.name] = 0;
				}
			} );
		}

		return data;
	}

	// _getDocuments(){
	// 	return {
	// 		pts: this.form.querySelector( 'input[name="pts"]' ).files[0] ?? '',
	// 		sts: this.form.querySelector( 'input[name="sts"]' ).files[0] ?? '',
	// 		passport: this.form.querySelector( 'input[name="passport"]' ).files[0] ?? '',
	// 	}
	// }

	_getVideo(){
		const video1 = this.form.querySelector( 'input[name="video_1"]' );
		const video2 = this.form.querySelector( 'input[name="video_2"]' );
		const video3 = this.form.querySelector( 'input[name="video_3"]' );

		return {
			video_1: video1 && video1.files.length ? video1.files[0] : '',
			video_2: video2 && video2.files.length ? video2.files[0] : '',
			video_3: video3 && video3.files.length ? video3.files[0] : '',
		}
	}

	save( button ) {
		const data = this._getData();

		//
		const nonce = this.form.querySelector( 'input[name="_wpnonce"]' ).value;
		const report_id = this.form.querySelector( 'input[name="report_id"]' )
		const report_action = this.form.querySelector( 'input[name="report_action"]' );
		const action = button.dataset.action;

		let send_action = 'yar_profile_report_save';

		if ( ! nonce || ! action ) {
			return false;
		}

		// if ( action === 'moderate' ){
		// 	send_action = 'yar_profile_report_validate_for_moderate';
		// }

		data.append( 'form_action', action );
		data.append( '_nonce', nonce );

		if ( report_id ){
			data.append( 'report_id', report_id.value );
			data.append( 'report_action', report_action.value );
		}

		this._removeInspectionErrors();

		sendRequest( button, send_action, ( result ) => {
			if ( result.success === true ) {
				if ( result.data.redirect ) {
					setTimeout( () => {
						window.location = result.data.redirect;
					}, 1000 );
				}

				if ( action === 'save' && report_action.value === 'edit' ){
					setTimeout( () => {
						window.location.reload();
					}, 1000 );
				}

				if ( result.data.modal ){
					document.querySelector( 'body' ).innerHTML += result.data.modal;
					if ( window.openPopup !== undefined ){
						window.openPopup( 'report-submit' );

						this.sendModerate();

						const reportSubmit = document.querySelector( '#report-submit' );
						const reportSubmitReferrer = reportSubmit.querySelector( 'input[name="referrer"]' );

						if ( reportSubmitReferrer ) {
							setTimeout( () => {
								window.location = '/profile/reports/';
							}, 2000 )
						}
					}
				}
			} else {
				if ( result.data.errors && result.data.errors ) {
					if ( result.data.errors.vin_check ){
						this._addInspectionErrors( result.data.errors.vin_check[0], 'vin_check' );
					}
					if ( result.data.errors.body_inspection ){
						this._addInspectionErrors( result.data.errors.body_inspection[0], 'body_inspection' );
					}
					if ( result.data.errors.interior_inspection ){
						this._addInspectionErrors( result.data.errors.interior_inspection[0], 'interior_inspection' );
					}
					if ( result.data.errors.summary ){
						this._addInspectionErrors( result.data.errors.summary[0], 'summary' );
					}
				}
			}
		}, data );
	}

	sendModerate() {
		const modal = document.querySelector( "#report-submit" );
		const button = modal.querySelector( '.popup-report-submit__btn' );

		if ( ! button ){
			return;
		}

		button.addEventListener( 'click', () => {
			sendRequest( button, 'yar_profile_report_send_to_moderate', ( result ) => {
				if ( result.success === true && result.data.redirect ){
					window.location = result.data.redirect;
				}
			} );
		} );
	}
}

window.addEventListener( 'DOMContentLoaded', () => {
	const $button = document.querySelectorAll( '.report-form__btn' );

	if ( ! $button ) {
		return;
	}

	$button.forEach( ( button ) => {
		button.addEventListener( 'click', () => {
			let save = new ReportSave();
			save.save( button );
		} );
	} );

	const buttonSend = document.querySelector( '.popup-report-submit__btn' );

	if ( ! buttonSend ){
		return;
	}

	buttonSend.addEventListener( 'click', () => {
		let save = new ReportSave();
		save.sendModerate();
	} );
} );
