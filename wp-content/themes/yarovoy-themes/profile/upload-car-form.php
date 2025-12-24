<?php get_header(); /* TEMPLATE NAME: Профиль: Загрузить своё авто (добавить) */

if (
	! is_user_logged_in()
	|| ! yar_is_client()
	|| ! defined( 'YAR_PROFILE_DIR' )
) {
	return '';
}


?>

<section class="section section--banner banner--dark">
	<div class="container">
		<?php get_template_part( YAR_THEME_TEMPLATES . '/breadcrumbs' ); ?>
	</div>
</section>

<?php load_template( YAR_PROFILE_TEMPLATES . '/upload-car/form.php' ); ?>

<?php get_footer(); ?>
