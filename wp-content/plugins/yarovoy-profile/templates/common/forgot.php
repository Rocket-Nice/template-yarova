<div class="auth">
	<div class="container auth__container">
		<h1 class="auth__title">ВОССТАНОВЛЕНИЕ ПАРОЛЯ ПОЛЬЗОВАТЕЛЯ</h1>
		<div class="auth__flex">
			<div class="auth__content">
				<h3 class="auth__content-title">В личном кабинете вы сможете</h3>
				<ul class="auth__content-list">
					<li>Увидеть статус заявки на подбор автомобиля</li>
					<li>Отследить ход подбора автомобиля и получить подробную информацию о его истории и техническом состоянии</li>
					<li>Найти все необходимые документы для оформления сделки и подписать их</li>
					<li>Связаться с персональным экспертом</li>
					<li>Все данные в одном личном кабинете, что экономит время и делает подбор максимально удобным для вас!</li>
				</ul>
			</div>
			<div class="auth__form forgot__form form">
				<?php if ( isset( $_GET['key'] ) ){ ?>
					<?php

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

					yar_plugin_get_template( 'form/text', [
						'name'        => 'reset_key',
						'placeholder' => '',
						'classes'     => 'input--black',
						'type'        => 'hidden',
						'value'       => $_GET['key']
					], false );

					?>

					<div class="form__message auth__message"></div>
					<?php wp_nonce_field( 'yar_auth_forgot_password_save' ); ?>
					<div class="auth__form-buttons">
						<button class="btn btn--big btn--accent forgot__form-save btn--loader">Изменить пароль</button>
					</div>
				<?php } else { ?>
					<div class="input input--black">
						<input type="email" name="email" class="input__cell" placeholder="E-mail">
					</div>
					<div class="form__message auth__message"></div>
					<?php wp_nonce_field( 'yar_auth_forgot_password' ); ?>
					<div class="auth__form-buttons">
						<button class="btn btn--big btn--accent forgot__form-btn btn--loader">Отправить</button>
						<a href="/register/" class="btn btn--big btn--light">Зарегистрироваться</a>
					</div>
				<?php } ?>
				<a href="/login/" class="auth__form-forgot">Войти</a>
			</div>
		</div>
	</div>
</div>

<?php yar_plugin_get_template( 'modals/message' ); ?>
