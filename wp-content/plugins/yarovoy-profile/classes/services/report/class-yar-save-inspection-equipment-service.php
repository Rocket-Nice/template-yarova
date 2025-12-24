<?php

namespace YAR_Profile\Services\Report;
use WP_Error;

class YAR_Save_Inspection_Equipment_Service {
	private $table = 'wp_yar_report_inspection_equipment';

	private function remove( $report_id ) {
		global $wpdb;

		$wpdb->delete( $this->table, [ 'report_id' => $report_id ] );
	}

	private function prepare_data( $data ) {
		if ( ! is_array( $data ) ){
			$data = json_decode( stripslashes( $data ), true );
		}

		return $data;

//        foreach ( $data as $key => $item ) {
//            if ( ! $item ){
//                unset( $data[ $key ] );
//            }
//		}

//		$new = [];
//
//		foreach ( $data as $datum ) {
//			$decode = json_decode( stripslashes( $datum ), true );
//			$new    = array_merge( $new, $decode );
//		}
//
//		return $new;
	}

	public function save( $report_id, $data, $fields = [] ) {
		if ( empty( $data ) ) {
			return new WP_Error( 'error_report_dashboard', 'Ошибка при сохранении отчета' );
		}

		$data = $this->prepare_data( $data );

		if ( ! empty( $data ) ) {
			global $wpdb;

			$this->remove( $report_id );

			foreach ( $data as $slug => $datum ) {
				$find = array_search( $slug, array_column( $fields, 'name' ) );

				if ( $find !== false && $datum ) {
					$wpdb->insert( $this->table, [
						'report_id' => $report_id,
						'param_id'  => $fields[ $find ]['id'],
						'value'     => 1
					] );
				}
			}
		}

		return true;
	}
}