<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/client/upload-car/item/(?P<id>\d+)', [
	'methods'  => 'GET',
	'args'     => [
		'id' => [
			'required'          => true,
			'validate_callback' => function ( $value ) {
				$repository = new YAR_Car_Repository();
				$post_id    = $repository->get_post_id( ( int ) $value );

				if ( yar_check_car_user( $post_id ) ) {
					return true;
				}

				return yar_get_api_error_message( 'report_exists', 'Автомобиль не найден' );
			}
		],
	],
	'callback' => function ( WP_REST_Request $request ) {
		$data = ( new YAR_Car_Repository() )->get_car(
			(int) $request->get_param( 'id' )
		);

		if ( ! empty( $data['gallery'] ) ) {
			foreach ( $data['gallery'] as $key => $datum ) {
				$data['gallery'][ $key ] = yar_get_file_url( $datum );
			}
		}

		return $data;
	},

	'permission_callback' => 'yar_api_is_client'
] );
