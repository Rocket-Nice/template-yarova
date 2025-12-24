<?php

function yar_get_config( $name ) {
	return require YAR_PROFILE_DIR . 'config/' . $name . '.php';
}

function yar_get_car_component( $name, $data = [] ) {
	get_template_part( YAR_THEME_TEMPLATES . '/profile/client/upload-car/components/' . $name, null, $data );
}

function yar_check_report_id( $report_id ) {
	global $wpdb;

	$table  = $wpdb->prefix . 'yar_report';
	$report = $wpdb->get_row( "SELECT * FROM $table WHERE id = $report_id", 'ARRAY_A' );

	if ( ! empty( $report ) ) {
		$post = get_post( $report['post_id'] );
		if ( ! empty( $post ) ) {
			$expert = get_field( 'expert', $post->ID );
			$client = get_field( 'client', $post->ID );
			if (
				( $expert && $expert === get_current_user_id() )
				|| ( $client && $client === get_current_user_id() )
			) {
				return $post->ID;
			}
		}
	}

	return false;
}

function yar_check_report_status( $post_id ) {
	$access_statuses = [ 'approved', 'rejected' ];
	if ( yar_is_expert() ) {
		$access_statuses = [ 'in_work', 'saved', 'not_correctly', 'approved' ];
	}

	$post = get_post( $post_id );
	if ( empty( $post ) || $post->post_status !== 'publish' ) {
		return false;
	}

	$status = get_field( 'status', $post_id );

	return in_array( $status['value'], $access_statuses );
}

function yar_is_expert() {
	return is_user_logged_in() && current_user_can( 'basic_expert' );
}

function yar_is_client() {
	return is_user_logged_in() && current_user_can( 'subscriber' );
}

function yar_get_normal_date_format( $date ) {
	if ( ! $date ) {
		return '';
	}

	return date( 'd.m.Y', strtotime( $date ) );
}

function yar_get_file_url( $field ) {
	if ( empty( $field ) || ! isset( $field['url'] ) ) {
		return '';
	}

	return $field['url'];
}

function yar_get_modal_message( $title, $message = '', $code = '' ) {
	return [
		'popup' => [
			'title'   => $title,
			'message' => $message,
			'code'    => $code
		]
	];
}

function yar_get_select_options( $post_type, $args = [] ) {
	$posts = get_posts( [
		'post_type'      => $post_type,
		'posts_per_page' => - 1,
		'orderby'        => 'title',
		'order'          => 'ASC'
	] );

	$return = [];

	if ( ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$return[ $post->ID ] = $post->post_title;
		}
	}

	return $return;
}

function yar_check_payment_client( $contact_id ) {
	$post = get_post( $contact_id );
	if ( ! empty( $post ) && $post->post_type === 'contracts' ) {
		$client = get_field( 'client', $contact_id );
		$status = get_field( 'status', $contact_id );
		if (
			$client === get_current_user_id()
			&& $status['value'] !== 'paid'
			&& $status['value'] !== 'await_pay'
		) {
			return true;
		}
	}

	return false;
}

function yar_get_price_with_currency( $price ) {
	$price = yar_get_normal_price( $price );
	if ( ! $price ) {
		return '';
	}

	return $price . ' ₽';
}

function yar_get_fio_by_user_id( $user_id ) {
	$last_name  = get_field( 'last_name', 'user_' . $user_id );
	$first_name = get_field( 'first_name', 'user_' . $user_id );
	$surname    = get_field( 'surname', 'user_' . $user_id );

	return $last_name . ' ' . $first_name . ' ' . $surname;
}

function yar_get_field( $selector, $post_id, $default = '' ) {
	$field = get_field( $selector, $post_id );
	if ( empty( $field ) ) {
		return $default;
	}

	return $field;
}

function yar_get_format_services( $services ) {
	if ( empty( $services ) ) {
		return $services;
	}

	foreach ( $services as $key => $service ) {
		$services[ $key ]['price'] = yar_get_price_with_currency( $service['price'] );
	}

	return $services;
}

