<?php get_header(); ?>
    <div class="page-container container">
      <section class="section section--404">
        <div class="section__img-bg--wrap anim-elem"><img class="section__img-bg" src="<?= get_template_directory_uri() ?>/img/content/banner/404-bg.png" width="1920" height="1080" alt="404"></div>
        <div class="error-404">
          <div class="error-404__info">
            <h1 class="error-404__title">404</h1>
            <div class="error-404__desc">Страница не найдена</div>
            <div class="error-404__btns"><a class="btn btn--big btn--accent" href="main.html">Вернуться на главную</a></div>
          </div>
        </div>
      </section>
    </div>
<?php get_footer(); ?>