<?php

use YAR_Profile\Helpers\YAR_Validator;

class YAR_Admin_Register_Report {
	private $table = 'wp_yar_report';

	public function __construct() {
		add_action( 'save_post', [ $this, 'create_fields' ], 10, 3 );
		add_action( 'before_delete_post', [ $this, 'before_delete_post' ], 10, 2 );

		add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );

		add_action( 'wp_ajax_yar_admin_report_set_status', [ $this, 'set_status' ] );

		add_filter( 'manage_report_posts_columns', [ $this, 'add_columns' ], 10, 2 );
		add_action( 'manage_report_posts_custom_column', [ $this, 'output_column' ], 10, 2 );
	}

	public function create_fields( $post_id, $post, $update ) {
		if ( $update || $post->post_type !== 'report' || ! current_user_can( 'administrator' ) ) {
			return;
		}

		global $wpdb;
		$wpdb->insert( $this->table, [
			'post_id' => $post_id
		] );

		update_post_meta( $post_id, '_yar_report_id', $wpdb->insert_id );
	}

	public function before_delete_post( $post_id, $post ) {
		if ( ! $post || $post->post_type !== 'report' ) {
			return;
		}

		global $wpdb;
		$wpdb->delete( $this->table, [
			'post_id' => $post_id
		] );

		delete_post_meta( $post_id, '_yar_report_id' );
	}

	public function add_meta_box(){
		add_meta_box( 'report_meta_box', 'Форма отчета', [ $this, 'meta_box_callback' ], [ 'report' ] );
	}

	public function meta_box_callback( $post, $meta ) {
		$report_id = get_post_meta( $post->ID, '_yar_report_id', true );
		if ( ! $report_id ) {
			return;
		}

		yar_plugin_get_template( 'report/meta-box', [
			'report_id' => $report_id,
			'post_id'   => $post->ID
		], true, true );
	}

	public function set_status() {
		$error = yar_get_modal_message( 'Произошла ошибка при сохранении' );

		if (
			! current_user_can( 'administrator' )
			|| ! wp_doing_ajax()
			|| empty( $_POST )
			|| ! wp_verify_nonce( $_POST['_nonce'], 'yar_admin_report_set_status' )
		) {
			wp_send_json_error( $error );
		}

		$rules = [
			'status'    => 'required',
			'report_id' => 'required',
		];

		$status = $_POST['status'];
		if ( $status === 'not_correctly' ) {
			$rules['not_correctly_comment'] = 'required';
		}

		$validator = new YAR_Validator();
		$validator->validate( $rules );

		$report_id = $validator->get_param( 'report_id' );
		if ( ! $report_id ) {
			wp_send_json_error( $error );
		}

		$post_id = $this->get_post_id( $report_id );
		if ( ! $post_id ) {
			wp_send_json_error( $error );
		}

		update_field( 'status', $status, $post_id );
		if ( $status === 'not_correctly' ) {
			update_field( 'not_correctly_comment', $validator->get_param( 'not_correctly_comment' ), $post_id );
		} else {
			update_field( 'not_correctly_comment', '', $post_id );
		}

		wp_send_json_success( array_merge(
			yar_get_modal_message( 'Отчет успешно сохранен' ),
			[
				'redirect' => '/wp-admin/post.php?post=' . $post_id . '&action=edit'
			]
		) );

		wp_die();
	}

	private function get_post_id( $report_id ) {
		global $wpdb;

		$table  = $wpdb->prefix . 'yar_report';
		$result = $wpdb->get_row( "SELECT * FROM $table WHERE id = $report_id", 'ARRAY_A' );
		if ( ! empty( $result ) ) {

			return $result['post_id'];
		}

		return false;
	}

	public function add_columns( $columns ){
		$custom_columns = [
			'custom_status' => 'Статус',
			'client'        => 'Клиент',
			'expert'        => 'Эксперт',
			'contact'       => 'Договор',
		];

		return array_slice( $columns, 0, 2 ) + $custom_columns + $columns;
	}

	public function output_column( $column_name, $post_id ) {
		if ( $column_name === 'custom_status' ) {
			$status = get_field( 'status', $post_id );
			echo '<div class="admin-custom__status _' . $status['value'] . '">' . $status['label'] . '</div>';
		}

		if ( $column_name === 'client' ) {
			$client = get_field( 'client', $post_id );
			if ( $client ) {
				echo '<strong>' . yar_get_fio_by_user_id( $client ) . '</strong>';
			}
		}

		if ( $column_name === 'expert' ) {
			$expert = get_field( 'expert', $post_id );
			if ( $expert ) {
				echo '<strong>' . yar_get_fio_by_user_id( $expert ) . '</strong>';
			}
		}

		if ( $column_name === 'contact' ) {
			$treaty = get_field( 'treaty', $post_id );

			if ( $treaty ) {
				$number = get_field( 'number', $treaty->ID );
				if ( $number ) {
					echo '<strong>' . $treaty->post_title . ': №' . $number . '</strong>';
				}
			}
		}

		if ( $column_name === 'paid_date' ) {
			echo yar_get_normal_date_format( get_field( 'paid_date', $post_id ) );
		}
	}
}