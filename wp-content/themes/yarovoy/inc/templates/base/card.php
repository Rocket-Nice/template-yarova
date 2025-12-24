<?php

$classes = yar_get_part_arg( $args, 'classes' );
$button  = yar_get_part_arg( $args, 'button' );

$image = get_the_post_thumbnail_url( get_the_ID() );

$price = get_field( 'price' );

$report      = get_field( 'report' );
$report_from = get_field( 'report_from' );

$generation = get_base_feature( 'Поколение' );
$year       = get_base_feature( 'Год выпуска' );
$miliage    = get_base_feature( 'Пробег' );
$engine     = get_base_feature( 'Двигатель' );
$kpp        = get_base_feature( 'КПП' );
$drive      = get_base_feature( 'Привод' );
$color      = get_base_feature( 'Цвет автомобиля' );

?>

<div class="hotoffer__card <?= $classes; ?>">
	<div class="hotoffer__card-body">
		<a href="<?php the_permalink(); ?>" class="hotoffer__card-img--wrap">
			<?php if ( has_post_thumbnail() ) { ?>
				<img class="hotoffer__card-img" src="<?= $image; ?>"
					 width="571" height="428" alt="<?php the_title(); ?>">
			<?php } ?>
			<div class="hotoffer__card-title">
				<div class="link-white">
					<?php the_title() ?> <?= ( $year ? ', ' . $year : '' ); ?>
				</div>
			</div>
			<?php if ( $report || $report_from ){ ?>
				<div class="hotoffer__card-report">
					Автомобиль проверен
				</div>
			<?php } ?>
		</a>
		<div class="hotoffer__card-content">
			<div class="hotoffer__card-info">
				<div class="hotoffer__card-list list-reset">
					<?php if ( $generation ) { ?>
						<li><?= $generation; ?></li>
					<?php } ?>
					<?php if ( $miliage ) { ?>
						<li><?= yar_get_normal_price( $miliage ); ?> км</li>
					<?php } ?>
					<?php if ( $engine ) { ?>
						<li><?= $engine; ?></li>
					<?php } ?>
					<?php if ( $kpp ) { ?>
						<li><?= $kpp; ?></li>
					<?php } ?>
					<?php if ( $drive ) { ?>
						<li><?= $drive; ?></li>
					<?php } ?>
					<?php if ( $color ) { ?>
						<li><?= $color; ?></li>
					<?php } ?>
				</div>
			</div>
			<?php if ( $price ) { ?>
				<div class="hotoffer__card-nav">
					<div class="price hotoffer__card-price">
						<div class="price__current"><?= yar_get_normal_price( $price ); ?> &#8381;</div>
					</div>
				</div>
			<?php } ?>
			<?php if ( $button ){ ?>
				<button class="hotoffer__card-btn btn btn--wide btn--accent" data-popup="popup-feedback">Оставить заявку</button>
			<?php } ?>
		</div>
	</div>
</div>
