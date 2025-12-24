<?php get_header(); ?>

<section class="section section--banner banner--dark">
	<div class="container">

	</div>
</section>

<div class="profile profile-report">
	<div class="container profile__container">
		<?php

		yar_plugin_get_template( 'common/page-header' );

		yar_plugin_get_template( 'report/form' );

		?>
	</div>
</div>

<?php get_footer(); ?>
