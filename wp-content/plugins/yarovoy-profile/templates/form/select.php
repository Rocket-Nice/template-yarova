<?php

$name     = yar_get_part_arg( $args, 'name' );
$label    = yar_get_part_arg( $args, 'label' );
$type     = yar_get_part_arg( $args, 'type' );
$options  = yar_get_part_arg( $args, 'options' );
$value    = yar_get_part_arg( $args, 'value' );
$text     = yar_get_part_arg( $args, 'text' );
$classes  = yar_get_part_arg( $args, 'classes' );
$fill     = yar_get_part_arg( $args, 'fill' );
$exclude  = yar_get_part_arg( $args, 'exclude' );
$readonly = yar_get_part_arg( $args, 'readonly', false );

$is_text_value = yar_get_part_arg( $args, 'is_text_value' );
if ( $is_text_value ) {
	$value = (string) $value;
} else {
	$value = (int) $value;
}

if ( empty( $options ) && ! $exclude ) {
	return '';
}

?>

<div class="input <?= ( $classes ? $classes : '' ) ?>">
	<?php if ( $label ){ ?>
		<label for="<?= $name; ?>" class="input__label"><?= $label; ?></label>
	<?php } ?>
	<select class="input__cell" name="<?= $name; ?>" <?= ( $fill ? 'data-fill="' . $fill . '"' : '' ); ?> <?= ( $readonly ? 'disabled' : '' ); ?>>
		<option value="" selected=""><?= ( $text ? $text : 'Выбрать' ); ?></option>
		<?php if ( ! empty( $options ) ) {
			foreach ( $options as $key => $item ) { ?>
				<option value="<?= $key; ?>" <?= ( $value !== '' && $value === $key ? 'selected' : '' ); ?>><?= $item; ?></option>
			<?php }
		} ?>
	</select>
</div>
