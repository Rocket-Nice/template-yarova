<?php

$title     = yar_get_part_arg( $args, 'title', '' );
$step_type = yar_get_part_arg( $args, 'step_type', '' );
$fields    = yar_get_part_arg( $args, 'fields', '' );

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="report-form__block report-form__video profile-form__block" data-type="video">
	<div class="report-form__title profile-form__block-title"><?= $title; ?></div>
	<div class="report-form__documents-grid">
		<?php

		foreach ( $fields as $field ) {

			yar_plugin_get_template( 'form/file', [
				'title'    => $field['title'],
				'name'     => $field['name'],
				'value'    => ( ! empty( $data[ $field['name'] ] ) ? $data[ $field['name'] ] : [] ),
				'validate' => $field['validate']
			], false );
		}

		?>
	</div>
</div>
