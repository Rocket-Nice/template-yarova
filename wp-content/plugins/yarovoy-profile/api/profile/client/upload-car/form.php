<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/client/upload-car/form', [
	'methods'  => 'GET',
	'callback' => function () {
		return ( new YAR_Car_Fields_Repository() )->get_steps();

//		$step_key = 'main';
//
//		if ( $request->get_param( 'step' ) ) {
//			$step_key = $request->get_param( 'step' );
//		}
//
//		$repository = new YAR_Car_Repository();
//		$step       = $repository->get_step( $step_key );
//
//		if ( ! $step ) {
//			return new WP_Error( 'step_error', '' );
//		}
//
//		return [
//			'data'          => $step,
//			'next_step_key' => $repository->get_next_step( $step_key ),
//			'prev_step_key' => $repository->get_prev_step( $step_key ),
//		];
	},

	'permission_callback' => 'yar_api_is_client',
] );