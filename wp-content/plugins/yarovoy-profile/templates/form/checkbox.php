<?php

$class   = yar_get_part_arg( $args, 'class', '' );
$name    = yar_get_part_arg( $args, 'name', '' );
$value   = yar_get_part_arg( $args, 'value', '' );
$title   = yar_get_part_arg( $args, 'title', '' );
$checked = yar_get_part_arg( $args, 'checked', false );

$is_array = yar_get_part_arg( $args, 'is_array', false );

if ( $is_array ){
	$name = $name . '[]';
}

?>

<div class="<?= $class; ?> checkbox__field">
	<input class="checkbox__field-input" type="checkbox" name="<?= $name; ?>" value="<?= $value; ?>" <?= ( $checked ? 'checked' : '' ); ?>>
	<span  class="checkbox__field-icon"></span>
	<label for="<?= $name; ?>" class="checkbox__field-label"><?= $title; ?></label>
</div>