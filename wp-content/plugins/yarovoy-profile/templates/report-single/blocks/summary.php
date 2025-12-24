<?php

$data = yar_get_part_arg( $args, 'data' );
if ( empty( $data ) ){
	return '';
}

$type = yar_get_part_arg( $args, 'type' );

?>

<div class="profile-report__summary profile-report__summary--<?= $type ?>">
	<div class="profile-report__block-subtitle">Комплексная оценка, где 5 - “отлично”, а 1 - “очень плохо”</div>
	<div class="profile-report__summary-list">
		<?php foreach ( $data as $datum ) { ?>
			<div class="profile-report__summary-item">
				<div class="profile-report__summary-item__title profile-report__block-number"><?= $datum['order']; ?>. <?= $datum['title']; ?></div>
				<?php if ( ! empty( $datum['value'] ) ){ ?>
					<div class="profile-report__summary-item__value <?= $datum['value']['class']; ?>">
						<?= $datum['value']['title']; ?>
					</div>
				<?php } ?>
				<?php if ( $datum['comment'] ){ ?>
					<div class="profile-report__summary-item__comment profile-report__block-comment">
						<?= $datum['comment']; ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>
