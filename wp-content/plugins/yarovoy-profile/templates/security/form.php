<?php

$user_id = get_current_user_id();

$on_email = get_field( 'on_email', 'user_' . $user_id );
$on_phone = get_field( 'on_phone', 'user_' . $user_id );

$view_notifications = false;

?>


<div class="profile profile-security">
	<div class="container profile__container">
		<?php yar_plugin_get_template( 'common/page-header' ); ?>

		<div class="profile-security__form">
			<?php if ( $view_notifications ){ ?>
				<div class="form profile-form__block profile-notifications">
					<div class="profile-form__block-title">Уведомления</div>
					<div class="profile-form__block-grid profile-security__form-grid">
						<?php yar_plugin_get_template( 'form/checkbox', [
							'name'    => 'on_email',
							'title'   => 'Получать уведомление по почте',
							'value'   => 1,
							'checked' => $on_email
						], false );

						yar_plugin_get_template( 'form/checkbox', [
							'name'    => 'on_phone',
							'title'   => 'Получать уведомление по СМС',
							'value'   => 1,
							'checked' => $on_phone
						], false ); ?>
					</div>
					<?php wp_nonce_field( 'yar_update_expert_notifications' ); ?>
					<button class="profile-notifications__btn btn btn--loader btn--accent btn--huge btn--wide">Сохранить</button>
				</div>
			<?php } ?>
			<div class="form profile-form__block profile-password">
				<div class="profile-form__block-title">Изменить пароль</div>
				<div class="profile-form__block-grid profile-security__form-grid">
					<?php

					yar_plugin_get_template( 'form/text', [
						'label'       => 'Старый пароль',
						'name'        => 'old_password',
						'placeholder' => 'Старый пароль',
						'type'        => 'password',
					], false );

					yar_plugin_get_template( 'form/text', [
						'label'       => 'Новый пароль',
						'name'        => 'password',
						'placeholder' => 'Новый пароль',
						'type'        => 'password',
					], false );

					yar_plugin_get_template( 'form/text', [
						'label'       => 'Подтвердите пароль',
						'name'        => 'password_confirmed',
						'placeholder' => 'Подтвердите пароль',
						'type'        => 'password',
					], false );

					?>
				</div>
				<?php wp_nonce_field( 'action_on_update_password' ); ?>
				<button class="profile-password__btn btn--loader btn btn--accent btn--huge btn--wide">Сохранить</button>
			</div>
			<div class="form profile-form__block profile-logout">
				<div class="profile-form__block-title">Выйти из профиля</div>
				<a href="<?php echo wp_logout_url( get_home_url() ); ?>" class="btn btn--dark btn--loader btn--huge" style="width: 100%;">Выйти из профиля</a>
			</div>
		</div>
	</div>
</div>

<?php yar_plugin_get_template( 'modals/message' ); ?>
