<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/expert/report/(?P<id>\d+)', [
	'methods'             => 'GET',
	'args'                => [
		'id' => [
			'type' => 'integer',
		]
	],
	'callback'            => 'yar_rest_api_profile_expert_report_edit_form_callback',
	'permission_callback' => 'yar_api_is_expert'
] );

function yar_rest_api_profile_expert_report_edit_form_callback( WP_REST_Request $request ) {
	$report_id = $request->get_param( 'id' );
	$post_id   = yar_check_report_id( $report_id );
	if ( ! $post_id || ! yar_check_report_status( $post_id ) ) {
		return yar_get_api_error_message( 'report_edit_error', 'Ошибка редактирования отчета' );
	}

	$report_repository = new YAR_Report_Repository();

	$errors = $report_repository->get_errors( $post_id );
	$status = $report_repository->get_expert_status( $post_id );

	$steps = ( new YAR_Report_Fields_Repository() )->get_steps_filled( $report_id );

	return yar_get_api_format_data( [
		'report' => [
			'errors' => strip_tags( $errors ),
			'status' => $status
		],
		'steps'  => $steps,
	] );
}