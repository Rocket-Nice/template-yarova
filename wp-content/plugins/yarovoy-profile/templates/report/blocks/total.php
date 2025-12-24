<?php

$total = yar_get_part_arg( $args, 'total' );

?>

<div class="report-form__block report-form__summary profile-form__block" data-type="total">
	<div class="report-form__fields">
		<div class="inspection__field inspection__field--summary" data-exclude="true" data-total>
			<div class="inspection__field-title">6. Итоговые рекомендации</div>
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
