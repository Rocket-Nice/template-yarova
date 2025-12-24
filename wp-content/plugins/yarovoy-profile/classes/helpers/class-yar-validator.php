<?php

namespace YAR_Profile\Helpers;

/**
 * Class YAR_Validator
 * Helper class for working validate forms
 */
class YAR_Validator {
	public $validated = [];

	public function validated(){
		return $this->validated;
	}

	/**
	 * Get param from request
	 * @param $key
	 * @return false|mixed
	 */
	public function get_param( $key ) {
		$data = $this->validated();
		if ( isset( $data[ $key ] ) ) {
			return $data[ $key ];
		}

		return false;
	}

	public function validate( $rules, $data = [], $return_errors = false ) {
		if ( empty( $data ) ) {
			$data = $_POST;
		}

		if ( ! empty( $_FILES ) ){
			$data = array_merge( $data, $_FILES );
		}

		$wp_error = new \WP_Error();

		foreach ( $rules as $key => $rule ) {
			if ( ! isset( $data[ $key ] ) ) {
				$data[ $key ] = '';
			}

			$errors = explode( '|', $rule );
			foreach ( $errors as $error ) {
				$error = $this->switch_errors( $error,  $data[ $key ], $key );
				if ( $error ){
					$wp_error->add( $key, $error );
				} else {
					$value = $data[ $key ];

					// Prepare always phone to one format
					if ( $key === 'phone' ) {
						$value = yar_reset_phone( $value );
					}

					$this->validated[ $key ] = $value;
				}
			}
		}

		if ( ! empty( $wp_error->errors ) ) {
			if ( $return_errors ){
				return $wp_error;
			}

			wp_send_json_error( [
				'errors'  => $wp_error->errors,
				'message' => 'Необходимо заполнить все обязательные поля'
			] );
		}
	}

	/**
	 * Switch of types errors
	 * Example: [
	 *  'name' => 'required|min:8|max:15'
	 * ]
	 * @param string $key Name of error: required|min
	 * @param mixed $value Value from request
	 * @param string $field_key Key of field from request, example: phone
	 *
	 * @return array|string
	 */
	private function switch_errors( $key, $value, $field_key = '' ){
		$return = '';
		$type   = '';

		if ( strpos( $key, ':' ) !== false ) {
			$explode = explode( ':', $key );
			if ( isset( $explode[0] ) ) {
				$key = $explode[0];
			}

			if ( isset( $explode[1] ) ) {
				$type = $explode[1];
			}
		}

		switch ( $key ){
			case 'required':
				if ( $value == '' ){
					$return = 'Это поле необходимо заполнить';
				}

				break;
			case 'email':
				if ( ! is_email( $value ) ){
					$return = 'Введите валидный E-mail';
				}

				break;
			case 'confirmed':
				$password = $_POST['password'];

				if ( ! isset( $password ) || $password !== $value ) {
					$return = 'Это поле должно совпадать с паролем';
				}

				break;
			case 'type':
				if ( ! empty( $value ) ) {
					$return = [];
					$types  = explode( ',', $type );

					if ( is_array( $value['name'] ) ) {
						foreach ( $value['name'] as $key => $item ) {
							if ( empty( $value['name'][ $key ] ) ) {
								continue;
							}

							$ext = mb_strtolower( pathinfo( $value['name'][ $key ], PATHINFO_EXTENSION ) );

							if ( ! in_array( $ext, $types ) ) {
								$return['files'][ $value['name'][ $key ] ] = 'Нелья загрузить файл тип: ' . $ext;
							}
						}
					} else {
						$ext = mb_strtolower( pathinfo( $value['name'], PATHINFO_EXTENSION ) );
						if ( ! in_array( $ext, $types ) ) {
							$return = 'Нелья загрузить файл тип: ' . $ext;
						}
					}
				}

				break;
			case 'min':
				if ( $field_key === 'phone' ){
					$value = yar_reset_phone( $value );
				}

				if ( $type && mb_strlen( $value ) < (int) $type ){
					$return = 'Это поле должно содержать минимум ' . $type . ' символов';
				}

				break;
			case 'max':
				if ( $field_key === 'phone' ){
					$value = yar_reset_phone( $value );
				}

				if ( $type && mb_strlen( $value ) > (int) $type ){
					$return = 'Это поле должно содержать максимум ' . $type . ' символов';
				}

				break;
			case 'has':
				$types  = explode( ',', $type );
				foreach ( $types as $type ) {
					if ( $type === 'numbers' && ! preg_match( "#[0-9]+#", $value ) ) {
						$return = 'Ваш пароль должен содержать не менее 1 цифры';
					}

					if ( $type === 'symbols' && ! preg_match( "#[A-Z]+#", $value ) ) {
						$return = 'Ваш пароль должен содержать хотя бы одну заглавную букву';
					}

					if ( $type === 'symbols' && ! preg_match( "#[a-z]+#", $value ) ) {
						$return = 'Ваш пароль должен содержать хотя бы одну прописную букву';
					}
				}

				break;
			case 'min_files':
				$return = [];
				$value  = (array) $value;

				if ( is_array( $value ) ) {
					$return = [];

					if ( count( $value ) < (int) $type ) {
						$return['file_message'] = 'Необходимо загрузить минимум ' . $type . ' фотографии';
					}
				}

				break;
			case 'max_files':
				$return = [];
				$value  = (array) $value;

				if ( is_array( $value ) ) {
					$return = [];
					$name   = (array) $value['name'];

					if ( count( $name ) > (int) $type ) {
						$return['file_message'] = 'Можно загрузить максимум ' . $type . ' фотографии';
					}
				}

				break;
			case 'inspection':
				if ( ! empty( $value ) ) {
					$inspection = json_decode( stripslashes( $value ), true );
					$return     = [];

					if ( ! empty( $inspection['fields'] ) ) {
						foreach ( $inspection['fields'] as $name => $field ) {
							if ( (int) $field['status'] === 0 ){
								$return[ $name ] = 'Это поле является обязательным';
							}
						}
					}
				}

				break;
			case 'number':
				if ( ! is_numeric( $value ) ){
					$return = 'Это поле может содержать только цифры';
				}

				break;
			case 'vin':
				if ( ! preg_match( '/^[A-HJ-NPR-Za-hj-npr-z\d]{8}[\dX][A-HJ-NPR-Za-hj-npr-z\d]{2}\d{6}$/', $value ) ) {
					$return = 'Поле VIN введено не верно';
				}

				break;
		}

		return $return;
	}
}