<?php get_header( null, [ 'classes' => 'body--dark' ] ); ?>

<div class="page-container container blog blog__archive">
	<section class="section section--banner">
		<?php get_template_part( 'inc/templates/breadcrumbs' ); ?>
		<div class="section__head">
			<h1 class="section__title section__title--white">Читайте свежие новости</h1>
		</div>
		<?php get_template_part( YAR_THEME_TEMPLATES . '/vlog/menu', null, [
			'taxonomy' => 'blog_category',
			'type'     => 'blog'
		] ); ?>
		<div class="blog__body">
			<div class="blog__grid">
				<?php if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();

						get_template_part( YAR_THEME_TEMPLATES . '/blog/card' );
					}
				} else {
					get_template_part( YAR_THEME_TEMPLATES . '/not-found' );
				} ?>
			</div>
			<div class="blog__pagination pagination">
				<?php yar_pagination(); ?>
			</div>
		</div>
	</section>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/contacts' ); ?>
</div>

<?php get_footer(); ?>