function yar_get_file_data( $data ) {
	$value = [];
	$set_array = function ( $item ){
		$value = [];

		if ( isset( $item['id'] ) ){
			$value['id'] = $item['id'];
		}

		if ( isset( $item['url'] ) ){
			$value['url'] = $item['url'];
		}

		if ( isset( $item['filename'] ) ){
			$value['name'] = $item['filename'];
		}

		if ( isset( $item['mime_type'] ) ) {
			$value['mime_type'] = $item['mime_type'];
		}

		return $value;
	};

	if ( ! yar_is_associative( $data ) ) {
		foreach ( $data as $datum ) {
			$value[] = $set_array( $datum );
		}
	} else {
		$value = $set_array( $data );
	}

	return $value;
}

function yar_check_car_user( $post_id ) {
	if ( ! $post_id ) {
		return false;
	}

	$post = get_post( $post_id );
	if ( $post->post_type === 'auto' ) {
		$client = get_field( 'client', $post_id );
		if ( $client && $client === get_current_user_id() ) {
			return true;
		}
	}

	return false;
}

if ( yar_is_client() || yar_is_expert() ) {
	add_filter( 'show_admin_bar', '__return_false' );
}

function yar_restrict_admin_access() {
	if ( ! wp_doing_ajax() && ( yar_is_client() || yar_is_expert() ) ) {
		wp_redirect( home_url() );
		exit();
	}
}

add_action( 'admin_init', 'yar_restrict_admin_access' );

function yar_filter_gallery_field( $gallery ) {
	if ( empty( $gallery ) ) {
		return [];
	}

	foreach ( $gallery as $key => $item ) {
		$gallery[ $key ] = yar_get_file_url( $item );
	}

	return $gallery;
}

function yar_format_phone( $phone ) {
	$phone = trim( $phone );

	return preg_replace(
		[
			'/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
		],
		[
			'+7 ($2) $3-$4-$5',
		],
		$phone
	);
}

function yar_send_to_telegram( $data ) {
	if ( empty( $data ) ) {
		return false;
	}

	$message = '';
	foreach ( $data as $datum ) {
		$message .= $datum['title'] . ": " . $datum['value'] . "\n";
	}


	$response = wp_remote_post( 'https://api.telegram.org/bot7132338626:AAHNHxYdUXnxY-tOQhpU-Tc_jMN6sJRGS0U/sendMessage', [
		'body' => [
			'chat_id' => - 1002010083232,
			'text'    => $message
		]
	] );

	if ( ! is_wp_error( $response ) && wp_remote_retrieve_body( $response ) ) {
		return true;
	}

	return false;
}

function yar_dd_json( $array ) {
	echo json_encode( $array );
}

function yar_is_associative( $array ) {
	if ( empty( $array ) ){
		return true;
	}

	return array_keys( array_merge( $array ) ) !== range( 0, count( $array ) - 1 );
}

function yar_plugin_get_template( $path, $data = [], $load_once = true, $is_admin = false ) {
	$dir = $is_admin ? YAR_PROFILE_ADMIN_TEMPLATES : YAR_PROFILE_TEMPLATES;

	load_template(
		$dir . '/' . $path . '.php',
		$load_once,
		$data
	);
}

/**
 * We check what environment we are currently in: local, dev, prod.
 * Some actions depend on this, for example, the code does not fall on Email for the local environment.
 * @param string $type prod|dev|local
 * @param string $operator
 *
 * @return bool
 */
function yar_plugin_is_app_type( $type = 'prod', $operator = '=' ){
	if ( defined( 'WP_YAR_PROFILE_TYPE_APP' ) ){
		if ( $operator === '!=' ){
			return WP_YAR_PROFILE_TYPE_APP !== $type;
		}

		if ( $operator === '=' ){
			return WP_YAR_PROFILE_TYPE_APP === $type;
		}
	}

	return true;
}