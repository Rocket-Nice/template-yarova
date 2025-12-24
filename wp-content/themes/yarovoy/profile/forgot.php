<?php get_header(); /* TEMPLATE NAME: Забыли пароль? */ ?>

<section class="section section--banner banner--dark">
	<div class="container">
		<?php get_template_part( YAR_THEME_TEMPLATES . '/breadcrumbs' ); ?>
	</div>
</section>

<?php load_template( YAR_PROFILE_TEMPLATES . '/common/forgot.php' ); ?>

<?php get_footer(); ?>
