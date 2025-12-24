<?php

add_action( 'wp_logout', 'yar_profile_redirect_after_logout' );
function yar_profile_redirect_after_logout() {
	wp_redirect( home_url() );
	exit();
}

add_action( 'template_redirect', 'yar_profile_template_redirect' );
function yar_profile_template_redirect() {
	if ( is_user_logged_in() ) {
		if ( is_page( [ 'login', 'register', 'forgot' ] ) ) {
			wp_redirect( '/profile' );
			die;
		}

		if ( ! yar_is_client() ) {
			if ( is_page( 'upload-car' ) ) {
				wp_redirect( home_url() );
				die;
			}
		}
	} else {
		if ( is_page( [ 'profile', 'reports', 'upload-car', 'contracts' ] ) ) {
			global $wp_query;

			$wp_query->set_404();
			status_header( 404 );
		}
	}
}