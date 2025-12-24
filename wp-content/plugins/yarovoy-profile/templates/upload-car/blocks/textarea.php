<?php

$textarea = yar_get_part_arg( $args, 'block' );
$settings = yar_get_part_arg( $args, 'settings' );
$data     = yar_get_part_arg( $args, 'data' );

?>

<div class="upload-car__textarea">
	<?php if ( ! empty( $textarea['title'] ) ) { ?>
		<div class="upload-car__subtitle"><?= $textarea['title']; ?></div>
	<?php } ?>

	<?php
	$template = [
		'label'       => '',
		'placeholder' => 'Добавить описание автомобиля',
		'name'        => $textarea['name']
	];

	if ( ! empty( $data['description'] ) ){
		$template['value'] = $data['description'];
	}

	load_template( YAR_PROFILE_TEMPLATES . '/form/textarea.php', false, $template ); ?>
</div>