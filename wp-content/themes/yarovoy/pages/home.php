<?php get_header(); /* TEMPLATE NAME: Главная */

$brands = get_brands();

?>

<div class="page-container container">
	<section class="section section--banner">
		<div class="banner anim-elem">
			<div class="banner__bg"><img class="banner__bg-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/banner/bg.png" width="1920" height="1104" alt="Профессиональный автоподбор под ключ"></div>
			<div class="banner__body">
				<div class="banner__info">
					<h1 class="banner__title">Профессиональный <br> автоподбор под ключ</h1>
					<ul class="banner__list">
						<li class="banner__list-item">Автоподбор и доставка по всей России</li>
						<li class="banner__list-item">Более 200 квалифицированных экспертов</li>
						<li class="banner__list-item">Работаем с любыми марками и бюджетами</li>
						<li class="banner__list-item">Реальная техническая и юридическая гарантия на год</li>
					</ul>
				</div>
				<div class="banner__benefits">
					<div class="banner__benefits-col">
						<div class="banner__benefits-col--body">
							<div class="banner__benefits-title">Бесплатная консультация автоэксперта</div>
							<div class="banner__benefits-desc">На консультации автоэксперт узнает о ваших предпочтениях, критериях, бюджете для подбора автомобиля и ответит на вопросы.</div>
							<div class="banner__benefits-nav">
								<a class="btn btn--accent btn--big banner__benefits-btn" data-popup="popup-feedback" aria-label="Open modal">Оставить заявку</a>
							</div>
						</div>
					</div>
					<div class="banner__benefits-col">
						<div class="banner__benefits-col--body">
							<div class="banner__benefits-title">Подбор авто под ключ </div>
							<div class="price">
								<div class="price__old">40 000 &#8381;</div>
								<div class="price__current">25 000 &#8381;</div>
							</div>
							<div class="banner__benefits-desc">После проверки автомобиля нашим специалистом вы можете убедиться в его юридической чистоте и технической исправности самостоятельно, скачав бесплатный отчёт.</div>
							<div class="banner__benefits-nav">
								<a class="btn btn--accent btn--big banner__benefits-btn" data-popup="popup-feedback" aria-label="Open modal">Оставить заявку</a>
							</div>
						</div>
					</div>
					<div class="banner__benefits-col">
						<div class="banner__benefits-col--body">
							<div class="banner__benefits-title">Эксперты по подбору автомобилей</div>
							<div class="banner__benefits-desc">В компании работает команда опытных экспертов-криминалистов, которые используют новое высокотехнологичное оборудование для подбора автомобилей по вашим предпочтениям.</div>
							<div class="banner__benefits-nav">
								<a href="/platform/catalog/" class="btn btn--accent btn--big banner__benefits-btn">Выбрать эксперта</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="banner__sale">
	<img src="<?= YAR_THEME_ASSETS; ?>/img/content/banner/October-_1_.webp" class="banner__sale-img" alt="">
</div>

