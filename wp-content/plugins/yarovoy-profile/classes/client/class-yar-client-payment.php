<?php

use YAR_Profile\Services\YAR_Payment_Service;

/**
 * Class YAR_Client_Payment
 * Payment request processing, payment link generated in a separate service
 */
class YAR_Client_Payment {
	public function __construct() {
		add_action( 'wp_ajax_yar_profile_contacts_pay', [ $this, 'payment' ] );
	}

	public function payment() {
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_nonce'], 'yar_profile_contacts_pay' ) ) {
			wp_send_json_error();
		}

		$contract_id = (int) $_POST['id'];
		if ( ! yar_check_payment_client( $contract_id ) ) {
			wp_send_json_error( yar_get_modal_message( 'Произошла ошибка', 'Пожалуйста, обратитесь к администратору' ) );
		}

		$user   = ( new YAR_User_Repository() )->get_current_user();
		$date   = time();
		$amount = get_field( 'total_amount', $contract_id );

		$payment = ( new YAR_Payment_Service() )->get_payment_link( [
			'amount'      => $amount,
			'first_name'  => $user['first_name'],
			'last_name'   => $user['first_name'],
			'phone'       => $user['phone'],
			'contract_id' => $contract_id
		] );

		if ( is_wp_error( $payment ) ) {
			wp_send_json_error( yar_get_modal_message( 'Произошла ошибка', 'Пожалуйста, обратитесь к администратору' ) );
		}

		update_field( 'url', $payment['link'], $contract_id );
		update_field( 'status', 'await_pay', $contract_id );
		update_field( 'paid_date', $date, $contract_id );
		update_field( 'uuid', $payment['id'], $contract_id );
		update_field( 'invoice_id', $payment['invoice_id'], $contract_id );

		wp_send_json_success( array_merge(
			yar_get_modal_message( 'Перенаправление', 'Через несколько секунд вы будете перенаправлены на форму оплаты. После оплаты, проверьте статус договора в ЛК' ),
			[
				'status' => 'await_pay',
				'title'  => 'Ожидает оплаты',
				'date'   => date( 'd.m.Y', $date ),
				'link'   => $payment['link']
			]
		) );

		wp_die();
	}
}