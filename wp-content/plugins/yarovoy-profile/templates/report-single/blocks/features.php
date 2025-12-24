<?php

$data   = yar_get_part_arg( $args, 'data' );

?>

<div class="profile-report__features">
	<?php foreach ( $data as $type => $datum ) {
		$include = [
			'title' => $datum['title'],
			'value' => $datum['value']
		];

		yar_plugin_get_template( 'form/plug', $include, false );
	} ?>
</div>