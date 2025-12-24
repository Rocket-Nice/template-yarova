<div class="popup popup-reset-password" id="popup-reset-password">
	<div class="popup__wrapper">
		<div class="popup__content">
			<div class="popup-reset-password__content">
				<div class="popup-reset-password__title">Обновление пароля личного кабинета</div>
				<div class="form profile-password">
					<div class="input">
						<label for="password" class="input__label">Новый пароль</label>
						<div class="input__wrapper">
							<input type="password" name="password" class="input__cell" placeholder="Новый пароль">
						</div>
					</div>
					<div class="input">
						<label for="password_confirmed" class="input__label">Подтвердите пароль</label>
						<div class="input__wrapper">
							<input type="password" name="password_confirmed" class="input__cell" placeholder="Подтвердите пароль">
						</div>
					</div>
					<?php wp_nonce_field( 'action_on_update_password' ); ?>
					<button class="profile-password__btn btn btn--accent btn--huge btn--wide">Сохранить</button>
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