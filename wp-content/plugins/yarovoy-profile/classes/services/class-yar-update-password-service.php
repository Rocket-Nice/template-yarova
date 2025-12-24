<?php

namespace YAR_Profile\Services;

/**
 * Class YAR_Update_Password_Service
 * Update password service
 */
class YAR_Update_Password_Service {
	public function update( $password ){
		$user_id = get_current_user_id();

		if ( ! $user_id ) {
			return false;
		}

		$password = trim( wp_unslash( $password ) );
		wp_set_password( $password, $user_id );

		return true;
	}
}