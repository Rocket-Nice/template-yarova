<?php 
/*
Template name: Expert
*/
get_header(); ?>
    <div class="page-container container">
    <section class="section section--bg section--banner">
        <div class="breadcrumbs">
          <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="main.html">Главная страница</a></li>
            <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="contacts.html">Контакты</a></li>
          </ul>
        </div>
    </section>
    <section class="section section--bg anim-elem no-margin-top">
        <div class="section__head">
          <h2 class="section__title">БАЗА КВАЛИФИЦИРОВАННЫХ ЭКСПЕРТОВ ПО АВТОПОДБОРУ</h2>
        </div>
        <div class="section__img-bg--wrap"><img class="section__img-bg" src="<?= get_template_directory_uri(); ?>/img/content/services/bg.png" width="1920" height="2822" alt="Услуги"></div>
        <div class="services">
          <div class="services__row">
            <div class="services__card">
              <div class="services__card--wrap">
                <div class="services__card-info">
                  <div class="services__image-wraper">
                    <img class="services__image" src="<?= get_template_directory_uri(); ?>/img/content/expert/expert1.png" alt="">
                  </div>
                  <div class="services__content-wrapper">
                    <div class="services__card-head">
                        <div class="services__card-title small">Мамедяров Вячеслав Рамизович</div>
                    </div>
                    <div class="services__card-hint">Эксперт криминалист</div>
                    <ul class="services__card-list">
                        <li>Поиск по всем базам</li>
                        <li>Подбор автомобиля до желаемого результата</li>
                        <li>Юридическая проверка</li>
                        <li>Техническая проверка</li>
                    </ul>
                  </div>
                  
                  <p class="services__card-desc small">Подбор автомобиля по вашим предпочтениям. Ищем автомобиль не только по общедоступным базам, но также в закрытых каналах, трейд-ин, у официальных дилеров, на специальных площадках.</p>
                </div>
                <div class="services__card-nav">
                    <a class="btn btn--border-light btn--big services__card-btn services__card-btn-secondary" href="/services-article">Показать телефон</a>
                    <a class="btn btn--accent btn--big services__card-btn services__card-btn-secondary" href="/services-article">Подробнее</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
<?php get_footer(); ?>