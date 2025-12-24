<?php

$report_id         = get_query_var( 'profile/reports/edit' );
$report_repository = new YAR_Report_Fields_Repository();

$fields = $report_repository->get_steps_filled( $report_id );
$errors = $report_repository->get_errors();

if ( empty( $fields ) ) {
	return '';
}

if ( ! empty( $errors ) ) {
	yar_plugin_get_template(
		'report/blocks-new/errors',
		[
			'data' => $errors
		],
		true
	);
}

foreach ( $fields as $key => $step ) {
	yar_plugin_get_template(
		'report/blocks-new/' . $step['type'],
		array_merge( $step, [
			'type'     => $key
		] ),
		false
	);
}

wp_nonce_field( 'yar_expert_edit_report' );

?>

<input type="hidden" name="report_id" value="<?= $report_id; ?>">
<input type="hidden" name="report_action" value="edit">

