<?php

$title     = yar_get_part_arg( $args, 'title', '' );
$type      = yar_get_part_arg( $args, 'type', '' );
$name      = yar_get_part_arg( $args, 'name', '' );
$validate  = yar_get_part_arg( $args, 'validate', [] );

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="report-form__block report-form__gallery profile-form__block" data-type="<?= $type; ?>">
	<div class="report-form__title profile-form__block-title"><?= $title; ?></div>
	<?php

	yar_plugin_get_template( 'form/gallery', [
		'name'     => $name,
		'data'     => $data,
		'validate' => $validate
	], false );

	?>
</div>