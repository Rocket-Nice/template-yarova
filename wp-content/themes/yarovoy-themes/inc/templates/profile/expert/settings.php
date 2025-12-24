<h1 class="profile__title">Личный кабинет Специалиста</h1>
<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/expert/menu' ); ?>

<div class="profile-settings__form form">
	<div class="profile-settings__avatar _preview">
		<div class="profile-settings__avatar-icon"></div>
		<input type="file" name="avatar">
	</div>

	<div class="profile-settings__row">
		<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/expert/settings/fields' ); ?>
		<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/expert/settings/documents' ); ?>
		<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/expert/settings/services' ); ?>
		<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/expert/settings/portfolio' ); ?>
		<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/expert/settings/about' ); ?>
	</div>

	<div class="profile-settings__button">
		<?php wp_nonce_field( 'yar_expert_update_profile' ); ?>
		<button class="btn btn--accent btn--huge" type="submit">Сохранить</button>
	</div>
</div>