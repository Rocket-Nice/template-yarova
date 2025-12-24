<div class="popup popup-reset-password popup--profile" id="popup-reset-password">
	<div class="popup__wrapper">
		<div class="popup__content">
			<div class="popup-reset-password__content">
				<div class="popup-reset-password__title">Обновление пароля личного кабинета</div>
				<div class="form profile-password">
					<?php

					yar_plugin_get_template( 'form/text', [
						'label'       => 'Старый пароль',
						'name'        => 'old_password',
						'value'       => '',
						'placeholder' => 'Старый пароль',
						'type'        => 'password'
					], false );

					yar_plugin_get_template( 'form/text', [
						'label'       => 'Новый пароль',
						'name'        => 'password',
						'value'       => '',
						'placeholder' => 'Новый пароль',
						'type'        => 'password'
					], false );

					yar_plugin_get_template( 'form/text', [
						'label'       => 'Подтвердите пароль',
						'name'        => 'password_confirmed',
						'value'       => '',
						'placeholder' => 'Подтвердите пароль',
						'type'        => 'password'
					], false );

					?>
					<?php wp_nonce_field( 'action_on_update_password' ); ?>
					<button class="profile-password__btn btn btn--accent btn--huge btn--wide btn--loader">Сохранить</button>
				</div>
				<button class="popup__close popup--close">
					<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.5 1.48828L27.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round"></path>
						<path d="M27.5 1.48828L1.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round"></path>
					</svg>
				</button>
			</div>
		</div>
	</div>
	<div class="popup__bg"></div>
</div>