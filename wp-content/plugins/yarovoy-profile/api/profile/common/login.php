<?php

use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Services\Api\YAR_Login_Api_Service;

register_rest_route( YAR_API_NAMESPACE, '/login', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_login_args(),
	'callback' => 'yar_rest_api_login_callback',
] );

function yar_rest_api_login_args() {
	$args['phone'] = [
		'required'          => true,
		'sanitize_callback' => function ( $phone ) {
			return yar_reset_phone( $phone );
		}
	];

	$args['password'] = [
		'required' => true,
	];

	return $args;
}

function yar_rest_api_login_callback( WP_REST_Request $request ) {
	$phone = $request->get_param( 'phone' );
	if ( empty( ( new YAR_User() )->get_by_phone( $phone ) ) ) {
		return yar_get_api_error_message( 'error_user_not_exists', 'Такого пользователя не найдено' );
	}

	return ( new YAR_Login_Api_Service() )->auth(
		$request->get_param( 'phone' ),
		$request->get_param( 'password' )
	);
}
