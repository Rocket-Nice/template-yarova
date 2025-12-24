<?php

$portfolio = get_field( 'portfolio', 'user_' . get_current_user_id() );

?>

<div class="profile-form__block profile-settings__portfolio">
	<div class="profile-form__block-title">Портфолио</div>
	<div class="profile-form__block-grid profile-image" data-type="portfolio">
		<div class="profile-image__item profile-settings__docs-item">
			<input type="file" name="portfolio">
		</div>
		<?php if ( ! empty( $portfolio ) ) {
			foreach ( $portfolio as $key => $item ) { ?>
				<div class="profile-image__item profile-settings__docs-item _selected"
					 style="background-image: url('<?= $item['url']; ?>')" data-image-key="<?= $key; ?>" data-image-id="<?= $item['id']; ?>">
					<button class="profile__icon-remove profile-image__remove"></button>
				</div>
			<?php }
		} ?>
	</div>
</div>