<?php

namespace YAR_Profile\Services\Report;

class YAR_Save_Owners_Data_Service {
	public function save( $data = [], $post_id = 0 ) {
		if ( empty( $data ) || ! $post_id ) {
			return false;
		}

		if ( isset( $data['owners_fio'] ) ) {
			update_field( 'owners_fio', $data['owners_fio'], $post_id );
		}
		if ( isset( $data['owners_phone'] ) ) {
			update_field( 'owners_phone', $data['owners_phone'], $post_id );
		}

		return true;
	}
}