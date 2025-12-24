<?php

register_rest_route( YAR_API_NAMESPACE, '/profile/expert/report/moderate', [
	'methods'  => 'GET',
	'callback' => function () {
		return yar_get_api_format_data( ( new YAR_Contracts_Repository() )->get_contracts_for_report() );
	},

	'permission_callback' => 'yar_api_is_expert',
] );