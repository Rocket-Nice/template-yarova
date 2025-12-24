<?php

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="report-form__block report-form__gallery profile-form__block" data-type="gallery">
	<div class="report-form__title profile-form__block-title">Фото автомобиля <span>(не менее 24шт)</span></div>
	<?php

	load_template( YAR_PROFILE_DIR . 'templates/form/gallery.php', false, [
		'name'     => 'gallery',
		'data'     => $data,
		'validate' => [
			'ext' => [ '.jpg', '.jpeg' ]
		]
	] );

	?>
</div>