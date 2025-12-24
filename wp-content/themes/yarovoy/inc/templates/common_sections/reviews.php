<?php

$classes = yar_get_section_classes( $args );
$reviews = get_field( 'reviews', 'option' );

if ( empty( $reviews ) ){
	return '';
}

?>


<section class="reviews section <?= $classes; ?>">
	<div class="section__head">
		<h2 class="section__title">Отзывы клиентов</h2>
	</div>
	<div class="reviews__slider">
		<div class="swiper">
			<div class="swiper-wrapper">
				<?php foreach ( $reviews as $review ) {
					if ( empty( $review['video']['url'] ) ){
						continue;
					} ?>
					<div class="swiper-slide">
						<div class="reviews__item">
							<video class="reviews__video">
								<source src="<?= $review['video']['url']; ?>" type="video/mp4">
							</video>
							<button class="reviews__play"></button>
							<?php if ( $review['image'] ){ ?>
								<div class="reviews__preview" style="background-image: url(<?= $review['image']; ?>)"></div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<button class="btn--reset slider-btn slider-btn-prev reviews__slider-prev"></button>
		<button class="btn--reset slider-btn slider-btn-next reviews__slider-next"></button>

		<div class="reviews__slider-pagination slider-pagination"></div>
	</div>
</section>