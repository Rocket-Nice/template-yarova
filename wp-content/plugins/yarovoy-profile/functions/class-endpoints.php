<?php

class YAR_Endpoints {
	private $endpoints = [];

	public function init() {
		$this->set_endpoints();

		add_action( 'init', [ $this, 'add_endpoints' ] );
		add_filter( 'query_vars', [ $this, 'query_vars' ] );
		add_filter( 'template_include',  [ $this, 'template_include' ] );
		add_action( 'template_redirect',  [ $this, 'template_redirect' ] );

		register_activation_hook( __FILE__, [ $this, 'activate' ] );
		register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );
	}

	private function set_endpoints() {
		$this->endpoints = require YAR_PROFILE_DIR . 'config/endpoints.php';
	}

	public function query_vars( $vars ){
		$vars[] = 'report_item';

		return $vars;
	}

	private function check_user_type( $endpoint ) {
		$user_type = $endpoint['user_type'];
		if ( ! is_array( $user_type ) ) {
			$user_type = ( array ) $user_type;
		}

		foreach ( $user_type as $type ) {
			if ( $type === 'client' && yar_is_client() ){
				return true;
			}

			if ( $type === 'expert' && yar_is_expert() ){
				return true;
			}

			if ( $type === 'admin' && current_user_can( 'administrator' ) ){
				return true;
			}
		}

		return false;
	}

	private function determinate_endpoint( $wp_query, $endpoint ) {
		return (
			isset( $wp_query->query[ $endpoint['endpoint'] ] )
			&& (
				// Check if endpoint for user_type
				! $this->check_user_type( $endpoint )
				// Check if endpoint has number
				|| (
					isset( $endpoint['is_number'] )
					&& ! is_numeric( $wp_query->query[ $endpoint['endpoint'] ] )
				)
				|| (
					isset( $endpoint['callback'] )
					&& is_callable( $endpoint['callback'] )
					&& ! call_user_func( $endpoint['callback'], $wp_query->query[ $endpoint['endpoint'] ] )
				)
			)
		);
	}

	public function template_redirect() {
		global $wp_query;

		foreach ( $this->endpoints as $endpoint ) {
			if ( $this->determinate_endpoint( $wp_query, $endpoint ) ) {
				$wp_query->set_404();
				status_header( 404 );

				break;
			}
		}
	}

	public function template_include( $template = '' ){
		global $wp_query;

		foreach ( $this->endpoints as $endpoint ) {
			if (
				isset( $wp_query->query_vars[ $endpoint['endpoint'] ] )
				&& ! $this->determinate_endpoint( $wp_query, $endpoint )
				&& ! empty( $endpoint['template'] )
			) {
				$template = YAR_PROFILE_DIR . $endpoint['template'] . '.php';
			}
		}

		return $template;
	}

	public function add_endpoints() {
		foreach ( $this->endpoints as $endpoint ) {
			add_rewrite_endpoint( $endpoint['endpoint'], EP_ROOT );
			if ( isset( $endpointp['rules'] ) ) {
				add_rewrite_rule( $endpointp['rules'], 'index.php?pagename=$matches[1]', 'top' );
			}
		}
	}

	public function activate() {
		$this->add_endpoints();
		flush_rewrite_rules();
	}

	public function deactivate() {
		flush_rewrite_rules();
	}
}