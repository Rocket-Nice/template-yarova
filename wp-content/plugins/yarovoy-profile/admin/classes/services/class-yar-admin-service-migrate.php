<?php

class YAR_Admin_Service_Migrate {
	public function __construct() {
		add_action( 'wp_ajax_yar_admin_service_migrate', [ $this, 'set_new_service' ] );
	}

	public function set_new_service(){
		if (
			! current_user_can( 'administrator' )
			|| ! wp_doing_ajax()
			|| empty( $_POST )
			|| ! wp_verify_nonce( $_POST['_nonce'], 'yar_admin_service_migrate' )
		) {
			wp_send_json_error();
		}

		set_time_limit( -1 );

		$posts = get_posts( [
			'post_type' => 'expert',
			'posts_per_page' => -1
		] );

		if ( ! empty( $posts ) ) {
			foreach ( $posts as $post ) {
				$user = get_field( '_expert_user', $post->ID );
				if ( empty( $user ) ) {
					continue;
				}

				$services      = get_field( 'services', $post->ID );
				$services_user = [];

				if ( ! empty( $services ) ) {
					foreach ( $services as $service ) {
						$_post = get_posts( [
							'post_type' => 'service',
							's'         => $service['title']
						] );

						if ( ! empty( $_post ) ) {
							$services_user[] = $_post[0]->ID;
						}
					}

					if ( ! empty( $services_user ) ){
						update_field( 'services', $services_user, 'user_' . $user['ID'] );
					}
				}
			}
		}

		wp_send_json_success();

		wp_die();
	}
}