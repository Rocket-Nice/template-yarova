<?php get_header(null, ['classes' => 'body-landing']); /*

* Template Name: Новая услуга
* Template Post Type: service

*/ ?>

<div class="page-container container">
  <section class="land-section" id="section-banner">
    <div class="land-banner">
      <div class="land-banner__info">
        <h1 class="land-banner__title"><?= esc_html(the_title()); ?></h1>
        <div class="land-banner__desc"><?= esc_html(strip_tags(get_field("new_single_description"))); ?></div>
        <div class="land-banner__btns btns-spacer">
          <button class="btn l-btn btn--accent" data-modal="modal-feedback-order" aria-label="Open modal">Заказать автомобиль</button>
          <button class="btn l-btn btn--border-light" data-modal="modal-feedback-cons" aria-label="Open modal">Бесплатная консультация</button>
        </div>
      </div>
      <div class="land-banner__img--wrap"><img class="land-banner__img" src="<?= esc_url(get_field("new_image")); ?>" width="1920" height="860" alt="Bg banner"></div>
    </div>
  </section>
  <section class="land-section" id="section-features">
    <div class="land-features">
      <div class="land-features__col">
        <div class="land-features__content">
          <h2 class="land-features__title">При заказе автомобиля в&nbsp;Яподбор Вы получаете:</h2>
          <div class="land-features__acc">
            <button class="btn btn--reset land-features__btn js-acc" aria-expanded="false" aria-label="Toggle acc"><span>Подробнее</span><i> </i></button>
            <div class="land-features__desc"><?= get_field("order_bonus_desk"); ?></div>
          </div>
        </div>
      </div>
      <div class="land-features__col">
        <div class="land-features__list">
          <?php
          foreach (get_field("order_bonus_list") as $key):
          ?>
            <div class="land-features__list-item">
              <div class="land-features__list-name"><?= $key["bonus"]; ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
  <section class="land-section" id="section-benefits">
    <div class="land-benefits anim-elem">
      <div class="land-benefits__row">
        <div class="land-benefits__card">
          <div class="land-benefits__card-body">
            <div class="land-benefits__card-img--wrap"><img class="land-benefits__card-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/benefits/cards/card_0.svg" width="85" height="85" alt="Title card 0"></div>
            <div class="land-benefits__card-title">Профессионально проверяем автомобиль перед покупкой, гарантия лучшей цены</div>
          </div>
        </div>
        <div class="land-benefits__card">
          <div class="land-benefits__card-body">
            <div class="land-benefits__card-img--wrap"><img class="land-benefits__card-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/benefits/cards/card_1.svg" width="85" height="85" alt="Title card 1"></div>
            <div class="land-benefits__card-title">Фото и&nbsp;видео отчеты на&nbsp;всех этапах сопровождения</div>
          </div>
        </div>
        <div class="land-benefits__card">
          <div class="land-benefits__card-body">
            <div class="land-benefits__card-img--wrap"><img class="land-benefits__card-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/benefits/cards/card_2.svg" width="85" height="85" alt="Title card 2"></div>
            <div class="land-benefits__card-title">Оформляем полный пакет документов, подготавливаем авто перед выдачей</div>
          </div>
        </div>
      </div>
      <div class="land-benefits__country">
        <div class="land-benefits__country-title">Мы импортируем автомобили более чем из 5 стран мира</div>
        <div class="land-benefits__country-list">
          <?php
          foreach (get_field("imports_in_country") as $key):
          ?>
            <div class="land-benefits__country-item"><img class="land-benefits__country-img" src="<?= esc_url($key["icon_country"]); ?>" width="28" height="20" alt="США">
              <div class="land-benefits__country-name"><?= esc_html($key["contry"]); ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
  <section class="land-section" id="section-v-reviews">
    <div class="land-section__head">
      <h2 class="land-section__title">Подобрали и привезли</h2>
    </div>
    <div class="land-v-reviews">
      <div class="slider-wrapper">
        <div class="land-v-reviews__slider">
          <div class="swiper-wrapper">
            <?php
            foreach (get_field("picked_videos") as $key):
            ?>
              <div class="land-v-reviews__slide swiper-slide">
                <div class="land-v-reviews__slide-body">
                  <div class="land-v-reviews__slide-video land-video">
                    <video class="land-video__player" poster="<?= esc_attr($key["poster_video"]); ?>">
                      <source src="<?= esc_url($key["video"]); ?>" type="video/mp4">
                    </video>
                    <button class="btn btn--reset land-video__btn" aria-label="Video button"></button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="land-slider-nav">
          <button class="btn--reset land-slider-arrow land-slider-prev" aria-label="Prev slide"></button>
          <button class="btn--reset land-slider-arrow land-slider-next" aria-label="Prev slide"></button>
        </div>
        <div class="land-slider-pagination"></div>
      </div>
    </div>
  </section>
  <section class="land-section" id="section-marquee">
    <div class="land-marquee">
      <div class="land-marquee__panel">
        <div class="land-marquee__panel-text"></div>
      </div>
    </div>
  </section>
  <section class="land-section" id="section-reviews">
    <div class="land-section__head">
      <h2 class="land-section__title">Кейсы подобранных автомобилей</h2>
    </div>
    <div class="cases">
      <div class="carousel-wrapper">
        <div class="cases__slider overflow-hidden">
          <?php
          $auto_keys = get_field("auto_keys");

          if ($auto_keys) {
            usort($auto_keys, function ($a, $b) {
              $getPrice = function ($item) {
                $priceStr = str_replace(['₽', ' '], '', $item["characteristics"]['cost']);
                $priceStr = str_replace('.', '', $priceStr);
                return is_numeric($priceStr) ? (float)$priceStr : 0;
              };

              $a_price = $getPrice($a);
              $b_price = $getPrice($b);

              return $b_price <=> $a_price;
            });
          }
          ?>

          <div class="swiper-wrapper">
            <?php
            foreach ($auto_keys as $key):
            ?>
              <div class="swiper-slide cases__card">
                <div class="cases__card-body">
                  <div class="cases__card-gallery">
                    <?php
                    $firstSLide = $key["galery"][0];
                    ?>
                    <div class="cases__card-gallery-main"><img class="cases__card-gallery-main-img" src="<?= esc_url($firstSLide); ?>" width="676" height="454" alt="FORD EXPLORER"></div>
                    <div class="cases__card-gallery-sub">
                      <?php foreach ($key["galery"] as $galery): ?>
                        <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= esc_url($galery); ?>" width="676" height="454" alt="FORD EXPLORER"></div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <div class="cases__card-info">
                    <div class="cases__card-title h4"><?= esc_html($key["title"]); ?></div>
                    <ul class="cases__card-list list-reset">
                      <?php if (!empty($key["characteristics"]["year_of_release"])): ?>
                        <li class="cases__card-list-item"><span>Год выпуска: </span>
                          <p><?= esc_html($key["characteristics"]["year_of_release"]); ?></p>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($key["characteristics"]["generation"])): ?>
                        <li class="cases__card-list-item"><span>Поколение: </span>
                          <p><?= esc_html($key["characteristics"]["generation"]); ?></p>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($key["characteristics"]["bodywork"])): ?>
                        <li class="cases__card-list-item"><span>Кузов: </span>
                          <p><?= esc_html($key["characteristics"]["bodywork"]); ?></p>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($key["characteristics"]["engine"])): ?>
                        <li class="cases__card-list-item"><span>Двигатель: </span>
                          <p><?= esc_html($key["characteristics"]["engine"]); ?></p>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($key["characteristics"]["transmission"])): ?>
                        <li class="cases__card-list-item"><span>Трансмиссия: </span>
                          <p><?= esc_html($key["characteristics"]["transmission"]); ?></p>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($key["characteristics"]["drive"])): ?>
                        <li class="cases__card-list-item"><span>Привод: </span>
                          <p><?= esc_html($key["characteristics"]["drive"]); ?></p>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($key["characteristics"]["where_from"])): ?>
                        <li class="cases__card-list-item"><span>Откуда привезли: </span>
                          <p><?= esc_html($key["characteristics"]["where_from"]); ?></p>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($key["characteristics"]["mileage"])): ?>
                        <li class="cases__card-list-item"><span>Пробег: </span>
                          <p><?= esc_html($key["characteristics"]["mileage"]); ?></p>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($key["characteristics"]["selection_period"])): ?>
                        <li class="cases__card-list-item"><span>Срок подбора: </span>
                          <p><?= esc_html($key["characteristics"]["selection_period"]); ?></p>
                        </li>
                      <?php endif; ?>

                      <?php if (!empty($key["characteristics"]["cost"])): ?>
                        <li class="cases__card-list-item"><span>Стоимость: </span>
                          <p><?= esc_html($key["characteristics"]["cost"]); ?></p>
                        </li>
                      <?php endif; ?>
                    </ul>
                    <div class="cases__card-text">
                      <?= $key["desk"]; ?>
                    </div>
                    <?php if ($key["price_benefit"]): ?>
                      <div class="cases__card-total">
                        <div class="cases__card-total-title">Выгода с учетом затрат:</div>
                        <div class="cases__card-total-price"><?= $key["price_benefit"]; ?> <?= is_numeric($key["price_benefit"]) ? '&#8381;' : ''; ?></div>
                      </div>
                    <?php endif; ?>
                    <div class="cases__card-nav btns-spacer"><a class="btn btn--accent btn--big" href="#!" data-modal="modal-feedback-order">&Pcy;&ocy;&dcy;&ocy;&bcy;&rcy;&acy;&tcy;&softcy; &acy;&vcy;&tcy;&ocy;</a></div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="slider-pagination"></div>
        <div class="slider-nav">
          <button class="btn--reset slider-btn slider-btn-prev" aria-label="Prev slide"></button>
          <button class="btn--reset slider-btn slider-btn-next" aria-label="Next slide"></button>
        </div>
      </div>
    </div>
  </section>
  <section class="land-section" id="section-about">
    <div class="land-about">
      <div class="land-about__info">
        <h2 class="land-about__title"><?= esc_html(get_field("about_company_title")); ?></h2>
        <div class="land-about__desc"><?= get_field("about_company_desk"); ?></div>
        <div class="land-about__caption"><?= esc_html(get_field("about_company_subtitle")); ?></div>
        <div class="land-about__nav btns-spacer">
          <button class="btn l-btn btn--accent" data-modal="modal-feedback-order" aria-label="Open modal">Заказать автомобиль</button>
          <button class="btn l-btn btn--border-light" data-modal="modal-feedback-cons" aria-label="Open modal">Бесплатная консультация</button>
        </div>
      </div>
      <div class="land-about__img--wrap"><img class="land-about__img" src="<?= YAR_THEME_ASSETS; ?>/img/content/about/bg.png" width="1920" height="860" alt="О компании ЯПодбор"></div>
    </div>
  </section>
  <section class="land-section" id="section-hero">
    <div class="land-hero">
      <div class="land-hero__info">
        <h2 class="land-hero__title">Работаем под ключ</h2>
        <div class="land-hero__desc">Мы подберём для вас подходящий автомобиль, проведём его тщательную проверку, организуем выкуп, полностью оформим таможенные документы и доставим в любую точку России. Все услуги выполняются «под ключ» с предоставлением гарантии.</div>
      </div>
      <div class="land-hero__img--wrap"><img class="land-hero__img" src="<?= YAR_THEME_ASSETS; ?>/img/content/hero/img.png" width="477" height="386" alt="Работаем под ключ"></div>
    </div>
  </section>
  <section class="land-section" id="section-steps">
    <div class="land-steps">
      <div class="land-steps__slider">
        <div class="swiper-wrapper">
          <?php
          foreach (get_field("work_list_is_key") as $key):
          ?>
            <div class="land-steps__slide swiper-slide">
              <div class="land-steps__slide-body">
                <div class="land-steps__slide-title"><?= esc_html($key["title"]); ?></div>
                <div class="land-steps__slide-desc"><?= esc_html($key["subtitle"]); ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="land-slider-pagination"></div>
      </div>
    </div>
  </section>
  <section class="land-section" id="section-offer">
    <div class="land-offer">
      <div class="land-offer__info">
        <h2 class="land-offer__title">Бесплатно рассчитаем стоимость</h2>
        <div class="land-offer__nav">
          <button class="btn l-btn btn--border-light" data-modal="modal-feedback-cons" aria-label="Open modal">Бесплатная консультация</button>
        </div>
      </div>
      <div class="land-offer__img--wrap"><img class="land-offer__img" src="<?= YAR_THEME_ASSETS; ?>/img/content/offer/img.png" width="731" height="311" alt="Бесплатно рассчитаем стоимость"></div>
    </div>
  </section>
  <?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/yandex-reviews'); ?>
  <section class="land-section" id="section-faq">
    <div class="land-section__head text-center">
      <h2 class="land-section__title">Часто задаваемые вопросы</h2>
    </div>
    <div class="land-faq">
      <?php
      foreach (get_field("new_faq") as $key):
      ?>
        <div class="land-faq__item">
          <button class="btn--reset land-faq__btn js-acc" aria-expanded="false" aria-label="Toggle acc"><?= esc_html($key["new_title_faq"]); ?></button>
          <div class="land-faq__content">
            <p><?= $key["new_subtitle_faq"]; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <section class="land-section" id="section-contacts">
    <div class="land-section__head text-center">
      <h2 class="land-section__title">Контакты</h2>
    </div>
    <div class="land-contacts">
      <div class="land-contacts__info">
        <div class="land-commun land-contacts__commun"> <a class="land-commun__link" href="tel:+7 495 159-39-20">+7 495 159-39-20</a><a class="land-commun__link" href="mailto:yarovoipodbor@yandex.ru">yarovoipodbor@yandex.ru</a>
          <div class="land-commun__link">г. Москва, ул. Ташкентская, д28с1</div>
        </div>
      </div>
      <div class="land-contacts__map">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ab22385ad2cd865e02d0eded7e5e4f20ed40c206704ab67448a74c1a236fbb563&amp;amp;width=700&amp;amp;height=400&amp;amp;lang=ru_RU&amp;amp;scroll=true"></script>
      </div>
    </div>
  </section>
