<?php

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="report-form__block report-form__data profile-form__block" data-type="data">
	<div class="report-form__title profile-form__block-title">Данные заявки</div>
	<div class="report-form__fields">
		<?php

		load_template( YAR_PROFILE_DIR . 'templates/form/plug.php', false, [
			'title' => '№ договора',
			'value' => $data['treaty']
		] );

		load_template( YAR_PROFILE_DIR . 'templates/form/plug.php', false, [
			'title' => 'Машина',
			'value' => $data['car']
		] );

		load_template( YAR_PROFILE_DIR . 'templates/form/plug.php', false, [
			'title' => 'Год выпуска',
			'value' => $data['year']
		] );

		load_template( YAR_PROFILE_DIR . 'templates/form/plug.php', false, [
			'title' => 'ФИО клиента',
			'value' => $data['fio']
		] );

		load_template( YAR_PROFILE_DIR . 'templates/form/plug.php', false, [
			'title' => 'Телефон клиента',
			'value' => $data['phone']
		] );

		load_template( YAR_PROFILE_DIR . 'templates/form/plug.php', false, [
			'title' => 'Дата заявки',
			'value' => $data['date']
		] );

		?>
	</div>
	<div class="report-form__data-files">
		<?php

		load_template( YAR_PROFILE_DIR . 'templates/form/file.php', false, [
			'title' => 'Загрузить юридический отчет',
			'name'  => 'legal_report'
		] );

		load_template( YAR_PROFILE_DIR . 'templates/form/file.php', false, [
			'title' => 'Загрузить криминалистический отчет',
			'name'  => 'forensic_report'
		] );

		?>
	</div>
</div>