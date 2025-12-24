<?php

function get_brands() {
	global $wpdb;

	$cache_key = 'yar_get_brand';
	$cache     = wp_cache_get( $cache_key );

	if ( $cache !== false ) {
		return $cache;
	}

	$result = $wpdb->get_results(
		"SELECT * FROM wp_yar_bmg WHERE parent_id IS NULL AND type='brand'", 'ARRAY_A'
	);

	wp_cache_set( $cache_key, $result );

	return $result;
}

function get_models( $parent_id ) {
	global $wpdb;

	$cache_key = 'yar_get_model';
	$cache     = wp_cache_get( $cache_key );

	if ( $cache !== false ) {
		return $cache;
	}

	$result = $wpdb->get_results(
		"SELECT * FROM wp_yar_bmg WHERE parent_id=$parent_id AND type='model'", 'ARRAY_A'
	);

	wp_cache_set( $cache_key, $result );

	return $result;
}

function get_generations( $parent_id ) {
	global $wpdb;

	$cache_key = 'yar_get_generation';
	$cache     = wp_cache_get( $cache_key );

	if ( $cache !== false ) {
		return $cache;
	}

	$result = $wpdb->get_results(
		"SELECT * FROM wp_yar_bmg WHERE parent_id=$parent_id AND type='generation'", 'ARRAY_A'
	);

	wp_cache_set( $cache_key, $result );

	return $result;
}

add_action( 'wp_ajax_yar_get_bmg', 'yar_get_bmg' );
add_action( 'wp_ajax_nopriv_yar_get_bmg', 'yar_get_bmg' );
function yar_get_bmg() {
	if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['_nonce'], 'action_get_bmg' ) ) {
		wp_send_json_error();
	}

	$option_id = (int) $_POST['option_id'];
	$next_type = $_POST['next_type'];
	if ( ! $option_id || ! $next_type ) {
		wp_send_json_error();
	}

	$data = [];

	if ( $next_type === 'model' ) {
		$data = get_models( $option_id );
	}

	if ( $next_type === 'generation' ) {
		$data = get_generations( $option_id );
	}

	if ( empty( $data ) ) {
		wp_send_json_error();
	}

	$options = '';
	foreach ( $data as $datum ) {
		$options .= '<option value="' . $datum['id'] . '">' . $datum['title'] . '</option>';
	}

	wp_send_json_success( [
		'options' => $options
	] );

	wp_die();
}