<?php

namespace YAR_Profile\Services\Report;

use WP_Error;

class YAR_Save_Equipment_Service {
	private $table = 'wp_yar_report_equipment';

	private function remove( $report_id ) {
		global $wpdb;

		$wpdb->delete( $this->table, [ 'report_id' => $report_id ] );
	}

	public function save( $report_id, $data, $fields = [] ) {
		if ( ! empty( $data ) ) {
			global $wpdb;

			$this->remove( $report_id );

			foreach ( $data as $datum ) {
				$wpdb->insert( $this->table, [
					'param_id' => $datum,
					'report_id'    => $report_id
				], [ '%d', '%d' ] );

				if ( ! empty( $wpdb->error ) ) {
					return new WP_Error( 'report_save_equipment', 'Ошибка при сохранении комлектации' );
				}
			}
		}

		return true;
	}
}

/**
 *			// TODO: Вернуть при пуше на DEV
//			$sms = ( new YAR_SMS_Service() )->send( $phone, $this->codes->save( $phone ) );
//
//			if ( is_wp_error( $sms ) ) {
//				wp_send_json_error( yar_get_modal_message(
//					'Произошла ошибка',
//					'Пожалуйста, обратитесь к администратору сайта'
//				) );
//			}
 */