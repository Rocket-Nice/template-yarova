<?php

$classes = yar_get_section_classes( $args );

?>

<section class="section section--bg <?= $classes; ?>">
	<div class="contacts">
		<div class="contacts__row">
			<div class="contacts__info">
				<h2 class="contacts__title">Контакты</h2>
				<ul class="contacts__list list-reset">
					<li class="contacts__list-item"><span class="contacts__list-name">Номер телефона</span><a class="contacts__list-link" href="tel:+74951593920">+7 (495) 159-39-20</a></li>
					<li class="contacts__list-item"><span class="contacts__list-name">Почта</span><a class="contacts__list-link" href="mailto:yarovoipodbor@yandex.ru">yarovoipodbor@yandex.ru</a></li>
					<li class="contacts__list-item"><span class="contacts__list-name">Адрес</span>
						<div class="contacts__list-link">г.Москва, ул. Ташкентская, д28с1</div>
					</li>
				</ul>
			</div>
			<div class="contacts__map">
				<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ab22385ad2cd865e02d0eded7e5e4f20ed40c206704ab67448a74c1a236fbb563&amp;amp;width=700&amp;amp;height=400&amp;amp;lang=ru_RU&amp;amp;scroll=true"></script>
			</div>
		</div>
	</div>
</section>