<?php

$user     = ( new YAR_User_Repository() )->get_current_user();
$validate = [
	'ext' => [ '.jpg', '.jpeg' ],
	'max' => 1,
];

?>

<div class="profile-settings__form form">
	<div class="profile-settings__avatar preview">
		<div class="preview__block">
			<div class="preview__output" <?= ( ! empty( $user['avatar'] ) ? 'style="background-image: url(' . $user['avatar'] . ')"' : '' ); ?>></div>
			<div class="profile-settings__avatar-icon"></div>
			<input type="file" name="avatar" accept=".jpg,.jpeg" class="preview__input" data-validate='<?= ( $validate ? json_encode( $validate ) : '' ) ?>'>
		</div>
	</div>

	<div class="profile-settings__row">
		<?php yar_plugin_get_template( 'settings/expert/fields' ); ?>
		<?php yar_plugin_get_template( 'settings/expert/documents' ); ?>
		<?php yar_plugin_get_template( 'settings/expert/services' ); ?>
		<?php yar_plugin_get_template( 'settings/expert/portfolio' ); ?>
		<?php yar_plugin_get_template( 'settings/expert/about' ); ?>
	</div>

	<div class="profile-settings__button">
		<?php wp_nonce_field( 'yar_profile_action_update_settings' ); ?>
		<button class="profile-settings__btn btn btn--accent btn--huge btn--loader btn--wide" type="submit">Сохранить</button>
	</div>

	<div class="form__message--error"></div>
</div>
