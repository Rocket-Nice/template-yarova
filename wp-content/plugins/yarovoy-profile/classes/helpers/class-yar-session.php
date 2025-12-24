<?php

namespace YAR_Profile\Helpers;

/**
 * Class YAR_Session
 * Actions for working with email codes
 */
class YAR_Session {
	private function start() {
		if ( ! isset( $_SESSION ) ) {
			session_start();
		}
	}

	public function add( $key, $value ) {
		$this->start();

		if ( isset( $_SESSION[ $key ] ) ) {
			$this->remove( $key );
		}

		$_SESSION[ $key ] = $value;
	}

	public function get( $key ) {
		$this->start();

		if ( isset( $_SESSION[ $key ] ) ) {
			return $_SESSION[ $key ];
		}

		return false;
	}

	public function remove( $key ){
		$this->start();

		if ( isset( $_SESSION[ $key ] ) ) {
			unset( $_SESSION[ $key ] );
		}
	}

	public function destroy(){
		session_destroy();
	}
}