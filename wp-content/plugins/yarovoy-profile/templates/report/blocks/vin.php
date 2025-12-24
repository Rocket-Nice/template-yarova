<?php

$fields  = yar_get_part_arg( $args, 'fields' );;
$counter = 1;

$data  = yar_get_part_arg( $args, 'data' );
$total = yar_get_part_arg( $args, 'total' );

$inputs = [
	[
		'value' => 5,
		'class' => '_ok'
	],
	[
		'value' => 4,
		'class' => '_ok'
	],
	[
		'value' => 3,
		'class' => '_middle'
	],
	[
		'value' => 2,
		'class' => '_fail'
	],
	[
		'value' => 1,
		'class' => '_fail'
	],
];

?>

<div class="report-form__block report-form__summary profile-form__block" data-type="vin_view">
	<div class="report-form__title profile-form__block-title">Осмотр VIN номера</div>
	<div class="report-form__fields">
		<?php if ( ! empty( $fields ) ){
			foreach ( $fields as $key => $field ) {
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
					<div class="inspection__field-title"><?= $counter; ?>. <?= $field['title']; ?></div>
					<div class="inspection__field-inputs">
						<?php foreach ( $inputs as $input ) {
							$checked = false;

							if ( $find !== false && (int) $data[ $find ]['value'] === $input['value'] ) {
								$checked = true;
							}

							?>
							<div class="inspection__field-input">
								<input type="radio" name="<?= $field['group']; ?>_<?= $field['slug']; ?>_status" class="<?= $input['class']; ?>"
								       value="<?= $input['value']; ?>" <?= ( $checked ? 'checked' : '' ); ?>> <label for=""><?= $input['value']; ?></label>
							</div>
						<?php } ?>
					</div>
					<div class="inspection__field-comment inspection__field-textarea">
						<textarea class="input__cell" placeholder="Комментарии..."><?= $comment; ?></textarea>
					</div>
				</div>
				<?php $counter++; }
		} ?>
		<div class="inspection__field inspection__field--summary" data-exclude="true" data-total>
			<div class="inspection__field-title"><?= $counter; ?>. Итоговые рекомендации</div>
			<div class="inspection__field-inputs">
				<div class="inspection__field-input">
					<input type="radio" name="total" class="_ok"
					       value="1" <?= ( ! empty( $total ) && (int) $total['total'] === 1 ? 'checked' : '' ); ?>>
					<label for="is_recommend">Рекомендуется к покупке</label>
				</div>
				<div class="inspection__field-input">
					<input type="radio" name="total" class="_fail"
					       value="2" <?= ( ! empty( $total ) && (int) $total['total'] === 2 ? 'checked' : '' ); ?>>
					<label for="is_recommend">Не рекомендуется к покупке</label>
				</div>
			</div>
			<div class="inspection__field-comment inspection__field-textarea input">
				<textarea class="input__cell" name="total_comment" placeholder="Комментарии..."><?= ( ! empty( $total ) && $total['total_comment'] ? $total['total_comment'] : '' ); ?></textarea>
			</div>
		</div>
	</div>
</div>
