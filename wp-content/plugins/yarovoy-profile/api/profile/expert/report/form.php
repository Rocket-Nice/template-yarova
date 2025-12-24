<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/expert/report/form', [
	'methods'  => 'GET',
	'callback' => function () {
		return yar_get_api_format_data( [
			'steps' => ( new YAR_Report_Fields_Repository() )->get_steps()
		] );
	},

	'permission_callback' => 'yar_api_is_expert',
] );