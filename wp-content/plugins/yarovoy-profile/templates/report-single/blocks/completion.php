<?php

$data       = yar_get_part_arg( $args, 'data' );
$hide_title = yar_get_part_arg( $args, 'hide_title', false );

?>

<div class="profile-report__dashboard">
	<?php if ( $hide_title ){ ?>
		<div class="profile-report__block-subtitle _error">Ошибки и проблемы</div>
	<?php } ?>
	<?php if ( ! empty( $data ) ){ ?>
	<div class="profile-report__dashboard-list">
		<?php foreach ( $data as $datum ) { ?>
			<div class="profile-report__dashboard-item">
				<?php if ( ! empty( $datum['group'] ) ){ ?>
					<div class="profile-report__dashboard-icon">
						<img src="<?= YAR_PROFILE_URL . 'assets/img/completion/' . $datum['group'] . '.svg'; ?>" alt="">
					</div>
				<?php } ?>
				<div class="profile-report__dashboard-text"><?= $datum['title']; ?></div>
			</div>
		<?php } ?>
	</div>
	<?php } else { ?>
		<div class="profile__not profile-report__block-subtitle">Замечаний не обнаружено</div>
	<?php } ?>
</div>