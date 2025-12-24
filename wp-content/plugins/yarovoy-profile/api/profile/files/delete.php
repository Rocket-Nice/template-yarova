<?php

use YAR_Profile\Services\Api\YAR_Files_Api_Service;

register_rest_route( YAR_API_NAMESPACE, '/profile/files', [
	'methods'  => 'DELETE',
	'args'     => yar_rest_api_files_delete_args(),
	'callback' => 'yar_rest_api_files_delete_callback',

	'permission_callback' => 'yar_is_logged_in',
] );

function yar_rest_api_files_delete_args() {
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

function yar_rest_api_files_delete_callback( $request ) {
	$delete = ( new YAR_Files_Api_Service() )->delete( $request );

	if ( is_wp_error( $delete ) ){
		return $delete;
	}

	return yar_get_api_format_data( [
		'success' => true
	] );
}
