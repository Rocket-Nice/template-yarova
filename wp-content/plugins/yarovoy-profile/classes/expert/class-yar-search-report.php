<?php

use YAR_Profile\Helpers\YAR_Validator;

/**
 * Class YAR_Expert_Search_Report
 * Search report request
 */
class YAR_Expert_Search_Report {
	public function __construct() {
		add_action( 'wp_ajax_yar_profile_report_search', [ $this, 'search' ] );
	}

	public function search(){
		if (
			! wp_doing_ajax()
			|| empty( $_POST )
			|| wp_verify_nonce( $_POST['_nonce'], 'yar_profile_search_report' )
			|| ! yar_is_expert()
		) {
			wp_send_json_error( yar_get_modal_message( 'Произошла ошибка' ) );
		}

		$validator = new YAR_Validator();
		$validator->validate( [
			'search' => 'required'
		] );

		$data = ( new YAR_Report_List_Repository() )->get_report_by_vin(
			$validator->get_param( 'search' )
		);

		if ( empty( $data ) ){
			wp_send_json_error( yar_get_modal_message( 'В базе ничего не найдено' ) );
		}

		$list = '';

		foreach ( $data as $datum ) {
			$datum['status'] = $datum['status']['value'];
			$datum['link']   = '/profile/search-report-view/';

			ob_start();
			load_template( YAR_PROFILE_TEMPLATES . '/report/list/client-item.php', false, $datum );

			$list .= ob_get_clean();
		}

		wp_send_json_success( [
			'list' => $list
		] );

		wp_die();
	}
}