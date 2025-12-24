<?php

register_rest_route( YAR_API_NAMESPACE, '/base/(?P<id>.+)', [
	'methods'  => 'GET',
	'callback' => function ( WP_REST_Request $request ) {
		$post = get_post( $request->get_param( 'id' ) );
		if ( empty( $post ) || $post->post_status !== 'publish' ){
			return [];
		}

		$car  = new YAR_Car_Public_Repository();
		$data = $car->get_single_car( $post->ID );

		return array_merge( [
			'ID'    => $post->ID,
			'title' => $post->post_title,
			'slug'  => $post->post_name,
		], $data );
	},

	'permission_callback' => '__return_true'
] );