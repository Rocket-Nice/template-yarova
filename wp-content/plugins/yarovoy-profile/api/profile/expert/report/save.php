<?php

use YAR_Profile\Services\YAR_Expert_Save_Report_Service;

register_rest_route( YAR_API_NAMESPACE, '/profile/expert/report', [
	'methods'  => 'POST',
	'args'     => [],
	'callback' => 'yar_rest_api_save_report_callback',

	'permission_callback' => 'yar_api_is_expert'
] );

register_rest_route( YAR_API_NAMESPACE, '/profile/expert/report/(?P<id>\d+)', [
	'methods'  => 'PATCH',
	'args'     => [],
	'callback' => 'yar_rest_api_edit_report_callback',

	'permission_callback' => 'yar_api_is_expert'
] );


register_rest_route( YAR_API_NAMESPACE, '/profile/expert/report/validate', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_save_report_args(),
	'callback' => 'yar_rest_api_validate_report_callback',

	'permission_callback' => 'yar_api_is_expert'
] );

function yar_rest_api_save_report_args() {
	$args   = [];
	$steps  = ( new YAR_Report_Fields_Repository() )->get_steps();

	$_step  = ( isset( $_GET['step'] ) ? $_GET['step'] : '' );
	$step   = ( isset($_step ) && isset( $steps[ $_step ] ) ? $steps[ $_step ] : [] );
	$fields = ! empty( $step ) && ! empty( $step['fields'] ) ? $step['fields'] : [];

	if ( ! empty( $fields ) && ! empty( $step ) ) {
		foreach ( $fields as $field ) {
			if ( $step['type'] === 'fields' ) {
				$args[ $field['name'] ] = [
					//'type'              => $field['type'] === 'number' ? 'number' : 'string',
					'subtype'           => 'string',
					'type_field'        => $field['type'] === 'number' ? 'number' : 'string',
					'is_required'       => true,
					'default'           => '',
					'validate_callback' => 'yar_api_validate_report_fields'
				];
			}
		}
	}

	if ( ! empty( $step ) ) {
		if ( $step['type'] === 'inspection' || $step['type'] === 'inspection-values' ) {
			$args[ $_step ] = [
				//'type'              => 'object',
				'subtype'           => 'object',
				'default'           => '{}',
				'validate_callback' => 'yar_api_validate_report_fields',
			];
		}
	}

	return $args;
}

function yar_api_validate_report_fields( $value, $request, $param ) {
	$attributes     = $request->get_attributes();
	$param_attr     = &$attributes['args'][ $param ];

	$errors     = [];
	$repository = new YAR_Report_Fields_Repository();

	if (
		$param_attr['subtype'] === 'string'
		&& $param_attr['is_required']
	){
		if ( isset( $param_attr['type_field'] ) ){
			if ( $param_attr['type_field'] === 'string' && empty( $value ) ){
				$errors[ $param ] = 'Это поле является обязательным';
			}

			if ( $param_attr['type_field'] === 'number' && $value == '' ){
				$errors[ $param ] = 'Это поле является обязательным';
			}
		} elseif( empty( $value ) ) {
			$errors[ $param ] = 'Это поле является обязательным';
		}
	}

	// Вариант 1
	if ( $param_attr['subtype'] === 'object' ) {
		if ( ! is_array( $value ) ){
			$value = json_decode( stripslashes( $value ), true );
		}

		if ( empty( $value ) ) {
			$step = $repository->get_step( $param );
			if ( ! empty( $step ) && ! empty( $step['fields'] ) ) {
				foreach ( $step['fields'] as $field ) {
					$value['fields'][ $field['name'] ] = [
						'status' => 0
					];
				}
			}
		}

		if ( ! empty( $value ) ){
			foreach ( $value['fields'] as $key => $item ) {
				if ( empty( $item['status'] ) ){
					$errors[ $key ] = 'Это поле является обязательным';
				}
			}
		}
	}

	if ( ! empty( $errors ) ) {
		return new WP_Error( 'rest_invalid_param', 'Это поле является обязательным', [
			'status' => 400,
			'errors' => $errors
		] );
	}

	return true;
}

function yar_rest_api_validate_report_callback( WP_REST_Request $request ) {
	return [
		'success' => true
	];
}

add_filter( 'rest_request_before_callbacks', 'yar_api_report_rest_request_before_callbacks', 99, 3 );
function yar_api_report_rest_request_before_callbacks( $response, $handler, $request ){
	if ( is_wp_error( $response ) ) {
		if ( $handler['callback'] === 'yar_rest_api_validate_report_callback' ) {
			$step   = $request->get_param( 'step' );
			$args   = $step && isset( $handler['args'][ $step ] ) ? $handler['args'][ $step ] : [];
			$data   = $response->get_error_data();
			$errors = ! empty( $data['details'][ $step ]['data']['errors'] ) ? $data['details'][ $step ]['data']['errors'] : [];

			if (
				! empty( $args )
				&& isset( $args['subtype'] )
				&& $args['subtype'] === 'object'
				&& ! empty( $errors )
			) {
				$keys = array_keys( $errors );

				return new WP_Error( 'rest_invalid_param', 'Неверный параметр: ' . implode( ', ', $keys ), [
					'status' => 400,
					'params' => $errors
				] );
			}
		}
	}

	return $response;
}

function yar_rest_api_save_report_callback( WP_REST_Request $request ) {
	return yar_get_api_format_data( ( new YAR_Expert_Save_Report_Service() )->save( $request->get_params() ) );
}

function yar_rest_api_edit_report_callback( WP_REST_Request $request ) {
	return yar_get_api_format_data( ( new YAR_Expert_Save_Report_Service() )->save( $request->get_params(), 'edit', $request->get_param( 'id' ) ) );
}