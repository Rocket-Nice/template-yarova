<?php

$name = yar_get_part_arg( $args, 'name' );
$text = yar_get_part_arg( $args, 'text' );

?>

<div class="upload-car__checkboxes-item">
	<input type="checkbox" name="<?= $name; ?>" value="1">
	<span></span>
	<label for="<?= $name; ?>"><?= $text; ?></label>
</div>