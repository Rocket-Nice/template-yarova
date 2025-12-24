<?php get_header(); /* TEMPLATE NAME: Профиль: Отчеты - запись */

if (
	! is_user_logged_in()
	|| ! yar_is_client()
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

<?php load_template( YAR_PROFILE_TEMPLATES . '/report-single/form.php' ); ?>

<?php get_footer(); ?>
