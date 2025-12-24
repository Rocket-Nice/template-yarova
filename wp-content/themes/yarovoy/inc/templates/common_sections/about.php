<?php

$classes = yar_get_section_classes( $args );

?>

<section class="section <?= $classes; ?>">
	<div class="section__head">
		<h2 class="section__title">О компании ЯПодбор</h2>
	</div>
	<div class="infoblock">
		<div class="infoblock__columns">
			<div class="infoblock__columns-item">
				<p>Занимаемся подбором автомобилей с 2012 года. Делаем полную юридическую, техническую и криминалистическую проверку. География подбора не ограничивается Россией. Специалисты также ищут автомобили в странах СНГ, Европе и США <br><br> С момента основания компании мы подобрали более 9000 автомобилей, чётко следуя критериям клиентов. Доверьте нам поиск своего автомобиля — сэкономьте время, деньги и сохраните нервы.</p>
			</div>
			<div class="infoblock__columns-item">
				<h5>Выгодный торг</h5>
				<p> <strong>В 99% случаях оплата за услуги автоподбора окупается торгом с владельцем машины.</strong></p>
			</div>
			<div class="infoblock__columns-item">
				<h5>Экономим ваше времЯ</h5>
				<p>Проведём осмотр авто в течение нескольких часов после получения заявки.</p>
			</div>
		</div>
		<div class="infoblock__img--wrap"><img class="infoblock__img" src="<?= YAR_THEME_ASSETS; ?>/img/content/infoblock/main-2.jpg" width="1380" height="824" alt="Андрей Яровой | Генеральный директор ЯПОDБОР">
			<div class="infoblock__img-panel">
				<div class="infoblock__img-panel-title">Андрей Яровой</div>
				<div class="infoblock__img-panel-desc">Генеральный директор ЯПОDБОР</div>
			</div>
		</div>
	</div>
</section>