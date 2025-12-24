<?php

use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Helpers\YAR_Validator;

/**
 * Class YAR_Update_Password
 */
class YAR_Update_Password {
	public function __construct() {
		add_action( 'wp_ajax_yar_profile_update_password', [ $this, 'update_password' ] );
	}

	public function update_password() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'action_on_update_password' ) ) {
			wp_send_json_error();
		}

		$validator = new YAR_Validator();
		$validator->validate( [
			'old_password'       => 'required|min:6',
			'password'           => 'required|min:6|has:numbers,symbols',
			'password_confirmed' => 'required|confirmed|has:numbers,symbols'
		] );

		$old_password = $validator->get_param( 'old_password' );
		$user         = wp_get_current_user();

		if ( ! $user || ! wp_check_password( $old_password, $user->user_pass, $user->ID ) ) {
			wp_send_json_error( [
				'errors' => [
					'old_password' => [
						0 => 'Пароль введен неверно'
					]
				]
			] );
		}

		$password = $validator->get_param( 'password' );
		$password = trim( wp_unslash( $password ) );

		wp_set_password( $password, $user->ID );

		wp_destroy_current_session();
		wp_clear_auth_cookie();
		wp_set_current_user( 0 );

		wp_send_json_success();

		wp_die();
	}
}