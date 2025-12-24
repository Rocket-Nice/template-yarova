<?php

class YAR_Admin_Contracts {
	public function __construct() {
		add_filter( 'manage_contracts_posts_columns', [ $this, 'add_columns' ], 10, 2 );
		add_action( 'manage_contracts_posts_custom_column', [ $this, 'output_column' ], 10, 2 );
	}

	public function add_columns( $columns ) {
		$custom_columns = [
			'custom_status'        => 'Статус',
			'custom_status_expert' => 'Статус: Эксперт',
			'amount'               => 'Стоимость',
			'amount_total'         => 'Итоговая стоимость',
			'paid_date'            => 'Дата оплаты',
		];

		return array_slice( $columns, 0, 2 ) + $custom_columns + $columns;;
	}

	public function output_column( $column_name, $post_id ) {
		if ( $column_name === 'custom_status' ) {
			$status = get_field( 'status', $post_id );
			echo '<div class="admin-custom__status _' . $status['value'] . '">' . $status['label'] . '</div>';
		}

		if ( $column_name === 'custom_status_expert' ) {
			$status = get_field( 'status_expert', $post_id );
			echo '<div class="admin-custom__status _' . $status['value'] . '">' . $status['label'] . '</div>';
		}

		if ( $column_name === 'amount' ) {
			$amount = yar_get_normal_price( get_field( 'amount', $post_id ) );
			if ( $amount ) {
				echo '<strong>' . $amount . '₽' . '</strong>';
			}
		}

		if ( $column_name === 'amount_total' ) {
			$total_amount = yar_get_normal_price( get_field( 'total_amount', $post_id ) );
			if ( $total_amount ) {
				echo '<strong>' . $total_amount . '₽' . '</strong>';
			} else {
				echo 'Оплата договорная';
			}
		}

		if ( $column_name === 'paid_date' ) {
			echo yar_get_normal_date_format( get_field( 'paid_date', $post_id ) );
		}
	}
}