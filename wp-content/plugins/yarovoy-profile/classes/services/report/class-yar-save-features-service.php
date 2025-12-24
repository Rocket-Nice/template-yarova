<?php

namespace YAR_Profile\Services\Report;

use WP_Error;
use YAR_Report_Repository;

class YAR_Save_Features_Service {
	private $table = 'wp_yar_report_features';
	private $prefix = 'features';
	private $report_id;
	private $data = [];
	private $old = [];

	private function prepare( $data ){
		$new_data = [];

		foreach ( $data as $key => $datum ) {
			if ( strpos( $key, $this->prefix ) !== false ) {
				$new_data[ str_replace( $this->prefix . '_', '', $key ) ] = $datum;
			}
		}

		return $new_data;
	}

	public function save( $data, $report_id, $prefix = 'features', $fields = [] ) {
		if ( empty( $data ) ) {
			return $data;
		}

		$this->prefix    = $prefix;
		$this->report_id = $report_id;

		$data      = $this->prepare( $data );
		$this->old = ( new YAR_Report_Repository() )->query( $this->table, $this->prefix, $this->report_id );

		global $wpdb;

		foreach ( $data as $slug => $datum ) {
			$field = array_search( $slug, array_column( $fields, 'slug' ) );
			if ( $field !== false ) {
				$old = array_search( (int) $fields[ $field ]['id'], array_column( $this->old, 'param_id' ) );
				if ( $old !== false ) {
					$wpdb->update( $this->table, [
						'value' => $datum
					], [
						'report_id' => $this->report_id,
						'param_id'  => $fields[ $field ]['id']
					] );
				} else {
					$wpdb->insert( $this->table, [
						'report_id' => $report_id,
						'param_id'  => $fields[ $field ]['id'],
						'value'     => $datum
					] );
				}

				if ( ! empty( $wpdb->errors ) ){
					return new WP_Error( 'error_report_save_features', 'Ошибка при сохранении отчета', [
						'status' => 400,
						'params' => $wpdb->errors
					] );
				}
			}
		}

		return true;
	}
}