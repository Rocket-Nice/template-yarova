<?php 

/*
Template name: Portfolio Single
*/

get_header(); ?>
    <div class="page-container container">
        <section class="section section--banner">
            <div class="breadcrumbs">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="/">Главная страница</a></li>
                    <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="/services">Услуги</a></li>
                    <li class="breadcrumbs__item"><a class="breadcrumbs__link">Подбор автомобилей под ключ</a></li>
                </ul>
            </div>
        </section>
        <section class="section section--bg bg-transparent">
            <div class="section__head">
                <h2 class="section__title">Кейсы проверенных <br> автомобилей</h2>
            </div>
            <div class="cases">
                <div class="carousel-wrapper">
                    <div class="cases__slider overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide cases__card">
                        <div class="cases__card-body">
                            <div class="cases__card-gallery">
                            <div class="cases__card-gallery-main"><img class="cases__card-gallery-main-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/cases/card_1/item_1.jpeg" width="676" height="454" alt="Card gallery"></div>
                            <div class="cases__card-gallery-sub">
                                <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/cases/card_1/item_2.jpeg" width="676" height="454" alt="Card gallery"></div>
                                <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/cases/card_1/item_3.jpeg" width="676" height="454" alt="Card gallery"></div>
                                <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/cases/card_1/item_4.jpeg" width="676" height="454" alt="Card gallery"></div>
                                <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/cases/card_1/item_5.jpeg" width="676" height="454" alt="Card gallery"></div>
                            </div>
                            </div>
                            <div class="cases__card-info">
                            <div class="cases__card-title h4">Audi Q5</div>
                            <ul class="cases__card-list list-reset">
                                <li class="cases__card-list-item"><span>Двигатель:</span>
                                <p>2.0 л / 177 л.с</p>
                                </li>
                                <li class="cases__card-list-item"><span>Владельцев:</span>
                                <p>1</p>
                                </li>
                                <li class="cases__card-list-item"><span>Пробег:</span>
                                <p>95 263 км.</p>
                                </li>
                                <li class="cases__card-list-item"><span> <strong>Стоимость:</strong></span>
                                <p> <strong>1 560 000 &#8381;</strong></p>
                                </li>
                                <li class="cases__card-list-item"><span> <strong>Купили за:</strong></span>
                                <p> <strong>1 490 000 &#8381;</strong></p>
                                </li>
                                <li class="cases__card-list-item"><span> <strong>Срок подбора:</strong></span>
                                <p> <strong>3 дня</strong></p>
                                </li>
                            </ul>
                            <div class="cases__card-text">
                                <p>Обслуживался у официального дилера, пробег реальный. Небольшие притёртости на переднем бампере под полировку.</p>
                                <p>Произведена компьютерная и сервисная диагностика - не выявлено никаких ошибок, авто технически полностью обслужен.</p>
                                <p>Заменено масло в автомате 7 тыс. км назад, фильтры и масло в моторе. По ходовой части была произведена замена рычагов у официального дилера.</p>
                            </div>
                            </div>
                        </div>
                        </div>
                   
                    </div>
                    </div>
                </div>
            </div>
      </section>
      <section class="section anim-elem">
        <div class="section__head">
          <h2 class="section__title title white">Горячее предложение</h2>
        </div>
        <div class="hotoffer">
          <div class="carousel-wrapper">
            <div class="hotoffer__slider overflow-hidden">
              <div class="swiper-wrapper">
                <div class="hotoffer__card swiper-slide">
                  <div class="hotoffer__card-body">
                    <div class="hotoffer__card-img--wrap"><img class="hotoffer__card-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/hotoffer/item_1.png" width="571" height="428" alt="Title card">
                      <div class="hotoffer__card-title">BMW X5, 2020</div>
                    </div>
                    <div class="hotoffer__card-content">
                      <div class="hotoffer__card-info">
                        <div class="hotoffer__card-list list-reset">
                          <li>III (G01)</li>
                          <li>51 500 км</li>
                          <li>4.4л / 530 л.с. л / 530 л.с / Бензиновый</li>
                          <li>Автоматическая</li>
                          <li>Внедорожник 5 дв.</li>
                          <li>Полный</li>
                          <li>Синий</li>
                        </div>
                      </div>
                      <div class="hotoffer__card-nav">
                        <div class="price hotoffer__card-price">
                          <div class="price__current">8 990 000 &#8381;</div>
                        </div>
                        <button class="btn btn--accent btn--big btn--wide" aria-label="Open modal" data-popup="popup-feedback">Оставить заявку </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="hotoffer__card swiper-slide">
                  <div class="hotoffer__card-body">
                    <div class="hotoffer__card-img--wrap"><img class="hotoffer__card-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/hotoffer/item_2.png" width="571" height="428" alt="Title card">
                      <div class="hotoffer__card-title">BMW M5, 2018</div>
                    </div>
                    <div class="hotoffer__card-content">
                      <div class="hotoffer__card-info">
                        <div class="hotoffer__card-list list-reset">
                          <li>III (G01)</li>
                          <li>57 000 км</li>
                          <li>4.4л / 625 л.с. л / 625 л.с / Бензиновый</li>
                          <li>Автоматическая</li>
                          <li>Седан</li>
                          <li>Полный</li>
                          <li>Антибликовый белый</li>
                        </div>
                      </div>
                      <div class="hotoffer__card-nav">
                        <div class="price hotoffer__card-price">
                          <div class="price__current">8 600 000 &#8381;</div>
                        </div>
                        <button class="btn btn--accent btn--big btn--wide" aria-label="Open modal" data-popup="popup-feedback">Оставить заявку </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="hotoffer__card swiper-slide">
                  <div class="hotoffer__card-body">
                    <div class="hotoffer__card-img--wrap"><img class="hotoffer__card-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/hotoffer/item_3.png" width="571" height="428" alt="Title card">
                      <div class="hotoffer__card-title">Porsche Cayenne, 2019</div>
                    </div>
                    <div class="hotoffer__card-content">
                      <div class="hotoffer__card-info">
                        <div class="hotoffer__card-list list-reset">
                          <li>III (G01)</li>
                          <li>85 000 км</li>
                          <li>3.0л / 340 л.с. л / 340 л.с / Бензиновый</li>
                          <li>Автоматическая</li>
                          <li>Внедорожник 5 дв.</li>
                          <li>Полный</li>
                          <li>Антибликовый белый</li>
                        </div>
                      </div>
                      <div class="hotoffer__card-nav">
                        <div class="price hotoffer__card-price">
                          <div class="price__current">8 350 000 &#8381;</div>
                        </div>
                        <button class="btn btn--accent btn--big btn--wide" aria-label="Open modal" data-popup="popup-feedback">Оставить заявку </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="hotoffer__card swiper-slide">
                  <div class="hotoffer__card-body">
                    <div class="hotoffer__card-img--wrap"><img class="hotoffer__card-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/hotoffer/item_4.png" width="571" height="428" alt="Title card">
                      <div class="hotoffer__card-title">BMW X4, 2019</div>
                    </div>
                    <div class="hotoffer__card-content">
                      <div class="hotoffer__card-info">
                        <div class="hotoffer__card-list list-reset">
                          <li>III (G01)</li>
                          <li>122 000 км</li>
                          <li>2.0л / 190 л.с. л / 190 л.с / Дизельный</li>
                          <li>Автоматическая</li>
                          <li>Внедорожник 5 дв.</li>
                          <li>Полный</li>
                          <li>Черный</li>
                        </div>
                      </div>
                      <div class="hotoffer__card-nav">
                        <div class="price hotoffer__card-price">
                          <div class="price__current">4 444 000 &#8381;</div>
                        </div>
                        <button class="btn btn--accent btn--big btn--wide" aria-label="Open modal" data-popup="popup-feedback">Оставить заявку </button>
                      </div>
                    </div>
                  </div>
                </div>
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
    </div>
<?php get_footer(); ?>