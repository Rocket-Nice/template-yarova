<?php

$checkboxes = yar_get_part_arg( $args, 'block' );
$settings   = yar_get_part_arg( $args, 'settings' );
$data       = yar_get_part_arg( $args, 'data' );

if ( empty( $checkboxes ) ) {
	return '';
}

$count   = count( $checkboxes );
$percent = 2;

if ( isset( $settings['percent'] ) ) {
	$percent = $settings['percent'];
}

if ( $count < 4 ) {
	$percent = 1;
}

$checkboxes = array_chunk( $checkboxes, $percent );

?>

<div class="upload-car__checkboxes <?= ( isset( $settings['classes'] ) ? $settings['classes'] : '' ); ?> <?= ( $count < 4 ? '_100' : '' ); ?>">
	<?php foreach ( $checkboxes as $list ) { ?>
		<div class="upload-car__checkboxes-col">
			<?php foreach ( $list as $checkbox ) {
				$template = [
					'name'  => $checkbox['slug'],
					'title' => $checkbox['title'],
					'value' => 1
				];

				if (
					! empty( $data )
					&& isset( $data[ $checkbox['slug'] ] )
					&& $data[ $checkbox['slug'] ]['value']
				) {
					$template['checked'] = true;

				}

				load_template( YAR_PROFILE_TEMPLATES . '/form/checkbox.php', false, $template );
			} ?>
		</div>
	<?php } ?>
</div>
