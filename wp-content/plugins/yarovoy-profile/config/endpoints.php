<?php

return [
	[
		'endpoint'  => 'profile/reports/view',
		'rule'      => 'profile/reports/view/([^/]+)',
		'is_number' => true,
		'user_type' => [ 'client', 'report' ],
		'template'  => '/pages/report/item',
		'callback'  => function ( $value ) {
			$id = yar_check_report_id( $value );
			if ( ! $id ) {
				return false;
			}

			if ( ! yar_check_report_status( $id ) ) {
				return false;
			}

			return true;
		}
	],
	[
		'endpoint'  => 'profile/reports/edit',
		'rule'      => 'profile/reports/edit/([^/]+)',
		'is_number' => true,
		'user_type' => [ 'expert' ],
		'template'  => '/pages/report/edit',
		'callback'  => function ( $value ) {
			$id = yar_check_report_id( $value );
			if ( ! $id ) {
				return false;
			}

			if ( ! yar_check_report_status( $id ) ) {
				return false;
			}

			return true;
		}
	],
	[
		'endpoint'  => 'profile/reports/preview',
		'rule'      => 'profile/reports/preview/([^/]+)',
		'is_number' => true,
		'user_type' => [ 'admin' ],
		'template'  => '/pages/report/preview',
		'callback'  => function ( $value ) {
			if ( ! current_user_can( 'administrator' ) ) {
				return false;
			}

			return true;
		}
	],
	[
		'endpoint'  => 'profile/reports/create',
		'rule'      => 'profile/reports/create/([^/]+)',
		'user_type' => [ 'expert' ],
		'template'  => '/pages/report/create',
	],
	[
		'endpoint'  => 'profile/search-report',
		'rule'      => 'profile/search-report/([^/]+)',
		'user_type' => [ 'expert' ],
		'template'  => '/pages/report/search',
	],
	[
		'endpoint'  => 'profile/search-report-view',
		'rule'      => 'profile/search-report-view/([^/]+)',
		'user_type' => [ 'expert' ],
		'template'  => '/pages/report/item',
	],
	[
		'endpoint'  => 'profile/upload-car/create',
		'user_type' => [ 'client' ],
		'template'  => '/pages/upload-car/create',
		'callback'  => function ( $value ) {
			if ( ! yar_is_client() ) {
				return false;
			}

			return true;
		}
	],
	[
		'endpoint'  => 'profile/upload-car/edit',
		'rule'      => 'profile/upload-car/edit/([^/]+)',
		'is_number' => true,
		'user_type' => [ 'client' ],
		'template'  => '/pages/upload-car/edit',
		'callback'  => function ( $value ) {
			$repository = new YAR_Car_Repository();
			$post_id    = $repository->get_post_id( $value );

			if ( ! $post_id || ! yar_check_car_user( $post_id ) ) {
				return false;
			}

			return true;
		}
	]
];