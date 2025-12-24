<?php

namespace YAR_Profile\Services\Report;

use WP_Error;

class YAR_Save_Report_Data_Service {
	private $table_report = 'wp_yar_report';

	protected $post_id;
	protected $report_id;

	protected function set_status( $status = 'saved' ){
		update_field( 'field_6710f52dc20c0', $status, $this->post_id );
	}


	private function set_expert() {
		update_field( 'expert', get_current_user_id(), $this->post_id );
	}

	protected function get_status(){
		return yar_get_field( 'status', $this->post_id, [] );
	}

	protected function get_post_id(){
		global $wpdb;

		$result = $wpdb->get_row( "SELECT post_id FROM $this->table_report WHERE id = $this->report_id", 'ARRAY_A' );
		if ( ! empty( $result ) ) {
			$this->post_id = $result['post_id'];

			return $result['post_id'];
		}

		return new WP_Error( 'error_report_get_post_id', 'Ошибка при создании отчета' );
	}

	protected function create_post(){
		$post_data = [
			'post_type'   => 'report',
			'post_title'  => sanitize_text_field( 'Отчет ' . time() ),
			'post_status' => 'publish',
			'post_author' => 1,
		];

		$post_id = wp_insert_post( wp_slash( $post_data ) );
		if ( is_wp_error( $post_id ) ) {
			return new WP_Error( 'error_report_create_post', 'Ошибка при создании отчета' );
		}

		$this->post_id = $post_id;
		$this->set_status();
		$this->set_expert();

		return $this->post_id;
	}

	protected function get_report_id(){
		global $wpdb;

		$result = $wpdb->get_row( "SELECT id FROM $this->table_report WHERE post_id = $this->post_id", 'ARRAY_A' );
		if ( ! empty( $result ) ) {
			$this->report_id = $result['id'];

			return $result['id'];
		}

		return new WP_Error( 'error_report_get_id', 'Ошибка при создании отчета' );
	}

	protected function create_report(){
		global $wpdb;

		$wpdb->insert( $this->table_report, [
			'post_id' => $this->post_id
		] );

		if ( ! empty( $wpdb->errors ) ){
			return new WP_Error( 'error_report_create_id', 'Ошибка при создании отчета' );
		}

		$this->report_id = $wpdb->insert_id;

		update_post_meta( $this->post_id, '_yar_report_id', $wpdb->insert_id );

		return $this->report_id;
	}
}