<?php

namespace YAR_Profile\Services\Api;

use YAR_Profile\Helpers\YAR_User;

class YAR_Login_Api_Service {
	public function auth( $phone, $password ) {
		$user = ( new YAR_User() )->get_by_phone( $phone );

		if ( $user ) {
			$response = wp_remote_post( 'http://yar.azat-web.ru/wp-json/jwt-auth/v1/token', [
				'body' => [
					'username' => $user->user_login,
					'password' => $password
				]
			] );

			if ( ! is_wp_error( $response ) ) {
				$status = wp_remote_retrieve_response_code( $response );
				$body   = json_decode( wp_remote_retrieve_body( $response ), true );

				if ( $status === 403 ) {
					return yar_get_api_error_message( 'user_incorrect_phone', 'Телефон / пароль не верные', 401 );
				}

				if ( $status === 200 && ! empty( $body ) ) {
					return $body;
				}
			}
		}

		return yar_get_api_error_message( 'user_not_exist', 'Пользователь не найден', 404 );
	}
}