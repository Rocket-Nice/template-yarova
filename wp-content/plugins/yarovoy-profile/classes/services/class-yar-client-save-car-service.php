<?php

namespace YAR_Profile\Services;

use WP_Error;
use YAR_Car_Fields_Repository;

/**
 * Class YAR_Client_Save_Car_Service
 * TODO: В дальнейшем доделать логику
 */
class YAR_Client_Save_Car_Service {
	private $data;
	private $car_id;
	private $post_id;
	private $fields;

	private function prepare_data(){
		if ( empty( $this->data ) ){
			return false;
		}
		
		$fields = ( new YAR_Car_Fields_Repository() )->get_all_fields();
		if ( empty( $fields ) ){
			return false;
		}

		$this->fields = $fields;

		foreach ( $this->data as $key => $datum ) {
			if (
				$key === 'about'
				|| $key === 'report'
				|| $key === 'report_from'
				|| $key === 'gallery'
				|| $key === 'gallery_removed'
			){
				continue;
			}

			if ( ! in_array( $key, $fields ) || empty( $datum ) ) {
				unset( $this->data[ $key ] );
			}
		}

		return true;
	}

	private function get_param( $param ) {
		if ( isset( $this->data[ $param ] ) ) {
			return $this->data[ $param ];
		}

		return '';
	}

	private function create_post() {
		$params = new YAR_Car_Fields_Repository();
		$brand  = $params->get_select_value( $this->get_param( 'brand' ) );
		$model  = $params->get_select_value( $this->get_param( 'model' ) );

		$post_data = [
			'post_type'   => 'auto',
			'post_title'  => $brand . ' ' . $model,
			'post_author' => 1
		];

		$post_id = wp_insert_post( wp_slash( $post_data ) );
		if ( is_wp_error( $post_id ) ){
			return new WP_Error( 'error_create_auto_post', 'Ошибка при создании авто' );
		}

		update_field( 'client', get_current_user_id(), $post_id );

		global $wpdb;
		$table = $wpdb->prefix . 'yar_car';

		$wpdb->insert( $table, [
			'post_id' => $post_id
		] );

		if ( ! $wpdb->insert_id || ! empty( $wpdb->error ) ){
			return new WP_Error( 'error_create_auto_post', 'Ошибка при создании авто' );
		}

		$this->car_id  = $wpdb->insert_id;
		$this->post_id = $post_id;

		update_post_meta(  $post_id, '_real_car_id', $this->car_id );

		return true;
	}

	private function get_post_id() {
		global $wpdb;
		$table = $wpdb->prefix . 'yar_car';

		$result = $wpdb->get_row( "SELECT * FROM $table WHERE id= $this->car_id", 'ARRAY_A' );
		if ( ! empty( $wpdb->error ) || empty( $result ) ) {
			return false;
		}

		$this->post_id = $result['post_id'];

		return $result['post_id'];
	}

	private function save_fields() {
		global $wpdb;

		$table = $wpdb->prefix . 'yar_car_parameters_values';
		$wpdb->delete( $table, [ 'car_id' => $this->car_id ] );

		foreach ( $this->data as $key => $data ) {
			$key = array_search( $key, $this->fields );
			if ( $key !== false ) {
				$wpdb->insert( $table, [
					'car_id'   => $this->car_id,
					'param_id' => $key,
					'value'    => $data
				] );
			}
		}
	}

	private function save_about() {
		if ( isset( $this->data['about'] ) ) {
			$about = strip_tags( $this->data['about'] );
			$about = trim( $about );

			$short = mb_substr( $about, 0, 200 );
			update_field( 'mini_description', $short, $this->post_id );

			update_field( 'description', $about, $this->post_id );
		}
	}

	private function save_report() {
		if ( ! empty( $this->data['report'] ) ) {
			$selector = 'report';

			$file = new YAR_File_Field_Service();
			$file->remove( $selector, $this->post_id );

			$save = $file->save( $this->data['report'], $selector, $this->post_id );
			if ( is_wp_error( $save ) ) {
				return $save;
			}
		}

		return true;
	}

	private function save_report_from() {
		if ( ! empty( $this->data['report_from'] ) ) {
			$selector = 'report_from';

			$file = new YAR_File_Field_Service();
			$file->remove( $selector, $this->post_id );

			$save = $file->save( $this->data['report_from'], $selector, $this->post_id );
			if ( is_wp_error( $save ) ) {
				return $save;
			}
		}

		return true;
	}

	private function save_gallery() {
		$service = new YAR_Gallery_Field_Service();
		if ( ! empty( $this->data['gallery_removed'] ) ){
			$service->remove( $this->data['gallery_removed'], 'field_66cd9a4419bfc', $this->post_id );
		}

		if ( ! empty( $this->data['gallery'] ) ) {
			$save = $service->save( $this->data['gallery'], 'field_66cd9a4419bfc', $this->post_id );
			if ( is_wp_error( $save ) ) {
				return $save;
			}

			$gallery = yar_get_field( 'field_66cd9a4419bfc', $this->post_id );
			if ( ! empty( $gallery ) ){
				set_post_thumbnail( $this->post_id, $gallery[0]['ID'] );
			}
		}

		return true;
	}

	private function set_status() {
		wp_update_post( [
			'ID'          => $this->post_id,
			'post_status' => 'draft'
		] );

		update_field( 'is_sold', 0, $this->post_id );
	}

	private function save_post_fields(){
		if ( isset( $this->data['price'] ) ){
			update_field( 'price', (int) $this->data['price'], $this->post_id );
		}
	}

	public function save( $data, $action = 'create', $car_id = '' ){
		$this->data = $data;
		$this->prepare_data();

		if ( $action === 'edit' ) {
			$this->car_id = $car_id;
			$this->get_post_id();
			$this->set_status();
		}

		if ( ! $this->post_id ) {
			$post = $this->create_post();
			if ( is_wp_error( $post ) ) {
				return $post;
			}
		}

		$this->save_gallery();
		$this->save_about();
		$this->save_report();
		$this->save_report_from();
		$this->save_post_fields();
		$this->save_fields();

		return true;
	}
}