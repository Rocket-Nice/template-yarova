<?php

$files = yar_get_part_arg( $args, 'block' );
$data  = yar_get_part_arg( $args, 'data' );
if ( empty( $files ) ) {
	return '';
}

?>

<div class="upload-car__files">
	<?php foreach ( $files as $key => $file ) {
		load_template( YAR_PROFILE_TEMPLATES . '/form/file.php', false, [
			'name'     => $key,
			'title'    => $file,
			'value'    => ! empty( $data[ $key ] ) ? $data[ $key ] : '',
			'validate' => [
				'ext'     => [ '.pdf', '.docx', '.doc' ],
				'maxsize' => 3096
			]
		] );
	} ?>
</div>