</div>
<button class="btn btn--reset scroll-top" aria-label="Scroll top"></button>
<div class="modal" id="modal-feedback-order">
  <div class="modal__square">
    <div class="modal__head">
      <div class="modal__title h2">Заказать автомобиль</div>
      <button class="btn btn--reset btn--cross modal__close" data-close-modal></button>
    </div>
    <div class="modal__body">
      <div class="form modal__form">
        <?php wp_nonce_field('modal_form_nonce'); ?>
        <div class="form__group">
          <div class="input">
            <input class="input__cell" type="text" name="name" placeholder="Ваше имя" required>
          </div>
          <div class="input">
            <input class="input__cell" type="text" name="phone" placeholder="Телефон" required>
          </div>
          <div class="input">
            <input class="input__cell" type="text" name="budget" placeholder="Бюджет">
          </div>
        </div>
        <button class="btn l-btn btn--accent form__send" id="submit-form--js" type="submit">Оставить заявку</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="modal-feedback-cons">
  <div class="modal__square">
    <div class="modal__head">
      <div class="modal__title h2">Бесплатная консультация</div>
      <button class="btn btn--reset btn--cross modal__close" data-close-modal></button>
    </div>
    <div class="modal__body">
      <div class="form modal__form">
        <?php wp_nonce_field('modal_form_nonce'); ?>
        <div class="form__group">
          <div class="input">
            <input class="input__cell" type="text" name="name" placeholder="Ваше имя" required>
          </div>
          <div class="input">
            <input class="input__cell" type="text" name="phone" placeholder="Телефон" required>
          </div>
        </div>
        <button class="btn l-btn btn--accent form__send" id="submit-form--js" type="submit">Оставить заявку</button>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>