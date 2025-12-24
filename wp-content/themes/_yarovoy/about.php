<?php 

/*
Template name: About
*/

get_header(); ?>
    <div class="page-container container">
      <section class="section section--banner">
        <div class="breadcrumbs">
          <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="/">Главная страница</a></li>
            <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="">О нас</a></li>
          </ul>
        </div>
        <div class="section__img-bg--wrap anim-elem"><img class="section__img-bg" src="<?= get_template_directory_uri(); ?>/img/content/banner/contacts-bg.png" width="1920" height="810" alt="Контакты"></div>
        <div class="contacts contacts--light">
          <div class="contacts__row">
            <div class="contacts__info">
              <h1 class="contacts__title">О нас</h1>
            </div>
            <div class="contacts__map">
              <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ab22385ad2cd865e02d0eded7e5e4f20ed40c206704ab67448a74c1a236fbb563&amp;amp;width=700&amp;amp;height=400&amp;amp;lang=ru_RU&amp;amp;scroll=true"></script>
            </div>
          </div>
        </div>
      </section>
    </div>
<?php get_footer(); ?>