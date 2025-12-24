<?php

class YAR_Report_Repository {
	protected $report_id;

	private $report_data;
	private $post_id;
	private $inpections = [];

	private function get_post_id() {
		global $wpdb;

		$table  = $wpdb->prefix . 'yar_report';
		$result = $wpdb->get_row( "SELECT * FROM $table WHERE id = $this->report_id", 'ARRAY_A' );
		if ( ! empty( $result ) ) {
			$this->report_data = $result;
			$this->post_id     = $result['post_id'];

			return true;
		}

		return false;
	}

	private function get_features(){
		return $this->query( 'wp_yar_report_features' );
	}

	protected function get_title(){
		$features = $this->get_features();
		$find     = function ( $key ) use ( $features ) {
			$find = array_search( $key, array_column( $features, 'field_slug' ) );
			if ( $find !== false ) {
				return $features[ $find ]['value'];
			}

			return '';
		};

		$title = '';

		$brand = $find( 'brand' );
		$model = $find( 'model' );
		$year  = $find( 'year' );

		if ( $brand ) {
			$title .= $brand;
		}

		if ( $model ) {
			$title .= '' . $model;
		}

		if ( $year ) {
			$title .= '-' . $year;
		}

		if ( empty( $title ) ){
			return 'Отчет ' . $this->report_id;
		}

		return $title;
	}

	public function query( $table, $group = '', $report_id = '' ) {
		global $wpdb;

		$report_id = $report_id ? $report_id : $this->report_id;

		$query = "
				SELECT 
				       ins_values.*, field.id as field_id, 
				       field.group as field_group, 
				       field.title as field_title, 
				       field.slug as field_slug, field.type as field_type, 
				       field.params as field_params, 
				       field.order as field_order FROM $table ins_values
    			INNER JOIN wp_yar_report_fields field ON ins_values.param_id = field.id
				WHERE ins_values.report_id = $report_id
    			";

		if ( $group ) {
			$query .= " AND field.group = '$group'";
		}

		$result = $wpdb->get_results( $query, 'ARRAY_A' );

		if ( empty( $result ) || ! empty( $wpdb->error ) ) {
			return [];
		}

		foreach ( $result as $key => $item ) {
			if ( ! empty( $item['field_params'] ) ) {
				$params = json_decode( $item['field_params'], true );
				if ( $item['field_type'] === 'select' ) {
					$result[ $key ]['options'] = $params;
				} else {
					$result[ $key ] = array_merge( $item, $params );
				}
			}

			$result[ $key ]['field_name'] = $item['field_group'] . '_' . $item['field_slug'];
		}

		return $result;
	}

	private function get_inspections() {
		$data = $this->query( 'wp_yar_report_inspection' );
		$new  = [];
		if ( ! empty( $data ) ) {
			foreach ( $data as $datum ) {
				$new[ $datum['field_group'] ][] = $datum;
			}
		}

		$this->inpections = $new;

		return $new;
	}

	private function get_inspection( $type ) {
		if ( isset( $this->inpections[ $type ] ) ) {
			return $this->inpections[ $type ];
		}

		return [];
	}

//	private function get_summary() {
//		return [
//			'total'         => $this->report_data['total'],
//			'total_comment' => $this->report_data['total_comment'],
//		];
//	}

	private function get_videos() {
		return [
			'video_1' => yar_get_file_data( yar_get_field( 'video', $this->post_id, [] ) ),
			'video_2' => yar_get_file_data( yar_get_field( 'video_2', $this->post_id, [] ) ),
			'video_3' => yar_get_file_data( yar_get_field( 'video_3', $this->post_id, [] ) ),
		];
	}

	private function get_by_id( $id ) {
		$this->report_id = $id;
		if ( ! $this->get_post_id() ) {
			return new WP_Error( 'error_report_id', 'Отчет не найден', [
				'status' => 404
			] );
		}

		// Preload full inspections / filter
		$this->get_inspections();

		$data = [
			'owners'              => [
				[
					'field_slug' => 'fio',
					'field_name' => 'owners_fio',
					'value'      => yar_get_field( 'owners_fio', $this->post_id, '' ),
					'title'      => 'ФИО владельца'
				],
				[
					'field_slug' => 'phone',
					'field_name' => 'owners_phone',
					'value'      => yar_get_field( 'owners_phone', $this->post_id, '' ),
					'title'      => 'Телефон'
				],
			],
			'features'            => $this->query( 'wp_yar_report_features' ),
			'vin'                 => $this->get_inspection( 'vin' ),
			'gallery'             => yar_get_file_data(
				yar_get_field( 'gallery', $this->post_id, [] )
			),
			'documents'           => yar_get_file_data(
				yar_get_field( 'documents', $this->post_id, [] )
			),
			'videos'              => $this->get_videos(),
			'body_inspection'     => $this->get_inspection( 'front' ),
			'dashboard'           => $this->query( 'wp_yar_report_inspection_equipment', 'dashboard' ),
			'interior_inspection' => $this->get_inspection( 'interior' ),
			'interior_equipment'  => $this->query( 'wp_yar_report_features', 'interior_equipment' ),
			'summary'             => $this->get_inspection( 'summary' ),
		];

		if (
			yar_is_expert()
			&& $report_errors = yar_get_field( 'not_correctly_comment', $this->post_id, '' )
		) {
			$data['report_errors'] = $report_errors;
		}

		return $data;
	}

	private function get_report_for_admin() {
		if ( ! current_user_can( 'administrator' ) ) {
			return new WP_Error( 'error_report_id', 'Отчет не найден', [
				'status' => 404
			] );
		}

		$report_id = get_query_var( 'profile/reports/preview' );

		if ( empty( $report_id ) ) {
			return new WP_Error( 'error_report_id', 'Отчет не найден', [
				'status' => 404
			] );
		}

		return $this->get_by_id( $report_id );
	}


	public function get_expert_status( $post_id = '' ){
		return yar_get_field( 'status', $post_id, [] );
	}

	public function get_errors( $post_id = '' ){
		$errors = '';

		if ( ! $post_id ){
			$post_id = $this->post_id;
		}

		$status  = yar_get_field( 'status', $post_id, [] );
		$message = yar_get_field( 'not_correctly_comment', $post_id, '' );

		if (
			yar_is_expert()
			&& $message
			&& $status['value'] === 'not_correctly'
		) {
			$errors = $message;
		}

		return $errors;
	}

	public function get_report() {
		if ( current_user_can( 'administrator' ) ) {
			return $this->get_report_for_admin();
		}

		if ( empty( $this->report_id ) || ! yar_check_report_id( $this->report_id ) ) {
			return new WP_Error( 'error_report_id', 'Отчет не найден', [
				'status' => 404
			] );
		}

		return $this->get_by_id( $this->report_id );
	}
}