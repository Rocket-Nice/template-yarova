<?php

$classes  = yar_get_section_classes( $args );
$services = new WP_Query( [
	'post_type'      => 'service',
	'posts_per_page' => - 1
] );

if ( ! $services->have_posts() ) {
	return '';
}

?>


<section class="section <?= $classes; ?>">
	<div class="section__head text-center">
		<h2 class="section__title">Услуги</h2>
	</div>
	<div class="section__img-bg--wrap">
		<img class="section__img-bg" src="<?= YAR_THEME_ASSETS; ?>/img/content/services/bg.jpg" width="1920" height="2821" alt="Услуги">
	</div>
	<div class="services">
		<div class="services__row">
			<?php while ( $services->have_posts() ) {
				$services->the_post();

				get_template_part( YAR_THEME_TEMPLATES . '/service/card' );
			}
			wp_reset_postdata(); ?>
		</div>
	</div>
</section>