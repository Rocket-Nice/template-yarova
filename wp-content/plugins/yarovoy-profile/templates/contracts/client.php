<?php

$contacts = ( new YAR_Contracts_Repository() )->get();

?>

<div class="profile-contacts__client contacts-client">
	<?php if ( ! empty( $contacts ) ){  ?>
		<div class="contacts-client__alert">Обращаем ваше внимание, что нажимая галочку в поле «Согласен с условиями оферты» перед оплатой Договора, вы выражаете согласие с условиями Договора</div>
		<div class="contacts-client__table">
			<div class="contacts-client__table-head">
				<div class="contacts-client__table-th" style="--width: 346px;">Услуга</div>
				<div class="contacts-client__table-th" style="--width: 210px;">Стоимость</div>
				<div class="contacts-client__table-th" style="--width: 210px;">Дата оплаты</div>
				<div class="contacts-client__table-th" style="--width: 235px;">Итоговая сумма</div>
				<div class="contacts-client__table-th" style="--width: 159px">Статус</div>
				<div class="contacts-client__table-th" style="--width: 104px">Договор</div>
			</div>
			<div class="contacts-client__table-body">
				<?php foreach ( $contacts as $contact ) { ?>
					<div class="contacts-client__table-row" data-id="<?= $contact['contact_id']; ?>" data-nonce="<?= wp_create_nonce( 'yar_profile_contacts_pay' ) ?>">
						<div class="contacts-client__table-flex">
							<div class="contacts-client__table-col" style="--width: 346px;"><?= $contact['service_title']; ?></div>
							<div class="contacts-client__table-col" style="--width: 210px;"><?= ( $contact['amount'] ? $contact['amount'] : 'Оплата договорная' ); ?></div>
							<div class="contacts-client__table-col contacts-client__table-date" style="--width: 210px;"><?= $contact['paid_date']; ?></div>
							<div class="contacts-client__table-col" style="--width: 235px;">
								<strong class="contacts-client__table-price" style="--width: 20.97%">
									<?= $contact['total_amount']; ?>
								</strong>
							</div>
							<div class="contacts-client__table-col" style="--width: 159px">
								<div class="contacts-client__table-status _<?= $contact['status']['value']; ?>"><?= $contact['status']['label']; ?></div>
							</div>
							<div class="contacts-client__table-col" style="--width: 104px">
								<?php if ( $contact['treaty'] ){ ?>
									<a href="<?= $contact['treaty']; ?>" class="contacts-client__table-link" target="_blank">Договор</a>
								<?php } ?>
							</div>
						</div>
						<?php if ( $contact['payment_form'] ){ ?>
							<div class="contacts-client__table-form">
								<?php yar_plugin_get_template( 'form/checkbox', [
									'name'  => 'policy',
									'title' => 'Согласен с условиями <a href="/public-offer/" target="_blank">оферты</a>'
								] ); ?>
								<button class="contacts-client__table-form__btn btn--loader" disabled>Оплатить сейчас</button>
							</div>
						<?php } ?>
						<?php if ( $contact['payment_link'] ){ ?>
							<div class="contacts-client__table-form">
								<a href="<?= $contact['payment_link']; ?>" class="contacts-client__table-form__btn btn--loader" target="_blank">Вернуться к оплате</a>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="profile-contacts__empty">Пока нет договоров</div>
	<?php } ?>
</div>

