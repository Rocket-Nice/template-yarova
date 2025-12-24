<?php

register_rest_route( YAR_API_NAMESPACE, '/ref/bmg', [
	'methods'  => 'GET',
	'callback' => function ( WP_REST_Request $request ) {
		$id = $request->get_param( 'id' );
		if ( ! $id ) {
			return [];
		}

		return yar_get_api_format_data( [
			'items' => ( new YAR_Car_Fields_Repository() )->fill_select( $id )
		] );
	},

	'permission_callback' => 'yar_api_is_client'
] );