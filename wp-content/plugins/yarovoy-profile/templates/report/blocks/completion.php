<?php

$fields   = yar_get_part_arg( $args, 'fields', [] );
$type     = yar_get_part_arg( $args, 'type', '' );
$title    = yar_get_part_arg( $args, 'title', '' );
$subtitle = yar_get_part_arg( $args, 'subtitle', '' );
$data     = yar_get_part_arg( $args, 'data', [] );

?>


<div class="report-form__block report-form__dashboard profile-form__block" data-type="<?= $type; ?>">
	<?php if ( $title ){ ?>
		<div class="report-form__title profile-form__block-title"><?= $title; ?></div>
	<?php } ?>
	<?php if ( $subtitle ){ ?>
		<div class="inspection__field-title"><?= $subtitle; ?></div>
	<?php } ?>
	<div class="report-form__fields">
		<?php if ( ! empty( $fields ) ){
			foreach ( $fields as $field ) {
				$template = [
					'position' => $field['group'] . '_' . $field['slug'],
					'title' => $field['title']
				];

				if ( ! empty( $data ) ) {
					$key = array_search( $field['id'], array_column( $data, 'param_id' ) );
					if ( $key !== false ) {
						$template['checked'] = true;
					}
				}

				load_template( YAR_PROFILE_DIR . 'templates/form/checkbox-toggle.php', false, $template );
			}
		} ?>
	</div>
</div>