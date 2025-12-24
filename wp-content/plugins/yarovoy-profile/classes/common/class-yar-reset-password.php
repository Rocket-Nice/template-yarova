<?php

use YAR_Profile\Helpers\YAR_Codes;
use YAR_Profile\Helpers\YAR_Session;
use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Helpers\YAR_Validator;
use YAR_Profile\Services\YAR_Email_Notifications_Service;
use YAR_Profile\Services\YAR_SMS_Service;

/**
 * Class YAR_Reset_Password
 */
class YAR_Reset_Password {
	private $user_service;
	private $session_service;
	private $email_notifications;
	private $code_service;

	public function __construct() {
		add_action( 'wp_ajax_yar_profile_reset_password', [ $this, 'get_code' ] );
		add_action( 'wp_ajax_nopriv_yar_profile_reset_password', [ $this, 'get_code' ] );

		add_action( 'wp_ajax_yar_profile_reset_password_repeat', [ $this, 'repeat_code' ] );
		add_action( 'wp_ajax_nopriv_yar_profile_reset_password_repeat', [ $this, 'repeat_code' ] );

		add_action( 'wp_ajax_yar_profile_reset_password_confirm', [ $this, 'confirm_code' ] );
		add_action( 'wp_ajax_nopriv_yar_profile_reset_password_confirm', [ $this, 'confirm_code' ] );

		add_action( 'wp_ajax_yar_profile_reset_password_save', [ $this, 'save' ] );
		add_action( 'wp_ajax_nopriv_yar_profile_reset_password_save', [ $this, 'save' ] );

		$this->user_service        = new YAR_User();
		$this->session_service     = new YAR_Session();
		$this->code_service        = new YAR_Codes();
		$this->email_notifications = new YAR_Email_Notifications_Service();
	}

	public function get_code() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_auth_forgot_password' ) ) {
			wp_send_json_error();
		}

		$validator = new YAR_Validator();
		$validator->validate( [
			'email' => 'required|email',
		] );

		$email = $validator->get_param( 'email' );

		if ( empty( $this->user_service->get_by_email( $email ) ) ) {
			wp_send_json_error( yar_get_modal_message(
				'Такого пользователя не существует',
				'<a href="/forgot" class="modal-reset__btn btn btn--big btn--accent">Регистрация</a>'
			) );
		}

		if ( ! $this->code_service->get( $email ) ) {
			$code = $this->code_service->save( $email );

			if ( yar_plugin_is_app_type( 'local', '!=' ) ) {
				$send_code = $this->email_notifications->send(
					$email,
					'Код авторизации',
					'Ваш код авторизации: <strong>' . $code . '</strong>'
				);

				if ( is_wp_error( $send_code ) ) {
					wp_send_json_error( yar_get_modal_message(
						'Произошла ошибка',
						'Пожалуйста, обратитесь к администратору сайта'
					) );
				}
			}

			ob_start();
			load_template( YAR_PROFILE_TEMPLATES . '/modals/code.php' );
			$template = ob_get_clean();

			$this->session_service->add( 'user_data', $validator->validated() );

			// TODO: В будущем вернуть регистрацию / восстановление пароля через СМС
//			$sms = ( new YAR_SMS_Service() )->send( $phone, $this->code_service->save( $phone ) );
//
//			if ( is_wp_error( $sms ) ) {
//				wp_send_json_error( yar_get_modal_message(
//					'Произошла ошибка',
//					'Пожалуйста, обратитесь к администратору сайта'
//				) );
//			}

			$send_data = [
				'code_popup' => $template,
			];

			if ( yar_plugin_is_app_type( 'local' ) ) {
				$send_data['code'] = $code;
			}

			wp_send_json_success( $send_data );
		}

		wp_send_json_error( yar_get_modal_message(
			'Произошла ошибка',
			'Пожалуйста, обратитесь к администратору сайта'
		) );


		wp_die();
	}

	public function repeat_code() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_auth_confirm_code' ) ) {
			wp_send_json_error();
		}

		$data = $this->session_service->get( 'user_data' );
		if ( ! isset( $data['email'] ) ) {
			wp_send_json_error( yar_get_modal_message(
					'Произошла ошибка',
					'Пожалуйста, обратитесь к администратору сайта'
				)
			);
		}

		$email = $data['email'];

		$this->code_service->remove( $email );
		$code = $this->code_service->save( $email );

		if ( yar_plugin_is_app_type( 'local', '!=' ) ) {
			$send_code = $this->email_notifications->send(
				$email,
				'Код авторизации',
				'Ваш код авторизации: <strong>' . $code . '</strong>'
			);

			if ( is_wp_error( $send_code ) ) {
				wp_send_json_error( yar_get_modal_message(
					'Произошла ошибка',
					'Пожалуйста, обратитесь к администратору сайта'
				) );
			}
		}

		$send_data = [];
		if ( yar_plugin_is_app_type( 'local' ) ) {
			$send_data['code'] = $code;
		}

