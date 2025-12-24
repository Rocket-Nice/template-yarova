<?php get_header(); /* TEMPLATE NAME: О компании */ ?>

<div class="page-container container">
	<section class="section section--banner banner__about">
		<?php get_template_part( 'inc/templates/breadcrumbs' ); ?>
		<div class="banner anim-elem">
			<div class="banner__bg"><img class="banner__bg-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/banner/about-bg.jpg" width="1920" height="1104" alt="Профессиональный автоподбор под ключ"></div>
			<div class="banner__body">
				<div class="banner__info">
					<h1 class="banner__title">О компании япоdбор</h1>
					<p>Занимаемся подбором автомобилей с 2012 года. Делаем полную юридическую, техническую и криминалистическую проверку. География подбора не ограничивается Россией. Специалисты также ищут автомобили в странах СНГ, Европе и США.</p>
					<p>С момента основания компании мы подобрали более 9000 автомобилей, чётко следуя критериям клиентов. Доверьте нам поиск своего автомобиля — сэкономьте время, деньги и сохраните нервы.</p>
				</div>
				<div class="banner__advantages">
					<div class="banner__advantages-item">
						<div class="banner__advantages-title">Выгодный торг</div>
						<div class="banner__advantages-text _red">
							В 99% случаях оплата за услуги автоподбора окупается торгом с владельцем машины.
						</div>
					</div>
					<div class="banner__advantages-item">
						<div class="banner__advantages-title">Экономим ваше времЯ</div>
						<div class="banner__advantages-text">
							Проведём осмотр авто в течение нескольких часов после получения заявки.
						</div>
					</div>
				</div>
				<button class="btn banner__btn btn--accent btn--big" data-popup="popup-feedback">Оставить заявку</button>
			</div>
			<div class="banner__signature">
				<h3 class="banner__signature-title">АНДРЕЙ ЯРОВОЙ</h3>
				<div class="banner__signature-text">Генеральный директор ЯПОDБОР</div>
			</div>
		</div>
	</section>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/features', null, [
		'classes' => 'anim-elem'
	] ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/services', null, [
		'classes' => 'section--bg anim-elem'
	] ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/forms/contact', null, [
		'classes' => 'anim-elem'
	] ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/contacts', null, [
		'classes' => 'anim-elem'
	] ); ?>
</div>

<?php get_footer(); ?>
