<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/client/contracts', [
	'methods'  => 'GET',
	'callback' => function () {
		return yar_get_api_format_data( [
			'items' => ( new YAR_Contracts_Repository() )->get()
		] );
	},

	'permission_callback' => 'yar_api_is_client'
] );
