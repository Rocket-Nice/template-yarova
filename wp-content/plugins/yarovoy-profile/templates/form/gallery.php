<?php

$name     = yar_get_part_arg( $args, 'name' );
$data     = yar_get_part_arg( $args, 'data' );
$validate = yar_get_part_arg( $args, 'validate' );
$readonly = yar_get_part_arg( $args, 'readonly', false );

$tag = 'div';

$is_preview = get_query_var( 'profile/reports/preview' );
if ( $is_preview ) {
	$tag = 'a';
}


?>

<div class="profile-image" data-type="<?= $name; ?>">
	<div class="profile-image__item profile-settings__docs-item">
		<input
			type="file"
			name="<?= $name; ?>"
			multiple
			<?= isset( $validate['ext'] ) ? 'accept="' . implode( ',', $validate['ext'] ) . '"' : '' ?>
			data-validate='<?= json_encode( $validate ); ?>'
		>
	</div>
	<?php if ( ! empty( $data ) ) {
		foreach ( $data as $key => $item ) {
			?>
			<<?= $tag; ?> class="profile-image__item profile-settings__docs-item _selected"
				 style="background-image: url('<?= $item['url']; ?>')" data-image-key="<?= $key; ?>" data-image-id="<?= $item['id']; ?>" <?= ( $is_preview ? 'data-fancybox="' . $name . '" href="' . $item['url'] . '"' : '' ); ?>>

				<?php if ( ! $is_preview ){ ?>
					<button class="profile__icon-remove profile-image__remove"></button>
				<?php } ?>

				<?php if ( ! empty( $item['name'] ) ) { ?>
					<div class="profile-image__name"><?= $item['name']; ?></div>
				<?php } ?>
			</<?= $tag; ?>>
		<?php }
	} ?>
</div>
