<?php

$name    = yar_get_part_arg( $args, 'name' );
$type    = yar_get_part_arg( $args, 'type' );
$list    = yar_get_part_arg( $args, 'list' );
$value   = yar_get_part_arg( $args, 'value' );
$text    = yar_get_part_arg( $args, 'text' );
$exclude = yar_get_part_arg( $args, 'exclude' );
$fill    = yar_get_part_arg( $args, 'fill' );
$classes = yar_get_part_arg( $args, 'classes' );

if ( empty( $list ) && ! $exclude  ) {
	return '';
}

?>

<div class="input <?= ( $classes ? $classes : '' ) ?>">
	<select class="input__cell" name="<?= $name; ?>" <?= ( $fill ? 'data-fill="' . $fill . '"' : '' ); ?>>
		<option disabled="" selected=""><?= $text; ?></option>
		<?php foreach ( $list as $item ) { ?>
			<option value="<?= $item['parameter_current_id']; ?>"><?= $item['parameter_value']; ?></option>
		<?php } ?>
	</select>
</div>
