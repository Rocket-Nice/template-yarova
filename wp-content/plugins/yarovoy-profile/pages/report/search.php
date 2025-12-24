<?php get_header(); ?>

<section class="section section--banner banner--dark">
	<div class="container">
	</div>
</section>

<div class="profile profile-report-search">
	<div class="container profile__container">
		<?php

		yar_plugin_get_template( 'common/page-header' );

		?>

		<div class="profile-report-search__form form">
			<?php

			yar_plugin_get_template( 'form/text', [
				'label'       => '',
				'name'        => 'search',
				'value'       => '',
				'placeholder' => 'Поиск',
			], false );

			?>

			<?php wp_nonce_field( 'yar_profile_search_report' ); ?>

			<button class="profile-report-search__btn btn btn--big btn--accent btn--loader">Найти</button>
		</div>

		<div class="profile-report-search__list"></div>
	</div>
</div>

<?php yar_plugin_get_template( 'modals/message' ); ?>

<?php get_footer(); ?>
