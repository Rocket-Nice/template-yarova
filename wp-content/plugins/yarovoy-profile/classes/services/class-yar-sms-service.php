<?php

namespace YAR_Profile\Services;

use WP_Error;

/**
 * Class YAR_SMS_Service
 * SMS service
 * TODO: В дальнейшем вернуть
 */
class YAR_SMS_Service {
	private $url = 'https://sms.ru/sms/send';
	private $api_key = 'F220FD4E-744D-CB85-2C1D-986361F11F90';

	private function get_response( $response ){
		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( ! empty( $body ) ) {
			return [
				'code' => isset( $body['status'] ) ? $body['status'] : $response['status_code'],
				'data' => $body
			];
		}

		return [
			'code' => 400,
			'data' => []
		];
	}

	public function send( $phone, $code ) {
		$body = $this->get_response(
			wp_remote_post(
				$this->url . '?api_id=' . $this->api_key .
				'&to=' . $phone .
				'&msg=Код авторизации: ' . $code .
				'&json=1'
			)
		);

		if ( $body['code'] !== 'OK' ) {
			return new WP_Error( 'yar_profile_error_sms_code', 'Произошла ошибка, обратитесь к администратору сайта.' );
		}

		return true;
	}
}