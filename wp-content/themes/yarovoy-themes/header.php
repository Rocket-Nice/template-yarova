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

	<?php //TODO: Не забыть вернуть 
	?>
	<meta name="yandex-verification" content="096c028b0808fd65" />
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

	<script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8" defer></script>
	<?php wp_head(); ?>
</head>

<?php

$classes = isset($args['classes']) ? $args['classes'] : '';
$header_class = 'header anim-elem';

if (isset($args['header_class'])) {
	$header_class .= ' ' . esc_attr($args['header_class']);
}
?>

<body <?php body_class($classes); ?>>
	<header class="<?php echo $header_class; ?>">
		<div class="container header__container">
			<div class="header__row">
				<div class="header__logo-burger">
					<button class="btn btn--reset btn--burger header__burger burger-desk" aria-label="Open menu"></button>
					<a class="header__logo" href="/">
						<img class="header__logo-img header__logo-desk" src="<?= YAR_THEME_ASSETS; ?>/img/icons/logo.svg" width="268" height="55" alt="ЯПодбор">
						<img class="header__logo-img header__logo-mob" src="<?= YAR_THEME_ASSETS; ?>/img/icons/logo-mob.svg" width="98" height="13.09" alt="ЯПодбор">
					</a>
				</div>

				<div class="commun header__commun header__commun--mob">
					<div class="commun__item commun__item--phone">
						<a class="commun__item-name" href="tel:+74951593920">+7 (495) 159-39-20</a>
						<button class="btn--reset commun__item-btn" data-popup="popup-feedback" aria-label="Open modal">
							Перезвоните мне
						</button>
					</div>
					<button class="btn btn--reset btn--burger header__burger burger-mob" aria-label="Open menu"></button>
				</div>
			</div>
			<div class="header__menu">
				<a class="header__logo header__logo--first" href="/">
					<img class="header__logo-img" src="<?= YAR_THEME_ASSETS; ?>/img/icons/logo-new.svg" width="163" height="21.77" alt="ЯПодбор">
				</a>
				<nav class="header__nav header__nav--desk">
					<?php
					wp_nav_menu([
						'theme_location' => 'main',
						'container'      => '',
						'depth'          => 0,
						'menu_class'     => 'header__nav-list menu',
						'menu_bem_class' => 'header__nav'
					]);
					?>
				</nav>
				<nav class="header__nav header__nav--mob">
					<?php
					wp_nav_menu([
						'menu'           => 'header_menu_mob',
						'container'      => '',
						'depth'          => 0,
						'menu_class'     => 'header__nav-list menu',
						'menu_bem_class' => 'header__nav'
					]);
					?>
				</nav>
				<div class="commun header__commun header__commun--desk">
					<div class="commun__item--phone">
						<a class="commun__item-name" href="tel:+74951593920">+7 (495) 159-39-20</a>
					</div>
				</div>
				<div class="header__menu-hidden">
					<a class="header__user" href="<?= (is_user_logged_in() ? '/profile/' : '/login/'); ?>">
						<span class="header__user-icon">
							<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="44" height="44" rx="8" fill="#252525" />
								<path d="M22 22C20.7167 22 19.618 21.5431 18.7042 20.6292C17.7903 19.7153 17.3333 18.6167 17.3333 17.3333C17.3333 16.05 17.7903 14.9514 18.7042 14.0375C19.618 13.1236 20.7167 12.6667 22 12.6667C23.2833 12.6667 24.3819 13.1236 25.2958 14.0375C26.2097 14.9514 26.6667 16.05 26.6667 17.3333C26.6667 18.6167 26.2097 19.7153 25.2958 20.6292C24.3819 21.5431 23.2833 22 22 22ZM12.6667 31.3333V28.0667C12.6667 27.4056 12.8368 26.7979 13.1771 26.2437C13.5174 25.6896 13.9694 25.2667 14.5333 24.975C15.7389 24.3722 16.9639 23.9201 18.2083 23.6187C19.4528 23.3174 20.7167 23.1667 22 23.1667C23.2833 23.1667 24.5472 23.3174 25.7917 23.6187C27.0361 23.9201 28.2611 24.3722 29.4667 24.975C30.0305 25.2667 30.4826 25.6896 30.8229 26.2437C31.1632 26.7979 31.3333 27.4056 31.3333 28.0667V31.3333H12.6667ZM15 29H29V28.0667C29 27.8528 28.9465 27.6583 28.8396 27.4833C28.7326 27.3083 28.5917 27.1722 28.4167 27.075C27.3667 26.55 26.3069 26.1562 25.2375 25.8937C24.168 25.6312 23.0889 25.5 22 25.5C20.9111 25.5 19.8319 25.6312 18.7625 25.8937C17.693 26.1562 16.6333 26.55 15.5833 27.075C15.4083 27.1722 15.2674 27.3083 15.1604 27.4833C15.0535 27.6583 15 27.8528 15 28.0667V29ZM22 19.6667C22.6417 19.6667 23.191 19.4382 23.6479 18.9812C24.1048 18.5243 24.3333 17.975 24.3333 17.3333C24.3333 16.6917 24.1048 16.1424 23.6479 15.6854C23.191 15.2285 22.6417 15 22 15C21.3583 15 20.809 15.2285 20.3521 15.6854C19.8951 16.1424 19.6667 16.6917 19.6667 17.3333C19.6667 17.975 19.8951 18.5243 20.3521 18.9812C20.809 19.4382 21.3583 19.6667 22 19.6667Z" fill="white" />
							</svg>

						</span>
					</a>
					<?php get_template_part(YAR_THEME_TEMPLATES . '/socials', null, [
						'classes' => 'header__social'
					]); ?>
				</div>
				<div class="header__menu-btns btns-spacer">
					<button data-popup="popup-feedback" class="btn btn--accent header__menu-btn header__menu-btn--desk">Перезвоните мне</button>
					<button data-popup="popup-feedback" class="btn btn--accent header__menu-btn header__menu-btn--mob">Получить консультацию</button>
					<a class="btn btn--accent header__menu-btn header__menu-btn-expert" href="/platform/catalog/">Выбрать эксперта</a>
					<div class="header__panel">

						<?php if (is_user_logged_in()) { ?>
							<div class="header__user">
								<div class="header__user-info">
									<?php

									$user_prefix = 'user_' . get_current_user_id();
									$last_name   = get_field('last_name', $user_prefix);
									$first_name  = get_field('first_name', $user_prefix);
									$phone       = get_field('phone', $user_prefix);

									?>

									<div class="header__user-fio"><?= $last_name; ?> <?= $first_name; ?></div>
									<div class="header__user-phone"><?= yar_format_phone($phone); ?></div>
									<div class="header__user-actions">
										<a href="/profile/" class="header__user-link">Перейти</a>
										<a href="<?= wp_logout_url('/login'); ?>" class="header__user-link">Выход</a>
									</div>
								</div>
								<a href="/profile/" class="header__user-icon">
									<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect width="44" height="44" rx="8" fill="#252525" />
										<path d="M22 22C20.7167 22 19.618 21.5431 18.7042 20.6292C17.7903 19.7153 17.3333 18.6167 17.3333 17.3333C17.3333 16.05 17.7903 14.9514 18.7042 14.0375C19.618 13.1236 20.7167 12.6667 22 12.6667C23.2833 12.6667 24.3819 13.1236 25.2958 14.0375C26.2097 14.9514 26.6667 16.05 26.6667 17.3333C26.6667 18.6167 26.2097 19.7153 25.2958 20.6292C24.3819 21.5431 23.2833 22 22 22ZM12.6667 31.3333V28.0667C12.6667 27.4056 12.8368 26.7979 13.1771 26.2437C13.5174 25.6896 13.9694 25.2667 14.5333 24.975C15.7389 24.3722 16.9639 23.9201 18.2083 23.6187C19.4528 23.3174 20.7167 23.1667 22 23.1667C23.2833 23.1667 24.5472 23.3174 25.7917 23.6187C27.0361 23.9201 28.2611 24.3722 29.4667 24.975C30.0305 25.2667 30.4826 25.6896 30.8229 26.2437C31.1632 26.7979 31.3333 27.4056 31.3333 28.0667V31.3333H12.6667ZM15 29H29V28.0667C29 27.8528 28.9465 27.6583 28.8396 27.4833C28.7326 27.3083 28.5917 27.1722 28.4167 27.075C27.3667 26.55 26.3069 26.1562 25.2375 25.8937C24.168 25.6312 23.0889 25.5 22 25.5C20.9111 25.5 19.8319 25.6312 18.7625 25.8937C17.693 26.1562 16.6333 26.55 15.5833 27.075C15.4083 27.1722 15.2674 27.3083 15.1604 27.4833C15.0535 27.6583 15 27.8528 15 28.0667V29ZM22 19.6667C22.6417 19.6667 23.191 19.4382 23.6479 18.9812C24.1048 18.5243 24.3333 17.975 24.3333 17.3333C24.3333 16.6917 24.1048 16.1424 23.6479 15.6854C23.191 15.2285 22.6417 15 22 15C21.3583 15 20.809 15.2285 20.3521 15.6854C19.8951 16.1424 19.6667 16.6917 19.6667 17.3333C19.6667 17.975 19.8951 18.5243 20.3521 18.9812C20.809 19.4382 21.3583 19.6667 22 19.6667Z" fill="white" />
									</svg>

								</a>
							</div>
						<?php } else { ?>
							<a class="header__user" href="<?= (is_user_logged_in() ? '/profile/' : '/login/'); ?>">
								<span class="header__user-icon">
									<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect width="44" height="44" rx="8" fill="#252525" />
										<path d="M22 22C20.7167 22 19.618 21.5431 18.7042 20.6292C17.7903 19.7153 17.3333 18.6167 17.3333 17.3333C17.3333 16.05 17.7903 14.9514 18.7042 14.0375C19.618 13.1236 20.7167 12.6667 22 12.6667C23.2833 12.6667 24.3819 13.1236 25.2958 14.0375C26.2097 14.9514 26.6667 16.05 26.6667 17.3333C26.6667 18.6167 26.2097 19.7153 25.2958 20.6292C24.3819 21.5431 23.2833 22 22 22ZM12.6667 31.3333V28.0667C12.6667 27.4056 12.8368 26.7979 13.1771 26.2437C13.5174 25.6896 13.9694 25.2667 14.5333 24.975C15.7389 24.3722 16.9639 23.9201 18.2083 23.6187C19.4528 23.3174 20.7167 23.1667 22 23.1667C23.2833 23.1667 24.5472 23.3174 25.7917 23.6187C27.0361 23.9201 28.2611 24.3722 29.4667 24.975C30.0305 25.2667 30.4826 25.6896 30.8229 26.2437C31.1632 26.7979 31.3333 27.4056 31.3333 28.0667V31.3333H12.6667ZM15 29H29V28.0667C29 27.8528 28.9465 27.6583 28.8396 27.4833C28.7326 27.3083 28.5917 27.1722 28.4167 27.075C27.3667 26.55 26.3069 26.1562 25.2375 25.8937C24.168 25.6312 23.0889 25.5 22 25.5C20.9111 25.5 19.8319 25.6312 18.7625 25.8937C17.693 26.1562 16.6333 26.55 15.5833 27.075C15.4083 27.1722 15.2674 27.3083 15.1604 27.4833C15.0535 27.6583 15 27.8528 15 28.0667V29ZM22 19.6667C22.6417 19.6667 23.191 19.4382 23.6479 18.9812C24.1048 18.5243 24.3333 17.975 24.3333 17.3333C24.3333 16.6917 24.1048 16.1424 23.6479 15.6854C23.191 15.2285 22.6417 15 22 15C21.3583 15 20.809 15.2285 20.3521 15.6854C19.8951 16.1424 19.6667 16.6917 19.6667 17.3333C19.6667 17.975 19.8951 18.5243 20.3521 18.9812C20.809 19.4382 21.3583 19.6667 22 19.6667Z" fill="white" />
									</svg>

								</span>
							</a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="header__social--position">
				<?php get_template_part(YAR_THEME_TEMPLATES . '/socials', null, [
					'classes' => 'header__social'
				]); ?>
			</div>
			<div class="header__overlay"></div>
		</div>
	</header>