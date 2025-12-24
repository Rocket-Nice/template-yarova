<?php

namespace YAR_Profile\Services;

use WP_Error;

/**
 * Class YAR_Gallery_Field_Service
 * Service for working with multiple files
 */
class YAR_Gallery_Field_Service {
	public function remove( $data, $selector, $post_id ) {
		if ( empty( $data ) ) {
			return false;
		}

		if ( ! is_array( $data ) ) {
			$data = json_decode( stripslashes( $data ), true );
		}

		if ( ! empty( $data ) ) {
			$field = get_field( $selector, $post_id );
			if ( ! empty( $field ) ) {
				foreach ( $data as $datum ) {
					$find  = array_search( $datum, array_column( $field, 'ID' ) );

					if ( $find !== false ) {
						unset( $field[ $find ] );
						wp_delete_attachment( $datum, true );
					}
				}

				update_field( $selector, $field, $post_id );
			}
		}

		return true;
	}

	public function save( $files, $selector, $post_id ) {
		if ( empty( $files ) ) {
			return false;
		}

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		$gallery = [];
		$errors  = [];

		foreach ( $files['name'] as $key => $value ) {
			if ( empty( $files['name'][ $key ] ) ) {
				continue;
			}

			$file = [
				'name'     => $files['name'][ $key ],
				'type'     => $files['type'][ $key ],
				'tmp_name' => $files['tmp_name'][ $key ],
				'error'    => $files['error'][ $key ],
				'size'     => $files['size'][ $key ],
			];

			$file   = ( new YAR_Image_Resize_Service() )->resize( $file );
			$upload = media_handle_sideload( $file );

			if ( is_wp_error( $upload ) ) {
				$errors['gallery'][ $key ] = $upload->get_error_message();
			}

			$gallery[] = $upload;
		}

		if ( ! empty( $errors ) ) {
			return new WP_Error( 'error_save_files', 'Ошибка при сохранении файлов', $errors );
		}

		$old     = yar_get_field( $selector, $post_id, [] );
		$gallery = array_merge( $old, $gallery );

		update_field( $selector, $gallery, $post_id );

		return true;
	}
}
