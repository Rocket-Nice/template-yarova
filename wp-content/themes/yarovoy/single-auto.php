<?php get_header( null, [ 'classes' => 'body--dark' ] );

$post_id = get_the_ID();

$car  = new YAR_Car_Public_Repository();
$data = $car->get_single_car( $post_id );

$related = new WP_Query( [
	'post_type'      => 'auto',
	'posts_per_page' => 5,
	'post__not_in'   => [ $post_id ]
] );

?>

<div class="page-container container">
	<section class="section section--banner base-singe--banner">
		<?php get_template_part( YAR_THEME_TEMPLATES . '/breadcrumbs' ); ?>
	</section>
</div>

<section class="section base-single">
	<div class="container base-single__container">
		<div class="base-single__grid">
			<div class="base-single__gallery">
				<?php if ( $data['thumbnail'] ){ ?>
				<a href="<?= $data['thumbnail']; ?>" class="base-single__gallery-main" data-fancybox="gallery">
					<img src="<?= $data['thumbnail']; ?>" alt="">
				</a>
				<?php } ?>
				<?php if ( ! empty( $data['gallery'] ) ) {
					$gallery_counter = 1;

					$gallery_count = count( $data['gallery'] );
					if ( $gallery_count <= 4 ) {
						$gallery_count -= 4;
					}

					?>
					<div class="base-single__gallery-thumbs">
						<?php foreach ( $data['gallery'] as $item ) {
							if ( $gallery_counter <= 4 ) { ?>
								<a href="<?= $item; ?>"
								   class="base-single__gallery-thumbs__item" data-fancybox="gallery">
									<img src="<?= $item; ?>" alt="">
									<?php if ( $gallery_counter === 4 && $gallery_count > 4 ) { ?>
										<span class="base-single__gallery-thumbs__counter">
											+<?= $gallery_count; ?>
										</span>
									<?php } ?>
								</a>
							<?php } else { ?>
								<a href="<?= $item; ?>" data-fancybox="gallery"></a>
							<?php }
							$gallery_counter ++;
						} ?>
					</div>
				<?php } ?>
			</div>
			<div class="base-single__main">
				<div class="base-single__header">
					<h1 class="base-single__title"><?php the_title(); ?></h1>
					<?php if ( $data['price'] ) { ?>
						<div class="base-single__price"><?= $data['price'] ?></div>
					<?php } ?>
				</div>
				<?php if ( ! empty( $data['features'] ) ) { ?>
					<ul class="base-single__features list-reset">
						<?php foreach ( $data['features'] as $feature ) { ?>
							<li class="cases__card-list-item">
								<span><?= $feature['title']; ?></span>
								<p><?= $feature['value']; ?></p>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
				<div class="base-single__actions">
					<?php if ( $data['report'] || $data['report_from'] ) { ?>
						<a href="<?= ( $data['report'] ? $data['report'] : $data['report_from'] ) ?>" class="base-single__report btn btn--big btn--dark" target="_blank">
							показать отчет
						</a>
					<?php } else { ?>
						<button class="btn btn--big btn--dark" data-popup="popup-feedback">Заказать отчет</button>
					<?php } ?>
					<button
							class="btn btn--big btn--accent"
							data-id="<?= get_the_ID(); ?>"
							data-nonce="<?= wp_create_nonce( 'yar_base_auto_phone' ) ?>"
					>
						Показать телефон
					</button>
				</div>
			</div>
		</div>

		<?php if ( $data['description'] || $data['mini_description'] ) { ?>
			<div class="base-single__description cases__card-text">
				<?= ( $data['description'] ? $data['description'] : $data['mini_description'] ); ?>
				<?php if ( ! empty( $data['additional'] ) ){ ?>
					<p>
						<?php foreach ( $data['additional'] as $additional ) { ?>
							— <?= $additional; ?> <br>
						<?php } ?>
					</p>
					<p>И многое другое</p>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if ( ! $related->have_posts() ) { ?>
			<section class="base-singe--related">
				<div class="section__head">
					<h2 class="section__title">Горячее предложение</h2>
				</div>
				<div class="hotoffer">
					<div class="carousel-wrapper">
						<div class="hotoffer__slider overflow-hidden">
							<div class="swiper-wrapper">
								<?php while ( $related->have_posts() ) {
									$related->the_post();

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
		<?php } ?>
	</div>
</section>

<div class="page-container container">
	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/contacts', null, [
			'classes' => 'no-margin'
	] ); ?>
</div>

<?php get_footer(); ?>
