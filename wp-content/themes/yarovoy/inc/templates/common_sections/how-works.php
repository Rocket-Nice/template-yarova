<?php

$classes = yar_get_section_classes( $args );

?>

<section class="section <?= $classes; ?>">
	<div class="section__head">
		<h2 class="section__title">Как устроена услуга <br> автоподбора?</h2>
	</div>
	<div class="coop">
		<div class="coop__row">
			<div class="coop__col">
				<div class="coop__col-body">
					<div class="coop__col-title">Онлайн-заявка на подбор автомобиля</div>
					<p class="coop__col-desc">Через форму на сайте, по телефону или через мессенджеры.</p>
				</div>
			</div>
			<div class="coop__col">
				<div class="coop__col-body">
					<div class="coop__col-title">Бесплатная консультация со специалистом</div>
					<p class="coop__col-desc">Определяем требования к автомобилю, обсуждаем ваши пожелания, после чего заключаем договор. Вы вносите предоплату.</p>
				</div>
			</div>
			<div class="coop__col">
				<div class="coop__col-body">
					<div class="coop__col-title">Поиск и проверка автомобиля</div>
					<p class="coop__col-desc">Анализируем рынок. Проверяем историю автомобиля, проводим техническую, юридическую и криминалистическую проверку. Предоставляем отчёт и заключение эксперта о состоянии автомобиля.</p>
				</div>
			</div>
			<div class="coop__col">
				<div class="coop__col-body">
					<div class="coop__col-title">Проверка автомобиля</div>
					<p class="coop__col-desc">Проверяем на СТО. Предоставляем отчёт и заключение эксперта о состоянии автомобиля. Торгуемся с продавцом.</p>
				</div>
			</div>
			<div class="coop__col">
				<div class="coop__col-body">
					<div class="coop__col-title">Заключение сделки купли-продажи</div>
					<p class="coop__col-desc">Сопровождаем сделку, включая составление Договора купли-продажи, помогаем при постановке в ГАИ</p>
				</div>
			</div>
			<div class="coop__col">
				<div class="coop__col-body">
					<div class="coop__col-title">Доставка автомобиля и оплата услуг подбора</div>
					<p class="coop__col-desc">При необходимости доставляем автомобиль, если он приобретен в удаленном регионе или другой стране. Выдаём пакет документов. Вы оплачиваете услугу подбора и доставку.</p>
				</div>
			</div>
		</div>
		<div class="coop__footer">
			<button class="btn btn--accent btn--huge btn--wide" aria-label="Open modal" data-popup="popup-feedback">Оставить заявку</button>
		</div>
	</div>
</section>