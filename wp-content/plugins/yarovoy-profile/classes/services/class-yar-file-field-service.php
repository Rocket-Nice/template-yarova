<?php

namespace YAR_Profile\Services;

use WP_Error;

/**
 * Class YAR_File_Field_Service
 * Service for working with single files
 */
class YAR_File_Field_Service {
	public function remove( $selector, $post_id ) {
		$field = get_field( $selector, $post_id );
		if ( ! empty( $field ) ) {
			wp_delete_attachment( $field['id'], true );
		}
	}

	public function save( $file, $selector, $post_id ) {
		if ( empty( $file ) ) {
			return false;
		}

		$errors = [];

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		$file_data = [
			'name'     => $file['name'],
			'type'     => $file['type'],
			'tmp_name' => $file['tmp_name'],
			'error'    => $file['error'],
			'size'     => $file['size'],
		];

		$file_data = ( new YAR_Image_Resize_Service() )->resize( $file );
		$upload    = media_handle_sideload( $file_data );

		if ( is_wp_error( $upload ) ) {
			$errors[ $selector ][] = 'Ошибка загрузки файла';
		}

		if ( ! empty( $errors ) ) {
			return new WP_Error( 'error_save_files', 'Ошибка при сохранении файлов', $errors );
		}

		update_field( $selector, $upload, $post_id );

		return true;
	}
}
