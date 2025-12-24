<?php

$open_popup  = get_field( 'open_popup' );
$price       = get_field( 'price' );
$price_old   = get_field( 'price_old' );
$description = get_field( 'description' );

?>

<div class="services__card">
	<div class="services__card--wrap">
		<div class="services__card-info">
			<div class="services__card-head">
				<div class="services__card-title"><?php the_title(); ?></div>
				<?php if ( $price_old || $price !== '' ) { ?>
					<div class="price services__card-price">
						<?php if ( $price_old ) { ?>
							<div class="price__old"><?= yar_get_normal_price( $price_old ); ?> &#8381;</div>
						<?php } ?>
						<?php if ( $price) { ?>
							<div class="price__current"><?= yar_get_normal_price( $price ); ?> <?= is_numeric($price) ? "&#8381;" : ''; ?></div>
						<?php } elseif ( $price == '0' ) { ?>
							<div class="price__current">Оплата договорная</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="services__card-text">
				<?= $description; ?>
			</div>
		</div>
		<div class="services__card-nav">
			<a class="btn btn--accent btn--big services__card-btn" <?= ( $open_popup ? 'data-popup="popup-feedback"' : '' ); ?> href="<?= ( $open_popup ? '#' : get_the_permalink() ); ?>">
				Подробнее
			</a>
		</div>
	</div>
</div>
