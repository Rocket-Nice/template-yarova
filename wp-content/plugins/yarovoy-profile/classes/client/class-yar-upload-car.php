<?php

use YAR_Profile\Helpers\YAR_Validator;
use YAR_Profile\Services\YAR_Client_Save_Car_Service;
use YAR_Profile\Services\YAR_Client_Validate_Car_Service;

class YAR_Upload_Car {
	public function __construct() {
		add_action( 'wp_ajax_yar_profile_upload_car_fill', [ $this, 'fill_select' ] );
		add_action( 'wp_ajax_yar_profile_upload_get_step', [ $this, 'get_step' ] );
		add_action( 'wp_ajax_yar_profile_upload_validate', [ $this, 'validate' ] );
		add_action( 'wp_ajax_yar_profile_upload_save', [ $this, 'save' ] );
		add_action( 'wp_ajax_yar_profile_upload_car_send_order', [ $this, 'send_order' ] );
	}

	public function fill_select() {
		$id   = $_POST['id'];
		$type = $_POST['type'];

		if ( ! $id || ! $type ) {
			wp_send_json_error();
		}

		$result = ( new YAR_Car_Fields_Repository() )->fill_select( $id );
		if ( ! empty( $result ) ) {
			wp_send_json_success( [
				'options' => $result
			] );
		}

		wp_send_json_error();
		wp_die();
	}

	public function validate(){
		if ( empty( $_POST ) || ! $_POST['current_step'] ) {
			wp_send_json_error();
		}

		$rules  = ( new YAR_Car_Fields_Repository() )->get_validation_rules(  $_POST['current_step'] );
		if ( ! empty( $rules ) ){
			$validator = new YAR_Validator();
			$validator->validate( $rules );
		}

		wp_send_json_success();

		wp_die();
	}

	public function save() {
		if (
			! wp_doing_ajax()
			|| empty( $_POST )
			|| (
				! wp_verify_nonce( $_POST['_nonce'], 'yar_client_save_car' )
				&& ! wp_verify_nonce( $_POST['_nonce'], 'yar_client_update_car' )
			)
		) {
			wp_send_json_error();
		}

		$rules     = ( new YAR_Car_Fields_Repository() )->get_rules();
		$validator = new YAR_Validator();
		$validator->validate( $rules );

		$action = 'create';
		$car_id = 0;
		if ( check_ajax_referer( 'yar_client_update_car', '_nonce', false ) ) {
			$action = 'edit';
			$car_id = (int) $_POST['car_id'];
		}

		$save    = ( new YAR_Client_Save_Car_Service() )->save(
			$validator->validated(),
			$action,
			$car_id
		);

		if ( is_wp_error( $save ) ){
			wp_send_json_error( yar_get_modal_message( 'Произошла ошибка' ) );
		}

		wp_send_json_success(
			array_merge(
				yar_get_modal_message(
					'Сохранено',
					'Автомобиль добавлен и будет размещен в каталоге после проверки администратором сайта.' ),
				[
					'redirect' => '/profile/upload-car/'
				]
			)
		);

		wp_die();
	}

	public function send_order(){
		if (
			! wp_doing_ajax()
			|| empty( $_POST )
			|| ! wp_verify_nonce( $_POST['_nonce'], 'yar_profile_upload_car_send_order' )
			|| ! $user = wp_get_current_user()
		) {
			wp_send_json_error(
				yar_get_modal_message( 'Произошла ошибка' )
			);
		}

		$fio   = yar_get_fio_by_user_id( $user->ID );
		$phone = yar_get_field( 'phone', 'user_' . $user->ID, '' );

		$send = yar_send_to_telegram( [
			[
				'title' => 'ФИО',
				'value' => $fio,
			],
			[
				'title' => 'Телефон',
				'value' => yar_format_phone( $phone ),
			],
			[
				'title' => 'E-mail',
				'value' => $user->user_email,
			],
			[
				'title' => 'Страница',
				'value' => '/profile/upload-car/create/'
			],
			[
				'title' => 'Действие',
				'value' => 'Профиль: заказать выездную диагностику'
			],
		] );

		if ( ! $send ){
			wp_send_json_error(
				yar_get_modal_message( 'Произошла ошибка', 'Пожалуйста обратитесь к администратору сайта' )
			);
		}

		wp_send_json_success(
			yar_get_modal_message( 'Заявка успешно отравлена' )
		);

		wp_die();
	}
}