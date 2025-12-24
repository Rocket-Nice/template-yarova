<?php

use YAR_Profile\Services\YAR_Payment_Service;

register_rest_route( YAR_API_NAMESPACE, '/profile/client/contracts/(?P<id>\d+)', [
	'methods'             => 'POST',
	'args'                => yar_rest_api_profile_pay_args(),
	'callback'            => 'yar_rest_api_profile_pay_callback',
	'permission_callback' => 'yar_is_client',
] );

function yar_rest_api_profile_pay_args() {
	$args = [];

	$args['id'] = [
		'type'     => 'integer',
		'required' => true,
	];

	return $args;
}

function yar_rest_api_profile_pay_callback( WP_REST_Request $request ) {
	$contract_id = $request->get_param( 'id' );
	if ( ! yar_check_payment_client( $contract_id ) ) {
		return yar_get_api_error_message( 'contract_not_exists', 'Договор не найден' );
	}

	$date   = time();
	$user   = ( new YAR_User_Repository() )->get_current_user();
	$amount = get_field( 'total_amount', $contract_id );

	$payment = ( new YAR_Payment_Service() )->get_payment_link( [
		'amount'      => $amount,
		'first_name'  => $user['first_name'],
		'last_name'   => $user['first_name'],
		'phone'       => $user['phone'],
		'contract_id' => $contract_id
	] );

	if ( is_wp_error( $payment ) ) {
		return yar_get_api_error_message( 'contract_payment_error', 'Произошла ошибка при оплате, обратитесь к администратору' );
	}

	update_field( 'url', $payment['link'], $contract_id );
	update_field( 'status', 'await_pay', $contract_id );
	update_field( 'paid_date', $date, $contract_id );
	update_field( 'uuid', $payment['id'], $contract_id );
	update_field( 'invoice_id', $payment['invoice_id'], $contract_id );


	return yar_get_api_format_data( [
		'status' => 'await_pay',
		'date'   => date( 'd.m.Y', $date ),
		'link'   => $payment['link']
	] );
}
