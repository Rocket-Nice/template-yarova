<?php get_header(); ?>

<section class="section section--banner banner--dark">
	<div class="container">
	</div>
</section>

<?php yar_plugin_get_template( 'report-single/form', false, [
		'report_id' => get_query_var( 'profile/search-report-view' )
] ); ?>

<?php get_footer(); ?>
