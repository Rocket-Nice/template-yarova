<?php

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="profile-report__features">
	<?php

	foreach ( $data as $datum ) {
		yar_plugin_get_template( 'form/plug', [
			'title' => $datum['title'],
			'value' => $datum['value']
		], false );
	}

	?>
</div>