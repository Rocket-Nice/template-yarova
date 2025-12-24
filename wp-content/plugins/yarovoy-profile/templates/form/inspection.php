<?php

$id       = yar_get_part_arg( $args, 'id' );
$name     = yar_get_part_arg( $args, 'name' );
$title    = yar_get_part_arg( $args, 'label' );
$order    = yar_get_part_arg( $args, 'order' );
$weight   = yar_get_part_arg( $args, 'with_weight', false );
$readonly = yar_get_part_arg( $args, 'readonly', false );

// If value is not empty
$status    = (int) yar_get_part_arg( $args, 'value' );
$thickness = (int) yar_get_part_arg( $args, 'thickness' );
$comment   = yar_get_part_arg( $args, 'comment' );

?>


<div class="inspection__field" data-inpection-id="<?= $id; ?>" data-position="<?= $name; ?>">
	<div class="inspection__field-title"><?= $order; ?>. <?= $title; ?></div>
	<div class="inspection__field-inputs">
		<div class="inspection__field-input">
			<input type="radio" name="<?= $name; ?>_status" class="_ok" value="1" <?= ( $status && $status === 1 ? 'checked' : '' ); ?> <?= ( $readonly ? 'disabled' : '' ); ?>>
			<label for="">Все хорошо</label>
		</div>
		<div class="inspection__field-input">
			<input type="radio" name="<?= $name; ?>_status" class="_fail" value="2" <?= ( $status && $status === 2 ? 'checked' : '' ); ?> <?= ( $readonly ? 'disabled' : '' ); ?>>
			<label for="">Есть замечания</label>
		</div>
		<?php if ( $weight ){ ?>
			<div class="inspection__field-input">
				<input type="number" class="input__cell" name="weight" placeholder="Толщина покрытия" <?= ( $thickness ? 'value="' . $thickness . '"' : '' ); ?> <?= ( $readonly ? 'readonly' : '' ); ?>>
			</div>
		<?php } ?>
	</div>
	<div class="inspection__field-comment inspection__field-textarea">
		<textarea class="input__cell" placeholder="Комментарии..." <?= ( $readonly ? 'readonly' : '' ); ?>><?= ( $comment ? $comment : '' ); ?></textarea>
	</div>
</div>