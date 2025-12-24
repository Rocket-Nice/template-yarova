<?php

class YAR_Report_List_Repository extends YAR_Report_Repository {
	private $allowed_statuses = [];

	public function __construct() {
		$this->get_statuses();
	}

	private function get_statuses(){
		$this->allowed_statuses = yar_get_config( 'report-statuses' );
	}

	private function get_meta_key(){
		if ( yar_is_expert() ){
			return 'expert';
		}

		return 'client';
	}

	private function get_status( $post_id ){
		$legal    = yar_get_file_url( yar_get_field( 'report_legal', $post_id ) );
		$forensic = yar_get_file_url( yar_get_field( 'report_forensic', $post_id ) );

		if ( $legal && $forensic ) {
			return [
				'label' => 'Одобрен к покупке',
				'value' => 'approved'
			];
		}

		return [
			'label' => 'Документы на проверке',
			'value' => 'documents_on_moderate'
		];
	}

	private function get_fields_for_client( $post_id ) {
		$legal    = yar_get_file_url( yar_get_field( 'report_legal', $post_id ) );
		$forensic = yar_get_file_url( yar_get_field( 'report_forensic', $post_id ) );

		return [
			'files' => [
				'legal'    => $legal,
				'forensic' => $forensic,
			]
		];
	}

	private function get_fields_for_expert( $post_id ){
		$contact = get_field( 'treaty', $post_id );
		$number  = '';
		$service = '';
		if ( ! empty( $contact ) ) {
			$number = get_field( 'number', $contact->ID );

			if ( get_field( 'service_type', $contact->ID ) === 'custom' ) {
				$service = get_field( 'service_custom', $contact->ID );
			} else {
				$service = get_field( 'service_list', $contact->ID );
				if ( $service ) {
					$service = $service->post_title;
				}
			}
		}

		return [
			'number'  => $number,
			'service' => $service
		];
	}

	public function get_list(){
		if ( empty( $this->allowed_statuses ) ){
			return $this->allowed_statuses;
		}

		foreach ( $this->allowed_statuses as $type => $status ) {
			$posts = get_posts( [
				'post_type'      => 'report',
				'posts_per_page' => - 1,
				'post_status'    => [ 'publish', 'draft' ],
				'meta_query'     => [
					'relations' => 'AND',
					[
						'key'   => $this->get_meta_key(),
						'value' => get_current_user_id(),
					],
					[
						'key'   => 'status',
						'value' => $status['statuses'],
					],
				]
			] );
			
			if ( ! empty( $posts ) ){
				foreach ( $posts as $post ) {
					$report_id = (int) get_post_meta( $post->ID, '_yar_report_id', true );
					if ( empty( $report_id ) ){
						continue;
					}

					$this->report_id = $report_id;

					$data = [
						'ID'            => $post->ID,
						'post_title'    => $this->get_title(),
						'post_date'     => $post->post_date,
						'_report_id'    => $report_id,
						'status_report' => get_field( 'status', $post->ID ),
						'status_view'   => $this->get_status( $post->ID )
					];

					if ( yar_is_expert() ) {
						$data = array_merge( $data, $this->get_fields_for_expert( $post->ID ) );
					} elseif ( yar_is_client() ) {
						$data = array_merge( $data, $this->get_fields_for_client( $post->ID ) );
					}

					$this->allowed_statuses[ $type ]['posts'][] = $data;
				}
			}
		}

		return $this->allowed_statuses;
	}

	public function get_report_by_vin( $vin ){
		global $wpdb;

		$table = $wpdb->prefix . 'yar_report_features';
		$query = "
				SELECT 
					features.*, 
					fields.id as fields_id,
					report.post_id as post_id
				FROM $table features
				LEFT JOIN wp_yar_report_fields fields ON features.param_id = fields.id
				LEFT JOIN wp_yar_report report ON features.report_id = report.id
				WHERE fields.id = 1
				AND features.value = '$vin'
				";

		$result = $wpdb->get_results( $query, 'ARRAY_A' );
		$list   = [];
		if ( ! empty( $result ) ) {
			foreach ( $result as $item ) {
				$post = get_post( $item['post_id'] );
				if ( empty( $post ) ) {
					continue;
				}

				$status = yar_get_field( 'status', $post->ID, '' );
				if ( $status['value'] !== 'approved' && $status['value'] !== 'rejected' ) {
					continue;
				}

				$this->report_id = (int) $item['report_id'];

				$data = [
					'ID'            => $post->ID,
					'post_title'    => $this->get_title(),
					'post_date'     => $post->post_date,
					'_report_id'    => $this->report_id,
					'status_report' => yar_get_field( 'status', $post->ID, [] ),
					'status_view'   => $this->get_status( $post->ID )
				];

				$data = array_merge( $data, $this->get_fields_for_client( $post->ID ) );

				$list[] = $data;
			}
		}

		return $list;
	}
}