<?php

$title   = isset( $args['title'] ) ? $args['title'] : '';
$type    = isset( $args['type'] ) ? $args['type'] : '';
$counter = isset( $args['counter'] ) ? $args['counter'] : '';

?>

<div class="admin-report-inspection__field" data-summary-type="<?= $type; ?>">
	<div class="admin-report-field__title admin-report-inspection__field-title"><?= $counter; ?>. <?= $title; ?></div>
	<div class="admin-report-inspection__field-inputs">
		<?php if ( $type === 'summary_recommendations' ){ ?>
			<div class="admin-report-inspection__field-input admin-report-inspection__radio">
				<input type="radio" class="_ok" name="<?= $type; ?>" value="Рекомендуется к покупке">
				<label>Рекомендуется к покупке</label>
			</div>
			<div class="admin-report-inspection__field-input admin-report-inspection__radio">
				<input type="radio" class="_fail" name="<?= $type; ?>" value="Не рекомендуется к покупке">
				<label>Не рекомендуется к покупке</label>
			</div>
		<?php } else { ?>
			<div class="admin-report-inspection__field-input admin-report-inspection__radio">
				<input type="radio" class="_ok" name="<?= $type; ?>" value="5">
				<label>5</label>
			</div>
			<div class="admin-report-inspection__field-input admin-report-inspection__radio">
				<input type="radio" class="_ok" name="<?= $type; ?>" value="4">
				<label>4</label>
			</div>
			<div class="admin-report-inspection__field-input admin-report-inspection__radio">
				<input type="radio" class="_middle" name="<?= $type; ?>" value="3">
				<label>3</label>
			</div>
			<div class="admin-report-inspection__field-input admin-report-inspection__radio">
				<input type="radio" class="_fail" name="<?= $type; ?>" value="2">
				<label>2</label>
			</div>
			<div class="admin-report-inspection__field-input admin-report-inspection__radio">
				<input type="radio" class="_fail" name="<?= $type; ?>" value="1">
				<label>1</label>
			</div>
		<?php } ?>
	</div>
	<div class="admin-report-meta__field-comment admin-report__field-textarea">
		<textarea placeholder="Комментарии..."></textarea>
	</div>
</div>
