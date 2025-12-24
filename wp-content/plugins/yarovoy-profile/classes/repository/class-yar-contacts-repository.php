<?php

class YAR_Contracts_Repository {
	private $post_id;

	private function get_service_title() {
		$service = '';
		if ( get_field( 'service_type', $this->post_id ) === 'custom' ) {
			$service = get_field( 'service_custom', $this->post_id );
		} else {
			$service = get_field( 'service_list', $this->post_id );
			if ( $service ) {
				$service = $service->post_title;
			}
		}

		return $service;
	}

	private function check_payment_form() {
		$status = get_field( 'status', $this->post_id );
		if ( $status['value'] === 'paid' || $status['value'] === 'await_pay' ) {
			return false;
		}

		return true;
	}

	private function check_payment_link(){
		$status = get_field( 'status', $this->post_id );
		$link   = get_field( 'url', $this->post_id );
		if ( $status['value'] === 'await_pay' && $link ) {
			return $link;
		}

		return '';
	}

	public function can_be_completed( $post_id = '' ) {
		if ( ! $post_id ) {
			$post_id = $this->post_id;
		}

		$status_expert = get_field( 'status_expert', $post_id );
		if ( $status_expert['value'] !== 'created' ) {
			return false;
		}

		$report = get_posts( [
			'post_type'      => 'report',
			'posts_per_page' => 1,
			'post_status'    => [ 'publish', 'draft' ],
			'meta_query'     => [
				[
					'key'   => 'expert',
					'value' => get_current_user_id()
				],
				[
					'key'   => 'treaty',
					'value' => $post_id
				]
			]
		] );

		if ( ! empty( $report ) ) {
			$status = get_field( 'status', $report[0]->ID );
			if ( $status['value'] === 'approved' || $status['value'] === 'rejected' ) {
				return true;
			}
		}

		return false;
	}

	private function get_for_client() {
		return [
			'status'       => yar_get_field( 'status', $this->post_id, [] ),
			'amount'       => yar_get_price_with_currency( yar_get_field( 'amount', $this->post_id ) ),
			'total_amount' => yar_get_price_with_currency( yar_get_field( 'total_amount', $this->post_id ) ),
			'paid_date'    => yar_get_normal_date_format( yar_get_field( 'paid_date', $this->post_id ) ),
			'treaty'       => yar_get_field( 'treaty', $this->post_id ),
			'payment_form' => $this->check_payment_form(),
			'payment_link' => $this->check_payment_link(),
		];
	}

	private function get_for_expert() {
		$client = get_field( 'client', $this->post_id );

		return [
			'car'           => yar_get_field( 'data_car', $this->post_id ),
			'year'          => yar_get_field( 'data_year', $this->post_id ),
			'date'          => yar_get_normal_date_format( yar_get_field( 'data_date', $this->post_id ) ),
			'fio'           => yar_get_fio_by_user_id( $client ),
			'phone'         => yar_format_phone( yar_get_field( 'phone', 'user_' . $client ) ),
			'treaty'        => yar_get_field( 'treaty', $this->post_id ),
			'status_expert' => yar_get_field( 'status_expert', $this->post_id ),

			'can_be_completed' => $this->can_be_completed()
		];
	}

	private function get_args() {
		$meta_user_key = 'client';
		if ( yar_is_expert() ) {
			$meta_user_key = 'expert';
		}

		$args = [
			'post_type'      => 'contracts',
			'posts_per_page' => - 1,
			'meta_query'     => [
				'relations' => 'AND',
				[
					'key'   => $meta_user_key,
					'value' => get_current_user_id()
				]
			]
		];

		if ( yar_is_expert() ) {
			$args['meta_query'][] = [
				'key'   => 'status',
				'value' => 'paid'
			];
		}

		return $args;
	}

	public function get() {
		$contacts = get_posts( $this->get_args() );

		$data = [];

		if ( ! yar_is_client() && ! yar_is_expert() ) {
			return $data;
		}

		if ( ! empty( $contacts ) ) {
			foreach ( $contacts as $contact ) {
				$this->post_id = $contact->ID;

				$new = [
					'contact_id'    => $contact->ID,
					'post_title'    => $contact->post_title,
					'service_title' => $this->get_service_title(),
				];

				if ( yar_is_client() ) {
					$new = array_merge( $new, $this->get_for_client() );
				} elseif ( yar_is_expert() ) {
					$new = array_merge( $new, $this->get_for_expert() );
				}

				$data[] = $new;
			}
		}

		return $data;
	}

	public function is_client_report( $report_id ) {
		$client = get_field( 'client', $report_id );

		if ( $client && $client === get_current_user_id() ) {
			return true;
		}

		return false;
	}

	public function get_by_uuid( $uuid ) {
		$contract = get_posts( [
			'post_type'      => 'contracts',
			'posts_per_page' => 1,
			'meta_query'     => [
				'relations' => 'AND',
				[
					'key'   => 'uuid',
					'value' => $uuid
				],
				[
					'key'   => 'status',
					'value' => 'await_pay'
				]
			]
		] );

		if ( empty( $contract ) ) {
			return false;
		}

		return $contract[0];
	}

	public function get_contracts_for_report() {
		$contacts = get_posts( [
			'post_type'      => 'contracts',
			'posts_per_page' => - 1,
			'meta_query'     => [
				'relations' => 'AND',
				[
					'key'   => 'expert',
					'value' => get_current_user_id()
				],
				[
					'key'   => 'status',
					'value' => 'paid'
				],
				[
					'key'   => 'status_expert',
					'value' => 'created'
				]
			]
		] );

		if ( empty( $contacts ) ) {
			return [
				'message' => 'Пока что нет прикрепленных за вами договоров, но отчет был сохранен, вы сможете вернуться к нему позже',
				'success' => false
			];
		}

		$options = [];

		foreach ( $contacts as $contact ) {
			$client = yar_get_field( 'client', $contact->ID, 0 );
			$fio    = yar_get_fio_by_user_id( $client );
			$phone  = yar_get_field( 'phone', 'user_' . $client, '' );

			$options[ $contact->ID ] = $contact->post_title . ': ' . $fio . ' / ' . yar_format_phone( $phone );
		}

		return [
			'list' => $options
		];
	}
}