<?php

register_rest_route( YAR_API_NAMESPACE, '/expert/(?P<id>.+)', [
	'methods'  => 'GET',
	'callback' => function ( WP_REST_Request $request ) {
		return yar_get_api_format_data(
			( new YAR_Expert_Repository() )->get_post( $request->get_param( 'id' ) )
		);
	},

	'permission_callback' => '__return_true'
] );