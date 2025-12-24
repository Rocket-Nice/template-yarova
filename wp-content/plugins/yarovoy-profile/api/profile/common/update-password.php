<?php

use YAR_Profile\Services\YAR_Update_Password_Service;

register_rest_route( YAR_API_NAMESPACE, '/profile/update-password', [
	'methods'             => 'PATCH',
	'args'                => yar_rest_api_profile_update_password_args(),
	'callback'            => 'yar_rest_api_profile_update_password_callback',
	'permission_callback' => 'yar_is_logged_in',
] );

function yar_rest_api_profile_update_password_args() {
	$args = [];

	$args['old_password'] = [
		'type'              => 'string',
		'required'          => true,
		'validate_callback' => function ( $value ) {
			$user = wp_get_current_user();
			if ( $user && wp_check_password( $value, $user->user_pass, $user->ID ) ) {
				return true;
			}

			return yar_get_api_error_message( 'old_password_not_confirmed', 'Старый пароль введен не верно' );
		}
	];

	$args['password'] = [
		'type'              => 'string',
		'required'          => true,
		'validate_callback' => function ( $value ) {
			$validate = yar_api_validate_password( $value );
			if ( empty( $validate ) ) {
				return true;
			}

			return yar_get_api_error_message( 'password_invalid', $validate );
		},
	];

	$args['password_confirmed'] = [
		'type'              => 'string',
		'required'          => true,
		'validate_callback' => function ( $confirmed, $request ) {
			$password = $request->get_param( 'password' );
			if ( $confirmed === $password ) {
				return true;
			}

			return yar_get_api_error_message( 'password_not_confirmed', 'Это поле должно совпадать с паролем' );
		}
	];

	return $args;
}

function yar_rest_api_profile_update_password_callback( WP_REST_Request $request ) {
	$update = ( new YAR_Update_Password_Service() )->update( $request->get_param( 'password' ) );
	if ( ! $update ) {
		return yar_get_api_error_message( 'password_error', 'Произошла ошибка' );
	}

	return [ 'success' => true ];
}