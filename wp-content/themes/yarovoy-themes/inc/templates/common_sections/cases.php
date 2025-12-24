<?php

$portfolio = new WP_Query( [
	'post_type'      => 'portfolio',
	'posts_per_page' => 5,
	'orderby'        => 'rand'
] );

if ( ! $portfolio->have_posts() ) {
	return '';
}

?>

<section class="section anim-elem">
	<div class="section__head">
		<h2 class="section__title">Кейсы проверенных <br> автомобилей</h2>
	</div>
	<div class="cases">
		<div class="carousel-wrapper">
			<div class="cases__slider overflow-hidden">
				<div class="swiper-wrapper">
					<?php while ( $portfolio->have_posts() ){
						$portfolio->the_post();

						$gallery     = get_field( 'gallery' );
						$gallery     = array_slice( $gallery, 0, 4 );
						$price       = get_field( 'price' );
						$deadline    = get_field( 'deadline' );
						$description = get_field( 'description' );

						$main = '';

						$image = get_the_post_thumbnail_url( get_the_ID() );

						$engine_size = get_field( 'engine_size' );
						$horse_power = get_field( 'horse_power' );
						$pts_owners  = get_field( 'pts_owners' );
						$mileage     = yar_get_number_format( get_field( 'mileage' ) );

						$engine = '';
						if ( $engine_size ) {
							$engine .= $engine_size . ' л';
						}

						if ( $horse_power ) {
							$engine .= '/' . $horse_power . ' л.с';
						}

						if ( $description ){
							$description = str_replace( '<p>&nbsp;</p>', '', $description );
						}

						?>

						<div class="swiper-slide cases__card">
							<div class="cases__card-body">
								<?php if ( $image ){ ?>
									<div class="cases__card-gallery">
										<div class="cases__card-gallery-main">
											<img class="cases__card-gallery-main-img" src="<?= $image; ?>" width="676" height="454" alt="<?php the_title(); ?>">
										</div>
										<?php if ( ! empty( $gallery ) ){ ?>
											<div class="cases__card-gallery-sub">
												<?php foreach ( $gallery as $item ) { ?>
													<div class="cases__card-gallery-sub-item">
														<img class="cases__card-gallery-sub-img" src="<?= $item; ?>" width="676" height="454" alt="<?php the_title(); ?>">
													</div>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								<?php } ?>
								<div class="cases__card-info">
									<div class="cases__card-title h4"><?php the_title(); ?></div>
									<ul class="cases__card-list list-reset">
										<?php if ( $engine ){ ?>
											<li class="cases__card-list-item"><span>Двигатель:</span>
												<p><?= $engine; ?></p>
											</li>
										<?php } ?>
										<?php if ( $pts_owners !== '' ){ ?>
											<li class="cases__card-list-item"><span>Владельцев:</span>
												<p><?= $pts_owners; ?></p>
											</li>
										<?php } ?>
										<?php if ( $mileage ){ ?>
											<li class="cases__card-list-item"><span>Пробег:</span>
												<p><?= $mileage; ?> км.</p>
											</li>
										<?php } ?>
										<?php if ( $price ){ ?>
											<li class="cases__card-list-item"><span> <strong>Стоимость:</strong></span>
												<p> <strong><?= yar_get_normal_price( $price ); ?> &#8381;</strong></p>
											</li>
										<?php } ?>
										<!--<li class="cases__card-list-item"><span> <strong>Купили за:</strong></span>
											<p> <strong>1 490 000 &#8381;</strong></p>
										</li>-->
										<?php if ( $deadline ){ ?>
											<li class="cases__card-list-item"><span> <strong>Срок подбора:</strong></span>
												<p> <strong><?= $deadline; ?></strong></p>
											</li>
										<?php } ?>
									</ul>
									<?php if ( $description ){ ?>
										<div class="cases__card-text">
											<?= mb_substr( $description, 0, 366 ); ?>...
										</div>
									<?php } ?>
									<!--<div class="cases__card-total">
										<div class="cases__card-total-title">Выгода с учетом затрат:</div>
										<div class="cases__card-total-price">70 000 &#8381;</div>
									</div>-->
									<div class="cases__card-nav btns-spacer">
										<a class="btn btn--accent btn--big" href="#!"  data-popup="popup-feedback">Подобрать авто</a>
										<a class="btn btn--dark btn--big" href="/catalog/">Посмотреть все кейсы</a>
									</div>
								</div>
							</div>
						</div>
					<?php } wp_reset_postdata(); ?>
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
