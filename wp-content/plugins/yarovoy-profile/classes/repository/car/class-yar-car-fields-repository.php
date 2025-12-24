<?php

class YAR_Car_Fields_Repository {
	private $config;

	public function get_menu(){
		$steps = $this->get_steps();
		$menu  = [];
		
		if ( ! empty( $steps ) ){
			foreach ( $steps as $key => $step ) {
				$menu[ $key ] = $step['title'];
			}
		}
		
		return $menu;
	}

	private function get_config(){
		if ( ! $this->config ){
			$this->config = yar_get_config( 'steps' );
		}

		return $this->config;
	}

	private function get_data( $slug ) {
		global $wpdb;

		$table   = $wpdb->prefix . 'yar_parameters_possible';
		$results = $wpdb->get_results(
			"SELECT a.*, 
       			b.id as parameter_current_id, b.parameter_id as parameter_id, b.value as parameter_value, b.parent_id as parameter_parent_id 
				FROM $table a
				LEFT JOIN wp_yar_parameters_possible_value b ON a.id = b.parameter_id
				WHERE a.slug='$slug'
				ORDER BY b.value",
			'ARRAY_A'
		);

		if ( empty( $wpdb->error ) && ! empty( $results ) ) {
			return $results;
		}

		return [];
	}

	private function prepare_fields( $fields ) {
		foreach ( $fields as $key => $field ) {
			if ( ! empty( $field['params'] ) ) {
				$params = json_decode( stripslashes( $field['params'] ), true );
				if ( $params ) {
					$field['params'] = $params;
					$fields[ $key ]  = $field;
				}
			}

			if ( $field['type'] === 'select' && ! isset( $field['params']['exclude'] ) ) {
				$data    = $this->get_data( $field['slug'] );
				$options = [];
				if ( ! empty( $data ) ) {
					foreach ( $data as $datum ) {
						$options[ $datum['parameter_current_id'] ] = $datum['parameter_value'];
					}
				}

				$fields[ $key ]['options'] = $options;
			}
		}

		return $fields;
	}

	public function get_steps() {
		$cache_key = '_admin_car_fields';
		$fields    = wp_cache_get( $cache_key );

		if ( $fields !== false ) {
			return $fields;
		}

		global $wpdb;

		$config = $this->get_config();
		$result = $wpdb->get_results( 'SELECT * FROM wp_yar_car_parameters', 'ARRAY_A' );
		$fields = [];

		if ( ! empty( $result ) ) {
			foreach ( $result as $item ) {
				if ( $item['type'] === 'checkbox' ) {
					$fields[ $item['group'] ]['checkboxes'][] = $item;
				} elseif( $item['type'] === 'color' ) {
					$fields[ $item['group'] ]['colors'][] = $item;
				} else {
					$fields[ $item['group'] ]['fields'][] = $item;
				}
			}
		}

		if ( ! empty( $fields ) ) {
			foreach ( $config as $key => $cfg ) {
				if ( isset( $fields[ $key ] ) ) {
					$config[ $key ]['blocks']['fields'] = $this->prepare_fields( $fields[ $key ]['fields'] );
					if ( isset( $fields[ $key ]['checkboxes'] ) ) {
						$config[ $key ]['blocks']['checkboxes'] = $fields[ $key ]['checkboxes'];
					}
					if ( isset( $fields[ $key ]['colors'] ) ) {
						$config[ $key ]['blocks']['colors'] = $this->prepare_fields( $fields[ $key ]['colors'] );
					}
				}
			}
		}

		wp_cache_set( $cache_key, $config );

		return $config;
	}

	public function get_all_fields() {
		$steps  = $this->get_steps();
		$fields = [];

		if ( empty( $steps ) ){
			return $fields;
		}

		$keys = [ 'fields', 'checkboxes', 'colors' ];

		foreach ( $steps as $step ) {
			foreach ( $keys as $key ) {
				if ( ! empty( $step[ 'blocks' ][ $key ] ) ) {
					foreach ( $step[ 'blocks' ][ $key ] as $field ) {
						$fields[ $field['id'] ] = $field['slug'];
					}
				}
			}
		}

		return $fields;
	}

	public function fill_select( $id ) {
		global $wpdb;

		$table  = $wpdb->prefix . 'yar_parameters_possible_value';
		$result = $wpdb->get_results(
			"SELECT id, parent_id, value FROM $table WHERE parent_id=$id", 'ARRAY_A'
		);

		if ( empty( $wpdb->error ) && ! empty( $result ) ) {
			return $result;
		}

		return [];
	}

	public function get_select_value( $id, $key = 'value' ){
		global $wpdb;

		$table  = $wpdb->prefix . 'yar_parameters_possible_value';
		$result = $wpdb->get_row(
			"SELECT parent_id, value FROM $table WHERE id=$id", 'ARRAY_A'
		);

		if ( empty( $wpdb->error ) && ! empty( $result ) ) {
			return $result[ $key ];
		}

		return false;
	}

	public function get_action( $step, $prev = false ){
		$config = $this->get_config();

		$keys = array_keys( $config );
		$pos  = array_search( $step, $keys );

		$action = '';
		$find   = $pos + 1;

		if ( $prev ){
			$find = $pos - 1;
		}

		if ( isset( $keys[ $find ] ) ) {
			$action = $keys[ $find ];
		}

		return $action;
	}

	public function get_validation_rules( $key ) {
		$fields = $this->get_config();
		$rules  = [];

		if ( isset( $fields[ $key ] ) && isset( $fields[ $key ]['validation'] ) ) {
			$rules = $fields[ $key ]['validation'];
		}

		return $rules;
	}

	public function get_step( $key ) {
		$steps = $this->get_steps();
		if ( isset( $steps[ $key ] ) ) {
			return $steps[ $key ];
		}

		return [];
	}

	public function get_rules() {
		$fields = $this->get_config();
		$rules  = [];
		foreach ( $fields as $field ) {
			if ( isset( $field['validation'] ) ) {
				$rules = array_merge( $rules, $field['validation'] );
			}
		}

		return $rules;
	}
}