<?php

$type   = yar_get_part_arg( $args, 'type', '' );
$title  = yar_get_part_arg( $args, 'title', '' );
$fields = yar_get_part_arg( $args, 'fields', [] );

if ( empty( $fields ) ){
	return '';
}

?>

<div class="report-form__block report-form__<?= $type; ?> profile-form__block" data-type="<?= $type; ?>">
	<div class="report-form__title profile-form__block-title"><?= $title; ?></div>
	<div class="report-form__fields">
		<?php

		foreach ( $fields as $field ) {
			$type = $field['type'] === 'number' ? 'text' : $field['type'];

			yar_plugin_get_template( 'form/' . $type, $field, false );
		}

		?>
	</div>
</div>
