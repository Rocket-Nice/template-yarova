<footer class="footer">
      <div class="container footer__container">
        <div class="footer__panel"><a class="footer__logo" href="main.html"><img class="footer__logo-img" src="<?= get_template_directory_uri(); ?>/img/icons/logo.svg" width="268" height="55" alt="ЯПодбор"></a>
          <div class="commun footer__commun">
            <div class="commun__item commun__item--phone"><a class="commun__item-name" href="tel:+74951593920">+7 (495) 159-39-20</a>
              <button class="btn--reset commun__item-btn" aria-label="Open modal">Перезвоните мне</button>
            </div>
          </div>
          <div class="footer__panel-btns btns-spacer hide-sm-down"><a class="btn btn--accent footer__panel-btn" href="#!">Получить консультацию</a><a class="btn btn--border-light footer__panel-btn" href="#!">Выбрать эксперта</a></div>
        </div>
        <div class="footer__row">
          <div class="footer__nav">
            <ul class="footer__nav-list">
              <li class="footer__nav-item">
                <div class="footer__nav-item-title"><a class="footer__nav-link" href="services.html">Услуги</a>
                  <button class="btn btn--reset btn--chevron-down footer__nav-toggle" aria-label="Toggle submenu"></button>
                </div>
                <ul class="footer__nav-child-list">
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Разовый осмотр</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Подбор авто «Под ключ»</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Эксперт на день</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Доставка авто</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Выкуп автомобиля</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Доп услуги</a></li>
                </ul>
              </li>
              <li class="footer__nav-item">
                <div class="footer__nav-item-title"><a class="footer__nav-link" href="about-us.html">О компании</a>
                  <button class="btn btn--reset btn--chevron-down footer__nav-toggle" aria-label="Toggle submenu"></button>
                </div>
                <ul class="footer__nav-child-list">
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">О нас</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Блог</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Влог</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Портфолио</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Адреса и телефоны</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Онлайн оплата</a></li>
                </ul>
              </li>
              <li class="footer__nav-item">
                <div class="footer__nav-item-title"><a class="footer__nav-link" href="login.html">Личный кабинет</a>
                  <button class="btn btn--reset btn--chevron-down footer__nav-toggle" aria-label="Toggle submenu"></button>
                </div>
                <ul class="footer__nav-child-list">
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Личный кабинет клиента</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Регистрация для клиента</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Вход для специалиста</a></li>
                  <li class="footer__nav-child-item"><a class="footer__nav-child-link" href="#!">Договор купли-продажи авто</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="footer__social social"><a class="social__link social__link--wa" href="#wa" target="_blank" title="Go to What's App">What's App</a><a class="social__link social__link--tg" href="#tg" target="_blank" title="Go to Telegram">Telegram</a><a class="social__link social__link--vk" href="#vk" target="_blank" title="Go to VK">VK</a><a class="social__link social__link--tt" href="#tt" target="_blank" title="Go to TikTok">TikTok</a></div>
          <div class="footer__panel-btns btns-spacer hide-sm-only"><a class="btn btn--accent footer__panel-btn" href="#!">Получить консультацию</a><a class="btn btn--border-light footer__panel-btn" href="#!">Выбрать эксперта</a></div>
        </div>
        <div class="footer__copy">
          <div class="footer__copy-text">2024 © ЯПОDБОР Все права защищены</div>
          <div class="footer__copy-desc"><a href="#!" target="_blank">Политика конфиденциальности</a><a href="#!" target="_blank">Публичная оферта</a></div>
          <div class="footer__copy-desc">
            <p>ИП Яровой Сергей Анатольевич <br /> OГРНИП: 321631300065010</p>
          </div>
        </div>
      </div>
    </footer>
    <script src="<?= get_template_directory_uri(); ?>/libs/swiper/swiper-bundle.min.js"></script>
    <script src="<?= get_template_directory_uri(); ?>/scripts/main.js"></script>
    <?php wp_footer(); ?>
  </body>
</html>