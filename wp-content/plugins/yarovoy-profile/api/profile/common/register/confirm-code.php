<?php

use YAR_Profile\Helpers\YAR_Codes;
use YAR_Profile\Helpers\YAR_Session;
use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Services\Api\YAR_Login_Api_Service;
use YAR_Profile\Services\YAR_Register_Service;

register_rest_route( YAR_API_NAMESPACE, '/register/confirm-code', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_confirm_code_args(),
	'callback' => 'yar_rest_api_confirm_code_callback',

	'permission_callback' => '__return_true'
] );

function yar_rest_api_confirm_code_args(){
	$args = [];

	$args['code'] = [
		'required' => true,
		'type'     => 'integer',
		'minimum'  => 1000,
		'maximum'  => 9999,
	];

	return $args;
}

function yar_rest_api_confirm_code_callback( WP_REST_Request $request ) {
	$session = new YAR_Session();
	$data    = $session->get( 'api_user_data' );

	if ( empty( $data ) ) {
		return yar_get_api_error_message( 'user_data_error', 'Произошла ошибка' );
	}

	if ( ! empty( $data ) && ! empty( $data['email'] ) ) {
		if ( ( new YAR_Codes() )->compare( $data['email'], $request->get_param( 'code' ) ) ) {
			$register = ( new YAR_Register_Service() )->register( $data );
			if ( is_wp_error( $register ) ) {
				return $register;
			}

			$session->remove( 'api_user_data' );

			return ( new YAR_Login_Api_Service() )->auth(
				$data['phone'],
				$data['password']
			);
		}
	}

	return yar_get_api_error_message( 'code_error', 'Введенный код неверный' );
}