<?php

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="profile-report__inspection">
	<div class="profile-report__inspection-media">
	</div>
	<div class="profile-report__inspection-row">
		<?php
		if ( ! empty( $data ) ) {
			foreach ( $data as $datum ) { ?>
				<div class="profile-report__inspection-item">
					<div class="profile-report__inspection-title profile-report__block-number"><?= $datum['order']; ?>. <?= $datum['title']; ?></div>
					<div class="profile-report__inspection-status <?= $datum['value_class']; ?>"><?= $datum['value_title']; ?></div>
					<?php if ( $datum['comment'] ) { ?>
						<div class="profile-report__inspection-comment profile-report__block-comment">
							<?= $datum['comment']; ?>
						</div>
					<?php } ?>
				</div>
			<?php }
		} else { ?>
			<div class="profile__not profile-report__block-subtitle">Замечаний не обнаружено</div>
		<?php } ?>
	</div>
</div>
