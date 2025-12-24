<?php

$user = wp_get_current_user();

$fio    = get_field( 'fio', 'user_' . $user->ID );
$phone  = get_field( 'phone', 'user_' . $user->ID );
$phone  = mb_substr( $phone, 1 );
$region = get_field( 'region', 'user_' . $user->ID );
$post   = get_field( 'post', 'user_' . $user->ID );

$regions = get_posts( [
	'post_type'      => 'region',
	'posts_per_page' => - 1,
	'orderby'        => 'title',
	'order'          => 'ASC'
] );

$expert_posts = get_posts( [
	'post_type'      => 'expert_posts',
	'posts_per_page' => - 1,
	'orderby'        => 'title',
	'order'          => 'ASC'
] );

?>

<div class="profile-form__block profile-settings__fields">
	<div class="profile-form__block-title">Личные данные</div>
	<div class="profile-form__block-grid">
		<div class="input">
			<label for="name" class="input__label">ФИО</label>
			<div class="input__wrapper">
				<input type="text" name="name" class="input__cell" placeholder="ФИО" value="<?= ( $fio ? $fio : '' ); ?>">
			</div>
		</div>
		<div class="input">
			<label for="phone" class="input__label">Номер телефона</label>
			<div class="input__wrapper">
				<input type="text" name="phone" class="input__cell" placeholder="+7 (999) 999-99-99" value="<?= ( $phone ? $phone : '' ); ?>">
			</div>
		</div>
		<div class="input">
			<label for="email" class="input__label">Email</label>
			<div class="input__wrapper">
				<input type="text" name="email" class="input__cell" placeholder="test@yarovoycompany.ru" value="<?= ( $user->user_email ? $user->user_email : '' ); ?>">
			</div>
		</div>
		<?php if ( ! empty( $regions ) ){ ?>
			<div class="input">
				<label for="regions" class="input__label">Регионы</label>
				<div class="input__wrapper">
					<select name="region" class="input__cell">
						<option value="0">Выбрать</option>
						<?php foreach ( $regions as $item ) { ?>
							<option value="<?= $item->ID; ?>" <?= ( $region === $item->ID ? 'selected' : '' ); ?>><?= $item->post_title; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! empty( $expert_posts ) ) { ?>
			<div class="input">
				<label for="post" class="input__label">Должность</label>
				<div class="input__wrapper">
					<select name="post" class="input__cell">
						<option value="0">Выбрать</option>
						<?php foreach ( $expert_posts as $item ) { ?>
							<option value="<?= $item->ID; ?>" <?= ( $post === $item->ID ? 'selected' : '' ); ?>><?= $item->post_title; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		<?php } ?>
	</div>
</div>