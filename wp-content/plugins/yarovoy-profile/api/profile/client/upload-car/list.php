<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/client/upload-car/list', [
	'methods'  => 'GET',
	'callback' => function () {
		return ( new YAR_Car_Public_Repository() )->list();
	},

	'permission_callback' => 'yar_api_is_client'
] );
