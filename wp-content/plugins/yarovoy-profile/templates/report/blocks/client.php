<?php

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="report-form__block report-form__client profile-form__block" data-type="client">
	<div class="report-form__title profile-form__block-title">Данные владельца</div>
	<div class="report-form__fields">
		<?php

		load_template( YAR_PROFILE_DIR . 'templates/form/text.php', false, [
			'label'       => 'ФИО владельца',
			'placeholder' => 'ФИО владельца',
			'name'        => 'owners_fio',
			'value'       => isset( $data['fio'] ) ? $data['fio'] : ''
		] );

		load_template( YAR_PROFILE_DIR . 'templates/form/text.php', false, [
			'label'       => 'Телефон владельца',
			'placeholder' => 'Телефон владельца',
			'name'        => 'owners_phone',
			'value'       => isset( $data['phone'] ) ? $data['phone'] : ''
		] );

		?>
	</div>
</div>