<div class="page-container container">
	<section class="section anim-elem">
		<div class="section__head">
			<h2 class="section__title">Что входит в услугу автоподбор</h2>
		</div>
		<div class="infoblock">
			<div class="infoblock__columns">
				<div class="infoblock__columns-item">
					<p>Специалисты ЯПОDБОР подберут автомобиль по вашим пожеланиям и бюджету. В услугу включена техническая проверка всех узлов и агрегатов, компьютерная диагностика, а также обязательная криминалистическая проверка и проверка юридической чистоты.</p>
				</div>
				<div class="infoblock__columns-item">
					<p>Наши эксперты умеют договариваться о приобретении автомобиля на основании состояния и рыночной стоимости. Эксперты подберут для вас лучший автомобиль и будут полностью сопровождать сделку, включая составление Договора купли-продажи.</p>
				</div>
			</div>
			<div class="infoblock__img--wrap"><img class="infoblock__img" src="<?= YAR_THEME_ASSETS; ?>/img/content/infoblock/main-1.png" width="1380" height="824" alt="Что входит в услугу автоподбор"></div>
		</div>
	</section>
	<section class="section anim-elem">
		<div class="feedback">
			<h2 class="feedback__title">Выберите автомобиль, который вы хотели бы приобрести</h2>
			<p class="feedback__desc">Подберём юридически чистый и технически исправный автомобиль с учётом ваших предпочтений. <br /> При первом обращении дарим бесплатную консультацию и скидку 20% на подбор автомобиля под ключ!</p>
			<div class="form feedback__form">
				<div class="form__row">
					<?php if ( ! empty( $brands ) ) { ?>
						<div class="input">
							<select class="input__cell" name="mark" data-next-type="model" data-nonce="<?= wp_create_nonce( 'action_get_bmg' ); ?>">
								<option disabled="" selected="">Марка</option>
								<?php foreach ( $brands as $brand ) { ?>
									<option value="<?= $brand['id']; ?>"><?= $brand['title']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="input">
							<select class="input__cell" name="model" data-next-type="generation"  data-nonce="<?= wp_create_nonce( 'action_get_bmg' ); ?>">
								<option disabled="" selected="">Модель</option>
							</select>
						</div>
						<div class="input">
							<select class="input__cell" name="generation"  data-nonce="<?= wp_create_nonce( 'action_get_bmg' ); ?>">
								<option disabled="" selected="">Поколение</option>
							</select>
						</div>
					<?php } ?>
					<div class="input">
						<input class="input__cell" type="text" name="year" placeholder="Год">
					</div>
					<div class="input">
						<input class="input__cell" type="text" name="budget" placeholder="Бюджет">
					</div>
					<div class="input">
						<input class="input__cell" type="text" name="name" placeholder="Ваше имя">
					</div>
					<div class="input">
						<input class="input__cell" type="text" name="phone" placeholder="Телефон">
					</div>
					<div class="form__send">
						<?php wp_nonce_field( 'action_on_feedback' ); ?>
						<input type="hidden" name="page_url" value="<?= yar_get_current_url(); ?>">
						<button class="btn btn--accent btn--huge form__btn" type="submit" aria-label="Send form">Оставить заявку</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/about', null, [
		'classes' => 'anim-elem'
	] ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/features', null, [
		'classes' => 'anim-elem'
	] ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/how-works', null, [
		'classes' => 'anim-elem'
	] ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/cases', null, [
		'classes' => 'section--bg anim-elem _test'
	] ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/services', null, [
		'classes' => 'section--bg anim-elem'
	] ); ?>

    <?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/hot', null, [
        'classes' => 'anim-elem'
    ] ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/forms/contact', null, [
		'classes' => 'anim-elem'
	] ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/reviews', null, [
		'classes' => 'anim-elem'
	] ); ?>

	<section class="section anim-elem">
		<div class="faq">
			<div class="faq__list">
				<div class="faq__item">
					<button class="btn--reset faq__item-btn js-accordion" aria-expanded="false" aria-label="Toggle accordion">Чем полезен автоподбор?</button>
					<div class="faq__item-content--wrap">
						<div class="faq__item-content">
							<p>Если вы заинтересованы в широком выборе автомобилей на рынке, придётся приложить много времени и усилий, чтобы сделать правильный выбор. Однако, не всегда есть возможность самостоятельно заниматься такой долгой монотонной работой. В данном случае, сайт автоподбора может быть полезен: с его помощью найдётся профессионал, который проведет все необходимые процедуры. Квалифицированный эксперт ознакомится с состоянием машины, посоветует вам лучшие марки и производителей, а также предложит несколько подходящих вариантов. Вы всегда сохраняете право на выбор, но специалист поможет принять решение и ориентироваться на обширном рынке, учитывая местные правила. Если вас интересует автоподбор Москва, наша компания предлагает услуги опытных специалистов.</p>
							<p>Наши сотрудники проведут комплекс мероприятий, опираясь на ваши пожелания и требования. Они проводят детальное обсуждение с клиентами заранее, чтобы определить их интересы в автомобилях, моделях, марках, диапазоне цен и желаемом пробеге. Все характеристики будут изучены неоднократно, чтобы составить полный план, соответствующий критериям выбора.</p>
							<p>Автоподбор авто включает проверку документов владельца машины, изучение юридических нарушений в ходе эксплуатации, проведение внешнего осмотра и определение тюнингованных и отремонтированных деталей, проверку истории обслуживания автомобиля, систематизацию собранных данных и информирование клиента любым удобным способом.</p>
							<p>Мы заботимся о том, чтобы всё было выполнено быстро и правильно, с учетом пожеланий и требований клиента. Наши специалисты имеют большой опыт работы с автомобилями и помогут вам найти и проверить машину, полностью соответствующую вашим вкусам и предпочтениям. </p>
							<p>Стоимость услуги автоподбора в нашей фирме зависит от выбранного договора и сроков. Опытные профессионалы проверяют не только объявления в сети, но также дилерские базы, трейд-ин, закрытые сервисы, исследуя все доступные варианты, пока не будет найден наиболее подходящий автомобиль. Все проверки проводятся заранее с юридической точки зрения, чтобы убедиться в честности и законности сделки. Мы уделяем этому аспекту большое внимание, так как новичку-автолюбителю легко запутаться на обширном современном рынке автомобилей.</p>
							<p>Мы обладаем всеми необходимыми документами и лицензиями, с которыми можно легко ознакомиться на нашем сайте, или обратившись к оператору. У нас достаточно опыта в предоставлении данного вида услуг, что позволяет сделать процесс быстрым и не утомительным для потенциального покупателя.</p>
							<p>Покупка подержанного автомобиля всегда является сложным процессом, но его без труда можно сделать гораздо проще. Мы предлагаем автоподбор Мск по доступной цене, которая полностью окупает потенциальные издержки и помогает избежать дополнительных расходов. Сервис доступен в любой точке страны, достаточно позвонить по указанному телефону и оставить заявку.</p>
						</div>
					</div>
				</div>
				<div class="faq__item">
					<button class="btn--reset faq__item-btn js-accordion" aria-expanded="false" aria-label="Toggle accordion">Что делает эксперт?</button>
					<div class="faq__item-content--wrap">
						<div class="faq__item-content">
							<p>Автоэксперт — это услуга, которая предлагается компаниями по продаже автомобилей. Опытный специалист помогает потенциальным покупателям выбрать подходящий вариант среди огромного количества объявлений на сайтах. Покупка автомобиля требует времени, усилий и средств, поэтому важно обратить внимание на каждую деталь, чтобы избежать проблем и ненужных трат. В таких случаях полезно иметь рядом квалифицированного помощника, который сможет дать советы и провести проверку. Наши профессионалы уже долгое время осуществляют автоподбор в Москве под ключ.</p>
							<p>Особенность такого сотрудника заключается в том, что он помогает клиентам на вторичном рынке машин найти правильную покупку. Срок услуги может быть гибким и зависит только от пожеланий клиента. Если потенциальные варианты уже отобраны, эксперт может осмотреть и оценить автомобиль за сутки. При необходимости он даст рекомендации, изучит историю машины и предоставит структурированную информацию для удобства клиента. Автоэксперт уже опытен в этой сфере и сможет быстро определить, есть ли риск мошенничества со стороны продавца.</p>
							<p>Перед окончательным решением о покупке необходимо убедиться в правильном оформлении документов и провести тест-драйв. В этом поможет профессионал. Сайт автоподбора ЯПодбор познакомит с нашими лучшими работниками.</p>
							<p>Если вы сомневаетесь в своем опыте, хотите избежать переплаты и нечестных продавцов, или у вас просто нет времени на тщательный подбор автомобиля, то автоэксперт будет отличным выбором. Компания гарантирует качество работы и полностью учитывает требования клиента.</p>
						</div>
					</div>
				</div>
				<div class="faq__item">
					<button class="btn--reset faq__item-btn js-accordion" aria-expanded="false" aria-label="Toggle accordion">Как осматривают автомобили?</button>
					<div class="faq__item-content--wrap">
						<div class="faq__item-content">
							<p>Осмотр автомобиля перед покупкой - это процедура, включающая проверку транспортного средства на его безопасность, надежность и наличие потенциальных неисправностей перед покупкой. Онлайн-проверка может выявить скрытые повреждения, а личное участие профессионала поможет установить замаскированные неисправности и избежать неприятностей в будущем. Основная цель - обеспечить безопасность и комфорт клиента, а также предотвратить ненужные траты на ремонт или покупку другого транспортного средства. Заказ осмотра автомобиля рекомендуется, если есть опасения относительно недобросовестных продавцов или недостаточного опыта для определения скрытых неисправностей.</p>
						</div>
					</div>
				</div>
				<div class="faq__item">
					<button class="btn--reset faq__item-btn js-accordion" aria-expanded="false" aria-label="Toggle accordion">Цена услуги автоподбора</button>
					<div class="faq__item-content--wrap">
						<div class="faq__item-content">
							<p>В нашей компании стоимость начинается от тридцати тысяч рублей и включает все необходимые услуги. С клиентом заключается официальный договор, обсуждаются детали и интересующие аспекты. Такая цена автоподбора является выгодной, так как в девяносто девяти процентах случаев окупает торги и дополнительные расходы.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="faq__footer">
				<a href="#" class="btn btn--accent btn--huge btn--wide" aria-label="Open modal" data-popup="popup-feedback">Оставить заявку</a>
			</div>
		</div>
	</section>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/contacts' ); ?>
</div>

<?php get_footer(); ?>
