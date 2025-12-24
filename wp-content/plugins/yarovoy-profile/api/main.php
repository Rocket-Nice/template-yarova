<?php

define( 'YAR_API_NAMESPACE',  'yarovoy/v1' );

add_action( 'rest_api_init', 'yar_rest_api_init' );
function yar_rest_api_init(){
	// Experts
	require_once 'experts/list.php';
	require_once 'experts/id.php';

	// Base auto
	require_once 'base/list.php';
	require_once 'base/id.php';

	/** PROFILE **/
	// Common
	require_once 'profile/common/login.php';

	// Register
	require_once 'profile/common/register/get-code.php';
	require_once 'profile/common/register/confirm-code.php';

	// Reset password
	require_once 'profile/common/reset/get-code.php';
	require_once 'profile/common/reset/confirm-code.php';
	require_once 'profile/common/reset/save-password.php';

	// Update profile / password
	require_once 'profile/common/update-password.php';
	require_once 'profile/common/profile.php';

	// Files
	require_once 'profile/files/save.php';
	require_once 'profile/files/delete.php';

	// Refs
	require_once 'profile/reference/regions.php';
	require_once 'profile/reference/bmg.php';
	require_once 'profile/reference/services.php';

	// Client
	if ( yar_is_client() ) {
		require_once 'profile/client/upload-car/form.php';
		require_once 'profile/client/upload-car/list.php';
		require_once 'profile/client/upload-car/id.php';

		// Reports
		require_once 'profile/client/reports/list.php';
		require_once 'profile/client/reports/id.php';

		// Contacts
		require_once 'profile/client/contracts/list.php';
		require_once 'profile/client/contracts/pay.php';
	}

	if ( yar_is_expert() ){
		// Contracts
		require_once 'profile/expert/contracts/list.php';
		require_once 'profile/expert/contracts/complete.php';

		// Report
		require_once 'profile/expert/report/moderate/get-contracts.php';
		require_once 'profile/expert/report/moderate/save.php';

		require_once 'profile/expert/report/list.php';
		require_once 'profile/expert/report/form.php';
		require_once 'profile/expert/report/edit.php';
		require_once 'profile/expert/report/save.php';
		require_once 'profile/expert/report/view.php';
	}
}

function yar_is_logged_in() {
	return is_user_logged_in();
}

function yar_api_is_client(){
	return is_user_logged_in() && current_user_can( 'subscriber' );
}

function yar_api_is_expert(){
	return is_user_logged_in() && current_user_can( 'basic_expert' );
}

function yar_get_api_error_message( $code = 'not_found', $message = 'Ресурс не найден', $status = 400, $data = [] ) {
	return new WP_Error( $code, $message, array_merge( $data, [
		'status' => $status
	] ) );
}

function yar_get_api_format_data( $data = [], $status = 200 ) {
	return [
		'status' => $status,
		'data'   => $data
	];
}

function yar_get_post_thumbnail( $post_id, $size = 'big' ) {
	$thumbnail = '';

	if ( has_post_thumbnail( $post_id ) ) {
		$thumbnail = get_the_post_thumbnail_url( $post_id, $size );
	}

	return $thumbnail;
}

function yar_api_validate_password( $password ){
	$return = '';

	if ( mb_strlen( $password ) < 6 ){
		$return = 'Это поле должно содержать минимум 6 символов';
	}

	if ( ! preg_match( "#[0-9]+#", $password ) ) {
		$return = 'Ваш пароль должен содержать не менее 1 цифры';
	}

	if ( ! preg_match( "#[A-Z]+#", $password ) ) {
		$return = 'Ваш пароль должен содержать хотя бы одну заглавную букву';
	}

	if ( ! preg_match( "#[a-z]+#", $password ) ) {
		$return = 'Ваш пароль должен содержать хотя бы одну прописную букву';
	}

	return $return;
}

function yar_jwt_auth_token_before_dispatch( $data, $user ) {
	$user_info = get_user_by( 'email',  $user->data->user_email );

	return array_merge( $data, [
		'user_role' => $user_info->roles[0],
	] );
}
add_filter( 'jwt_auth_token_before_dispatch', 'yar_jwt_auth_token_before_dispatch', 10, 2 );

