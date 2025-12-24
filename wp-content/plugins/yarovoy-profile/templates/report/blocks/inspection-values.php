<?php

$fields   = yar_get_part_arg( $args, 'fields', [] );
$data     = yar_get_part_arg( $args, 'data', [] );
$title    = yar_get_part_arg( $args, 'title', '' );
$subtitle = yar_get_part_arg( $args, 'subtitle', '' );
$type     = yar_get_part_arg( $args, 'type', '' );
$inputs   = yar_get_part_arg( $args, 'inputs', '' );

?>

<div class="report-form__block report-form__inspection-values profile-form__block" data-type="<?= $type; ?>">
	<?php if ( $title ){ ?>
		<div class="report-form__title profile-form__block-title"><?= $title; ?></div>
	<?php } ?>
	<?php if ( $subtitle ){ ?>
		<div class="inspection__field-title"><?= $subtitle; ?></div>
	<?php } ?>
	<div class="report-form__fields">
		<?php if ( ! empty( $fields ) ){
			foreach ( $fields as $field ) {
				$find = false;

				if ( ! empty( $data ) ) {
					$find    = array_search( $field['slug'], array_column( $data, 'field_slug' ) );
					$comment = '';

					if ( $find !== false ) {
						$comment = $data[ $find ]['comment'];
					}
				}
				?>
				<div class="inspection__field" data-position="<?= $field['group']; ?>_<?= $field['slug']; ?>">
					<div class="inspection__field-title"><?= $field['order']; ?>. <?= $field['title']; ?></div>
						<?php if ( ! empty( $field['values'] ) ){ ?>
						<div class="inspection__field-inputs">
							<?php foreach ( $field['values'] as $value ) {
								$checked = false;

								if ( $find !== false && (int) $data[ $find ]['value'] === $value['value'] ) {
									$checked = true;
								}

								?>
								<div class="inspection__field-input">
									<input type="radio" name="<?= $field['group']; ?>_<?= $field['slug']; ?>_status" class="<?= $value['class']; ?>"
										   value="<?= $value['value']; ?>" <?= ( $checked ? 'checked' : '' ); ?>>
									<label for=""><?= $value['title']; ?></label>
								</div>
							<?php } ?>
						</div>
						<div class="inspection__field-comment inspection__field-textarea">
							<textarea class="input__cell" placeholder="Комментарии..."></textarea>
						</div>
					<?php } ?>
				</div>
			<?php }
		} ?>
	</div>
</div>
