<?php

$user    = ( new YAR_User_Repository() )->get_current_user();
$regions = yar_get_select_options( 'region' );

?>

<div class="profile-form__block profile-settings__fields">
	<div class="profile-form__block-title">Личные данные</div>
	<div class="profile-form__block-grid">
		<?php

		yar_plugin_get_template( 'form/text', [
			'label'       => 'Фамилия',
			'name'        => 'last_name',
			'value'       => $user['last_name'],
			'placeholder' => 'Фамилия'
		], false );

		yar_plugin_get_template( 'form/text', [
			'label'       => 'Имя',
			'name'        => 'first_name',
			'value'       => $user['first_name'],
			'placeholder' => 'Имя'
		], false );

		yar_plugin_get_template( 'form/text', [
			'label'       => 'Отчество',
			'name'        => 'surname',
			'value'       => $user['surname'],
			'placeholder' => 'Отчество'
		], false );

		yar_plugin_get_template( 'form/text', [
			'label'       => 'Номер телефона',
			'name'        => 'phone',
			'value'       => mb_substr( $user['phone'], 1 ),
			'placeholder' => 'Номер телефона'
		], false );

		yar_plugin_get_template( 'form/plug', [
			'title'       => 'E-mail',
			'value'       => $user['user_email'],
			'placeholder' => 'E-mail'
		], false );

		yar_plugin_get_template( 'form/select', [
			'label'   => 'Регионы',
			'name'    => 'region',
			'value'   => $user['region'],
			'options' => $regions
		], false );

		?>

	</div>
</div>
