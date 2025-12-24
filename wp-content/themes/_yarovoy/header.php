<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="apple-touch-icon" sizes="57x57" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= get_template_directory_uri(); ?>/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri(); ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= get_template_directory_uri(); ?>/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri(); ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= get_template_directory_uri(); ?>/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="msapplication-TileImage" content="<?= get_template_directory_uri(); ?>/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#4E3D7D">
    <title>Главная | YAPODBOR</title>
    <link href="<?= get_template_directory_uri(); ?>/libs/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= get_template_directory_uri(); ?>/styles/main.css" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body <?= body_class(); ?>>
    <header class="header anim-elem">
      <div class="container header__container">
        <div class="header__row">
          <button class="btn btn--reset btn--burger header__burger" aria-label="Open menu"></button><a class="header__logo" href="/"><img class="header__logo-img" src="<?= get_template_directory_uri(); ?>/img/icons/logo.svg" width="268" height="55" alt="ЯПодбор"></a>
          <div class="header__panel">
            <div class="commun header__commun">
              <div class="commun__item commun__item--phone"><a class="commun__item-name" href="tel:+74951593920">+7 (495) 159-39-20</a>
                <button class="btn--reset commun__item-btn" aria-label="Open modal">Перезвоните мне</button>
              </div>
            </div>
            <div class="social header__social"><a class="social__link social__link--vk" href="#vk" target="_blank" title="Go to VK"></a><a class="social__link social__link--tg" href="#tg" target="_blank" title="Go to Telegram"></a><a class="social__link social__link--wa" href="#wa" target="_blank" title="Go to What's App"></a></div><a class="header__user" href="#!">Войти в личный кабинет клиента</a>
          </div>
        </div>
        <div class="header__menu">
          <nav class="header__nav">
            <ul class="header__nav-list">
              <li class="header__nav-item"><a class="header__nav-link" href="/about">О компании</a></li>
              <li class="header__nav-item"><a class="header__nav-link" href="/services">Услуги</a></li>
              <li class="header__nav-item"><a class="header__nav-link" href="/projects">Наши работы</a></li>
              <li class="header__nav-item"><a class="header__nav-link" href="/contacts">Контакты</a></li>
              <li class="header__nav-item is-hot"><a class="header__nav-link" href="#">База проверенных автомобилей</a></li>
            </ul>
          </nav>
          <div class="header__menu-hidden"><a class="header__user" href="#!">Войти в личный кабинет клиента</a>
            <div class="social header__social"><a class="social__link social__link--vk" href="#vk" target="_blank" title="Go to VK"></a><a class="social__link social__link--tg" href="#tg" target="_blank" title="Go to Telegram"></a><a class="social__link social__link--wa" href="#wa" target="_blank" title="Go to What's App"></a></div>
          </div>
          <div class="header__menu-btns btns-spacer"><a class="btn header__menu-btn" href="/platform-catalog">Выбрать эксперта</a><a class="btn btn--accent header__menu-btn" href="#!">Получить консультацию</a></div>
        </div>
        <div class="header__overlay"></div>
      </div>
    </header>