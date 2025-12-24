<?php

use YAR_Profile\Helpers\YAR_Codes;
use YAR_Profile\Helpers\YAR_Session;
use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Services\YAR_Email_Notifications_Service;

register_rest_route( YAR_API_NAMESPACE, '/register/get-code', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_get_code_args(),
	'callback' => 'yar_rest_api_get_code_callback',

	'permission_callback' => '__return_true'
] );

function yar_rest_api_get_code_args() {
	$args = [];

	$args['first_name'] = [
		'required' => true,
		'type'     => 'string'
	];

	$args['last_name'] = [
		'required' => true,
		'type'     => 'string'
	];

	$args['surname'] = [
		'default' => '',
		'type'    => 'string'
	];

	$args['password'] = [
		'required'          => true,
		'type'              => 'string',
		'validate_callback' => function ( $value ) {
			$validate = yar_api_validate_password( $value );
			if ( empty( $validate ) ) {
				return true;
			}

			return yar_get_api_error_message( 'password_invalid', $validate );
		},
	];

	$args['password_confirmed'] = [
		'required'          => true,
		'type'              => 'string',
		'validate_callback' => function ( $value, $request ) {
			$password = $request->get_param( 'password' );

			if ( $password === $value ) {
				return true;
			}

			return false;
		},
	];

	$args['email'] = [
		'required' => true,
		'type'     => 'string',
		'format'   => 'email',
	];

	$args['phone'] = [
		'required'          => true,
		'type'              => 'string',
		'sanitize_callback' => function ( $phone ) {
			return yar_reset_phone( $phone );
		}
	];

	$args['is_expert'] = [
		'type'    => 'boolean',
		'default' => false,
	];

	return $args;
}

function yar_rest_api_get_code_callback( WP_REST_Request $request ) {
	$phone = $request->get_param( 'phone' );
	$email = $request->get_param( 'email' );

	if ( email_exists( $email ) || ! empty( ( new YAR_User() )->get_by_phone( $phone ) ) ) {
		return yar_get_api_error_message( 'user_exist', 'Такой пользователь уже зарегистрирован' );
	}

	$code_service        = new YAR_Codes();
	$email_notifications = new YAR_Email_Notifications_Service();

	// Save to session
	( new YAR_Session() )->add( 'api_user_data', $request->get_params() );

	$code_service->remove( $email );
	$code = $code_service->save( $email );

	if ( yar_plugin_is_app_type( 'local', '!=' ) ) {
		$send_code = $email_notifications->send(
			$email,
			'Код авторизации',
			'Ваш код регистрации: <strong>' . $code . '</strong>'
		);

		if ( is_wp_error( $send_code ) ) {
			return yar_get_api_error_message( 'send_email_error', 'Произошла ошибка' );
		}
	}

	$data = [
		'success' => true,
	];

	if ( yar_plugin_is_app_type( 'local' ) ) {
		$data['code'] = $code;
	}

	return $data;
}
