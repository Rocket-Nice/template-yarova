<div class="popup popup-code popup--profile" id="popup-code">
	<div class="popup__wrapper">
		<div class="popup__content">
			<div class="popup-code__content">
				<div class="popup-code__title">Подтвердите E-mail</div>
				<div class="popup-code__text">
					Чтобы завершить регистрацию введите код активации отправленный на ваш E-mail.
				</div>
				<div class="form popup-code__form">
					<div class="input">
						<input type="number" name="code" class="input__cell" max="4" placeholder="Введите код">
						<div class="input__timer">100 с</div>
					</div>
					<div class="code__repeat"></div>
					<button class="popup-code__btn btn btn--accent btn--wide btn--huge btn--loader">Отправить</button>
					<?php wp_nonce_field( 'yar_auth_confirm_code' ); ?>
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