<?php

namespace YAR_Profile\Services;

use WP_Error;

/**
 * Class YAR_Email_Notifications_Service
 * Email service
 */
class YAR_Email_Notifications_Service {
	public function send( $to, $subject, $message ) {
		$from = 'info@yar.azat-web.ru';
		if ( yar_plugin_is_app_type( 'prod', '=' ) ){
			$from = 'info@yarovoycompany.ru';
		}

		$headers = "Content-type: text/html; charset=utf-8 \r\n";
		$headers .= "From: <$from\r\n";

		if ( wp_mail( $to, $subject, $message, $headers ) ) {
			return true;
		}

		return new WP_Error( 'send_code_error', 'Ошибка при отправке кода', 400 );
	}
}