<?php

$fields   = yar_get_part_arg( $args, 'fields', [] );
$type     = yar_get_part_arg( $args, 'type', '' );
$title    = yar_get_part_arg( $args, 'title', '' );
$subtitle = yar_get_part_arg( $args, 'subtitle', '' );

?>


<div class="report-form__block report-form__dashboard profile-form__block" data-type="<?= $type; ?>">
	<?php if ( $title ){ ?>
		<div class="report-form__title profile-form__block-title"><?= $title; ?></div>
	<?php } ?>
	<?php if ( $subtitle ){ ?>
		<div class="inspection__field-title"><?= $subtitle; ?></div>
	<?php } ?>
	<div class="report-form__fields">
		<?php if ( ! empty( $fields ) ){
			foreach ( $fields as $field ) {
				yar_plugin_get_template( 'form/checkbox-toggle', $field, false );
			}
		} ?>
	</div>
</div>