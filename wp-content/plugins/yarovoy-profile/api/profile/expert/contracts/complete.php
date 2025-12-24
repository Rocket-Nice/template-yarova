<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/expert/contracts/complete/(?P<id>\d+)', [
	'methods'  => 'PATCH',
	'callback' => function ( WP_REST_Request $request ) {
		$id    = (int) $request->get_param( 'id' );
		$check = ( new YAR_Contracts_Repository() )->can_be_completed( $id );
		if ( ! $check ) {
			return yar_get_api_error_message( 'contract_error', 'Вы не можете завершить договор' );
		}

		update_field( 'status_expert', 'request_to_cancel', $id );

		return [
			'success' => true,
			'status'  => get_field( 'status_expert', $id )
		];
	},

	'permission_callback' => 'yar_api_is_expert'
] );
