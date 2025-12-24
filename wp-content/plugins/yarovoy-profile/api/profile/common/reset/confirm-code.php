<?php

use YAR_Profile\Helpers\YAR_Codes;
use YAR_Profile\Helpers\YAR_Session;
use YAR_Profile\Helpers\YAR_User;

register_rest_route( YAR_API_NAMESPACE, '/reset/confirm-code', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_reset_confirm_code_args(),
	'callback' => 'yar_rest_api_reset_confirm_code_callback',

	'permission_callback' => '__return_true'
] );

function yar_rest_api_reset_confirm_code_args(){
	$args = [];

	$args['code'] = [
		'required' => true,
		'type'     => 'integer',
		'minimum'  => 1000,
		'maximum'  => 9999,
	];

	return $args;
}

function yar_rest_api_reset_confirm_code_callback( WP_REST_Request $request ) {
	$session = new YAR_Session();
	$data    = $session->get( 'api_user_data' );

	if ( empty( $data ) ) {
		return yar_get_api_error_message( 'user_data_error', 'Произошла ошибка' );
	}

	if ( ! empty( $data ) && ! empty( $data['email'] ) ) {
		if ( ( new YAR_Codes() )->compare( $data['email'], $request->get_param( 'code' ) ) ) {
			$user = ( new YAR_User() )->get_by_email( $data['email'] );
			if ( empty( $user ) ) {
				return yar_get_api_error_message( 'user_not_exist', 'Такой пользователь не найден' );
			}

			( new YAR_Codes() )->remove( $data['email'] );
			$key = get_password_reset_key( $user );

			if ( is_wp_error( $key ) ) {
				return yar_get_api_error_message( 'key_error', 'Произошла ошибка' );
			}

			return yar_get_api_format_data( [
				'key' => $key
			] );
		}
	}

	return yar_get_api_error_message( 'code_error', 'Введенный код неверный' );
}