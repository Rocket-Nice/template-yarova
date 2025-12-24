<?php

namespace YAR_Profile\Services;
use WP_Error;
use YAR_Contracts_Repository;

/**
 * Class YAR_Payment_Service
 * Service for working with paykeeper API
 */
class YAR_Payment_Service {
	private $user = 'admin';
	private $password = '523bb7ad2f59';
	private $server = 'https://yapodbor.server.paykeeper.ru';

	private $token;

	private function get_header() {
		return [
			'Authorization' => 'Basic ' . base64_encode( $this->user . ':' . $this->password )
		];
	}

	private function get_status( $body ){
		if ( ! empty( $body['status'] ) ){
			return $body['status'];
		}

		if ( ! empty( $body['status_code'] ) ){
			return $body['status_code'];
		}

		return 200;
	}

	private function get_response( $response ) {
		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( ! empty( $body ) ) {
			return [
				'code' => $this->get_status( $body ),
				'data' => $body
			];
		}

		return [
			'code' => 400,
			'data' => []
		];
	}

	private function create_token() {
		$body = $this->get_response( wp_remote_post( $this->server . '/info/settings/token/', [
			'headers' => $this->get_header()
		] ) );

		if ( $body['code'] !== 200 && empty( $body['data']['token'] ) ) {
			return new WP_Error( 'yar_profile_error_payment', 'Произошла ошибка, обратитесь к администратору сайта.' );
		}

		$this->token = $body['data']['token'];

		return $body['data']['token'];
	}

	public function get_payment_link( $data ) {
		if ( empty( $data ) ) {
			return new WP_Error( 'yar_profile_error_payment', 'Произошла ошибка, обратитесь к администратору сайта.' );
		}

		$client   = $data['last_name'] . ' ' . $data['first_name'];
		$order_id = $data['contract_id'] . $client . rand( 10000, 99999 );
		$order_id = hash( 'sha256', $order_id );

		$token = $this->create_token();
		$send  = [
			'pay_amount'   => (float) $data['amount'],
			'clientid'     => $client,
			'orderid'      => $order_id,
			'client_email' => "info@yapodbor.ru",
			'service_name' => '{"service_name":"Оплата с произвольным платежом из пользовательской части", "user_result_callback": "http://yar.azat-web.ru/thanks-payment/?order_type=contract&order_id=' . $order_id . '"}',
			'client_phone' => $data['phone'],
			'token'        => $token,
		];

		$response = $this->get_response( wp_remote_post( $this->server . '/change/invoice/preview/', [
			'headers' => $this->get_header(),
			'body'    => $send
		] ) );

		
		if ( empty( $response['data']['invoice_id'] ) ) {
			return new WP_Error( 'yar_profile_error_payment', 'Произошла ошибка, обратитесь к администратору сайта.' );
		}

		return [
			'link'       => $response['data']['invoice_url'],
			'invoice_id' => $response['data']['invoice_id'],
			'id'         => $order_id,
		];
	}

	/**
	 * Set status after payment complete or fail
	 * @return bool
	 */
	public function set_payment_status(){
		$order_type = $_GET['order_type'] ?? '';
		$result     = $_GET['result'] ?? 'fail';
		$order_id   = $_GET['order_id'] ?? '';

		if (
			(
				empty( $order_type )
				|| $order_type !== 'contract'
			)
			|| empty( $order_id )
		) {
			return false;
		}

		$contract = ( new YAR_Contracts_Repository() )->get_by_uuid( $order_id );
		if ( empty( $contract ) ) {
			return false;
		}

		update_field( 'status', $result === 'success' ? 'paid' : 'error', $contract->ID );
		update_field( 'url', '', $contract->ID );

		return true;
	}
}