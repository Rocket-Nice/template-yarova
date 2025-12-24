<?php

class YAR_Car_Repository {
	private $table_main = 'wp_yar_car';
	private $table_params = 'wp_yar_car_parameters';
	private $table_values = 'wp_yar_car_parameters_values';
	private $table_possible = 'wp_yar_parameters_possible_value';
	private $car_id;
	private $post_id;

	private function get_car_id( $post_id ) {
		global $wpdb;

		$result = $wpdb->get_row( "SELECT id FROM $this->table_main WHERE post_id = $post_id", 'ARRAY_A' );

		if ( ! empty( $result ) ) {
			$this->car_id = (int) $result['id'];

			return (int) $result['id'];
		}

		return 0;
	}

	public function get_post_id( $car_id ){
		global $wpdb;

		$result = $wpdb->get_row( "SELECT post_id FROM $this->table_main WHERE id = $car_id", 'ARRAY_A' );

		if ( ! empty( $result ) ) {
			$this->post_id = $result['post_id'];

			return $result['post_id'];
		}

		return 0;
	}

	public function get_real_car_id() {
		$post_id = get_the_ID();
		if ( ! $post_id ) {
			return 0;
		}

		return $this->get_car_id( $post_id );
	}

	public function get_param( $param_id ){
		global $wpdb;

		$result = $wpdb->get_row( "SELECT value FROM $this->table_values WHERE car_id = $this->car_id AND param_id = $param_id", 'ARRAY_A' );

		if ( ! empty( $result ) ) {
			return $result['value'];
		}

		return '';
	}

	private function fill_select_params( $result ) {
		$fields_repository = new YAR_Car_Fields_Repository();
		foreach ( [ 'model', 'generation', 'body_style' ] as $type ) {
			$find = array_search( $type, array_column( $result, 'params_slug' ) );
			if ( $find !== false ) {
				$parent_id = $fields_repository->get_select_value( (int) $result[ $find ]['value'], 'parent_id' );
				if ( $parent_id ) {
					$fill = $fields_repository->fill_select( $parent_id );
					if ( ! empty( $fill ) ) {
						$options = [];
						foreach ( $fill as $item ) {
							$options[ $item['id'] ] = $item['value'];
						}

						$result[ $find ]['options'] = $options;
					}
				}
			}
		}

		// Add value for color
		$find_color = array_search( 'color', array_column( $result, 'params_slug' ) );
		if ( $find_color !== false ) {
			$params      = json_decode( $result[ $find_color ]['params_params'], true );
			$params_find = array_search( $result[ $find_color ]['value'], array_column( $params, 'label' ) );
			if ( $params_find !== false ) {
				$result[ $find_color ]['checked_label']  = $params[ $params_find ]['label'];
				$result[ $find_color ]['possible_value'] = $params[ $params_find ]['title'];
			}
		}


		return $result;
	}

	private function prepare_params( $result ){
		$return = [];

		foreach ( $result as $item ) {
			$return[ $item['params_slug'] ] = $item;
		}

		return $return;
	}

	private function get_post_fields() {
		$description = yar_get_field( 'description', $this->post_id );
		$description = strip_tags( $description );

		return [
			'description' => $description,
			'report'      => yar_get_field( 'field_6780e07f3da9e', $this->post_id ),
			'report_from' => yar_get_field( 'field_67a0a23697718', $this->post_id ),
			'gallery'     => yar_get_field( 'gallery', $this->post_id, [] )
		];
	}

	public function get_params( $car_id = '' ) {
		global $wpdb;

		if ( empty( $car_id ) ){
			$car_id = $this->car_id;
		}

		$result = $wpdb->get_results(
			"
				SELECT 
				       param_values.*, 
				       params.id as params_id, 
				       params.title as params_title, 
				       params.slug as params_slug, 
				       params.group as params_group, 
				       params.type as params_type, 
				       params.params as params_params,
					   possible.id as possible_id,
					   possible.value as possible_value
				FROM $this->table_values param_values
				LEFT JOIN $this->table_params params ON param_values.param_id = params.id
				LEFT JOIN $this->table_possible possible ON (params.type = 'select' AND param_values.value = possible.id)
				WHERE param_values.car_id = $car_id
    			",
			'ARRAY_A'
		);

		if ( ! empty( $result ) ){
			$result = $this->fill_select_params( $result );

			return $this->prepare_params( $result );
		}

		return [];
	}

	private function return_error_car(){
		if ( wp_is_rest_endpoint() ){
			return new WP_Error( 'error_car_id', 'Машина не найдена', [
				'status' => 404
			] );
		}

		return [];
	}

	public function get_car( $car_id ) {
		if ( empty( $car_id ) ) {
			return $this->return_error_car();
		}

		$this->car_id = $car_id;
		$this->get_post_id( $this->car_id );

		return array_merge(
			$this->get_params(),
			$this->get_post_fields()
		);
	}
}