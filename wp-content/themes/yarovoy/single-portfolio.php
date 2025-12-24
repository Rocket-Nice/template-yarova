<?php get_header( null, [ 'classes' => 'body--dark' ] );

$gallery     = get_field( 'gallery' );
$service     = get_field( 'service' );
$price       = get_field( 'price' );
$deadline    = get_field( 'deadline' );
$description = get_field( 'description' );

$features = [
	[
		'title' => 'Год выпуска',
		'field' => get_field( 'year' )
	],
	[
		'title' => 'Поколение',
		'field' => get_field( 'generation' )
	],
	[
		'title' => 'Двигатель',
		'field'     => function () {
			$engine_size = get_field( 'engine_size' );
			$horse_power = get_field( 'horse_power' );

			$output = '';
			if ( $engine_size ) {
				$output .= $engine_size . ' л';
			}

			if ( $horse_power ) {
				$output .= '/' . $horse_power . ' л.с';
			}

			return $output;
		}
	],
	[
		'title' => 'КПП',
		'field' => get_field( 'transmission' )
	],
	[
		'title' => 'Владельцев по ПТС',
		'field' => get_field( 'pts_owners' )
	],
	[
		'title' => 'Пробег',
		'field' => yar_get_number_format( get_field( 'mileage' ) )
	],
	[
		'title' => 'Привод',
		'field' => get_field( 'wheel_drive' )
	],
	[
		'title' => 'Цвет',
		'field' => get_field( 'color' )
	],
];

?>

<div class="page-container container portfolio">
	<section class="section section--banner section--transparent">
		<?php get_template_part( 'inc/templates/breadcrumbs' ); ?>
		<div class="section__head">
			<h2 class="section__title section__title--white">Наши работы</h2>
		</div>
		<div class="portfolio__main">
			<?php if ( ! empty( $gallery ) ) { ?>
				<div class="portfolio__gallery portfolio-gallery">
					<div class="portfolio-gallery__swiper swiper">
						<div class="swiper-wrapper">
							<?php foreach ( $gallery as $item ) { ?>
								<div class="swiper-slide">
									<a href="<?= $item; ?>" class="portfolio-gallery__item" data-fancybox="gallery">
										<img src="<?= $item; ?>" alt="<?php the_title(); ?>">
									</a>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="swiper__pagination portfolio-gallery__pagination"></div>
				</div>
			<?php } ?>
			<div class="portfolio__content">
				<div class="portfolio__header">
					<h1 class="portfolio__title"><?php the_title(); ?></h1>
					<?php if ( $price ) { ?>
						<div class="portfolio__price"><?= yar_get_normal_price( $price ); ?> ₽</div>
					<?php } ?>
				</div>
				<?php if ( ! empty( $features ) ) { ?>
					<ul class="portfolio__features list-reset">
						<?php foreach ( $features as $feature ) {
							if ( empty( $feature['field'] ) ) {
								continue;
							} ?>
							<li class="cases__card-list-item">
								<span><?= $feature['title']; ?></span>
								<p><?= ( is_callable( $feature['field'] ) ? call_user_func( $feature['field'] ) : $feature['field'] ); ?></p>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
				<?php if ( $service || $deadline ) { ?>
					<div class="portfolio__service">
						<?php if ( $service ) { ?>
							<div class="portfolio__service-item">
								<p>Услуга: </p>
								<p><?= $service; ?></p>
							</div>
						<?php } ?>
						<?php if ( $deadline ) { ?>
							<div class="portfolio__service-item">
								<p>Время подбора: </p>
								<p><?= $deadline; ?></p>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php if ( $description ) { ?>
			<div class="portfolio__description">
				<?= $description; ?>
			</div>
		<?php } ?>
	</section>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/portfolio/related' ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/contacts' ); ?>
</div>

<?php get_footer(); ?>
