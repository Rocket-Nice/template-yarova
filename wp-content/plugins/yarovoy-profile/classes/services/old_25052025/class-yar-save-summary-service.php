<?php

namespace YAR_Profile\Services\Report;

use WP_Error;

class YAR_Save_Summary_Service {
	private $table = 'wp_yar_report_summary';

	private function remove( $report_id ) {
		global $wpdb;

		$wpdb->delete( $this->table, [ 'report_id' => $report_id ] );
	}

	private function prepare_data( $data ) {
		if ( ! empty( $data ) ) {
			$data = json_decode( stripslashes( $data ), true );
			$data = $data['fields'];
		}

		return $data;
	}

	public function save( $report_id, $data, $fields = [] ) {
		$data   = $this->prepare_data( $data );

		if ( ! empty( $data ) ){
			global $wpdb;

			$this->remove( $report_id );

			foreach ( $data as $slug => $datum ) {
				$find = array_search( $slug, array_column( $fields, 'name' ) );
				if ( $find !== false ) {
					$wpdb->insert( $this->table, [
						'report_id' => $report_id,
						'param_id'  => $fields[ $find ]['id'],
						'value'     => $datum['status'],
						'comment'   => $datum['comment'],
					], [ '%d', '%d', '%d', '%s' ] );

					if ( ! empty( $wpdb->error ) ){
						return new WP_Error( 'error_report_save_inspection', 'Ошибка при сохранении комлектации' );
					}
				}
			}
		}

		return true;
	}
}