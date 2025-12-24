<?php

/**
 * Class YAR_Car_Sold
 * Set car status is sold
 */
class YAR_Car_Sold {
	public function __construct() {
		add_action( 'wp_ajax_yar_profile_client_car_sold', [ $this, 'sold' ] );
	}

	public function sold() {
		if (
			! wp_doing_ajax()
			|| empty( $_POST )
			|| ! wp_verify_nonce( $_POST['nonce'], 'yar_profile_sold_car' )
			|| ! yar_check_car_user( $_POST['post_id'] )
		) {
			wp_send_json_error(
				yar_get_modal_message( 'Произошла ошибка' )
			);
		}

		update_field( 'is_sold', 1, $_POST['post_id'] );
		wp_send_json_success(
			yar_get_modal_message( 'Объявление снято с продажи' )
		);

		wp_die();
	}
}