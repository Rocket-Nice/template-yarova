<?php

/**
 * Class YAR_Report_Fields_Repository
 * Repository for working with report fields. Output, fill, filter
 */
class YAR_Report_Fields_Repository extends YAR_Report_Repository {
	private $fields;
	private $table = 'wp_yar_report_fields';
	private $config = [];

	public function __construct() {
		$this->get_config();
		$this->get_fields();
	}

	private function get_config() {
		if ( ! $this->config ) {
			$this->config = yar_get_config( 'report' );
		}

		return $this->config;
	}

	/**
	 * Get steps for report
	 * @return array|mixed
	 */
	public function get_steps() {
		$cache_key = '_admin_report_steps';
		$fields    = wp_cache_get( $cache_key );

		if ( $fields !== false ) {
			return $fields;
		}

		foreach ( $this->config as $key => $config ) {
			if ( isset( $config['fill'] ) ) {
				$this->config[ $key ]['fields'] = $this->get_fields_by_group( $config['fill'] );
			}
		}

		return $this->config;
	}

	/**
	 * Get step by name
	 * @return array|mixed
	 */
	public function get_step( $step ) {
		if ( isset( $this->config[ $step ] ) ) {
			$this->config[ $step ]['fields'] = $this->get_fields_by_group( $this->config[ $step ]['fill'] );

			return $this->config[ $step ];
		}

		return [];
	}

	private function formatted_value( $value ) {
		if ( is_numeric( $value ) ) {
			return (float) $value;
		}

		return $value;
	}

	/**
	 * 
	 *
	 * @param int $report_id
	 * @return array|mixed
	 */
	public function get_steps_filled( $report_id = 0 ) {
		$this->report_id = $report_id;

		$steps = $this->get_steps();
		$data  = $this->get_report();

		$readonly = ( current_user_can( 'administrator' ) ) && ! empty( get_query_var( 'profile/reports/preview' ) );

		foreach ( $steps as $key => $step ) {
			if ( ! empty( $step['fields'] ) ) {
				foreach ( $step['fields'] as $field_key => $field ) {
					if ( isset( $data[ $key ] ) ) {
						$find = array_search( $field['name'], array_column( $data[ $key ], 'field_name' ) );
						if ( $find !== false ) {
							$type  = $steps[ $key ]['fields'][ $field_key ]['type'];
							$value = $data[ $key ][ $find ]['value'];

							if ( $value ) {
								$steps[ $key ]['fields'][ $field_key ]['value'] =
									$type === 'number' ? ( float ) $value : $value;
							}

							if ( $type === 'inspection' ) {
								if ( isset( $data[ $key ][ $find ]['thickness'] ) ) {
									$steps[ $key ]['fields'][ $field_key ]['thickness'] = $this->formatted_value( $data[ $key ][ $find ]['thickness'] );
								}

								$steps[ $key ]['fields'][ $field_key ]['comment'] = $data[ $key ][ $find ]['comment'];
							} elseif ( $type === 'completion' ) {
								$steps[ $key ]['fields'][ $field_key ]['checked'] = true;
							}
						}

						$steps[ $key ]['fields'][ $field_key ]['readonly'] = $readonly;
					}
				}
			}

			if ( isset( $step['type'] ) ) {
				if ( $step['type'] === 'gallery' && isset( $data[ $step['name'] ] ) ) {
					$steps[ $key ]['data']     = $data[ $step['name'] ];
				}

				if ( $step['type'] === 'video' && isset( $data[ $step['name'] ] ) ) {
					$steps[ $key ]['data'] = $data[ $step['name'] ];
				}
			}
		}

		return $steps;
	}

	private function prepare_field( $field ) {
		$new_field = [];

		if ( isset( $field['id'] ) ) {
			$new_field['id'] = $field['id'];
		}
		$new_field['slug']        = $field['slug'];
		$new_field['type']        = $field['type'];
		$new_field['label']       = $field['title'];
		$new_field['placeholder'] = $field['title'];
		$new_field['name']        = $field['group'] . '_' . $field['slug'];

		if ( ! empty( $field['order'] ) ) {
			$new_field['order'] = $field['order'];
		}

		if ( ! empty( $field['options'] ) ) {
			$new_field['options'] = $field['options'];
		}

		if ( ! empty( $field['values'] ) ) {
			$new_field['values'] = $field['values'];
		}

		if ( isset( $field['weight'] ) ) {
			$new_field['with_weight'] = $field['weight'];
		}

		return $new_field;
	}

	private function get_fields() {
		global $wpdb;

		$cache_key = '_admin_report_fields';
		$fields    = wp_cache_get( $cache_key );

		if ( $fields !== false ) {
			return $fields;
		}

		$fields = [];

		$result = $wpdb->get_results( "
			SELECT id, `group`, title, slug, `type`, params, `order`, status
			FROM $this->table
			WHERE status = 1
			ORDER BY `order`",
			'ARRAY_A' );

		if ( ! empty( $result ) ) {
			foreach ( $result as $item ) {
				if ( ! empty( $item['params'] ) ) {
					$params = json_decode( $item['params'], true );
					if ( $item['type'] === 'select' ) {
						$item['options'] = $params;
					} else {
						$item = array_merge( $item, $params );
					}
				}

				$fields[ $item['group'] ][] = $this->prepare_field( $item );
			}
		}

		$this->fields = $fields;

		return $fields;
	}

	public function get_fields_by_group( $group ) {
		if ( isset( $this->fields[ $group ] ) ) {
			return $this->fields[ $group ];
		}

		return [];
	}
}