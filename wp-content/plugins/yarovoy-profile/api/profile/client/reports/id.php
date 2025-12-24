<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/client/report/(?P<id>\d+)', [
	'methods'  => 'GET',
	'callback' => function ( WP_REST_Request $request ) {
		$report_id = $request->get_param( 'id' );
		$post_id   = yar_check_report_id( $report_id );
		if ( ! $post_id || ! yar_check_report_status( $post_id ) ) {
			return yar_get_api_error_message( 'report_edit_error', 'Отчет не найден', 404 );
		}

		return yar_get_api_format_data( ( new YAR_Report_Get_Id_Repository() )->get_single( $report_id ) );
	},

	'permission_callback' => 'yar_api_is_client'
] );