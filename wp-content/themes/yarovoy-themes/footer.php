<?php get_template_part(YAR_THEME_TEMPLATES . '/socials', null, [
	'classes'    => 'footer__social fixed-social',
	'with_title' => false
]); ?>

<footer class="footer">
	<div class="container footer__container">
		<div class="footer__panel">
			<a class="footer__logo" href="/">
				<img class="footer__logo-img" src="<?= YAR_THEME_ASSETS; ?>/img/icons/logo-new-footer.svg" width="163" height="21.77" alt="ЯПодбор">
			</a>
			<div class="commun footer__commun">
				<div class="commun__item commun__item--phone">
					<a class="commun__item-name" href="tel:+74951593920">+7 (495) 159-39-20</a>
				</div>
			</div>
			<div class="footer__panel-btns btns-spacer hide-sm-down">
				<button class="btn btn--border-light footer__panel-btn" aria-label="Open modal" data-popup="popup-feedback">Перезвоните мне</button>
				<a class="btn btn--accent footer__panel-btn" href="#!" data-popup="popup-feedback">Получить консультацию</a>
				<a class="btn btn--border-light footer__panel-btn" href="/platform/catalog/">Выбрать эксперта</a>
			</div>
		</div>
		<div class="footer__row">
			<div class="footer__nav">
				<ul class="footer__nav-list">
					<li class="footer__nav-item">
						<div class="footer__nav-item-title">
							<a class="footer__nav-link" href="/service">Услуги</a>
							<button class="btn btn--reset btn--chevron-down footer__nav-toggle" aria-label="Toggle submenu"></button>
						</div>
						<?php
						wp_nav_menu([
							'theme_location' => 'footer_services',
							'container'      => '',
							'depth'          => 0,
							'menu_class'     => 'footer__nav-child-list',
							'menu_bem_class' => 'footer__nav-child'
						]);
						?>
					</li>
					<li class="footer__nav-item">
						<div class="footer__nav-item-title">
							<a class="footer__nav-link" href="/about">О компании</a>
							<button class="btn btn--reset btn--chevron-down footer__nav-toggle" aria-label="Toggle submenu"></button>
						</div>
						<?php
						wp_nav_menu([
							'theme_location' => 'footer_about',
							'container'      => '',
							'depth'          => 0,
							'menu_class'     => 'footer__nav-child-list',
							'menu_bem_class' => 'footer__nav-child'
						]);
						?>
					</li>
					<li class="footer_nav-item">
						<ul class="footer__nav-list footer__nav-list--second">
							<li class="footer__nav-item">
								<div class="footer__nav-item-title">
									<a class="footer__nav-link" href="#">Личный кабинет</a>
									<button class="btn btn--reset btn--chevron-down footer__nav-toggle" aria-label="Toggle submenu"></button>
								</div>
								<!-- <ul class="footer__nav-child-list">
									<li class="footer__nav-child-item">
										<a class="footer__nav-child-link" href="<?= (is_user_logged_in() ? '/profile/' : '/login/'); ?>">Личный кабинет клиента</a>
									</li>
									<li class="footer__nav-child-item">
										<a class="footer__nav-child-link" href="<?= (is_user_logged_in() ? '/profile/' : '/register/'); ?>">Регистрация для клиента</a>
									</li>
									<li class="footer__nav-child-item">
										<a class="footer__nav-child-link" href="<?= (is_user_logged_in() ? '/profile/' : '/login/'); ?>">Вход для специалиста</a>
									</li>
								</ul> -->
								<?php
								wp_nav_menu([
									'theme_location' => 'footer_lk',
									'container'      => '',
									'depth'          => 0,
									'menu_class'     => 'footer__nav-child-list',
									'menu_bem_class' => 'footer__nav-child'
								]);
								?>
							</li>
							<li class="footer__nav-item">
								<div class="footer__nav-item-title">
									<a class="footer__nav-link" href="#!">Дополнительно</a>
									<button class="btn btn--reset btn--chevron-down footer__nav-toggle" aria-label="Toggle submenu"></button>
								</div>
								<?php
								wp_nav_menu([
									'theme_location' => 'footer_dop',
									'container'      => '',
									'depth'          => 0,
									'menu_class'     => 'footer__nav-child-list',
									'menu_bem_class' => 'footer__nav-child'
								]);
								?>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<?php get_template_part(YAR_THEME_TEMPLATES . '/socials', null, [
				'classes'     => 'footer__social',
				'with_title'  => true,
				'with_tiktok' => true
			]); ?>
		</div>
		<div class="footer__copy">
			<div class="footer__copy-text"><?= date('Y'); ?> © ЯПОDБОР Все права защищены</div>
			<div class="footer__copy-desc">
				<a href="<?= get_the_permalink(3); ?>" target="_blank">Политика конфиденциальности</a>
				<a href="<?= get_the_permalink(477); ?>" target="_blank">Публичная оферта</a>
			</div>
			<div class="footer__copy-desc">
				<p>ИП Яровой Сергей Анатольевич <br /> OГРНИП: 321631300065010</p>
			</div>
		</div>
	</div>
</footer>

<?php //TODO: Не забыть вернуть 
?>
<!-- calltouch -->
<script>
	(function(w, d, n, c) {
		w.CalltouchDataObject = n;
		w[n] = function() {
			w[n]["callbacks"].push(arguments)
		};
		if (!w[n]["callbacks"]) {
			w[n]["callbacks"] = []
		}
		w[n]["loaded"] = false;
		if (typeof c !== "object") {
			c = [c]
		}
		w[n]["counters"] = c;
		for (var i = 0; i < c.length; i += 1) {
			p(c[i])
		}

		function p(cId) {
			var a = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				i = function() {
					a.parentNode.insertBefore(s, a)
				},
				m = typeof Array.prototype.find === 'function',
				n = m ? "init-min.js" : "init.js";
			s.async = true;
			s.src = "https://mod.calltouch.ru/" + n + "?id=" + cId;
			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", i, false)
			} else {
				i()
			}
		}
	})(window, document, "ct", "w2a9o34e");
</script>
<!-- calltouch -->

<?php get_template_part(YAR_THEME_TEMPLATES . '/modals/feedback'); ?>

<?php wp_footer(); ?>
</body>

</html>