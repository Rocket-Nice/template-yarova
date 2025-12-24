<?php

namespace YAR_Profile\Helpers;

/**
 * Class YAR_User
 * Helpers for working with user
 */
class YAR_User {
	public function get_by_phone( $phone ){
		$user = get_users( [
			'meta_query' => [
				[
					'key'   => 'phone',
					'value' => $phone
				]
			]
		] );

		if ( empty( $user ) ) {
			return false;
		}

		return $user[0];
	}

	public function get_by_email( $email ){
		$user = get_user_by( 'email', $email );
		if ( empty( $user ) ){
			return false;
		}

		return $user;
	}

	public function check_user_email( $email ){
		$user = wp_get_current_user();

		if ( $email !== $user->user_email && email_exists( $email ) ){
			return false;
		}

		return true;
	}

	public function check_user_phone( $phone ){
		$user_phone = get_field( 'phone', 'user_' . get_current_user_id() );
		if ( $phone !== $user_phone && $this->get_by_phone( $phone ) ) {
			return false;
		}

		return true;
	}

	public function get_current_user() {
		$current_user = wp_get_current_user();
		$user_prefix  = 'user_' . $current_user->ID;

		return [
			'user_email'    => $current_user->user_email,
			'avatar'        => get_field( 'avatar', $user_prefix ),
			'last_name'     => get_field( 'last_name', $user_prefix ),
			'first_name'    => get_field( 'first_name', $user_prefix ),
			'surname'       => get_field( 'surname', $user_prefix ),
			'phone'         => get_field( 'phone', $user_prefix ),
			'notifications' => [
				'on_email' => get_field( 'on_email', $user_prefix ),
				'on_phone' => get_field( 'on_phone', $user_prefix ),
			]
		];
	}
}