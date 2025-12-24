<?php

$report_id = yar_get_part_arg( $args, 'report_id', 0 );
$post_id   = yar_get_part_arg( $args, 'post_id', 0 );

if ( empty( $report_id ) || empty( $post_id ) ){
	return '';
}

?>

<div class="admin-report-meta">
	<a href="/profile/reports/preview/<?= $report_id; ?>/?post_id=<?= $post_id; ?>" class="admin-btn _big _red" target="_blank">Проверить отчет</a>
</div>