//		$sms = ( new YAR_SMS_Service() )->send( $email, $this->code_service->save( $phone ) );
//		if ( is_wp_error( $sms ) ) {
//			wp_send_json_error( yar_get_modal_message(
//					'Произошла ошибка',
//					'Пожалуйста, обратитесь к администратору сайта'
//				)
//			);
//		}

		wp_send_json_success( $send_data );
	}

	public function confirm_code() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_auth_confirm_code' ) ) {
			wp_send_json_error();
		}

		$validator = new YAR_Validator();
		$validator->validate( [
			'code' => 'required|min:4|max:4'
		] );

		$code = $validator->get_param( 'code' );
		$data = $this->session_service->get( 'user_data' );

		$email = $data['email'];

		if ( ! $this->code_service->compare( $email, $code ) ) {
			wp_send_json_error( [
				'errors' => [
					'code' => [ 'Введенный код неверный' ]
				]
			] );
		}

		$user = $this->user_service->get_by_email( $email );
		$key  = get_password_reset_key( $user );

		if ( is_wp_error( $key ) ) {
			wp_send_json_error( yar_get_modal_message(
					'Произошла ошибка',
					'Пожалуйста, обратитесь к администратору сайта'
				)
			);
		}

		$this->code_service->remove( $email );

		wp_send_json_success( [
			'key' => $key
		] );

		wp_die();
	}

	public function save() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_auth_forgot_password_save' ) ) {
			wp_send_json_error();
		}

		$reset_key = $_POST['reset_key'];
		if ( empty( $reset_key ) ) {
			wp_send_json_error( yar_get_modal_message(
					'Произошла ошибка',
					'Пожалуйста, обратитесь к администратору сайта'
				)
			);
		}

		$validator = new YAR_Validator();
		$validator->validate( [
			'password'           => 'required|min:6|has:numbers,symbols',
			'password_confirmed' => 'required|confirmed',
		] );

		$data = $this->session_service->get( 'user_data' );
		$user = $this->user_service->get_by_email( $data['email'] );
		if ( empty( $data ) || empty( $user ) ) {
			wp_send_json_error( yar_get_modal_message(
					'Произошла ошибка',
					'Пожалуйста, обратитесь к администратору сайта'
				)
			);
		}

		$is_ok = check_password_reset_key( $reset_key, $user->user_login );
		if ( is_wp_error( $is_ok ) ) {
			wp_send_json_error( yar_get_modal_message(
					'Произошла ошибка',
					'Пожалуйста, обратитесь к администратору сайта'
				)
			);
		}

		$this->session_service->remove( 'user_data' );

		wp_set_password( $validator->get_param( 'password' ), $user->ID );

		wp_send_json_success( yar_get_modal_message(
			'Вы успешно сменили пароль',
			'Через несколько секунд вы будете перенаправлены на страницу входа'
		) );

		wp_die();
	}
}