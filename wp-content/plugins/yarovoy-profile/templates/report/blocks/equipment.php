<?php

$fields = yar_get_part_arg( $args, 'fields' );
$data   = yar_get_part_arg( $args, 'data' );

?>

<div class="report-form__block report-form__equipment profile-form__block" data-type="equipment">
	<div class="report-form__title profile-form__block-title">Комплектация</div>
	<div class="report-form__fields">
		<?php

		if ( ! empty( $fields ) ){
			foreach ( $fields as $field ) {
				$template = [
					'name'     => 'equipment',
					'value'    => (int) $field['id'],
					'title'    => $field['title'],
					'is_array' => true,
				];

				if ( ! empty( $data ) ) {
					$key = array_search( $field['id'], array_column( $data, 'param_id' ) );
					if ( $key !== false ) {
						$template['checked'] = true;
					}
				}

				load_template( YAR_PROFILE_DIR . 'templates/form/checkbox.php', false, $template );
			}
		}

		?>
	</div>
</div>