<?php

$data    = yar_get_part_arg( $args, 'data' );

?>

<?php if ( ! empty( $data['total'] ) ){ ?>
	<div class="profile-report__summary-item _total">
		<div class="profile-report__summary-item__title profile-report__block-number">6. Итоговые рекомендации</div>
		<div class="profile-report__summary-item__value <?= ( $data['total'] ? '_ok' : '_fail' ); ?>">
			<?= ( $data['total'] ? 'Рекомендуется к покупке' : 'Не рекомендуется к покупке' ); ?>
		</div>
		<?php if ( $data['total_comment'] ){ ?>
			<div class="profile-report__summary-item__comment profile-report__block-comment">
				<?= $data['total_comment']; ?>
			</div>
		<?php } ?>
	</div>
<?php } ?>
