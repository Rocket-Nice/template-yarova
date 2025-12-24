<?php

$fields   = yar_get_part_arg( $args, 'block' );
$settings = yar_get_part_arg( $args, 'settings' );
$data     = yar_get_part_arg( $args, 'data' );

if ( empty( $fields ) ){
	return '';
} ?>

<div class="upload-car__grid <?= ( isset( $settings['cols'] ) ? '_' .  $settings['cols'] : '' ); ?>">
	<?php foreach ( $fields as $key => $input ) {
		$template = [
			'id'          => $input['id'],
			'placeholder' => $input['title'],
			'name'        => $input['slug'],
			'label'       => $input['title'],
			'type'        => isset( $input['params']['type'] ) ? $input['params']['type'] : 'text'
		];

		if ( $input['type'] === 'select' ) {
			$template['text'] = 'Выбрать';

			if ( ! empty( $input['params']['fill'] ) ) {
				$template['fill'] = $input['params']['fill'];
			}
			if ( isset( $input['params']['exclude'] ) ) {
				$template['exclude'] = $input['params']['exclude'];
			}
			if ( ! empty( $input['options'] ) ) {
				$template['options'] = $input['options'];
			}
			if ( ! empty( $input['params']['classes'] ) ) {
				$template['classes'] = $input['params']['classes'];
			}
		}

		if ( ! empty( $data ) && isset( $data[ $input['slug'] ] ) ) {
			$template['value'] = $data[ $input['slug'] ]['value'];
			if ( isset( $data[ $input['slug'] ]['options'] ) ) {
				$template['options'] = $data[ $input['slug'] ]['options'];
			}
		}

		load_template( YAR_PROFILE_TEMPLATES . '/form/' . $input['type'] . '.php', false, $template );
	}

	?>
</div>

