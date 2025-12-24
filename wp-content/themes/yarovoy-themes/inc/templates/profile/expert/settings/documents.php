<?php

$documents = get_field( 'documents', 'user_' . get_current_user_id() );

?>

<div class="profile-form__block profile-settings__docs">
	<div class="profile-form__block-title">Документы эксперта</div>
	<div class="profile-form__block-grid profile-image" data-type="documents">
		<div class="profile-image__item profile-settings__docs-item">
			<input type="file" name="documents">
		</div>
		<?php if ( ! empty( $documents ) ) {
			foreach ( $documents as $key => $item ) { ?>
				<div class="profile-image__item profile-settings__docs-item _selected"
					 style="background-image: url('<?= $item['url']; ?>')" data-image-key="<?= $key; ?>" data-image-id="<?= $item['id']; ?>">
					<button class="profile__icon-remove profile-image__remove"></button>
				</div>
			<?php }
		} ?>
	</div>
</div>