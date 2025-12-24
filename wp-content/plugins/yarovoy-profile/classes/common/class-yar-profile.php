<?php

use YAR_Profile\Helpers\YAR_User;
use YAR_Profile\Helpers\YAR_Validator;
use YAR_Profile\Services\YAR_Update_Profile_Service;

/**
 * Class YAR_Login
 * Update profile by user type (client, expert)
 */
class YAR_Profile {
	private $user_hepler;
	private $validator;

	public function __construct() {
		add_action( 'wp_ajax_yar_profile_save_settings', [ $this, 'update_profile' ] );

		$this->user_helper = new YAR_User();
		$this->validator   = new YAR_Validator();
	}

	private function validate() {
		if ( yar_is_client() ) {
			$this->validator->validate( [
				'last_name'  => 'required',
				'first_name' => 'required',
				'surname'    => '',
				'phone'      => 'required|min:11|max:11',
				'on_email'   => '',
				'on_phone'   => '',
			] );
		} elseif ( yar_is_expert() ) {
			$this->validator->validate( [
				'last_name'         => 'required',
				'first_name'        => 'required',
				'surname'           => '',
				'phone'             => 'required|min:11|max:11',
				'region'            => 'required',
				'avatar'            => 'file|type:jpg,jpeg',
				'documents'         => 'file|type:jpg,jpeg',
				'portfolio'         => 'file|type:jpg,jpeg',
				'portfolio_removed' => '',
				'documents_removed' => '',
				'services'          => '',
				'about'             => 'required'
			] );
		}
	}

	public function update_profile() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_profile_action_update_settings' ) ) {
			wp_send_json_error();
		}

		$this->validate();

		$phone = $this->validator->get_param( 'phone' );
		if ( ! $this->user_helper->check_user_phone( $phone ) ) {
			wp_send_json_error( yar_get_modal_message( 'Такой пользователь уже существует', 'Введите другой телефон' ) );
		}

		$update = ( new YAR_Update_Profile_Service() )->update( $this->validator->validated() );

		if ( is_wp_error( $update ) ) {
			wp_send_json_error( yar_get_modal_message( 'Произошла ошибка', 'Пожалуйста, обратитесь к администратору' ) );
		}

		wp_send_json_success(  yar_get_modal_message( 'Профиль успешно сохранен', '' ) );

		wp_die();
	}

}