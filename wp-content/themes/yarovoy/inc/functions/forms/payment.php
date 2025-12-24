<?php

function get_request_response( $response ) {
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

add_action( 'wp_ajax_yar_payment_form', 'yar_payment_form' );
add_action( 'wp_ajax_nopriv_yar_payment_form', 'yar_payment_form' );
function yar_payment_form() {
	if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_payment_action' ) ) {
		wp_send_json_error();
	}

	$errors  = new WP_Error();

	$first_name = $_POST['first_name'];
	$last_name  = $_POST['last_name'];
	$phone      = $_POST['phone'];
	$amount     = $_POST['amount'];

	if ( empty( $first_name ) ) {
		$errors->add( 'first_name', 'Это поле необходимо заполнить' );
	}

	if ( empty( $last_name ) ) {
		$errors->add( 'last_name', 'Это поле необходимо заполнить' );
	}

	if ( empty( $phone ) ) {
		$errors->add( 'phone', 'Это поле необходимо заполнить' );
	}

	if ( empty( $amount ) ) {
		$errors->add( 'amount', 'Это поле необходимо заполнить' );
	}

	if ( ! empty( $errors->errors ) ) {
		wp_send_json_error( [
			'errors' => $errors->errors
		] );
	}

	$user     = "admin";
	$password = "523bb7ad2f59";

	$server_paykeeper = "https://yapodbor.server.paykeeper.ru";

	$get_token = wp_remote_post( $server_paykeeper . '/info/settings/token/', [
		'headers' => [
			'Authorization' => 'Basic ' . base64_encode( $user . ':' . $password )
		]
	] );

	$token_body = get_request_response( $get_token );
	if ( $token_body['status'] !== 200 && empty( $token_body['data']['token'] ) ) {
		wp_send_json_error( [
			'messages' => 'Произошла ошибка, обратитесь к администратору сайта.'
		] );
	}

	$order_title = 'Заказ #' . time();

	$token = $token_body['data']['token'];
	$data  = [
		'pay_amount'   => $amount,
		'clientid'     => $last_name . ' ' . $first_name,
		'orderid'      => $order_title,
		'client_email' => "info@yapodbor.ru",
		'service_name' => "Оплата с произвольным платежом из пользовательской части",
		'client_phone' => $phone,
		'token'        => $token
	];

	$response = wp_remote_post( $server_paykeeper . '/change/invoice/preview/', [
		'headers' => [
			'Authorization' => 'Basic ' . base64_encode( $user . ':' . $password )
		],
		'body'    => $data
	] );

	$response_body = get_request_response( $response );
	if ( empty( $response_body['data']['invoice_id'] ) ) {
		wp_send_json_error( [
			'messages' => 'Произошла ошибка, обратитесь к администратору сайта.'
		] );
	}

	$post_id = wp_insert_post( wp_slash( [
		'post_title'  => $order_title,
		'post_name'   => 'order-' . time(),
		'post_type'   => 'order_payments',
		'post_status' => 'draft',
        'post_author' => 1
	] ) );

	if ( ! is_wp_error( $post_id ) ) {
		update_field( 'id', $response_body['data']['invoice_id'], $post_id );
		update_field( 'first_name', $first_name, $post_id );
		update_field( 'last_name', $first_name, $post_id );
		update_field( 'phone', $phone, $post_id );
		update_field( 'amount', $amount, $post_id );
	}

	wp_send_json_success( [
		'link' => $response_body['data']['invoice_url']
	] );

	wp_die();
}