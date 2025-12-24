<?php


use YAR_Profile\Helpers\YAR_Codes;
use YAR_Profile\Helpers\YAR_Session;
use YAR_Profile\Helpers\YAR_User;

register_rest_route( YAR_API_NAMESPACE, '/profile/expert/report', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_save_report_args(),
	'callback' => 'yar_rest_api_save_report_callback',

	'permission_callback' => 'yar_api_is_expert'
] );

function yar_rest_api_save_report_args() {
	$args = [];

//	// Owners data
//	$args['owners_fio'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['owners_phone'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	// Features
//	$args['features_vin'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_brand'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_model'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_year'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_generation'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_body'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_gos_number'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_sts'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_engine_type'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_modification'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_pts_type'] = [
//		'required' => true,
//		'type'     => 'integer'
//	];
//
//	$args['features_pts_number'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_color'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['features_mileage'] = [
//		'required' => true,
//		'type'     => 'string'
//	];

	$args['body_inspection'] = [
		'required' => true,
		'type'     => 'string',
		'validate_callback' => function( $inspection ){
			$inspection = json_decode( stripslashes( $inspection ), true );

			if ( empty( $inspection[ 'fields' ] ) ){
				return false;
			}

			foreach ( $inspection['fields'] as $name => $field ) {
				if ( (int) $field['status'] === 0 ){
					$return[ $name ] = 'Это поле является обязательным';
				}
			}

			if ( ! empty( $return ) ){
				return new WP_Error( 'rest_invalid_param', 'Неверный параметр: body_inspection', [
					'status' => 400,
					'params' => $return
				] );
			}

			return true;
		},
	];

//	$args['last_name'] = [
//		'required' => true,
//		'type'     => 'string'
//	];
//
//	$args['surname'] = [
//		'default' => '',
//		'type'    => 'string'
//	];
//
//	$args['password'] = [
//		'required'          => true,
//		'type'              => 'string',
//		'validate_callback' => function ( $value ) {
//			$validate = yar_api_validate_password( $value );
//			if ( empty( $validate ) ) {
//				return true;
//			}
//
//			return yar_get_api_error_message( 'password_invalid', $validate );
//		},
//	];
//
//	$args['password_confirmed'] = [
//		'required'          => true,
//		'type'              => 'string',
//		'validate_callback' => function ( $value, $request ) {
//			$password = $request->get_param( 'password' );
//
//			if ( $password === $value ) {
//				return true;
//			}
//
//			return false;
//		},
//	];
//
//	$args['email'] = [
//		'required'          => true,
//		'type'              => 'string',
//		'format'            => 'email',
//	];
//
//	$args['phone'] = [
//		'required'          => true,
//		'type'              => 'string',
//		'sanitize_callback' => function ( $phone ) {
//			return yar_reset_phone( $phone );
//		}
//	];

	return $args;
}

function yar_rest_api_save_report_callback( WP_REST_Request $request ) {

}

function kama_validate_params( $value, WP_REST_Request $request, $param ) {

//	$attributes = $request->get_attributes();
//
//	$param_attr = & $attributes['args'][ $param ];
//	//yar_dd_json( $param );
//	//yar_dd_json( $param_attr );
//	//yar_dd_json( $value );
//	//yar_dd_json( $param_attr );
//
//	$params = $request->get_params();
//
//	$errors = [];
//	foreach ( $param_attr['properties'] as $key => $property ) {
//		if ( isset( $params[ $param ][ $key ] ) ) {
//			if ( empty( $property['status'] ) ) {
//				$errors[ $key ] = 'Ошибка';
//			}
//		}
//	}
//
//	if ( ! empty( $errors ) ){
//		return new WP_Error( 'rest_invalid_param',
//			sprintf( esc_html__('%s is not of type %s','dom'), $param, $param_attr ),
//			array( 'status' => 400 )
//		);
//	}

//	// передан параметр из схемы
//	if ( isset( $attributes['args'][ $param ] ) ) {
//		// убедимся что значение параметра является нужным типом (строкой, чилом)
//		if (
//			( 'string' === $param_attr['type'] && ! is_string( $value ) )
//			||
//			( 'integer' === $param_attr['type'] && ! is_numeric( $value ) )
//		) {
//			return new WP_Error( 'rest_invalid_param',
//				sprintf( esc_html__('%s is not of type %s','dom'), $param, $param_attr ),
//				array( 'status' => 400 )
//			);
//		}
//	}
//	// передан неизвестный параметр
//	else {
//		return new WP_Error( 'rest_invalid_param',
//			sprintf( esc_html__('%s was not registered as a request argument.','dom'), $param ),
//			array( 'status' => 400 )
//		);
//	}

	// ели мы дошли до сюда, значит данные прошили проверку
	return true;
}


// Регистрация эндпоинта
add_action( 'rest_api_init', function () {
	register_rest_route( 'my_namespace/v1', '/example', [
		'methods'  => 'GET',
		'callback' => 'my_example_callback',
		'args'     => [
			'id' => [
				'required'    => true,
				'type'        => 'integer',
				'description' => 'The ID of the resource',
			],
		],
	] );
} );

// Callback-функция эндпоинта
function my_example_callback( $request ) {
	$id = $request['id'];

	return new WP_REST_Response( [ 'message' => 'Success', 'id' => $id ], 200 );
}

// Перехват и изменение формата ошибки rest_missing_callback_param
add_filter( 'rest_request_before_callbacks', function ( $response, $handler, $request ) {
	// Проверяем, является ли ответ ошибкой WP_Error
	if ( is_wp_error( $response ) ) {
		$error_data = $response->get_error_data();
		// Проверяем, что ошибка именно rest_missing_callback_param
		if ( $response->get_error_code() === 'rest_missing_callback_param' ) {
			$params          = $error_data['params'] ?? [];
			$custom_response = [
				'error' => [
					'code'    => 'missing_param',
					'message' => sprintf( 'Required parameter "%s" is missing', implode( ', ', $params ) ),
					'status'  => 400,
				],
			];

			// Возвращаем новый WP_REST_Response с кастомным форматом
			return new WP_REST_Response( $custom_response, 400 );
		}
	}

	return $response;
}, 10, 3 );
