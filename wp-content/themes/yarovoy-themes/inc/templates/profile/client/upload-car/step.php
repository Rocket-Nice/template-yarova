<?php

$step_key  = yar_get_part_arg( $args, 'step_key' );
$grid_cols = yar_get_part_arg( $args, 'grid_cols' );
$percent   = yar_get_part_arg( $args, 'percent' );
$active    = yar_get_part_arg( $args, 'active' );

$repository = new YAR_Car_Repository();

$fields     = $repository->get_step( $step_key );

$gallery    = isset( $fields['gallery'] ) ? $fields['gallery'] : [];
$inputs     = isset( $fields['fields'] ) ? $fields['fields'] : [];
$checkboxes = isset( $fields['checkboxes'] ) ? $fields['checkboxes'] : [];

$actions = [
	'next_step' => $repository->get_next_step( $step_key ),
	'prev_step' => $repository->get_prev_step( $step_key ),
];

?>


<div class="upload-car__step <?= ( $active ? '_active' : '' ); ?>" data-id="<?= $step_key; ?>">
	<?php if ( $gallery ) {
		yar_get_car_component( 'file' );
	} ?>
	<div class="upload-car__grid <?= ( $grid_cols ? '_' . $grid_cols : '' ); ?>">
		<?php foreach ( $inputs as $key => $input ) {
			yar_get_car_component( $input['type'], array_merge( [ 'name' => $key ], $input ) );
		} ?>
	</div>
	<?php if ( ! empty( $checkboxes ) ){
		yar_get_car_component( 'checkboxes', [
			'checkboxes' => $checkboxes,
			'percent'    => $percent
		] );
	} ?>
	<?php yar_get_car_component( 'actions', $actions ); ?>
</div>

