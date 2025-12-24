<?php

$open_popup  = get_field('open_popup');
$price       = get_field('price');
$price_old   = get_field('price_old');
$description = get_field('description');

?>

<div class="services__card">
	<div class="services__card--wrap">
		<div class="services__card-info">
			<div class="services__card-head">
				<div class="services__title-and-arrow">
					<div class="services__card-title"><?php the_title(); ?></div>
					<svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 6L10 15" stroke="white" stroke-width="2" stroke-linecap="round" />
						<path d="M19 6L10 15" stroke="white" stroke-width="2" stroke-linecap="round" />
					</svg>
				</div>

				<?php if ($price_old || $price !== '') { ?>
					<div class="price services__card-price">
						<?php if ($price_old) { ?>
							<div class="price__old"><?= yar_get_normal_price($price_old); ?> &#8381;</div>
						<?php } ?>
						<?php if ($price) { ?>
							<div class="price__current">
								<?= (get_field("price_before")) ? get_field("price_before") : ''; ?>
								<?= yar_get_normal_price($price); ?> &#8381;
							</div>
						<?php } elseif ($price == '0') { ?>
							<div class="price__current">Оплата договорная</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="services__card-text">
				<div class="services__card-description">
					<?= $description; ?>
				</div>
				<div class="services__card-nav service-card--mob-btn">
					<a class="btn btn--accent btn--big services__card-btn" <?= ($open_popup ? 'data-popup="popup-feedback"' : ''); ?> href="<?= ($open_popup ? '#' : get_the_permalink()); ?>">
						Подробнее
					</a>
				</div>
			</div>
		</div>
		<div class="services__card-nav service-card--desk-btn">
			<a class="btn btn--accent btn--big services__card-btn" <?= ($open_popup ? 'data-popup="popup-feedback"' : ''); ?> href="<?= ($open_popup ? '#' : get_the_permalink()); ?>">
				Подробнее
			</a>
		</div>
	</div>
</div>