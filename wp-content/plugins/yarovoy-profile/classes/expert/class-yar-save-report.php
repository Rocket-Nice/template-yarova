<?php

use YAR_Profile\Helpers\YAR_Validator;
use YAR_Profile\Services\YAR_Expert_Moderate_Report_Service;
use YAR_Profile\Services\YAR_Expert_Save_Report_Service;

/**
 * Class YAR_Expert_Save_Report
 * Save report request
 */
class YAR_Expert_Save_Report {
	public function __construct() {
		add_action( 'wp_ajax_yar_profile_report_save', [ $this, 'save' ] );
		add_action( 'wp_ajax_yar_profile_report_validate_for_moderate', [ $this, 'validate_for_moderate' ] );
		add_action( 'wp_ajax_yar_profile_report_send_to_moderate', [ $this, 'send_to_moderate' ] );
	}

	private function get_validate_rules( $action ) {
		$rules = [
			'owners_fio'            => 'required',
			'owners_phone'          => 'required',

			// Features
			'features_vin'          => 'required',
			'features_brand'        => 'required',
			'features_model'        => 'required',
			'features_year'         => 'required',
			'features_generation'   => 'required',
			'features_body'         => 'required',
			'features_gos_number'   => 'required',
			'features_sts'          => 'required',
			'features_engine_type'  => 'required',
			'features_modification' => 'required',
			'features_pts_type'     => 'required',
			'features_pts_number'   => 'required',
			'features_color'        => 'required',
			'features_mileage'      => 'required',

			// Equipment
			'equipment'             => '',

			// Vin check
			'vin'             => 'required|inspection',

			// PTS, STS, Passport
			'pts'                   => '',
			'sts'                   => '',
			'passport'              => '',

			// Video
			'video_1'                 => '',
			'video_2'                 => '',
			'video_3'                 => '',

			//'gallery'               => 'required|file|min_files:24',
			'gallery'               => 'file',
			'gallery_removed'       => '',

			'documents'               => '',
			'documents_removed'       => '',

			// Inspection
			'body_inspection'       => 'required|inspection',
			'interior_inspection'   => 'required|inspection',

			// Inspection equipment
			'dashboard'             => '',
			'interior_equipment_comment'    => 'required',

			// Summary
			'summary'               => 'required|inspection',

			// Total
//			'total'                 => 'required',
//			'total_comment'         => 'required',
		];

		if ( $action === 'moderate' ) {
			return $rules;
		}

		foreach ( $rules as $key => $rule ) {
			$rules[ $key ] = '';
		}

		return $rules;
	}

	public function save() {
		if (
			! wp_doing_ajax()
			|| empty( $_POST )
			|| (
				! wp_verify_nonce( $_POST['_nonce'], 'yar_expert_save_report' )
				&& ! wp_verify_nonce( $_POST['_nonce'], 'yar_expert_edit_report' )
			)
		) {
			wp_send_json_error();
		}

		$form_action = $_POST['form_action'] ?? 'save';

		$validator = new YAR_Validator();
		$validator->validate( $this->get_validate_rules( $form_action ) );

		$action    = 'create';
		$report_id = '';
		if ( check_ajax_referer( 'yar_expert_edit_report', '_nonce', false ) ) {
			$action    = 'edit';
			$report_id = $_POST['report_id'];
		}

		$service = new YAR_Expert_Save_Report_Service();
		$save    = $service->save( $validator->validated(), $action, $report_id );

		if ( is_wp_error( $save ) ) {
			wp_send_json_error( yar_get_modal_message(
				'Ошибка при сохранении отчета',
				'Пожалуйста, обратитесь к администритору сайта'
			) );
		}

		$return = [];
		if ( $action === 'create' ) {
			$return = [
				'redirect' => '/profile/reports/edit/' . $save['report_id']
			];
		}

		if ( $form_action === 'moderate' ) {
			if ( ! empty( $save['status']['value'] ) && $save['status']['value'] === 'not_correctly' ) {
				$service->send_to_moderate();

				$return = array_merge(
					yar_get_modal_message( 'Отчет сохранен', 'И передан на проверку модератору' ),
					[ 'redirect' => '/profile/reports/' ]
				);
			} else {
				ob_start();
				load_template( YAR_PROFILE_TEMPLATES . '/modals/report-submit.php', false, $save );
				$template = ob_get_clean();

				$return = [
					'modal' => $template
				];
			}
		} else {
			$return = array_merge( $return, yar_get_modal_message(
				'Отчет сохранен',
			) );
		}

		wp_send_json_success( $return );

		wp_die();
	}

	public function send_to_moderate() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_nonce'], 'yar_profile_report_moderate' ) ) {
			wp_send_json_error();
		}

		$validator = new YAR_Validator();
		$validator->validate( [
			'contract'   => 'required',
			'report_id'  => 'required'
		] );

		$send = ( new YAR_Expert_Moderate_Report_Service() )->save(
			(int) $validator->get_param( 'report_id' ),
			(int) $validator->get_param( 'contract' )
		);

		if ( is_wp_error( $send ) ) {
			wp_send_json_error( yar_get_modal_message(
				'Произошла ошибка',
				'Пожалуйста, обратитесь к администратору',
				$send->get_error_code()
			) );
		}

		wp_send_json_success( array_merge(
			yar_get_modal_message( 'Отчет сохранен', 'И передан на проверку модератору' ),
			[ 'redirect' => '/profile/reports/' ]
		) );
	}

}