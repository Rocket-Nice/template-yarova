<?php

?>

<div class="auth">
	<div class="container auth__container">
		<h1 class="auth__title"><?php the_title(); ?></h1>
		<div class="register__form form">
			<div class="register__form-col">
				<?php

				yar_plugin_get_template( 'form/text', [
					'name'        => 'last_name',
					'placeholder' => 'Фамилия',
					'classes'     => 'input--black'
				], false );

				yar_plugin_get_template( 'form/text', [
					'name'        => 'first_name',
					'placeholder' => 'Имя',
					'classes'     => 'input--black'
				], false );

				yar_plugin_get_template( 'form/text', [
					'name'        => 'surname',
					'placeholder' => 'Отчество',
					'classes'     => 'input--black'
				], false );

				yar_plugin_get_template( 'form/text', [
					'name'        => 'phone',
					'placeholder' => 'Номер телефона',
					'classes'     => 'input--black'
				], false );

				?>
			</div>
			<div class="register__form-col">
				<?php

				yar_plugin_get_template( 'form/text', [
					'name'        => 'email',
					'placeholder' => 'E-mail',
					'classes'     => 'input--black'
				], false );

				yar_plugin_get_template( 'form/text', [
					'name'             => 'password',
					'placeholder'      => 'Пароль',
					'classes'          => 'input--black',
					'type'             => 'password',
					'is_password_show' => true,
				], false );

				yar_plugin_get_template( 'form/text', [
					'name'             => 'password_confirmed',
					'placeholder'      => 'Повторите пароль',
					'classes'          => 'input--black',
					'type'             => 'password',
					'is_password_show' => true,
				], false );

				yar_plugin_get_template( 'form/checkbox', [
					'title'   => 'Зарегистрироваться как эксперт',
					'name'    => 'is_expert',
					'value'   => 1,
				] );

				?>
				<?php wp_nonce_field( 'yar_auth_get_code' ); ?>
				<button class="btn btn--big btn--accent register__form-btn btn--loader">Зарегистрироваться</button>
				<div class="register__form-link">
					<a href="/login" class="auth__form-forgot">Войти в существующий аккаунт</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php load_template( YAR_PROFILE_TEMPLATES . '/modals/message.php' ); ?>
