<?php

$fields    = yar_get_part_arg( $args, 'fields', [] );
$type      = yar_get_part_arg( $args, 'type', '' );
$title     = yar_get_part_arg( $args, 'title', '' );
$data      = yar_get_part_arg( $args, 'data', [] );

$with_image      = yar_get_part_arg( $args, 'with_image', false );
$with_additional = yar_get_part_arg( $args, 'with_additional', false );

?>

<div class="report-form__block report-form__inspection profile-form__block" data-type="<?= $type; ?>">
	<div class="report-form__title profile-form__block-title"><?= $title; ?></div>
	<?php if ( $with_image ){ ?>
		<div class="report-form__media">
			<picture class="report-form__media-pic">
				<img src="<?= YAR_PROFILE_URL . 'assets/img/body-inspection/main.webp'; ?>" class="report-form__media-img" alt="">
			</picture>
		</div>
	<?php } ?>
	<div class="report-form__fields">
		<?php if ( ! empty( $fields ) ){
			foreach ( $fields as $field ) {
				yar_plugin_get_template( 'form/inspection', $field, false );
			}
		}

		if ( $with_additional ) {
			yar_plugin_get_template( 'form/additional', $field, false );
		}

		?>
	</div>
</div>
