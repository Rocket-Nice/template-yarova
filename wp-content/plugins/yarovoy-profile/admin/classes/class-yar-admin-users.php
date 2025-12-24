<?php

class YAR_Admin_Users {
	public function __construct() {
		add_filter( 'manage_users_columns', [ $this, 'add_columns' ], 10, 2 );
		add_filter( 'manage_users_custom_column', [ $this, 'output_column' ], 10, 3 );

		add_action( 'edit_user_profile', [ $this, 'edit_user_profile' ] );
		add_action( 'wp_ajax_yar_admin_update_user', [ $this, 'publish_in_base' ] );
	}

	public function add_columns( $columns ){
		$columns[ 'status' ] = 'Статус';

		return $columns;
	}

	public function output_column( $row_output, $column_id_attr, $user_id ){
		if ( $column_id_attr === 'status' ){
			$status = get_field( 'status', 'user_' . $user_id );
			if ( $status ){
				$row_output .= '<div class="admin-custom__flex">';
				$row_output .= '<div class="admin-custom__status _' . $status['value'] . '">' . $status['label'] . '</div>';
				$row_output .= '</div>';
			}
		}

		return $row_output;
	}

	public function edit_user_profile( $user ){
		if ( in_array( 'basic_expert', $user->roles ) ) {
			$status = get_field( 'status', 'user_' . $user->ID );
			echo '<div class="admin-user-profile">';
			echo '<div class="admin-user-profile__status">';
			echo '<span>Статус: </span>';
			echo '<div class="admin-custom__status _' . $status['value'] . '">' . $status['label'] . '</div>';
			echo '</div>';
			echo '<a href="#" class="admin-user--update admin-btn" data-id="' . $user->ID . '" data-nonce="' . wp_create_nonce( 'yar_admin_update_user' ) . '">';

			if ( $status['value'] === 'new' ){
				echo 'Опубликовать в базе экспертов';
			} else {
				echo 'Обновить в базе экспертов';
			}

			echo '</a>';
			echo '</div>';
		}
	}

	public function publish_in_base(){
		if ( ! is_admin() || ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_nonce'], 'yar_admin_update_user' ) ) {
			wp_send_json_error();
		}

		$user_id = (int) $_POST['user_id'];
		if ( ! $user_id ) {
			wp_send_json_error();
		}

		$publish = ( new YAR_Admin_Publish_Expert() )->publish( $user_id );
		if ( is_wp_error( $publish ) ) {
			wp_send_json_error( $publish );
		}

		wp_send_json_success();

		wp_die();
	}
}