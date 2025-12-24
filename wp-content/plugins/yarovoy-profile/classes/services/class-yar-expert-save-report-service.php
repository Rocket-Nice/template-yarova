<?php

namespace YAR_Profile\Services;

use WP_Error;

use YAR_Profile\Services\Report\YAR_Save_Owners_Data_Service;
use YAR_Profile\Services\Report\YAR_Save_Report_Data_Service;

use YAR_Profile\Services\Report\YAR_Save_Equipment_Service;
use YAR_Profile\Services\Report\YAR_Save_Features_Service;
use YAR_Profile\Services\Report\YAR_Save_Inspection_Equipment_Service;
use YAR_Profile\Services\Report\YAR_Save_Inspection_Service;
use YAR_Profile\Services\Report\YAR_Save_Summary_Service;
use YAR_Profile\Services\Report\YAR_Save_Total_Service;
use YAR_Report_Fields_Repository;

/**
 * Class YAR_Expert_Save_Report_Service
 * Save report service
 */
class YAR_Expert_Save_Report_Service extends YAR_Save_Report_Data_Service {
	private $data;
	private $fields;

	private function save_gallery( $prefix, $selector ) {
		$service = new YAR_Gallery_Field_Service();

		if ( ! empty( $this->data[ $prefix ] ) ) {
			$save = $service->save( $this->data[ $prefix ], $selector, $this->post_id );
			if ( is_wp_error( $save ) ) {
				return $save;
			}
		}

		if ( ! empty( $this->data[ $prefix . '_removed' ] ) ) {
			$service->remove( $this->data[ $prefix . '_removed' ], $selector, $this->post_id );
		}

		return true;
	}

	private function save_videos() {
		$fields = [
			'video'   => [
				'key'   => 'field_676e5fd7b180b',
				'value' => $this->data['video_1']
			],
			'video_2' => [
				'key'   => 'field_67c693755493f',
				'value' => $this->data['video_2']
			],
			'video_3' => [
				'key'   => 'field_67c6937b54940',
				'value' => $this->data['video_3']
			],
		];

		$service = new YAR_File_Field_Service();

		foreach ( $fields as $key => $field ) {
			if ( empty( $field['value'] ) ) {
				continue;
			}

			$old = yar_get_field( $field['key'], $this->post_id );
			if ( ! empty( $old ) ){
				$service->remove( $field['key'], $this->post_id );
			}

			$save = $service->save( $field['value'], $field['key'], $this->post_id );
			if ( is_wp_error( $save ) ){
				return $save;
			}
		}

		return true;
	}

	public function save( $data, $action = 'create', $report_id = '' ) {
		if ( $action === 'edit' ) {
			$this->report_id = $report_id;
			$this->post_id   = $this->get_post_id();
		}

		if ( empty( $this->report_id ) ) {
			$this->post_id   = $this->create_post();
			$this->report_id = $this->create_report();
		}

		$this->data = $data;
		$this->fields = new YAR_Report_Fields_Repository();

		// Save owners
		( new YAR_Save_Owners_Data_Service() )->save( $this->data, $this->post_id );

		// Save features
		$features_service = new YAR_Save_Features_Service();
		$features_save    = $features_service->save(
			$this->data,
			$this->report_id,
			'features',
			$this->fields->get_fields_by_group( 'features' )
		);

		if ( is_wp_error( $features_save ) ) {
			return $features_save;
		}

		$inspection_service = new YAR_Save_Inspection_Service();

		// Save vin
		if ( ! empty( $this->data['vin'] ) ) {
			$inspection_vin_save = $inspection_service->save(
				$this->data['vin'],
				$this->report_id,
				'vin',
				$this->fields->get_fields_by_group( 'vin' )
			);

			if ( is_wp_error( $inspection_vin_save ) ) {
				return $inspection_vin_save;
			}
		}

		// Save body inspection
		if ( ! empty( $this->data['body_inspection'] ) ) {
			$inspection_body_inspection_save = $inspection_service->save(
				$this->data['body_inspection'],
				$this->report_id,
				'front',
				$this->fields->get_fields_by_group( 'front' )
			);

			if ( is_wp_error( $inspection_body_inspection_save ) ) {
				return $inspection_body_inspection_save;
			}
		}

		if ( ! empty( $this->data['dashboard'] ) ) {
			$dashboard_save = ( new YAR_Save_Inspection_Equipment_Service() )->save(
				$this->report_id,
				$this->data['dashboard'],
				$this->fields->get_fields_by_group( 'dashboard' )
			);

			if ( is_wp_error( $dashboard_save ) ) {
				return $dashboard_save;
			}
		}

		if ( ! empty( $this->data['interior_inspection'] ) ) {
			$interior_inspection_save = $inspection_service->save(
				$this->data['interior_inspection'],
				$this->report_id,
				'interior',
				$this->fields->get_fields_by_group( 'interior' )
			);

			if ( is_wp_error( $interior_inspection_save ) ) {
				return $interior_inspection_save;
			}
		}

		if ( ! empty( $this->data['interior_equipment_comment'] ) ) {
			$interior_equipment_save    = $features_service->save(
				$this->data,
				$this->report_id,
				'interior_equipment',
				$this->fields->get_fields_by_group( 'interior_equipment' )
			);

			if ( is_wp_error( $interior_equipment_save ) ) {
				return $interior_equipment_save;
			}
		}

		// Summary
		if ( ! empty( $this->data['summary'] ) ) {
			$interior_inspection_save = $inspection_service->save(
				$this->data['summary'],
				$this->report_id,
				'summary',
				$this->fields->get_fields_by_group( 'summary' )
			);

			if ( is_wp_error( $interior_inspection_save ) ) {
				return $interior_inspection_save;
			}
		}

		$save_gallery = $this->save_gallery( 'gallery', 'field_671b61e041a87' );
		if ( is_wp_error( $save_gallery ) ) {
			return $save_gallery;
		}

		$save_documents = $this->save_gallery( 'documents', 'field_67a0ac7c69ff4' );
		if ( is_wp_error( $save_documents ) ) {
			return $save_documents;
		}

		$save_videos = $this->save_videos();
		if ( is_wp_error( $save_videos ) ) {
			return $save_videos;
		}

		return [
			'report_id' => $this->report_id,
			'post_id'   => $this->post_id,
			'status'    => $this->get_status(),
			'action'    => $action
		];
	}

	public function send_to_moderate(){
		$this->set_status( 'on_moderated' );
	}
}