<?php 

/*
Template name: Catalog
*/

get_header(); ?>
    <div class="page-container container">
      <section class="section section--banner">
        <div class="breadcrumbs">
          <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="main.html">Главная страница</a></li>
            <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="contacts.html">Контакты</a></li>
          </ul>
        </div>
      </section>
      <section class="section anim-elem no-margin-top">
        <div class="feedback">
          <h2 class="feedback__title">Выберите автомобиль, который вы хотели бы приобрести</h2>
          <p class="feedback__desc">Выберите выберите параметры автомобиля, который вы хотели бы приобрести</p>
          <form class="form feedback__form" action="/" method="/">
            <div class="form__row">
              <div class="input">
                <select class="input__cell" name="mark">
                  <option disabled="" selected="">Марка</option>
                  <option value="0">Element 1</option>
                  <option value="1">Element 2</option>
                  <option value="2">Element 3</option>
                </select>
              </div>
              <div class="input">
                <select class="input__cell" name="model">
                  <option disabled="" selected="">Модель</option>
                  <option value="0">Element 1</option>
                  <option value="1">Element 2</option>
                  <option value="2">Element 3</option>
                </select>
              </div>
              <div class="input">
                <select class="input__cell" name="generation">
                  <option disabled="" selected="">Поколение</option>
                  <option value="0">Element 1</option>
                  <option value="1">Element 2</option>
                  <option value="2">Element 3</option>
                </select>
              </div>
              <div class="input">
                <select class="input__cell" name="year">
                  <option disabled="" selected="">Год</option>
                  <option value="0">Element 1</option>
                  <option value="1">Element 2</option>
                  <option value="2">Element 3</option>
                </select>
              </div>
              <div class="input">
                <input class="input__cell" type="text" name="budget" placeholder="Бюджет">
              </div>
              <div class="input">
                <input class="input__cell" type="text" name="name" placeholder="Имя">
              </div>
              <div class="input">
                <input class="input__cell" type="text" name="phone" placeholder="Телефон">
              </div>
              <div class="form__send">
                <button class="btn btn--accent btn--huge form__btn" type="button" aria-label="Send form">Применить</button>
              </div>
            </div>
          </form>
        </div>
      </section>
      <section class="section anim-elem">
        <div class="section__head">
          <h2 class="section__title title white">База проверенных автомобилей</h2>
        </div>
        <div class="hotoffer">
          <div class="carousel-wrapper">
            <div class="hotoffer__slider overflow-hidden">
              <div class="swiper-wrapper">
                
              <div class="hotoffer__card swiper-slide">
                  <div class="hotoffer__card-body">
                    <div class="hotoffer__card-img--wrap"><img class="hotoffer__card-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/hotoffer/item_1.png" width="571" height="428" alt="Title card">
                      <div class="hotoffer__card-title">
                        <a class="link-white" href="/portfolio-single">
                            BMW X5, 2020
                        </a>
                    </div>
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
                      </div>
                    </div>
                  </div>
                </div>

                <div class="hotoffer__card swiper-slide">
                  <div class="hotoffer__card-body">
                    <div class="hotoffer__card-img--wrap"><img class="hotoffer__card-img" src="<?= YAR_THEME_ASSETS; ?>/img/content/hotoffer/item_1.png" width="571" height="428" alt="Title card">
                      <div class="hotoffer__card-title">
                        <a class="link-white" href="/portfolio-single">
                            BMW X5, 2020
                        </a>
                      </div>
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