<?php get_header(); /* TEMPLATE NAME: Профиль: Отчеты - форма */

if (
	! is_user_logged_in()
	|| ! defined( 'YAR_PROFILE_DIR' )
	|| ! isset( $_GET['report_id'] )
	|| ! yar_check_report_id( $_GET['report_id'] )
) {
	return '';
}

?>

<section class="section section--banner banner--dark">
	<div class="container">
		<?php get_template_part( YAR_THEME_TEMPLATES . '/breadcrumbs' ); ?>
	</div>
</section>

<div class="profile profile-report">
	<div class="container profile__container">
		<h1 class="profile__title">Личный кабинет Специалиста</h1>
		<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/expert/menu' ); ?>

		<?php load_template( YAR_PROFILE_DIR . 'templates/report/form.php' ); ?>
	</div>
</div>

<?php get_template_part( YAR_THEME_TEMPLATES . '/profile/modals/message' ); ?>

<?php get_footer(); ?>
