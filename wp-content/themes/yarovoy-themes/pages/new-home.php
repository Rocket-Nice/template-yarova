<?php get_header(); /* TEMPLATE NAME: Главная новая */

$brands = get_brands();

?>

<div class="page-container container">
	<section class="section section--banner">
		<div class="banner anim-elem">
			<div class="banner__bg"><img class="banner__bg-img banner__bg-img--height-full" src="<?= YAR_THEME_ASSETS; ?>/img/content/banner/new-bg.png" width="1920" height="1104" alt="Профессиональный автоподбор под ключ"></div>
			<div class="banner__body">
				<div class="banner__info">
					<h1 class="banner__title clamp-resize-h1">Профессиональный <br> автоподбор под ключ</h1>
					<ul class="banner__list-info">
						<li class="banner__list-info-item">
							<div class="banner__list-info-content">Опыт работы более 10 лет</div>
						</li>
						<li class="banner__list-info-item">
							<div class="banner__list-info-content">Предоставление полного отчета</div>
						</li>
						<li class="banner__list-info-item">
							<div class="banner__list-info-content">Более 100 пунктов проверки</div>
						</li>
						<li class="banner__list-info-item">
							<div class="banner__list-info-content">Техническая и юридическая гарантия на год</div>
						</li>
						<li class="banner__list-info-item">
							<div class="banner__list-info-content">Более 200 квалифицированных экспертов</div>
						</li>
						<li class="banner__list-info-item">
							<div class="banner__list-info-content">Работаем с любыми марками и бюджетами</div>
						</li>
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
							<?php
							$price = get_field('price', 502);

							if ($price) {
								$formatted_price = number_format($price, 0, '', ' ');
							?>
								<div class="price">
									<div class="price__current"><?php echo $formatted_price; ?> &#8381;</div>
								</div>
							<?php
							} else {
								echo '<div class="price"><div class="price__current">Цена не указана</div></div>';
							}
							?>
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
	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/about-new', null, [
		'classes' => 'anim-elem'
	]); ?>
</div>

<div class="page-container container">
	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/services', null, [
		'classes' => 'section--bg anim-elem'
	]); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/review-rec-list', null, [
		'classes' => 'anim-elem reviev-rec-list'
	]); ?>
</div>

<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/you-get', null, [
	'classes' => 'anim-elem you-get margin-unset'
]); ?>

<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/difficulties', null, [
	'classes' => 'anim-elem difficulties margin-unset'
]); ?>

<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/get-checklist', null, [
	'classes' => 'anim-elem get-checklist',
	'title' => 'Получите чек-лист бесплатно',
	'subtitle' => 'Подробная инструкция по подбору авто с пробегом',
	'description' => 'нажмите на кнопку и забирайте чек лист в нашем телеграм канале в закрепленных сообщениях',
	'button_text' => 'Получить чек-лист',
	'button_link' => 'https://t.me/yarovoycompany',
]); ?>

<div class="page-container container">
	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/yandex-reviews'); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/reviews', null, [
		'classes' => 'anim-elem'
	]); ?>
</div>

<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/form-feedback', null, [
	'classes' => 'anim-elem get-checklist',
	'title' => 'Свяжитесь с нами',
	'subtitle' => 'Мы перезвоним и ответим на все ваши вопросы',
	'background_image' => YAR_THEME_ASSETS . '/img/content/form/form-feedback.png'
]); ?>

<div class="page-container container">
	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/cases', null, [
		'classes' => 'section--bg anim-elem _test'
	]); ?>
</div>

<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/how-work', null, [
	'classes' => 'anim-elem how-work margin-unset'
]); ?>

<div class="page-container container">
	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/hot', null, [
		'classes' => 'anim-elem'
	]); ?>
</div>

<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/get-checklist', null, [
	'classes' => 'anim-elem get-checklist',
	'title' => 'База проверенных автомобилей',
	'subtitle' => 'Надежный каталог автомобилей, которые прошли тщательную проверку на юридическую чистоту и техническую исправность',
	'description' => 'Это идеальное решение для тех, кто ценит свое время и хочет приобрести надежный автомобиль без лишних хлопот',
	'button_text' => 'Смотреть всю базу авто',
	'button_link' => '/catalog/',
	'background_image' => YAR_THEME_ASSETS . '/img/content/checklist/base-auto.png'
]); ?>

<div class="page-container container">
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
</div>

<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/form-feedback', null, [
	'classes' => 'anim-elem get-checklist',
	'title' => 'Остались вопросы?',
	'subtitle' => 'Мы перезвоним и ответим на все ваши вопросы',
	'background_image' => YAR_THEME_ASSETS . '/img/content/form/any-questions.png'
]); ?>

<div class="page-container container">
	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/contacts', null, [
		'classes' => 'anim-elem margin-unset',
	]); ?>
</div>
<?php get_footer(); ?>