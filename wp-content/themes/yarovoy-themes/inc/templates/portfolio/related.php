<?php

$exclude_posts = isset( $args['exclude_posts'] ) ? $args['exclude_posts'] : get_the_ID();

if ( ! is_array( $exclude_posts ) ) {
	$exclude_posts = [ $exclude_posts ];
}

$portfolio = new WP_Query( [
	'post_type'      => 'portfolio',
	'posts_per_page' => 10,
	'post__not_in'   => $exclude_posts
] );

if ( ! $portfolio->have_posts() ) {
	return '';
}

?>

<section class="section section--transparent portfolio-related">
	<div class="section__head">
		<h2 class="section__title section__title--white">Смотреть ещё</h2>
	</div>
	<div class="portfolio-related__slider">
		<div class="portfolio-related__swiper swiper">
			<div class="swiper-wrapper">
				<?php while ( $portfolio->have_posts() ) { $portfolio->the_post(); ?>
					<div class="swiper-slide">
						<?php get_template_part( YAR_THEME_TEMPLATES . '/portfolio/card' ); ?>
					</div>
				<?php } wp_reset_postdata(); ?>
			</div>
		</div>
		<button class="swiper__arrow swiper__arrow--prev"></button>
		<button class="swiper__arrow swiper__arrow--next"></button>
	</div>
</section>

