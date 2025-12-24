<?php

?>

<div class="auth">
	<div class="container auth__container">
		<h1 class="auth__title"><?php the_title(); ?></h1>
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
			<div class="auth__form login__form form">
				<div class="input input--black">
					<input type="text" name="phone" class="input__cell" placeholder="Номер телефона">
				</div>
				<div class="input input--black">
					<input type="password" name="password" class="input__cell" placeholder="Пароль">
					<button class="input__show">
						<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12.0039 7.44479C15.4494 7.44479 18.5221 9.43279 20.0221 12.5781C18.5221 15.7235 15.4585 17.7115 12.0039 17.7115C8.54936 17.7115 5.48572 15.7235 3.98572 12.5781C5.48572 9.43279 8.55845 7.44479 12.0039 7.44479ZM12.0039 5.57812C7.45845 5.57812 3.57663 8.48079 2.00391 12.5781C3.57663 16.6755 7.45845 19.5781 12.0039 19.5781C16.5494 19.5781 20.4312 16.6755 22.0039 12.5781C20.4312 8.48079 16.5494 5.57812 12.0039 5.57812ZM12.0039 10.2448C13.2585 10.2448 14.2766 11.2901 14.2766 12.5781C14.2766 13.8661 13.2585 14.9115 12.0039 14.9115C10.7494 14.9115 9.73118 13.8661 9.73118 12.5781C9.73118 11.2901 10.7494 10.2448 12.0039 10.2448ZM12.0039 8.37812C9.74936 8.37812 7.913 10.2635 7.913 12.5781C7.913 14.8928 9.74936 16.7781 12.0039 16.7781C14.2585 16.7781 16.0948 14.8928 16.0948 12.5781C16.0948 10.2635 14.2585 8.37812 12.0039 8.37812Z" fill="white"/>
						</svg>
					</button>
				</div>
				<div class="form__message auth__message"></div>
				<?php wp_nonce_field( 'yar_auth_login', '_nonce' ); ?>
				<div class="auth__form-buttons">
					<button class="btn btn--big btn--accent login__form-btn btn--loader">Войти в аккаунт</button>
					<a href="/register/" class="btn btn--big btn--light">Зарегистрироваться</a>
				</div>
				<a href="/forgot/" class="auth__form-forgot">Забыли пароль?</a>
			</div>
		</div>
	</div>
</div>

<?php yar_plugin_get_template( 'modals/message' ); ?>
