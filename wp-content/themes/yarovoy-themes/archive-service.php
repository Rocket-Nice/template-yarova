<?php get_header(); ?>

<div class="page-container container">
	<section class="section section--bg section--banner">
		<?php get_template_part( 'inc/templates/breadcrumbs' ); ?>
		<div class="section__head text-center">
			<h2 class="section__title"><?= post_type_archive_title(); ?></h2>
		</div>
		<div class="section__img-bg--wrap anim-elem"><img class="section__img-bg" src="<?= YAR_THEME_ASSETS; ?>/img/content/banner/services-bg.png" width="1920" height="2822" alt="Услуги"></div>
		<div class="services anim-elem">
			<div class="services__row">
				<?php if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();

						get_template_part( YAR_THEME_TEMPLATES . '/service/card' );
					}
				} else {
					get_template_part( YAR_THEME_TEMPLATES . '/not-found' );
				} ?>
			</div>
		</div>
	</section>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/faq-default' ); ?>
</div>

<?php get_footer(); ?>
