<?php

namespace YAR_Profile\Services\Api;

use WP_Error;
use WP_REST_Request;
use YAR_Profile\Helpers\YAR_Validator;
use YAR_Profile\Services\YAR_File_Field_Service;
use YAR_Profile\Services\YAR_Gallery_Field_Service;

/**
 * Class YAR_Files_Api_Service
 * API files service. View all types in config/api-files.php
 */
class YAR_Files_Api_Service {
	private $files = [];
	private $accepted = [];

	private function get_accepted(){
		$this->accepted = yar_get_config( 'api-files' );
	}

	private function get_post_id( $type, $id ) {
		$post_id = '';

		switch ( $type ) {
			case 'user':
				$post_id = 'user_' . get_current_user_id();
				break;

			case 'report':
				$post_id = yar_check_report_id( $id );
				break;
		}

		return $post_id;
	}

	public function save( $files, $type, $id = 0 ) {
		$this->get_accepted();

		if (
			empty( $files )
			|| empty( $type )
			|| ! isset( $this->accepted[ $type ] )
			|| (
				$type !== 'user'
				&& empty( $id )
			)
		) {
			return new WP_Error( 'error_files_save', 'Ошибка при сохранении файлов' );
		}

		$validator = new YAR_Validator();
		$errors    = [];

		foreach ( $this->accepted[ $type ] as $key => $accepted ) {
			if ( isset( $files[ $key ] ) ) {
				$options = $this->accepted[ $type ][ $key ];
				$post_id = $this->get_post_id( $type, $id );
				if ( ! $post_id ){
					continue;
				}

				$rules   = $options['validate'];

				$validate = $validator->validate( [
					$key => $rules
				], [], true );

				if ( is_wp_error( $validate ) ) {
					$errors[ $key ] = $validate->errors[ $key ];
				} else {
					//$field_id = $options['field_key'] ?: $options['field'];
					$field_id = $options['field_key'] ?? $options['field'];

					if ( $options['multiple'] ) {
						$save = ( new YAR_Gallery_Field_Service() )->save( $files[ $key ], $field_id, $post_id );
					} else {
						$save = ( new YAR_File_Field_Service() )->save( $files[ $key ], $field_id, $post_id );
					}

					if ( is_wp_error( $save ) ) {
						$errors[ $key ] = $save->errors[ $key ];
					}
				}
			}
		}

		if ( ! empty( $errors ) ) {
			return new WP_Error( 'error_save_files', 'Ошибки при сохранении файлов', [
				'status' => 400,
				'errors' => $errors
			] );
		}

		return true;
	}

	public function delete( WP_REST_Request $request ){
		$this->get_accepted();

		$type = $request->get_param( 'type' );
		$id   = $request->get_param( 'id' );

		if (
			empty( $type )
			|| ! isset( $this->accepted[ $type ] )
			|| (
				$type !== 'user'
				&& empty( $id )
			)
		) {
			return new WP_Error( 'error_files_save', 'Ошибка при сохранении файлов' );
		}

		$accepted = $this->accepted[ $type ];

		foreach ( $accepted as $key => $accept ) {
			if ( $removed = $request->get_param( $key . '_removed' )){
				$options = $accept;
				$post_id = $this->get_post_id( $type, $id );

				if ( $options['multiple'] ) {
					$delete = ( new YAR_Gallery_Field_Service() )->remove( $removed, $options['field'], $post_id );

					if ( ! $delete ) {
						return new WP_Error( 'error_delete_files', 'Ошибки при удалении файлов', [
							'status' => 400,
						] );
					}
				}
			}
		}

		return true;
	}
}