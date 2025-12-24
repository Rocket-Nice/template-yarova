<?php

if ( ! yar_is_expert() ){
	return '';
}

$active    = yar_get_part_arg( $args, 'active', false );
$report_id = yar_get_part_arg( $args, 'report_id' );
$title     = 'Передать на проверку';

$contacts = ( new YAR_Contracts_Repository() )->get_contracts_for_report();

if ( empty( $contacts['list'] ) ) {
	$title = 'Отчет сохранен';
}

?>

<div class="popup popup-profile popup-report-submit popup--profile" id="report-submit">
	<div class="popup__wrapper">
		<div class="popup__content">
			<div class="popup-profile__content">
				<div class="popup-profile__title"><?= $title; ?></div>
				<?php if ( $title === 'Передать на проверку' ){ ?>
					<div class="popup-profile__text">После сохранения отчет проверит модератор, только после этого опубликуется для клиента</div>
				<?php } ?>
				<?php if ( ! empty( $contacts['list'] ) ) { ?>
					<div class="popup-profile__form popup-report-submit__form form">
						<?php

						yar_plugin_get_template( 'form/select', [
							'label'   => 'Выбрать договор',
							'name'    => 'contract',
							'value'   => '',
							'options' => $contacts['list']
						], false );

						?>
						<input type="hidden" name="report_id" value="<?= $report_id; ?>">
						<?php wp_nonce_field( 'yar_profile_report_moderate', '_nonce' ); ?>
						<button class="popup-report-submit__btn btn btn--accent btn--huge btn--wide btn--loader">Сохранить</button>
						<div class="form__message--error"></div>
					</div>
				<?php } else { ?>
					<div class="popup-profile__text">Пока что нет прикрепленных за вами договоров, но отчет был сохранен, вы сможете вернуться к нему позже</div>
					<input type="hidden" name="referrer" value="1">
				<?php } ?>
				<button class="popup__close popup--close">
					<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.5 1.48828L27.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round"></path>
						<path d="M27.5 1.48828L1.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round"></path>
					</svg>
				</button>
			</div>
		</div>
	</div>
	<div class="popup__bg"></div>
</div>
