<?php

class YAR_Car_Public_Repository extends YAR_Car_Repository {
	private $post_id;
	private $car_id;
	private $params;

	private function get_list_title() {
		$title = get_the_title();
		$year  = $this->get_param( 12 /* YEAR ID */ );
		$price = $this->get_param( 10 /* YEAR PRICE */ );

		if ( $year ) {
			$title .= ' / ' . $year . ' г.';
		}

		if ( $price ) {
			$title .= ' / ' . yar_get_price_with_currency( $price );
		}

		return $title;
	}

	public function list() {
		$list = [
			[
				'title'   => 'Список автомобилей в базе',
				'posts'   => [],
				'status'  => 'publish',
				'is_sold' => 0
			],
			[
				'title'  => 'Список автомобилей на модерации',
				'posts'  => [],
				'status' => 'draft',
			],
			[
				'title'   => 'Список автомобилей снятых с продажи',
				'posts'   => [],
				'status'  => 'publish',
				'is_sold' => 1
			],
		];

		foreach ( $list as $key => $item ) {
			$args = [
				'post_type'      => 'auto',
				'posts_per_page' => - 1,
				'post_status'    => $item['status'],
				'meta_query'     => [
					'relations' => 'AND',
					[
						'key'   => 'client',
						'value' => get_current_user_id()
					],
				]
			];

			if ( isset( $item['is_sold'] ) ) {
				$args['meta_query'][] = [
					'key'   => 'is_sold',
					'value' => $item['is_sold']
				];
			}

			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();

					$real_car_id = $this->get_real_car_id();
					if ( ! $real_car_id ) {
						continue;
					}

					$post_id = get_the_ID();

					$list[ $key ]['posts'][] = [
						'post_id'    => $post_id,
						'post_title' => get_the_title(),
						'title'      => $this->get_list_title(),
						'car_id'     => $real_car_id,
						'is_sold'    => (bool) yar_get_field( 'is_sold', $post_id ),
						'status'     => $item['status'],
					];
				}

				wp_reset_postdata();
			}
		}

		return $list;
	}

	private function get_lk_car_features() {
		$accepted = [
			'vin',
			'year',
			'generation',
			'body_style',
			'engine_size',
			'fuel_type',
			'transmission',
			'wheel_drive',
			'consumption',
			'acceleration',
			'ride_height',
			'trunk',
			'mileage',
			'color'
		];

		$data = [];

		$params = $this->get_params( $this->car_id );
		if ( ! empty( $params ) ) {
			$this->params = $params;
			foreach ( $accepted as $accept ) {
				if ( isset( $params[ $accept ] ) ) {
					$data[] = [
						'title' => $params[ $accept ]['params_title'],
						'value' => (
							! empty(
								$params[ $accept ]['possible_value'] )
								? $params[ $accept ]['possible_value']
								: $params[ $accept ]['value']
						),
					];
				}
			}
		}

		return $data;
	}

	private function filter_features( $features ){
		if ( empty( $features ) ){
			return [];
		}

		$filter = [
			'Год' => function ( $value ){
			    return $value . ' г';
			},
			'Объем' => function ( $value ){
				return $value . ' л.';
			},
			'Расход' => function ( $value ){
				return $value . ' л.';
			},
			'Багажник' => function ( $value ){
				return $value . ' л.';
			},
			'Клиренс' => function ( $value ){
				return yar_get_normal_price( $value ) . ' мм';
			},
			'Пробег' => function ( $value ){
				return yar_get_normal_price( $value ) . ' км';
			},
		];

		foreach ( $features as $key => $feature ) {
			if ( ! empty( $feature['value'] ) ){
				if ( isset( $filter[ $feature['title'] ] ) ){
					$features[ $key ]['value'] = $filter[ $feature['title'] ]( $feature['value'] );
				}
			} else {
				$features[ $key ]['value'] = '-';
			}
		}

		return $features;
	}

	private function get_features(){
		if ( ! empty( $this->car_id ) ){
			$features = $this->get_lk_car_features();
		} else {
			$features = yar_get_field( 'features', $this->post_id, [] );
		}

		return $this->filter_features( $features );
	}

	private function get_additional() {
		$data = [];
		if ( ! empty( $this->params ) ) {
			foreach ( $this->params as $param ) {
				if ( $param['params_type'] === 'checkbox' ) {
					$data[] = $param['params_title'];
				}
			}
		}

		return $data;
	}

	private function get_phone(){
		$phone = '+7 (495) 159-39-20';
		$client  = get_field( 'client', $this->post_id );
		if ( $client ) {
			$phone = yar_get_field( 'phone', 'user_' . $client, $this->post_id );
			$phone = yar_format_phone( $phone );
		}

		return $phone;
	}

	public function get_single_car( $post_id ) {
		if ( empty( $post_id ) ) {
			return [];
		}

		$this->post_id = $post_id;
		$this->car_id  = (int) get_post_meta( $this->post_id, '_real_car_id', true );

		$image = get_the_post_thumbnail_url( $this->post_id, 'big' );

		return [
			'thumbnail'        => $image ?: '',
			'features'         => $this->get_features(),
			'gallery'          => yar_filter_gallery_field( yar_get_field( 'gallery', $this->post_id, [] ) ),
			'phone'            => $this->get_phone(),
			'price'            => yar_get_price_with_currency( (int) yar_get_field( 'price', $this->post_id, 0 ) ),
			'description'      => yar_get_field( 'description', $this->post_id, '' ),
			'mini_description' => yar_get_field( 'mini_description', $this->post_id, '' ),
			'additional'       => $this->get_additional(),
			'report'           => yar_get_file_url( yar_get_field( 'report', $this->post_id, '' ) ),
			'report_from'      => yar_get_file_url( yar_get_field( 'report_from', $this->post_id, '' ) ),
		];
	}
}