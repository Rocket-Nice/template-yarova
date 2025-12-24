<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/expert/report', [
	'methods'  => 'GET',
	'callback' => function () {
		return yar_get_api_format_data( [
			'items' => ( new YAR_Report_List_Repository() )->get_list()
		] );
	},

	'permission_callback' => 'yar_api_is_expert',
] );