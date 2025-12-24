<?php

use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Helpers\YAR_Validator;

/**
 * Class YAR_Login
 * Logic for auth by phone, password
 */
class YAR_Login {
	public function __construct() {
		add_action( 'wp_ajax_yar_profile_login', [ $this, 'login' ] );
		add_action( 'wp_ajax_nopriv_yar_profile_login', [ $this, 'login' ] );
	}

	public function login() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_nonce'], 'yar_auth_login' ) ) {
			wp_send_json_error();
		}

		$validator = new YAR_Validator();
		$validator->validate( [
			'phone'    => 'required',
			'password' => 'required',
		] );

		$user_helper = new YAR_User();
		$user        = $user_helper->get_by_phone( $validator->get_param( 'phone' ) );

		if ( empty( $user ) ) {
			wp_send_json_error( yar_get_modal_message(
				'Пользователь не найден',
				'Зарегистрируйтесь или попробуйте ввести данные снова'
			) );
		}

		$auth = wp_authenticate( $user->user_login, $validator->get_param( 'password' ) );
		if ( is_wp_error( $auth ) ) {
			wp_send_json_error( yar_get_modal_message(
				'Неверный Логин или пароль',
				'Попробуйте ввести данные заново или восстановите данные'
			) );
		}

		wp_set_auth_cookie( $auth->ID );
		wp_send_json_success( [
			'redirect' => '/profile'
		] );

		wp_die();
	}
}