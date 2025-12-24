<?php

function get_base_feature( $key ) {
	$features = get_field( 'features' );
	if ( empty( $features ) ) {
		return '';
	}

	if ( ! empty( $features ) ) {
		foreach ( $features as $feature ) {
			if ( $feature['title'] == $key ) {
				return $feature['value'];
			}
		}
	}

	return '';
}

add_action( 'wp_ajax_yar_base_get_phone', 'yar_base_get_phone' );
add_action( 'wp_ajax_nopriv_yar_base_get_phone', 'yar_base_get_phone' );
function yar_base_get_phone() {
	if (
		empty( $_POST ) ||
		! wp_verify_nonce( $_POST['_nonce'], 'yar_base_auto_phone' )
		|| empty( $_POST['post_id'] )
	) {
		wp_send_json_error();
	}

	$phone = '+7 (495) 159-39-20';

	$post_id = (int) $_POST['post_id'];
	$client  = get_field( 'client', $post_id );
	if ( $client ) {
		$phone = yar_get_field( 'phone', 'user_' . $client, $phone );
		$phone = yar_format_phone( $phone );
	}

	wp_send_json_success( [
		'phone' => $phone
	] );

	wp_die();
}

function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');