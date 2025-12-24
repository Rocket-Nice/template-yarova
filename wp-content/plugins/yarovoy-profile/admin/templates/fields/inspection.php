<?php

$title    = isset( $args['title'] ) ? $args['title'] : '';
$position = isset( $args['position'] ) ? $args['position'] : '';
$order    = isset( $args['order'] ) ? $args['order'] : '';
$weight   = isset( $args['weight'] ) ? $args['weight'] : false;

?>

<div class="admin-report-inspection__field" data-position="<?= $position; ?>">
	<div class="admin-report-field__title admin-report-inspection__field-title"><?= $order; ?>. <?= $title; ?></div>
	<div class="admin-report-inspection__field-inputs">
		<div class="admin-report-inspection__field-input admin-report-inspection__radio">
			<input type="radio" name="status" class="_ok" value="1">
			<label for="">Все хорошо</label>
		</div>
		<div class="admin-report-inspection__field-input admin-report-inspection__radio">
			<input type="radio" name="status" class="_fail" value="1">
			<label for="">Есть замечания</label>
		</div>
		<?php if ( $weight ){ ?>
			<div class="admin-report-inspection__field-input admin-report__field-text">
				<input type="text" name="weight" placeholder="Толщина покрытия">
			</div>
		<?php } ?>
	</div>
	<div class="admin-report-meta__field-comment admin-report__field-textarea">
		<textarea name="comment" placeholder="Комментарии..."></textarea>
	</div>
</div>