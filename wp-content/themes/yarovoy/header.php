<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="apple-touch-icon" sizes="57x57" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"
		  href="<?= YAR_THEME_ASSETS; ?>/img/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?= YAR_THEME_ASSETS; ?>/img/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#fff">
	<meta name="msapplication-TileImage" content="<?= YAR_THEME_ASSETS; ?>/img/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#4E3D7D">
	<title>Главная | YAPODBOR</title>

	<?php //TODO: Не забыть вернуть ?>
	<!---<meta name="yandex-verification" content="096c028b0808fd65" />
	<script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k,
                a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(93889419, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
	</script>
	<noscript>
		<div><img src="https://mc.yandex.ru/watch/93889419" style="position:absolute; left:-9999px;" alt="" /></div>
	</noscript>

	<script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8" defer></script>-->

	<?php wp_head(); ?>
</head>

<?php

$classes = isset( $args['classes'] ) ? $args['classes'] : '';

?>

<body <?php body_class( $classes ); ?>>
<header class="header anim-elem">
	<div class="container header__container">
		<div class="header__row">
			<button class="btn btn--reset btn--burger header__burger" aria-label="Open menu"></button>
			<a class="header__logo" href="/">
				<img class="header__logo-img" src="<?= YAR_THEME_ASSETS; ?>/img/icons/logo.svg" width="268" height="55" alt="ЯПодбор">
			</a>
			<div class="header__panel">
				<div class="commun header__commun">
					<div class="commun__item commun__item--phone">
						<a class="commun__item-name" href="tel:+74951593920">+7 (495) 159-39-20</a>
						<button class="btn--reset commun__item-btn" data-popup="popup-feedback" aria-label="Open modal">
							Перезвоните мне
						</button>
					</div>
				</div>
				<?php get_template_part( YAR_THEME_TEMPLATES . '/socials', null, [
					'classes' => 'header__social'
				] ); ?>
				<?php if ( is_user_logged_in() ){ ?>
					<div class="header__user">
						<div class="header__user-info">
							<?php

							$user_prefix = 'user_' . get_current_user_id();
							$last_name   = get_field( 'last_name', $user_prefix );
							$first_name  = get_field( 'first_name', $user_prefix );
							$phone       = get_field( 'phone', $user_prefix );

							?>

							<div class="header__user-fio"><?= $last_name; ?> <?= $first_name; ?></div>
							<div class="header__user-phone"><?= yar_format_phone( $phone ); ?></div>
							<div class="header__user-actions">
								<a href="/profile/" class="header__user-link">Перейти</a>
								<a href="<?= wp_logout_url( '/login' ); ?>" class="header__user-link">Выход</a>
							</div>
						</div>
						<a href="/profile/" class="header__user-icon">
							<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M23.781 10.0742C23.513 13.6884 20.7732 16.6367 17.7654 16.6367C14.7576 16.6367 12.0129 13.6891 11.7498 10.0742C11.4763 6.31445 14.1423 3.51172 17.7654 3.51172C21.3884 3.51172 24.0544 6.38281 23.781 10.0742Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M17.7658 21.0117C11.8185 21.0117 5.78239 24.293 4.6654 30.4863C4.53073 31.2328 4.95319 31.9492 5.73454 31.9492H29.797C30.5791 31.9492 31.0015 31.2328 30.8669 30.4863C29.7492 24.293 23.7131 21.0117 17.7658 21.0117Z" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
							</svg>
						</a>
					</div>
				<?php } else { ?>
					<a class="header__user" href="<?= ( is_user_logged_in() ? '/profile/' : '/login/' ); ?>">
						<span class="header__user-login">Войти в личный кабинет клиента</span>
						<span class="header__user-icon">
							<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M23.781 10.0742C23.513 13.6884 20.7732 16.6367 17.7654 16.6367C14.7576 16.6367 12.0129 13.6891 11.7498 10.0742C11.4763 6.31445 14.1423 3.51172 17.7654 3.51172C21.3884 3.51172 24.0544 6.38281 23.781 10.0742Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M17.7658 21.0117C11.8185 21.0117 5.78239 24.293 4.6654 30.4863C4.53073 31.2328 4.95319 31.9492 5.73454 31.9492H29.797C30.5791 31.9492 31.0015 31.2328 30.8669 30.4863C29.7492 24.293 23.7131 21.0117 17.7658 21.0117Z" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
							</svg>
						</span>
					</a>
				<?php } ?>
			</div>
		</div>
		<div class="header__menu">
			<nav class="header__nav">
				<?php
					wp_nav_menu( [
						'theme_location' => 'main',
						'container'      => '',
						'depth'          => 0,
						'menu_class'     => 'header__nav-list menu',
						'menu_bem_class' => 'header__nav'
					] );
				?>
			</nav>
			<div class="header__menu-hidden">
				<a class="header__user" href="<?= ( is_user_logged_in() ? '/profile/' : '/login/' ); ?>">
					<span class="header__user-login">Войти в личный кабинет клиента</span>
					<span class="header__user-icon">
						<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M23.781 10.0742C23.513 13.6884 20.7732 16.6367 17.7654 16.6367C14.7576 16.6367 12.0129 13.6891 11.7498 10.0742C11.4763 6.31445 14.1423 3.51172 17.7654 3.51172C21.3884 3.51172 24.0544 6.38281 23.781 10.0742Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M17.7658 21.0117C11.8185 21.0117 5.78239 24.293 4.6654 30.4863C4.53073 31.2328 4.95319 31.9492 5.73454 31.9492H29.797C30.5791 31.9492 31.0015 31.2328 30.8669 30.4863C29.7492 24.293 23.7131 21.0117 17.7658 21.0117Z" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
						</svg>
					</span>
				</a>
				<?php get_template_part( YAR_THEME_TEMPLATES . '/socials', null, [
					'classes' => 'header__social'
				] ); ?>
			</div>
			<div class="header__menu-btns btns-spacer">
				<a class="btn header__menu-btn" href="/platform/catalog/">Выбрать эксперта</a>
				<button data-popup="popup-feedback" class="btn btn--accent header__menu-btn">Получить консультацию</button>
			</div>
		</div>
		<div class="header__overlay"></div>
	</div>
</header>