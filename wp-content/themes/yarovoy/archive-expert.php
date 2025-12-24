<?php get_header( null, [ 'classes' => 'body--dark' ] ); ?>

<div class="page-container container experts">
	<section class="section section--banner">
		<?php get_template_part( 'inc/templates/breadcrumbs' ); ?>
		<div class="section__head">
			<h1 class="section__title section__title--white"><?= post_type_archive_title(); ?></h1>
		</div>
		<div class="experts__grid">
			<?php if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					get_template_part( YAR_THEME_TEMPLATES . '/expert/card' );
				}
			} else {
				get_template_part( YAR_THEME_TEMPLATES . '/not-found' );
			} ?>
		</div>
		<div class="experts__pagination pagination">
			<?php yar_pagination(); ?>
		</div>
	</section>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/contacts' ); ?>
</div>

<?php get_footer(); ?>
