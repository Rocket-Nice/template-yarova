<?php

use YAR_Profile\Helpers\YAR_Codes;
use YAR_Profile\Helpers\YAR_Session;
use YAR_Profile\Helpers\YAR_User;

register_rest_route( YAR_API_NAMESPACE, '/reset/save-password', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_reset_save_password_args(),
	'callback' => 'yar_rest_api_reset_save_password_callback',

	'permission_callback' => '__return_true'
] );

function yar_rest_api_reset_save_password_args() {
	$args = [];

	$args['key'] = [
		'required' => true,
		'type'     => 'string',
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

	return $args;
}

function yar_rest_api_reset_save_password_callback( WP_REST_Request $request ) {
	$session = new YAR_Session();
	$data    = $session->get( 'api_user_data' );

	if ( empty( $data ) ) {
		return yar_get_api_error_message( 'user_error', 'Произошла ошибка' );
	}

	$user = ( new YAR_User() )->get_by_email( $data['email'] );
	if ( empty( $data ) ) {
		return yar_get_api_error_message( 'user_error', 'Произошла ошибка' );
	}

	$check_key = check_password_reset_key( $request->get_param( 'key' ), $user->user_login );
	if ( is_wp_error( $check_key ) ) {
		return yar_get_api_error_message( 'user_error', 'Произошла ошибка' );
	}

	$session->remove( 'api_user_data' );
	wp_set_password( $request->get_param( 'password' ), $user->ID );

	return [
		'success' => true
	];
}