<?php

use YAR_Profile\Helpers\YAR_Codes;
use YAR_Profile\Helpers\YAR_Session;
use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Services\YAR_Email_Notifications_Service;

register_rest_route( YAR_API_NAMESPACE, '/reset/get-code', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_reset_get_code_args(),
	'callback' => 'yar_rest_api_reset_get_code_callback',

	'permission_callback' => '__return_true'
] );

function yar_rest_api_reset_get_code_args() {
	$args = [];

	$args['email'] = [
		'required' => true,
		'type'     => 'string'
	];

	return $args;
}

function yar_rest_api_reset_get_code_callback( WP_REST_Request $request ) {
	$email = $request->get_param( 'email' );

	if ( ! email_exists( $email ) ) {
		return yar_get_api_error_message( 'user_not_exist', 'Такой пользователь не найден' );
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
			'Ваш код восстановления пароля: <strong>' . $code . '</strong>'
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
