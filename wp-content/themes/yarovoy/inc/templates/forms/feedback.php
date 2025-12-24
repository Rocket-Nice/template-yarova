<?php

$is_popup = yar_get_part_arg( $args, 'is_popup' );

?>

<div class="feedback">
	<h2 class="feedback__title">Свяжитесь с нами</h2>
	<p class="feedback__desc">Заполните заявку, чтобы мы точно поняли ваш запрос. Мы перезвоним и ответим на все ваши вопросы.</p>
	<div class="form feedback__form">
		<div class="form__row">
			<div class="input">
				<input class="input__cell" type="text" name="name" placeholder="Ваше имя">
			</div>
			<div class="input">
				<input class="input__cell" type="text" name="phone" placeholder="Номер телефона">
			</div>
			<div class="input">
				<?php get_template_part( YAR_THEME_TEMPLATES . '/forms/select-region' ); ?>
			</div>
			<div class="input">
				<input class="input__cell" type="text" name="budget" placeholder="Бюджет">
			</div>
			<div class="form__row-col -w50-">
				<div class="form__radioset">
					<label class="input">
						<input class="input__radio" type="radio" name="service" value="Подбор авто" checked>
						<div class="input__radio-label">Подбор авто</div>
					</label>
					<label class="input">
						<input class="input__radio" type="radio" name="service" value="Специалист на день">
						<div class="input__radio-label">Специалист на день</div>
					</label>
					<label class="input">
						<input class="input__radio" type="radio" name="service" value="Выездная диагностика">
						<div class="input__radio-label">Выездная диагностика</div>
					</label>
					<label class="input">
						<input class="input__radio" type="radio" name="service" value="Другое">
						<div class="input__radio-label">Другое</div>
					</label>
				</div>
			</div>
			<div class="form__row-col -w50-">
				<div class="input">
					<input class="input__cell" type="text" name="preference" placeholder="Какие марки рассматриваете в первую очередь?">
				</div>
			</div>
		</div>
		<div class="form__send">
			<?php wp_nonce_field( 'action_on_feedback' ); ?>
			<input type="hidden" name="page_url" value="<?= yar_get_current_url(); ?>">
			<button class="btn btn--accent btn--huge form__btn" type="submit" aria-label="Send form">Оставить заявку</button>
		</div>
		<div class="form__agree">Нажимая кнопку «Оставить заявку», вы соглашаетесь с <a href="/policy">политикой конфиденциальности</a></div>
	</div>
	<?php if ( $is_popup ) { ?>
		<button class="popup__close popup--close">
			<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1.5 1.48828L27.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round" />
				<path d="M27.5 1.48828L1.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round" />
			</svg>
		</button>
	<?php } ?>
</div>