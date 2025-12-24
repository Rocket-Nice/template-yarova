<?php

$payment = new \YAR_Profile\Services\YAR_Payment_Service();
if ( ! $payment->set_payment_status() ) {
	return '';
}

?>

<div class="page-container container">
	<section class="section section--banner banner__thanks">
		<div class="banner anim-elem">
			<div class="banner__info">
				<h1 class="banner__title">Спасибо, оплата прошла успешно</h1>
				<p>Договор можно проверить в Личном кабинете</p>
			</div>
			<a href="<?= home_url(); ?>" class="btn banner__btn btn--accent btn--big">Вернуться на главную</a>
		</div>
	</section>
</div>
