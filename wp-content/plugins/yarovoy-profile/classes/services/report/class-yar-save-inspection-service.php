<?php

namespace YAR_Profile\Services\Report;

use WP_Error;
use YAR_Report_Repository;

class YAR_Save_Inspection_Service {
	private $table = 'wp_yar_report_inspection';

	private function prepare( $data ) {
		if ( is_array( $data ) && ! empty( $data['fields'] ) ){
			return $data['fields'];
		}

		$data = json_decode( stripslashes( $data ), true );
		if ( empty( $data['fields'] ) ) {
			return [];
		}

		return $data['fields'];
	}

	public function save( $data, $report_id, $prefix, $fields ) {
		if ( empty( $data ) ) {
			return [];
		}

		$data = $this->prepare( $data );
		if ( ! empty( $data ) ) {
			global $wpdb;

			$old_data = ( new YAR_Report_Repository() )->query( $this->table, $prefix, $report_id );

			foreach ( $data as $slug => $datum ) {
				if ( empty( $datum['status'] ) ) {
					continue;
				}

				$field = array_search( $slug, array_column( $fields, 'name' ) );
				if ( $field !== false ) {
					$old = array_search( (int) $fields[ $field ]['id'], array_map( 'intval', array_column( $old_data, 'param_id' ) ) );

					$save_data = [
						'report_id' => $report_id,
						'param_id'  => $fields[ $field ]['id'],
						'value'     => $datum['status'],
						'comment'   => $datum['comment'],
						'thickness' => isset( $datum['thickness'] ) ? $datum['thickness'] : null,
					];

					if ( $old !== false ) {
						$wpdb->update( $this->table, $save_data, [
							'report_id' => $report_id,
							'param_id'  => $fields[ $field ]['id']
						] );
					} else {
						$wpdb->insert( $this->table, $save_data );
					}

					if ( ! empty( $wpdb->errors ) ) {
						return new WP_Error( 'error_report_save_' . $prefix, 'Ошибка при сохранении отчета', [
							'status' => 400,
							'params' => $wpdb->errors
						] );
					}
				}
			}
		}

		return true;
	}
}