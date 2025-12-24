<?php

add_action( 'wp_ajax_yar_get_phone', 'yar_get_phone' );
add_action( 'wp_ajax_nopriv_yar_get_phone', 'yar_get_phone' );
function yar_get_phone() {
	if ( empty( $_POST ) || empty( $_POST['post_id'] ) ) {
		wp_send_json_error();
	}

	$phone = get_field( 'phone', (int) $_POST['post_id'] );
	if ( $phone ) {
		wp_send_json_success( [
			'phone' => $phone
		] );
	}

	wp_send_json_error();
}