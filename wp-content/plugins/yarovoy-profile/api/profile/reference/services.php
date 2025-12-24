<?php

register_rest_route( YAR_API_NAMESPACE, '/ref/services', [
	'methods'  => 'GET',
	'callback' => function () {
		return yar_get_api_format_data( [
			'items' => yar_get_select_options( 'service' )
		] );
	},

	'permission_callback' => 'yar_is_logged_in'
] );
