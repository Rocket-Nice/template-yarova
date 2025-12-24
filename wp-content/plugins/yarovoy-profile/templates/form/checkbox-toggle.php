<?php

$id       = yar_get_part_arg( $args, 'id' );
$name     = yar_get_part_arg( $args, 'name' );
$value    = yar_get_part_arg( $args, 'value' );
$label    = yar_get_part_arg( $args, 'label' );
$is_green = yar_get_part_arg( $args, 'is_green', false );
$checked  = yar_get_part_arg( $args, 'checked', false );
$readonly = yar_get_part_arg( $args, 'readonly', false );

?>

<div class="checkbox__custom <?= ( $is_green ? '_green' : '' ); ?>" <?= ( $id ? 'data-id="' . $id . '"' : '' ); ?>>
	<div class="checkbox__custom-icon">
		<img src="<?= YAR_PROFILE_URL . 'assets/img/completion/' . $name . '.svg'; ?>" alt="">
	</div>
	<input class="checkbox__custom-input" type="checkbox" name="<?= $name; ?>" value="1" <?= ( $checked ? 'checked' : '' ); ?> <?= ( $readonly ? 'disabled' : '' ); ?>>
	<label class="checkbox__custom-label" for="<?= $name; ?>"><?= $label; ?></label>
	<div class="checkbox__custom-toggle"></div>
</div>
