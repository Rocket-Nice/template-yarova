<?php

namespace YAR_Profile\Helpers;

/**
 * Class YAR_Codes
 * Actions for working with email codes
 */
class YAR_Codes {
	private $table = 'yar_email_codes';

	public function __construct() {
		global $wpdb;
		$this->table = $wpdb->prefix . $this->table;
	}

	private function generate() {
		return rand( 1000, 9999 );
	}

	public function get( $email ){
		global $wpdb;

		$result = $wpdb->get_row( "SELECT * FROM $this->table WHERE email='$email'" );

		if ( empty( $wpdb->error ) && ! empty( $result ) ) {
			return $result->code;
		}

		return false;
	}

	public function save( $email ){
		global $wpdb;

		$code = $this->generate();

		$wpdb->insert( $this->table, [
			'email' => $email,
			'code'  => $code
		] );

		if ( empty( $wpdb->error ) ) {
			return $code;
		}

		return false;
	}

	public function remove( $email ) {
		global $wpdb;
		$wpdb->delete( $this->table, [ 'email' => $email ] );
	}

	public function compare( string $email, int $code ) {
		global $wpdb;

		$result = $wpdb->get_row( "SELECT * FROM $this->table WHERE email='$email' AND code=$code" );

		if ( empty( $wpdb->error ) && ! empty( $result ) ) {
			return true;
		}

		return false;
	}
}