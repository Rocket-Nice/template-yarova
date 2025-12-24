<?php

$title = yar_get_part_arg( $args, 'title' );
$value = yar_get_part_arg( $args, 'value' );

?>

<div class="pug__field">
	<div class="pug__field-title"><?= $title; ?></div>
	<div class="pug__field-input"><?= $value; ?></div>
</div>