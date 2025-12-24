<?php

use YAR_Profile\Helpers\YAR_Codes;
use YAR_Profile\Helpers\YAR_Session;
use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Helpers\YAR_Validator;
use YAR_Profile\Services\YAR_Email_Notifications_Service;
use YAR_Profile\Services\YAR_Register_Service;
use YAR_Profile\Services\YAR_SMS_Service;

/**
 * Class YAR_Register
 */
class YAR_Register {
	private $user;
	private $validator;
	private $session;
	private $codes;
	private $email_notifications;

	public function __construct() {
		$this->user                = new YAR_User();
		$this->validator           = new YAR_Validator();
		$this->session             = new YAR_Session();
		$this->codes               = new YAR_Codes();
		$this->email_notifications = new YAR_Email_Notifications_Service();

		add_action( 'wp_ajax_yar_profile_registration', [ $this, 'get_code' ] );
		add_action( 'wp_ajax_nopriv_yar_profile_registration', [ $this, 'get_code' ] );

		add_action( 'wp_ajax_yar_profile_confirm_code', [ $this, 'confirm_code' ] );
		add_action( 'wp_ajax_nopriv_yar_profile_confirm_code', [ $this, 'confirm_code' ] );

		add_action( 'wp_ajax_yar_profile_repeat_code', [ $this, 'repeat_code' ] );
		add_action( 'wp_ajax_nopriv_yar_profile_repeat_code', [ $this, 'repeat_code' ] );
	}

	public function get_code() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_auth_get_code' ) ) {
			wp_send_json_error();
		}

		$this->validator->validate( [
			'phone'              => 'required|min:11|max:11',
			'email'              => 'required|email',
			'first_name'         => 'required',
			'last_name'          => 'required',
			'surname'            => '',
			'password'           => 'required|min:6|has:numbers,symbols',
			'password_confirmed' => 'required|confirmed',
			'is_expert'          => ''
		] );

		$phone = $this->validator->get_param( 'phone' );
		$email = $this->validator->get_param( 'email' );

		if ( ! empty( $this->user->get_by_phone( $phone ) ) || email_exists( $email ) ) {
			wp_send_json_error( yar_get_modal_message(
				'Такой пользователь уже зарегистрирован',
				'<a href="/login">Войти</a> или <a href="/forgot">Восстановить пароль</a>'
			) );
		}

		if ( ! isset( $_POST['code'] ) ) {
			$this->codes->remove( $email );
		}

		if ( ! $this->codes->get( $email ) ) {
			$code = $this->codes->save( $email );

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

			$this->session->add( 'user_data', $this->validator->validated() );

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

	public function confirm_code() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_auth_confirm_code' ) ) {
			wp_send_json_error();
		}

		$this->validator->validate( [
			'code' => 'required|min:4|max:4'
		] );

		$code = $this->validator->get_param( 'code' );
		$data = $this->session->get( 'user_data' );

		$phone = $data['phone'];
		$email = $data['email'];

		if ( ! $this->codes->compare( $email, $code ) ) {
			wp_send_json_error( [
				'errors' => [
					'code' => [ 'Введенный код неверный' ]
				]
			] );
		}

		if ( ! empty( $this->user->get_by_phone( $phone ) ) || email_exists( $email ) ) {
			wp_send_json_error( yar_get_modal_message(
				'Такой пользователь уже зарегистрирован',
				'<a href="/login">Войти</a> или <a href="/forgot">Восстановить пароль</a>'
			) );
		}

		$user_id = ( new YAR_Register_Service() )->register( $data );

		if ( is_wp_error( $user_id ) ) {
			wp_send_json_error( yar_get_modal_message(
				'Произошла ошибка',
				'Пожалуйста, обратитесь к администратору сайта'
			) );
		}

		$this->codes->remove( $email );

		nocache_headers();
		wp_clear_auth_cookie();
		wp_set_auth_cookie( $user_id );

		wp_send_json_success( array_merge(
			yar_get_modal_message(
				'Вы успешно зарегистрировались',
				'Через несколько секунды вы будете перенаправлены на профиль'
			),
			[ 'redirect' => '/profile/', ]
		) );
	}

	public function repeat_code() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_auth_confirm_code' ) ) {
			wp_send_json_error();
		}

		$data = $this->session->get( 'user_data' );
		if ( ! isset( $data['phone'] ) ) {
			wp_send_json_error( yar_get_modal_message(
					'Произошла ошибка',
					'Пожалуйста, обратитесь к администратору сайта'
				)
			);
		}

		$email = $data['email'];

		$this->codes->remove( $email );
		$code      = $this->codes->save( $email );

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

		wp_send_json_success( $send_data );
	}

}