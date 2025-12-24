<?php get_header(); /* TEMPLATE NAME: Профиль: безопасность и уведомления */

if ( ! is_user_logged_in() || ! yar_is_expert() || ! defined( 'YAR_PROFILE_TEMPLATES' ) ) {
	return '';
}

?>

<section class="section section--banner banner--dark">
	<div class="container">
		<?php get_template_part( YAR_THEME_TEMPLATES . '/breadcrumbs' ); ?>
	</div>
</section>

<?php load_template( YAR_PROFILE_TEMPLATES . '/security/form.php' ); ?>

<?php get_footer(); ?>
