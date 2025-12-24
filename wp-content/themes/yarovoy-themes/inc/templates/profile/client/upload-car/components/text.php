<?php

$name  = yar_get_part_arg( $args, 'name' );
$type  = yar_get_part_arg( $args, 'type' );
$value = yar_get_part_arg( $args, 'value' );
$text  = yar_get_part_arg( $args, 'text' );

?>

<div class="input">
	<input type="<?= $type; ?>" class="input__cell" name="<?= $name; ?>" placeholder="<?= $text; ?>" value="<?= ( $value ? $value : '' ); ?>">
</div>