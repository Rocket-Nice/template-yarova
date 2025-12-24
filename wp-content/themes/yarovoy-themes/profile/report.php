<?php get_header(); /* TEMPLATE NAME: Профиль: Отчеты */

if ( ! is_user_logged_in() || ! defined( 'YAR_PROFILE_TEMPLATES' ) ) {
	return '';
}

?>

<section class="section section--banner banner--dark">
	<div class="container">
		<?php get_template_part( YAR_THEME_TEMPLATES . '/breadcrumbs' ); ?>
	</div>
</section>

<?php load_template( YAR_PROFILE_TEMPLATES . '/report/list.php' ); ?>

<?php get_footer(); ?>
