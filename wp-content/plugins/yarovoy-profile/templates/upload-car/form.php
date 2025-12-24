<?php

$is_work = false;
if ( ! $is_work ){
	return '';
}

$data = [];
$id   = get_query_var( 'profile/upload-car/edit' );

if ( ! empty( $id ) ){
	$data = ( new YAR_Car_Repository() )->get_car( $id );
}

$fields = new YAR_Car_Fields_Repository();

$steps = $fields->get_steps();
$menu  = $fields->get_menu();

$first_menu = array_key_first( $menu );
$first_step = array_key_first( $steps );

?>

<div class="profile profile-upload__car">
	<div class="container profile__container">
		<?php load_template( YAR_PROFILE_TEMPLATES . '/common/page-header.php' ); ?>

		<div class="upload-car__steps form">
			<div class="upload-car__menu">
				<?php foreach ( $menu as $key => $item ) { ?>
					<button class="upload-car__menu-item <?= ( $key === $first_menu ? '_active' : '' ); ?>" data-id="<?= $key; ?>"><?= $item; ?></button>
				<?php } ?>
			</div>
			<div class="upload-car__form">
				<?php foreach ( $steps as $key => $step ) { ?>
					<div class="upload-car__step <?= ( $key === $first_step ? '_active' : '' ); ?>" data-id="<?= $key; ?>">
						<?php foreach ( $step['blocks'] as $block_key => $block ) {
							$template = YAR_PROFILE_TEMPLATES . '/upload-car/blocks/' . $block_key . '.php';

							if ( file_exists( $template ) ) {
								load_template( $template, false, [
									'block'    => $block,
									'settings' => $step['settings'],
									'data'     => $data
								] );
							}
						}

						load_template( YAR_PROFILE_TEMPLATES . '/upload-car/blocks/actions.php', false, [
							'step' => $key
						] );

						?>
					</div>
				<?php } ?>


				<?php if ( ! empty( $id ) ){ ?>
					<input type="hidden" name="car_id" value="<?= $id; ?>">
					<input type="hidden" name="car_action" value="edit">

					<?php wp_nonce_field( 'yar_client_update_car', '_nonce' ); ?>
				<?php } else {
					wp_nonce_field( 'yar_client_save_car', '_nonce' );
				} ?>
			</div>
		</div>
	</div>
</div>

<?php load_template( YAR_PROFILE_TEMPLATES . '/modals/message.php' ); ?>