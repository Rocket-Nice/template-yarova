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
			foreach ( $fields as $field ) { ?>
				<div class="inspection__field" data-position="<?= $field['name']; ?>">
					<div class="inspection__field-title"><?= $field['order']; ?>. <?= $field['label']; ?></div>
					<?php if ( ! empty( $field['values'] ) ){ ?>
						<div class="inspection__field-inputs">
							<?php foreach ( $field['values'] as $value ) {
								$checked = false;

								if ( isset( $field['value'] ) && (int) $field['value'] === (int) $value['value'] ) {
									$checked = true;
								}

								?>
								<div class="inspection__field-input">
									<input type="radio" name="<?= $field['name']; ?>_status" class="<?= $value['class']; ?>"
									       value="<?= $value['value']; ?>" <?= ( $checked ? 'checked' : '' ); ?>
									<?= ( isset( $field[ 'readonly' ] ) && $field[ 'readonly' ] ? 'disabled' : '' ); ?>>
									<label for=""><?= $value['title']; ?></label>
								</div>
							<?php } ?>
						</div>
						<div class="inspection__field-comment inspection__field-textarea">
							<textarea class="input__cell" placeholder="Комментарии..." <?= ( isset( $field[ 'readonly' ] ) && $field[ 'readonly' ] ? 'readonly' : '' ); ?>><?= isset( $field['comment'] ) ? $field['comment'] : ''; ?></textarea>
						</div>
					<?php } ?>
				</div>
			<?php }
		} ?>
	</div>
</div>
