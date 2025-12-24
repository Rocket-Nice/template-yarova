<?php

namespace YAR_Profile\Services;

use WP_Error;

/**
 * Class YAR_Expert_Moderate_Report_Service
 * Send to moderate report service
 */
class YAR_Expert_Moderate_Report_Service {
	private $report_id;
	private $post_id;

	private $disabed_statuses = [
		'on_moderated',
		'approved',
		'rejected'
	];

	private function get_post_id() {
		global $wpdb;
		$table = $wpdb->prefix . 'yar_report';

		$result = $wpdb->get_row( "SELECT post_id FROM $table WHERE id = $this->report_id", 'ARRAY_A' );
		if ( ! empty( $result ) ) {
			return $result['post_id'];
		}

		return 0;
	}

	private function repeat_moderate() {
		update_field( 'field_6710f52dc20c0'/* status */, 'on_moderated', $this->post_id );

		return true;
	}

	public function save( $report_id, $contract_id = 0 ) {
		if (
			! $report_id
			|| ! yar_check_report_id( $report_id )
		) {
			return new WP_Error( 'send_to_moderate_report_id', '', 400 );
		}

		$this->report_id = $report_id;
		$this->post_id   = $this->get_post_id();

		$status = yar_get_field( 'field_6710f52dc20c0', $this->post_id, [] );
		if ( empty( $status ) ){
			return new WP_Error( 'send_to_moderate_status', '', 400 );
		}

		if ( $status['value'] === 'not_correctly' ){
			return $this->repeat_moderate();
		} else {
			if (
				empty( $contract_id )
				|| in_array( $status['value'], $this->disabed_statuses )
			) {
				return new WP_Error( 'send_to_moderate', '', 400 );
			}

			$client = get_field( 'client', $contract_id );
			if ( empty( $client ) ) {
				return new WP_Error( 'send_to_moderate_client', '', 400 );
			}

			$reports = yar_get_field( 'field_67599225afa54' /* reports */, $contract_id, [] );
			if ( array_search( $this->post_id, array_column( $reports, 'ID' ) ) !== false ) {
				return new WP_Error( 'send_to_moderate_report', '', 400 );
			}

			update_field( 'field_670a3d875a84f' /* client */, $client, $this->post_id );
			update_field( 'field_6710f52dc20c0'/* status */, 'on_moderated', $this->post_id );
			update_field( 'field_670a3dd7b7afc' /* treaty */, $contract_id, $this->post_id );

			$reports[] = $this->post_id;

			update_field( 'field_67599225afa54' /* report */, $reports, $contract_id );

			return true;
		}
	}

//	public function update( $report_id ) {
//		if (
//			! $report_id
//			|| ! yar_check_report_id( $report_id )
//		) {
//			return new WP_Error( 'send_to_moderate_report_id', '', 400 );
//		}
//
//		$this->report_id = $report_id;
//		$post_id         = $this->get_post_id();
//
//		$status = yar_get_field( 'field_6710f52dc20c0', $post_id, '' );
//
//		if (
//			empty( $status['value'] )
//			|| $status['value'] !== 'not_correctly'
//		) {
//			return new WP_Error( 'send_to_moderate_status', '', 400 );
//		}
//
//		update_field( 'field_6710f52dc20c0'/* status */, 'on_moderated', $post_id );
//
//		return true;
//	}
//
//	public function save( $contract_id, $report_id ) {
//		if (
//			! $contract_id
//			|| ! $report_id
//			|| ! yar_check_report_id( $report_id )
//		) {
//			return new WP_Error( 'send_to_moderate', '', 400 );
//		}
//
//		$this->report_id = $report_id;
//		$post_id         = $this->get_post_id();
//		if ( ! $post_id ){
//			return new WP_Error( 'send_to_moderate', '', 400 );
//		}
//
//		$status = yar_get_field( 'field_6710f52dc20c0', $post_id, '' );
//		if (
//			empty( $status )
//			|| (
//				! empty( $status )
//				&& in_array( $status['value'], $this->disabed_statuses )
//			) ) {
//			return new WP_Error( 'send_to_moderate', '', 400 );
//		}
//
//		$client = get_field( 'client', $contract_id );
//		if ( empty( $client ) ) {
//			return new WP_Error( 'send_to_moderate', '', 400 );
//		}
//
//		update_field( 'field_670a3d875a84f' /* client */, $client, $post_id );
//		update_field( 'field_6710f52dc20c0'/* status */, 'on_moderated', $post_id );
//		update_field( 'field_670a3dd7b7afc' /* treaty */, $contract_id, $post_id );
//
//		$reports   = yar_get_field( 'field_67599225afa54' /* reports */, $contract_id, [] );
//		$reports[] = $post_id;
//
//		update_field( 'field_67599225afa54' /* report */, $reports, $contract_id );
//
//		return true;
//	}
}