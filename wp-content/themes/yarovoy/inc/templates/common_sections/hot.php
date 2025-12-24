<?php

$hot = new WP_Query( [
	'post_type'      => 'auto',
	'posts_per_page' => 5,
	'orderby'        => 'rand'
] );

return '';

?>

<section class="section anim-elem">
    <div class="section__head">
        <h2 class="section__title">Горячее предложение</h2>
    </div>
    <div class="hotoffer">
        <div class="carousel-wrapper">
            <div class="hotoffer__slider overflow-hidden">
                <div class="swiper-wrapper">
	                <?php while ( $hot->have_posts() ) {
		                $hot->the_post();

		                get_template_part( YAR_THEME_TEMPLATES . '/base/card', null, [
			                'classes' => 'swiper-slide',
			                'button'  => true
		                ] );
	                } ?>
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