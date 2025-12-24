<?php

$fields = yar_get_part_arg( $args, 'fields', [] );
$type   = yar_get_part_arg( $args, 'type', '' );
$title  = yar_get_part_arg( $args, 'title', '' );
$data   = yar_get_part_arg( $args, 'data', [] );

$is_image      = yar_get_part_arg( $args, 'is_image', false );
$is_additional = yar_get_part_arg( $args, 'is_additional', false );

?>

<div class="report-form__block report-form__inspection profile-form__block" data-type="<?= $type; ?>">
	<div class="report-form__title profile-form__block-title"><?= $title; ?></div>
	<?php if ( $is_image ){ ?>
		<div class="report-form__media">
			<picture class="report-form__media-pic">
				<img src="<?= YAR_PROFILE_URL . 'assets/img/body-inspection/main.webp'; ?>" class="report-form__media-img" alt="">
			</picture>
		</div>
	<?php } ?>
	<div class="report-form__fields">
		<?php if ( ! empty( $fields ) ){
			foreach ( $fields as $field ) {
				$with_weight = false;
				if ( isset( $field['weight'] ) ) {
					$with_weight = $field['weight'];
				}

				$template = [
					'with_weight' => $with_weight,
					'title'       => $field['title'],
					'order'       => $field['order'],
					'position'    => $field['group'] . '_' . $field['slug']
				];

				if ( ! empty( $data ) ) {
					$key = array_search( $field['slug'], array_column( $data, 'field_slug' ) );
					if ( $key !== false ) {
						$template['status']    = $data[ $key ]['value'];
						$template['thickness'] = $data[ $key ]['thickness'];
						$template['comment']   = $data[ $key ]['comment'];
					}
				}

				load_template( YAR_PROFILE_DIR . 'templates/form/inspection.php', false, $template );
			}
		}

		if ( $is_additional ) {
			load_template( YAR_PROFILE_DIR . 'templates/form/additional.php', false, $field );
		}

		?>
	</div>
</div>
