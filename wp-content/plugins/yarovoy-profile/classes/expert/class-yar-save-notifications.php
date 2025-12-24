<?php

/**
 * Class YAR_Expert_Save_Notifications
 * TODO: В дальнейшем вернуть в профиль
 */
class YAR_Expert_Save_Notifications {
	public function __construct() {
		add_action( 'wp_ajax_yar_expert_update_notifications', [ $this, 'save' ] );
	}

	public function save(){
		if ( ! wp_doing_ajax() || empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'yar_update_expert_notifications' ) ) {
			wp_send_json_error();
		}

		$user_id = get_current_user_id();

		if ( isset( $_POST['on_email'] ) ) {
			update_field( 'on_email', $_POST['on_email'], 'user_' . $user_id );
		}
		if ( isset( $_POST['on_phone'] ) ) {
			update_field( 'on_phone', $_POST['on_phone'], 'user_' . $user_id );
		}

		wp_send_json_success( [
			'popup' => [
				'title' => 'Профиль успешно сохранен',
				'text'  => ''
			]
		] );

		wp_die();
	}
}