<?php

$step_key   = 'safety';
$repository = new CarRepository();

$fields     = $repository->get_step( $step_key );
$inputs     = $fields['fields'];
$checkboxes = $fields['checkboxes'];

$actions = [
	'next_step' => $repository->get_next_step( $step_key ),
	'prev_step' => $repository->get_prev_step( $step_key ),
];

?>

<div class="upload-car__step" data-id="<?= $step_key; ?>">
	<div class="upload-car__grid _2">
		<?php foreach ( $inputs as $key => $input ) {
			yar_get_car_component( $input['type'], array_merge( [ 'name' => $key ], $input ) );
		} ?>
	</div>
	<?php if ( ! empty( $checkboxes ) ){
		yar_get_car_component( 'checkboxes', [
				'checkboxes' => $checkboxes
		] );
	} ?>
	<?php yar_get_car_component( 'actions', $actions ); ?>
</div>