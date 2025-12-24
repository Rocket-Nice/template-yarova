<?php

namespace YAR_Profile\Services\Report;

use WP_Error;

class YAR_Save_Total_Service {
	private $table = 'wp_yar_report';

	public function save( $report_id, $data ) {
		global $wpdb;

		$data = [
			'total'         => $data['total'],
			'total_comment' => $data['total_comment']
		];

		$wpdb->update( $this->table, $data, [
			'id' => $report_id
		] );

		if ( ! empty( $wpdb->error ) ){
			return new WP_Error( 'error_report_features', 'Ошибка при сохранении отчета' );
		}

		return true;
	}
}