<?php

use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Services\YAR_Update_Profile_Service;

register_rest_route( YAR_API_NAMESPACE, '/profile/settings', [
	'methods'             => 'GET',
	'callback'            => function () {
		return yar_get_api_format_data( ( new YAR_User_Repository() )->get_current_user() );
	},
	'permission_callback' => 'yar_is_logged_in',
] );

register_rest_route( YAR_API_NAMESPACE, '/profile/settings', [
	'methods'  => 'PATCH',
	'args'     => yar_rest_api_profile_settings_args(),
	'callback' => 'yar_rest_api_profile_settings_callback',

	'permission_callback' => 'yar_is_logged_in',
] );

function yar_rest_api_profile_settings_args() {
	$args = [];

	$args['surname'] = [
		'type'    => 'string',
		'default' => ''
	];

	$args['first_name'] = [
		'type'     => 'string',
		'required' => true,
	];

	$args['last_name'] = [
		'type'     => 'string',
		'required' => true,
	];

	$args['phone'] = [
		'type'              => 'string',
		'required'          => true,
		'sanitize_callback' => function ( $phone ) {
			return yar_reset_phone( $phone );
		}
	];

	if ( yar_is_client() ) {
		// TODO: В будущем добавить уведомления
	}

	if ( yar_is_expert() ) {
		$args['region'] = [
			'type'              => 'integer',
			'required'          => true,
			'validate_callback' => function ( $value ) {
				if ( empty( $value ) ) {
					return false;
				}

				return true;
			}
		];

		$args['about'] = [
			'type'              => 'string',
			'required'          => true,
			'validate_callback' => function ( $value ) {
				if ( empty( $value ) ) {
					return false;
				}

				return true;
			}
		];
	}

	return $args;
}

function yar_rest_api_profile_get_data( WP_REST_Request $request ) {
	$data = [
		'first_name' => $request->get_param( 'first_name' ),
		'last_name'  => $request->get_param( 'last_name' ),
		'surname'    => $request->get_param( 'surname' ),
		'phone'      => $request->get_param( 'phone' ),
	];

	$files = $request->get_file_params();

	if ( ! empty( $files['avatar'] ) ) {
		$data['avatar'] = $files['avatar'];
	}

	if ( yar_is_client() ) {
		// TODO: В будущем добавить уведомления
	}

	if ( yar_is_expert() ) {
		if ( ! empty( $files['documents'] ) ) {
			$data['documents'] = $files['documents'];
		}

		if ( ! empty( $files['portfolio'] ) ) {
			$data['portfolio'] = $files['portfolio'];
		}

		$data['services'] = $request->get_param( 'services' ) ?: [];
		$data['region']   = $request->get_param( 'region' );
		$data['about']    = $request->get_param( 'about' );
	}

	return $data;
}

function yar_rest_api_profile_settings_callback( WP_REST_Request $request ) {
	$user = new YAR_User();

	if ( ! $user->check_user_phone( $request->get_param( 'phone' ) ) ) {
		return yar_get_api_error_message( 'user_exist', 'Такой пользователь уже зарегистрирован' );
	}

	$data   = yar_rest_api_profile_get_data( $request );
	$update = ( new YAR_Update_Profile_Service() )->update( $data );

	if ( is_wp_error( $update ) ) {
		return yar_get_api_error_message( 'user_update_error', 'Произошла ошибка при сохранении пользователя' );
	}

	return yar_get_api_format_data( ( new YAR_User_Repository() )->get_current_user() );
}