<?php

/**
 * Class YAR_Expert_Completed_Contract
 * Request for set status contract on completed.
 * And send request to admin for check
 */
class YAR_Expert_Completed_Contract {
	public function __construct() {
		add_action( 'wp_ajax_yar_profile_expert_request_contact', [ $this, 'request' ] );
	}

	public function request() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_nonce'], 'yar_profile_cancel_contact' ) ) {
			wp_send_json_error();
		}

		$id    = (int) $_POST['id'];
		$check = ( new YAR_Contracts_Repository() )->can_be_completed( $id );

		if ( ! $id || ! $check ){
			wp_send_json_error( yar_get_modal_message( 'Вы не можете пока завершить договор' ) );
		}

		update_field( 'status_expert', 'request_to_cancel', $id );

		wp_send_json_success( yar_get_modal_message( 'Запрос на завершение отчета отправлен' ) );

		wp_die();
	}
}