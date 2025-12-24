<?php

$contacts = ( new YAR_Contracts_Repository() )->get();

?>

<div class="profile-contacts__expert contacts-expert">
	<?php if ( ! empty( $contacts ) ) {
		foreach ( $contacts as $contact ) { ?>
			<div class="contacts-expert__item" data-id="<?php echo $contact['contact_id']; ?>" data-nonce="<?= wp_create_nonce( 'yar_profile_cancel_contact' ); ?>">
				<div class="contacts-expert__head">
					<div class="contacts-expert__title"><?= $contact['post_title']; ?></div>
					<?php if ( $contact['status_expert'] ){ ?>
						<div class="contacts-expert__status profile__status <?= '_' . $contact['status_expert']['value']; ?>">
							<?= $contact['status_expert']['label']; ?>
						</div>
					<?php } ?>
				</div>
				<?php if ( $contact['treaty'] ){ ?>
					<div class="contacts-expert__link">
						<a href="<?= $contact['treaty']; ?>" target="_blank">Просмотреть договор</a>
					</div>
				<?php } ?>
				<div class="contacts-expert__grid">
					<?php

					yar_plugin_get_template( 'form/plug', [
						'title' => 'Машина',
						'value' => $contact['car']
					], false );

					yar_plugin_get_template( 'form/plug', [
						'title' => 'Год выпуска',
						'value' => $contact['year']
					], false );

					yar_plugin_get_template( 'form/plug', [
						'title' => 'Услуга',
						'value' => $contact['service_title']
					], false );

					yar_plugin_get_template( 'form/plug', [
						'title' => 'ФИО клиента',
						'value' => $contact['fio']
					], false );

					yar_plugin_get_template( 'form/plug', [
						'title' => 'Телефон клиента',
						'value' => yar_format_phone( $contact['phone'] )
					], false );

					yar_plugin_get_template( 'form/plug', [
						'title' => 'Дата заявки',
						'value' => $contact['date']
					], false );

					?>
				</div>
				<?php if ( $contact['can_be_completed'] ){ ?>
					<div class="contacts-expert__action">
						<button class="contacts-expert__cancel btn btn--wide btn--accent btn--huge btn--loader">завершить</button>
					</div>
				<?php } ?>
			</div>
		<?php }
	} else {
		echo 'Договоров не найдено';
	} ?>
</div>

