<?php get_header(); ?>
    <div class="page-container container">
      <section class="section section--banner">
        <div class="banner anim-elem">
          <div class="banner__bg"><img class="banner__bg-img" src="<?= get_template_directory_uri(); ?>/img/content/banner/bg.png" width="1920" height="1104" alt="Профессиональный автоподбор под ключ"></div>
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
                    <button class="btn btn--accent btn--big banner__benefits-btn" aria-label="Open modal">Оставить заявку</button>
                  </div>
                </div>
              </div>
              <div class="banner__benefits-col">
                <div class="banner__benefits-col--body">
                  <div class="banner__benefits-title">Подбор авто под ключ </div>
                  <div class="price">
                    <div class="price__old">30 000 &#8381;</div>
                    <div class="price__current">24 000 &#8381;</div>
                  </div>
                  <div class="banner__benefits-desc">После проверки автомобиля нашим специалистом вы можете убедиться в его юридической чистоте и технической исправности самостоятельно, скачав бесплатный отчёт.</div>
                  <div class="banner__benefits-nav">
                    <button class="btn btn--accent btn--big banner__benefits-btn" aria-label="Open modal">Оставить заявку</button>
                  </div>
                </div>
              </div>
              <div class="banner__benefits-col">
                <div class="banner__benefits-col--body">
                  <div class="banner__benefits-title">Эксперты по подбору автомобилей</div>
                  <div class="banner__benefits-desc">В компании работает команда опытных экспертов-криминалистов, которые используют новое высокотехнологичное оборудование для подбора автомобилей по вашим предпочтениям.</div>
                  <div class="banner__benefits-nav">
                    <button class="btn btn--accent btn--big banner__benefits-btn" aria-label="Open modal">Оставить заявку</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
          <div class="infoblock__img--wrap"><img class="infoblock__img" src="<?= get_template_directory_uri(); ?>/img/content/infoblock/main-1.png" width="1380" height="824" alt="Что входит в услугу автоподбор"></div>
        </div>
      </section>
      <section class="section anim-elem">
        <div class="feedback">
          <h2 class="feedback__title">Выберите автомобиль, который вы хотели бы приобрести</h2>
          <p class="feedback__desc">Подберём юридически чистый и технически исправный автомобиль с учётом ваших предпочтений. <br /> При первом обращении дарим бесплатную консультацию и скидку 20% на подбор автомобиля под ключ!</p>
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
                <button class="btn btn--accent btn--huge form__btn" type="button" aria-label="Send form">Оставить заявку</button>
              </div>
            </div>
          </form>
        </div>
      </section>
      <section class="section anim-elem">
        <div class="section__head">
          <h2 class="section__title">О компании ЯПодбор</h2>
        </div>
        <div class="infoblock">
          <div class="infoblock__columns">
            <div class="infoblock__columns-item">
              <p>Занимаемся подбором автомобилей с 2012 года. Делаем полную юридическую, техническую и криминалистическую проверку. География подбора не ограничивается Россией. Специалисты также ищут автомобили в странах СНГ, Европе и США <br><br> С момента основания компании мы подобрали более 9000 автомобилей, чётко следуя критериям клиентов. Доверьте нам поиск своего автомобиля — сэкономьте время, деньги и сохраните нервы.</p>
            </div>
            <div class="infoblock__columns-item">
              <h5>Выгодный торг</h5>
              <p> <strong>В 99% случаях оплата за услуги автоподбора окупается торгом с владельцем машины.</strong></p>
            </div>
            <div class="infoblock__columns-item">
              <h5>Экономим ваше времЯ</h5>
              <p>Проведём осмотр авто в течение нескольких часов после получения заявки.</p>
            </div>
          </div>
          <div class="infoblock__img--wrap"><img class="infoblock__img" src="<?= get_template_directory_uri(); ?>/img/content/infoblock/main-2.png" width="1380" height="824" alt="Андрей Яровой | Генеральный директор ЯПОDБОР">
            <div class="infoblock__img-panel">
              <div class="infoblock__img-panel-title">Андрей Яровой</div>
              <div class="infoblock__img-panel-desc">Генеральный директор ЯПОDБОР</div>
            </div>
          </div>
        </div>
      </section>
      <?php get_template_part("partials/features") ?>
      <section class="section anim-elem">
        <div class="section__head">
          <h2 class="section__title">Как устроена услуга <br> автоподбора?</h2>
        </div>
        <div class="coop">
          <div class="coop__row">
            <div class="coop__col">
              <div class="coop__col-body">
                <div class="coop__col-title">Онлайн-заявка на подбор автомобиля</div>
                <p class="coop__col-desc">Через форму на сайте, по телефону или через мессенджеры.</p>
              </div>
            </div>
            <div class="coop__col">
              <div class="coop__col-body">
                <div class="coop__col-title">Бесплатная консультация со специалистом</div>
                <p class="coop__col-desc">Определяем требования к автомобилю, обсуждаем ваши пожелания, после чего заключаем договор. Вы вносите предоплату.</p>
              </div>
            </div>
            <div class="coop__col">
              <div class="coop__col-body">
                <div class="coop__col-title">Поиск и проверка автомобиля</div>
                <p class="coop__col-desc">Анализируем рынок. Проверяем историю автомобиля, проводим техническую, юридическую и криминалистическую проверку. Предоставляем отчёт и заключение эксперта о состоянии автомобиля.</p>
              </div>
            </div>
            <div class="coop__col">
              <div class="coop__col-body">
                <div class="coop__col-title">Проверка автомобиля</div>
                <p class="coop__col-desc">Проверяем на СТО. Предоставляем отчёт и заключение эксперта о состоянии автомобиля. Торгуемся с продавцом.</p>
              </div>
            </div>
            <div class="coop__col">
              <div class="coop__col-body">
                <div class="coop__col-title">Заключение сделки купли-продажи</div>
                <p class="coop__col-desc">Сопровождаем сделку, включая составление Договора купли-продажи, помогаем при постановке в ГАИ</p>
              </div>
            </div>
            <div class="coop__col">
              <div class="coop__col-body">
                <div class="coop__col-title">Доставка автомобиля и оплата услуг подбора</div>
                <p class="coop__col-desc">При необходимости доставляем автомобиль, если он приобретен в удаленном регионе или другой стране. Выдаём пакет документов. Вы оплачиваете услугу подбора и доставку.</p>
              </div>
            </div>
          </div>
          <div class="coop__footer">
            <button class="btn btn--accent btn--huge btn--wide" aria-label="Open modal">Оставить заявку</button>
          </div>
        </div>
      </section>
      <section class="section anim-elem">
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
                      <div class="cases__card-gallery-main"><img class="cases__card-gallery-main-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_1/item_1.jpeg" width="676" height="454" alt="Card gallery"></div>
                      <div class="cases__card-gallery-sub">
                        <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_1/item_2.jpeg" width="676" height="454" alt="Card gallery"></div>
                        <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_1/item_3.jpeg" width="676" height="454" alt="Card gallery"></div>
                        <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_1/item_4.jpeg" width="676" height="454" alt="Card gallery"></div>
                        <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_1/item_5.jpeg" width="676" height="454" alt="Card gallery"></div>
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
                      <div class="cases__card-total">
                        <div class="cases__card-total-title">Выгода с учетом затрат:</div>
                        <div class="cases__card-total-price">70 000 &#8381;</div>
                      </div>
                      <div class="cases__card-nav btns-spacer"><a class="btn btn--accent btn--big" href="#!">Подобрать авто</a><a class="btn btn--dark btn--big" href="#!">Посмотреть все кейсы</a></div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide cases__card">
                  <div class="cases__card-body">
                    <div class="cases__card-gallery">
                      <div class="cases__card-gallery-main"><img class="cases__card-gallery-main-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_2/item_1.jpeg" width="676" height="454" alt="Card gallery"></div>
                      <div class="cases__card-gallery-sub">
                        <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_2/item_2.jpeg" width="676" height="454" alt="Card gallery"></div>
                        <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_2/item_3.jpeg" width="676" height="454" alt="Card gallery"></div>
                        <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_2/item_4.jpeg" width="676" height="454" alt="Card gallery"></div>
                        <div class="cases__card-gallery-sub-item"><img class="cases__card-gallery-sub-img" src="<?= get_template_directory_uri(); ?>/img/content/cases/card_2/item_5.jpeg" width="676" height="454" alt="Card gallery"></div>
                      </div>
                    </div>
                    <div class="cases__card-info">
                      <div class="cases__card-title h4">Range Rover