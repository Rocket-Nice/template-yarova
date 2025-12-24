<?php

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="report-form__block report-form__documents profile-form__block" data-type="documents">
	<div class="report-form__title profile-form__block-title">Документы <span>(ПТС, СТС, Паспорт продавца)</span></div>
		<?php

		load_template( YAR_PROFILE_DIR . 'templates/form/gallery.php', false, [
			'name'     => 'documents',
			'data'     => $data,
			'validate' => [
				'ext' => [ '.jpg', '.jpeg' ],
				'max' => 20,
			],
		] );

		?>

</div>
