<?php get_header();

$open_popup  = get_field('open_popup');
$price       = get_field('price');
$price_old   = get_field('price_old');
$description = get_field('single_description');
$image       = get_field('image');

?>

<div class="page-container container">
	<section class="section section--banner single-service__banner">
		<?php get_template_part('inc/templates/breadcrumbs'); ?>
		<div class="banner">
			<?php if ($image) { ?>
				<div class="banner__bg">
					<img class="banner__bg-img"
						src="<?= $image; ?>" width="1920"
						height="978" alt="<?php the_title(); ?>">
				</div>
			<?php } ?>
			<div class="banner__body">
				<div class="banner__info <?= get_field("text_ul_all_width") ? "banner__info--single-service-ul" : ""; ?>">
					<h1 class="banner__title"><?php the_title(); ?></h1>
					<?= $description; ?>
				</div>
				<div class="banner__nav"><a class="btn btn--accent btn--big banner__nav-btn" aria-label="Open modal" data-popup="popup-feedback">Оставить заявку</a>
					<?php if ($price !== '' || $price_old) { ?>
						<div class="price banner__price">
							<?php if ($price_old) { ?>
								<div class="price__old"><?= $price_old; ?> &#8381;</div>
							<?php } ?>
							<?php if ($price) { ?>
								<div class="price__current">
									<?= (get_field("price_before")) ? get_field("price_before") : ''; ?>
									<?= number_format($price, 0, ',', ' '); ?> &#8381;
								</div>
							<?php } elseif ($price == '0') { ?>
								<div class="price__current _null">Оплата договорная</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/service/garanty'); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/about'); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/service/how'); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/service/coop'); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/how-works'); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/yandex-reviews'); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/feedback'); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/faq', null, []); ?>

	<?php get_template_part(YAR_THEME_TEMPLATES . '/common_sections/contacts'); ?>
</div>

<?php get_footer(); ?>