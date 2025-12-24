<?php

$user = ( new YAR_User_Repository() )->get_current_user();

?>

	<div class="profile-settings__form form profile-settings__client">
		<div class="profile-settings__client-grid">
			<?php

			yar_plugin_get_template( 'form/text', [
				'label'       => 'Фамилия',
				'name'        => 'last_name',
				'value'       => $user['last_name'],
				'placeholder' => 'Фамилия'
			], false );

			yar_plugin_get_template( 'form/text', [
				'label'       => 'Имя',
				'name'        => 'first_name',
				'value'       => $user['first_name'],
				'placeholder' => 'Имя'
			], false );

			yar_plugin_get_template( 'form/text', [
				'label'       => 'Отчество',
				'name'        => 'surname',
				'value'       => $user['surname'],
				'placeholder' => 'Отчество'
			], false );

			yar_plugin_get_template( 'form/text', [
				'label'       => 'Email',
				'name'        => 'email',
				'value'       => $user['user_email'],
				'placeholder' => 'Email'
			], false );

			yar_plugin_get_template( 'form/text', [
				'label'       => 'Номер телефона',
				'name'        => 'phone',
				'value'       => mb_substr( $user['phone'], 1 ),
				'placeholder' => 'Номер телефона'
			], false );

			?>
			<!--<div class="input">
				<?php

//				load_template( YAR_PROFILE_DIR . 'templates/form/checkbox.php', false, [
//					'title'   => 'Получать уведомление по почте',
//					'name'    => 'on_email',
//					'value'   => 1,
//					'checked' => ( $user['notifications']['on_email'] ? true : false )
//				] );
//
//				load_template( YAR_PROFILE_DIR . 'templates/form/checkbox.php', false, [
//					'title'   => 'Получать уведомление по СМС',
//					'name'    => 'on_phone',
//					'value'   => 1,
//					'checked' => ( $user['notifications']['on_phone'] ? true : false )
//				] );

				?>
			</div>-->
		</div>
		<div class="profile-settings__client-actions">
			<button class="input__link" data-popup="popup-reset-password">Установить новый пароль</button>
			<?php wp_nonce_field( 'yar_profile_action_update_settings' ) ?>
			<div>
				<a href="<?php echo wp_logout_url( get_home_url() ); ?>" class="btn btn--dark btn--loader btn--huge">Выйти из профиля</a>
				<button class="profile-settings__btn btn btn--accent btn--loader btn--huge" type="submit">Сохранить</button>
			</div>
		</div>
	</div>

<?php yar_plugin_get_template( 'modals/reset-password' ); ?>