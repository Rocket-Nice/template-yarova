<?php get_header( null, [ 'classes' => 'body--dark' ] ); ?>
	<div class="page-container container text__page">
		<section class="section section--banner">
			<?php get_template_part( YAR_THEME_TEMPLATES . '/breadcrumbs' ); ?>
			<div class="text__page-content">
				<h1 class="title white"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</section>
	</div>
<?php get_footer(); ?>