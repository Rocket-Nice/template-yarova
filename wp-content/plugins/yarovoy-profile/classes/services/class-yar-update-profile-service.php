<?php

namespace YAR_Profile\Services;

use WP_Error;

/**
 * Class YAR_Update_Profile_Service
 * Update profile service. Save all fields by user type
 */
class YAR_Update_Profile_Service {
	private $data;
	private $user_id;
	private $prefix;

	public function update( $data ) {
		$this->data    = $data;
		$this->user_id = get_current_user_id();
		$this->prefix  = 'user_' . $this->user_id;

		$this->save_fields();

		$avatar = $this->save_avatar();
		if ( is_wp_error( $avatar ) ) {
			return $avatar;
		}

		if ( yar_is_expert() ) {
			$documents = $this->save_documents();
			if ( is_wp_error( $documents ) ) {
				return $documents;
			}

			$this->save_services();

			$portfolio = $this->save_portfolio();
			if ( is_wp_error( $portfolio ) ) {
				return $portfolio;
			}

			update_field( 'status', 'verification', $this->prefix );
		}

		return true;
	}

	private function save_avatar() {
		if ( isset( $this->data['avatar'] ) ) {
			return ( new YAR_File_Field_Service() )->save( $this->data['avatar'], 'avatar', $this->prefix );
		}

		return false;
	}

	private function save_fields() {
		update_field( 'last_name', $this->data['last_name'], $this->prefix );
		update_field( 'first_name', $this->data['first_name'], $this->prefix );
		if ( isset( $this->data['surname'] ) ) {
			update_field( 'surname', $this->data['surname'], $this->prefix );
		}

		update_field( 'phone', $this->data['phone'], $this->prefix );

		if ( yar_is_client() ) {
			if ( isset( $this->data['on_email'] ) ) {
				update_field( 'on_email', $this->data['on_email'], $this->prefix );
			}

			if ( isset( $this->data['on_phone'] ) ) {
				update_field( 'on_phone', $this->data['on_phone'], $this->prefix );
			}
		} elseif ( yar_is_expert() ) {
			update_field( 'region', $this->data['region'], $this->prefix );
			update_field( 'about', $this->data['about'], $this->prefix );
		}
	}

	private function save_documents() {
		$service = new YAR_Gallery_Field_Service();
		if ( isset( $this->data['documents_removed'] ) ) {
			$service->remove( $this->data['documents_removed'], 'documents', $this->prefix );
		}

		if ( ! empty( $this->data['documents'] ) ) {
			return $service->save( $this->data['documents'], 'documents', $this->prefix );
		}

		return true;
	}

	private function save_services() {
		$services = [];
		if ( ! empty( $this->data['services'] ) ){
			$services = (array) $this->data['services'];
		}

		$services = array_map( 'intval', $services );

		update_field( 'field_66e41529f93f1', $services, $this->prefix );
	}

	private function save_portfolio() {
		$service = new YAR_Gallery_Field_Service();
		if ( isset( $this->data['portfolio_removed'] ) ) {
			$service->remove( $this->data['portfolio_removed'], 'portfolio', $this->prefix );
		}

		if ( ! empty( $this->data['portfolio'] ) ) {
			return $service->save( $this->data['portfolio'], 'portfolio', $this->prefix );
		}

		return true;
	}
}