<?php

register_rest_route( YAR_API_NAMESPACE, '/expert', [
	'methods'  => 'GET',
	'callback' => function () {
		return yar_get_api_format_data(
			( new YAR_Expert_Repository() )->get_list()
		);
	},

	'permission_callback' => '__return_true'
] );