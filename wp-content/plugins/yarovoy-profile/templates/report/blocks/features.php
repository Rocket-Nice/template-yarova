<?php

$fields    = yar_get_part_arg( $args, 'fields' );
$data      = yar_get_part_arg( $args, 'data' );
$title     = yar_get_part_arg( $args, 'title', 'Характеристики ТС' );
$subtitle  = yar_get_part_arg( $args, 'subtitle', '' );
$type      = yar_get_part_arg( $args, 'type', 'features' );
$grid_size = yar_get_part_arg( $args, 'grid_size' );

?>

<div class="report-form__block report-form__features profile-form__block" data-type="<?= $type; ?>">
	<div class="report-form__title profile-form__block-title"><?= $title; ?></div>
	<?php if ( $subtitle ){ ?>
		<div class="inspection__field-title">Отметьте ошибки и проблемы</div>
	<?php } ?>
	<div class="report-form__fields <?= ( $grid_size ? '_' . $grid_size : '' ); ?>">
		<?php

		foreach ( $fields as $field ) {
			$template = [
				'label'       => $field['title'],
				'placeholder' => $field['title'],
				'name'        => $type . '_' . $field['slug']
			];

			if ( ! empty( $field['options'] ) ) {
				$template['options'] = $field['options'];
			}

			if ( ! empty( $data ) ) {
				$find = array_search( $field['slug'], array_column( $data, 'field_slug' ) );
				if ( $find !== false ) {
					$template['value'] = $data[ $find ]['value'];
				}
			}

			load_template( YAR_PROFILE_DIR . 'templates/form/' . $field['type'] . '.php', false, $template );
		}

		?>
	</div>
</div>