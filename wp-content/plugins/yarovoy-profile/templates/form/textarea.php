<?php

$classes     = yar_get_part_arg( $args, 'classes' );
$label       = yar_get_part_arg( $args, 'label' );
$name        = yar_get_part_arg( $args, 'name' );
$value       = yar_get_part_arg( $args, 'value' );
$placeholder = yar_get_part_arg( $args, 'placeholder' );
$readonly    = yar_get_part_arg( $args, 'readonly', false );


?>

<div class="input <?= $classes; ?>">
	<?php if ( $label ){ ?>
		<label for="<?= $name; ?>" class="input__label"><?= $label; ?></label>
	<?php } ?>
	<textarea  name="<?= $name; ?>" class="input__cell" placeholder="<?= $placeholder; ?>" <?= ( $readonly ? 'readonly' : '' ); ?>><?= $value; ?></textarea>
</div>
