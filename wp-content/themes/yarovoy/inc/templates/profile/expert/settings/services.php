<?php

$posts = get_posts( [
	'post_type'      => 'service',
	'posts_per_page' => - 1
] );

if ( empty( $posts ) ) {
	return '';
}

$services = get_field( 'services', 'user_' . get_current_user_id() );

?>

<div class="profile-form__block profile-settings__services">
	<div class="profile-form__block-title">Список услуг</div>
	<div class="profile-form__block-grid profile-service">
		<div class="profile-service__row">
			<?php if ( ! empty( $services ) ){
				foreach ( $services as $key => $service ) { ?>
					<div class="profile-service__item">
						<div class="profile-service__input">
							<label for="service" class="input__label">Услуга</label>
							<select name="service" class="input__cell">
								<option value="0">Выбрать</option>
								<?php foreach ( $posts as $post ) { ?>
									<option value="<?= $post->ID; ?>" <?= ( $service['select'] && $service['select'] === $post->ID ? 'selected' : '' ); ?>><?= $post->post_title; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="profile-service__input">
							<label for="" class="input__label">Стоимость</label>
							<div class="profile-service__price">
								<input type="number" class="input__cell" value="<?= ( $service['price'] ? $service['price'] : '' ); ?>" placeholder="Цена">
								<span class="profile-service__price-symbol">₽</span>
							</div>
						</div>
						<?php if ( $key > 0 ) { ?>
							<button class="profile-service__remove profile__icon-remove"></button>
						<?php } ?>
					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="profile-service__item">
					<div class="profile-service__input">
						<label for="service class="input__label">Услуга</label>
						<select name="service" class="input__cell">
							<option value="0">Выбрать</option>
							<?php foreach ( $posts as $post ) { ?>
								<option value="<?= $post->ID; ?>"><?= $post->post_title; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="profile-service__input">
						<label for="" class="input__label">Стоимость</label>
						<div class="profile-service__price">
							<input type="number" class="input__cell" placeholder="Цена">
							<span class="profile-service__price-symbol">₽</span>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<button class="profile-service__add">+ Добавить пункт</button>
	</div>
</div>