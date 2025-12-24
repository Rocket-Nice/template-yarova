<?php

use YAR_Profile\Services\Api\YAR_Files_Api_Service;

register_rest_route( YAR_API_NAMESPACE, '/profile/files', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_files_args(),
	'callback' => 'yar_rest_api_files_callback',

	'permission_callback' => 'yar_is_logged_in',
] );

function yar_rest_api_files_args() {
	$args = [];

	$args['type'] = [
		'type'     => 'string',
		'required' => true
	];

	$args['id'] = [
		'type'    => 'integer',
		'default' => 0
	];

	return $args;
}

function yar_rest_api_files_callback( WP_REST_Request $request ) {
	$save = ( new YAR_Files_Api_Service() )->save(
		$request->get_file_params(),
		$request->get_param( 'type' ),
		$request->get_param( 'id' )
	);

	if ( is_wp_error( $save ) ){
		return $save;
	}

	return yar_get_api_format_data( [
		'success' => true
	] );
}
