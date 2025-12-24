<?php

$user = wp_get_current_user();

$last_name  = get_field( 'last_name', 'user_' . $user->ID );
$first_name = get_field( 'first_name', 'user_' . $user->ID );
$surname    = get_field( 'surname', 'user_' . $user->ID );

$phone = get_field( 'phone', 'user_' . $user->ID );
$phone = mb_substr( $phone, 1 );

$on_email = get_field( 'on_email', 'user_' . $user->ID );
$on_phone = get_field( 'on_phone', 'user_' . $user->ID );

?>

<h1 class="profile__title">Личный кабинет пользователя</h1>
<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/menu' ); ?>

<p class="profile-settings__alert">
	Личный кабинет пользователя не подтверждён.<br>
	Для подтверждения доступа и активации личного кабинета необходимо установить постоянный пароль.<br>
	Время деактивации текущего временого пароля: 22.05.2024 01:59:54.
</p>

<div class="profile-settings__form form profile-settings__client">
	<div class="profile-settings__client-grid">
		<div class="input">
			<label for="name" class="input__label">Фамилия</label>
			<div class="input__wrapper">
				<input type="text" name="last_name" class="input__cell" placeholder="Фамилия" value="<?= ( $last_name ? $last_name : '' ); ?>">
			</div>
		</div>
		<div class="input">
			<label for="name" class="input__label">Имя</label>
			<div class="input__wrapper">
				<input type="text" name="first_name" class="input__cell" placeholder="Имя" value="<?= ( $first_name ? $first_name : '' ); ?>">
			</div>
		</div>
		<div class="input">
			<label for="name" class="input__label">Отчество</label>
			<div class="input__wrapper">
				<input type="text" name="surname" class="input__cell" placeholder="Отчество" value="<?= ( $surname ? $surname : '' ); ?>">
			</div>
		</div>
		<div class="input">
			<label for="email" class="input__label">Email</label>
			<div class="input__wrapper">
				<input type="text" name="email" class="input__cell" placeholder="Email" value="<?= $user->user_email; ?>">
			</div>
		</div>
		<div class="input">
			<label for="phone" class="input__label">Номер телефона</label>
			<div class="input__wrapper">
				<input type="text" name="phone" class="input__cell" placeholder="+7 (999) 999-99-99" value="<?= ( $phone ? $phone : '' ) ?>">
			</div>
		</div>
		<div class="input">
			<div class="profile-form__checkboxes">
				<div class="profile-form__checkbox">
					<input class="profile-form__checkbox-input" type="checkbox" name="on_email" value="1" <?= ( $on_email ? 'checked' : '' ); ?>>
					<span  class="profile-form__checkbox-icon"></span>
					<label for="on_email" class="profile-form__checkbox-label">Получать уведомление по почте</label>
				</div>
				<div class="profile-form__checkbox">
					<input class="profile-form__checkbox-input" type="checkbox" name="on_phone" value="1" <?= ( $on_phone ? 'checked' : '' ); ?>>
					<span  class="profile-form__checkbox-icon"></span>
					<label for="on_email" class="profile-form__checkbox-label">Получать уведомление по СМС</label>
				</div>
			</div>
		</div>
	</div>
	<div class="profile-settings__client-actions">
		<button class="input__link" data-popup="popup-reset-password">Установить новый пароль</button>
		<?php wp_nonce_field( 'yar_update_profile' ) ?>
		<button class="profile-settings__btn btn btn--accent btn--huge" type="submit">Сохранить</button>
	</div>
</div>

<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/modals/reset-password' ); ?>