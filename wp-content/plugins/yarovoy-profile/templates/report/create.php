<?php

$fields = new YAR_Report_Fields_Repository();

foreach ( $fields->get_steps() as $key => $step ) {
	yar_plugin_get_template(
		'report/blocks-new/' . $step['type'],
		array_merge( $step, [
			'type' => $key
		] ),
		false
	);
}

wp_nonce_field( 'yar_expert_save_report' );