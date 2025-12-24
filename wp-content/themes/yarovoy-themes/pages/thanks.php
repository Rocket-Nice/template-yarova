<?php get_header( null, [ 'classes' => 'body--dark' ] ); /* TEMPLATE NAME: Спасибо */ ?>

<div class="page-container container">
    <section class="section section--banner banner__thanks">
        <div class="banner anim-elem">
            <div class="banner__info">
                <h1 class="banner__title">Спасибо, данные успешно переданы</h1>
                <p>Благодарим за выбор нашей компании Менеджер свяжется с вами в течении часа</p>
            </div>
            <a href="<?= home_url(); ?>" class="btn banner__btn btn--accent btn--big">Вернуться на главную</a>
        </div>
    </section>
</div>

<?php get_footer(); ?>