<?php

$colors = yar_get_part_arg( $args, 'block' );
$data   = yar_get_part_arg( $args, 'data' );

if ( empty( $colors[0]['params'] ) ) {
	return '';
}

?>

<div class="colors__select">
	<div class="colors__select-title upload-car__subtitle">Цвет:</div>
	<div class="colors__select-list">
		<?php foreach ( $colors[0]['params'] as $key => $color ) {
			$checked = false;

			if ( ! empty( $data['color'] ) ) {
				$checked = $data['color']['checked_label'] === $color['label'];
			}

			?>
			<div class="colors__select-item _<?= $color['label']; ?> <?= ( isset( $color['border'] ) ? '_border' : '' ); ?>"
				 style="--color: <?= $color['color']; ?>;">
				<input type="radio" name="color" value="<?= $color['label']; ?>" <?= ( $key === 0 || $checked ? 'checked' : '' ); ?>>
				<label>
					<svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.42578 4.73078L7.25 10.5565L16.5721 1.23438" stroke="black" stroke-width="2" />
					</svg>
				</label>
			</div>
		<?php } ?>
	</div>
</div>
