<?php

$counter       = yar_get_part_arg( $args, 'counter', '' );
$post_title    = yar_get_part_arg( $args, 'post_title', '' );
$files         = yar_get_part_arg( $args, 'files', [] );
$status_report = yar_get_part_arg( $args, 'status_report', '' );
$status_view   = yar_get_part_arg( $args, 'status_view', '' );
$report_id     = yar_get_part_arg( $args, '_report_id', 0 );
$link          = yar_get_part_arg( $args, 'link', 'view/' );

$report_link  = $status_report['value'] === 'approved' ? $link . $report_id : '';

?>

<div class="reports-client__item">
	<?php if ( $counter ){ ?>
		<div class="reports-client__item-counter"><?= $counter; ?>.</div>
	<?php } ?>
	<div class="reports-client__item-header">
		<div class="reports-client__item-title"><?= $post_title; ?></div>
		<div class="reports-client__item-status profile__status _<?= $status_view['value'] ?>">
			<?= $status_view['label'] ?>
		</div>
	</div>
	<div class="reports-client__item-actions">
		<a href="<?= $report_link; ?>" class="reports-client__item-action <?= ( ! $report_link ? '_disabled' : '' ); ?>">
			<span>Технический отчёт</span>
		</a>
		<a href="<?= ( ! empty( $files['legal'] ) ? $files['legal'] : '#' ); ?>" class="reports-client__item-action <?= ( empty( $files['legal'] ) ? '_disabled' : '' ); ?>" target="_blank">
			<span>Юридический отчёт</span>
			<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M10.5 15.6445L3.98633 9.13086L5.81016 7.24189L9.19727 10.629V0.0117188H11.8027V10.629L15.1898 7.24189L17.0137 9.13086L10.5 15.6445ZM2.68359 20.8555C1.96709 20.8555 1.35372 20.6003 0.843481 20.0901C0.333244 19.5799 0.078125 18.9665 0.078125 18.25V14.3418H2.68359V18.25H18.3164V14.3418H20.9219V18.25C20.9219 18.9665 20.6668 19.5799 20.1565 20.0901C19.6463 20.6003 19.0329 20.8555 18.3164 20.8555H2.68359Z" fill="white"/>
			</svg>
		</a>
		<a href="<?= ( ! empty( $files['forensic'] ) ? $files['forensic'] : '#' ); ?>" class="reports-client__item-action <?= ( empty( $files['forensic'] ) ? '_disabled' : '' ); ?>" target="_blank">
			<span>Криминалистический отчёт</span>
			<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M10.5 15.6445L3.98633 9.13086L5.81016 7.24189L9.19727 10.629V0.0117188H11.8027V10.629L15.1898 7.24189L17.0137 9.13086L10.5 15.6445ZM2.68359 20.8555C1.96709 20.8555 1.35372 20.6003 0.843481 20.0901C0.333244 19.5799 0.078125 18.9665 0.078125 18.25V14.3418H2.68359V18.25H18.3164V14.3418H20.9219V18.25C20.9219 18.9665 20.6668 19.5799 20.1565 20.0901C19.6463 20.6003 19.0329 20.8555 18.3164 20.8555H2.68359Z" fill="white"/>
			</svg>
		</a>
	</div>
</div>
