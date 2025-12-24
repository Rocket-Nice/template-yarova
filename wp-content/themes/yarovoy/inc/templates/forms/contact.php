<?php

$classes = yar_get_section_classes( $args );

?>

<section class="section <?= $classes; ?>">
	<div class="feedback">
		<h2 class="feedback__title">Свяжитесь с нами</h2>
		<p class="feedback__desc">Заполните заявку, чтобы мы точно поняли ваш запрос. Мы перезвоним и ответим на все ваши вопросы.</p>
		<div class="form feedback__form">
			<div class="form__row">
				<div class="input">
					<input class="input__cell" type="text" name="name" placeholder="Ваше имя">
				</div>
				<div class="input">
					<input class="input__cell" type="text" name="phone" placeholder="Телефон">
				</div>
				<div class="input">
					<?php get_template_part( YAR_THEME_TEMPLATES . '/forms/select-region' ); ?>
				</div>
				<div class="form__send">
					<?php wp_nonce_field( 'action_on_feedback' ); ?>
					<input type="hidden" name="page_url" value="<?= yar_get_current_url(); ?>">
					<button class="btn btn--accent btn--huge form__btn" type="submit" aria-label="Send form">Оставить заявку</button>
				</div>
			</div>
		</div>
	</div>
</section>