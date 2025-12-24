<?php

use YAR_Profile\Services\YAR_Expert_Moderate_Report_Service;

register_rest_route( YAR_API_NAMESPACE, '/profile/expert/report/moderate/(?P<id>\d+)', [
	'methods'  => 'POST',
	'args'     => yar_rest_api_expert_moderate_save_args(),
	'callback' => 'yar_rest_api_expert_moderate_save_callback',

	'permission_callback' => 'yar_api_is_expert',
] );

function yar_rest_api_expert_moderate_save_args() {
	$args = [];

	$args['contract_id'] = [
		'type' => 'integer',
	];

	$args['action'] = [
		'type' => 'string',
	];

	return $args;
}

function yar_rest_api_expert_moderate_save_callback( WP_REST_Request $request ) {
	$report_id   = (int) $request->get_param( 'id' );
	$contract_id = (int) $request->get_param( 'contract_id' );

	$moderate_service = new YAR_Expert_Moderate_Report_Service();

	$save = $moderate_service->save(
		$report_id,
		$contract_id
	);

	if ( is_wp_error( $save ) ) {
		return yar_get_api_error_message( $save->get_error_code(), 'Произошла ошибка' );
	}

	return [
		'success' => true
	];
}