<?php

namespace YAR_Profile\Services;

use YAR_Profile\Helpers\YAR_Codes;

class YAR_Register_Service {
	public function register( $data ){
		if ( empty( $data ) ) {
			return yar_get_api_error_message( 'user_error', 'Ошибка при создании пользователя', 404 );
		}

		$phone      = $data['phone'];
		$email      = $data['email'];
		$first_name = $data['first_name'];
		$last_name  = $data['last_name'];
		$surname    = $data['surname'];
		$password   = $data['password'];

		$role = get_option( 'default_role' );
		if ( isset( $data['is_expert'] ) && $data['is_expert'] ) {
			$role = 'basic_expert';
		}

		$user_id = wp_insert_user( [
			'user_login' => $email,
			'user_pass'  => $password,
			'user_email' => $email,
			'role'       => $role
		] );

		if ( is_wp_error( $user_id ) ) {
			return yar_get_api_error_message( 'user_error', 'Ошибка при создании пользователя', 404 );
		}

		$user_prefix = 'user_' . $user_id;

		update_field( 'phone', $phone, $user_prefix );
		update_field( 'first_name', $first_name, $user_prefix );
		update_field( 'last_name', $last_name, $user_prefix );

		if ( $role === 'basic_expert' ) {
			update_field( 'status', 'new', $user_prefix );
		}

		if ( $surname ){
			update_field( 'surname', $surname, $user_prefix );
		}

		// Remove old codes
		( new YAR_Codes() )->remove( $phone );

		return $user_id;
	}
}