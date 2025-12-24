<?php

$title    = yar_get_part_arg( $args, 'title' );
$name     = yar_get_part_arg( $args, 'name' );
$validate = yar_get_part_arg( $args, 'validate' );
$value    = yar_get_part_arg( $args, 'value' );

?>

<div class="file__field <?= ( ! empty( $value['url'] ) ? '_loaded' : '' ); ?>" data-title="<?= $title; ?>">
	<input class="file__field-input"
		   type="file" id="field_file_<?= $name; ?>"
		   name="<?= $name; ?>"
		<?= ( ! empty( $validate['ext'] ) ? 'accept="' . implode( ', ', $validate['ext'] ) . '"' : '' ) ?>
		   data-validate='<?= ( $validate ? json_encode( $validate ) : '' ) ?>'
	> <label class="file__field-label" for="field_file_<?= $name; ?>">
		<span>
			<?= $title; ?>
			<?= ( ! empty( $value['url'] ) ? ' загружен' : '' ); ?>
			<?= ( ! empty( $value['name'] ) ? '<span>(' . $value['name'] . ')</span>' : '' ); ?>
		</span>
		<svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd"
				  d="M9.99617 15.2306V4.64483L13.2891 7.93773L14.7033 6.52351L8.99617 0.816406L3.28906 6.52351L4.70328 7.93773L7.99617 4.64483V15.2306H9.99617ZM18 19.2306V10.2306H16V19.2306H2V10.2306H0V19.2306C0 20.3352 0.89543 21.2306 2 21.2306H16C17.1046 21.2306 18 20.3352 18 19.2306Z"
				  fill="white" />
		</svg>
	</label>
</div>