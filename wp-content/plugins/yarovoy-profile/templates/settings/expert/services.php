<?php

$posts = get_posts( [
	'post_type'      => 'service',
	'posts_per_page' => - 1
] );

if ( empty( $posts ) ) {
	return '';
}

$services = get_field( 'services', 'user_' . get_current_user_id() );
if ( ! is_array( $services ) ){
	$services = [];
}

?>

<div class="profile-form__block profile-settings__services">
	<div class="profile-form__block-title">Список услуг</div>
	<div class="profile-form__block-grid profile-service">
		<div class="profile-service__template profile-service__item" style="display: none;">
			<div class="profile-service__input">
				<label for="service" class="input__label">Услуга</label>
				<select name="service" class="input__cell">
					<option disabled selected value="0">Выбрать</option>
					<?php foreach ( $posts as $post ) {
						$disabled = false;
						if ( ! empty( $services ) ) {
							$find     = array_search( $post->ID, $services );
							$disabled = $find && $services[ $find ] === $post->ID;
						}

						?>
						<option value="<?= $post->ID; ?>" <?= $disabled ? 'disabled' : ''; ?>><?= $post->post_title; ?></option>
					<?php } ?>
				</select>
			</div>
			<button class="profile-service__remove profile__icon-remove"></button>
		</div>
		<div class="profile-service__row">
			<?php
			if ( ! empty( $services ) ) {
				foreach ( $services as $service ) { ?>
					<div class="profile-service__item">
						<div class="profile-service__input">
							<label for="service" class="input__label">Услуга</label>
							<select name="service" class="input__cell">
								<option disabled selected value="0">Выбрать</option>
								<?php foreach ( $posts as $post ) { ?>
									<option value="<?= $post->ID; ?>" <?= ( $service === $post->ID ? 'selected' : '' ); ?>><?= $post->post_title; ?></option>
								<?php } ?>
							</select>
						</div>
						<button class="profile-service__remove profile__icon-remove"></button>
					</div>
				<?php }
			}
			?>
		</div>
		<button class="profile-service__add">+ Добавить пункт</button>
	</div>
</div>