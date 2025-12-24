<?php

$step_key   = 'main';
$repository = new CarRepository();

$fields  = $repository->get_step( $step_key );
$gallery = $fields['gallery'];
$inputs  = $fields['fields'];

$actions = [
	'next_step' => $repository->get_next_step( $step_key ),
	'prev_step' => $repository->get_prev_step( $step_key ),
];

?>


<div class="upload-car__step" data-id="<?= $step_key; ?>">
	<?php if ( $gallery ) {
		yar_get_car_component( 'file' );
	} ?>
	<div class="upload-car__grid">
		<?php foreach ( $inputs as $key => $input ) {
			yar_get_car_component( $input['type'], array_merge( [ 'name' => $key ], $input ) );
		} ?>
	</div>
	<div class="upload-car__color">
		<div class="upload-car__color-title">Цвет:</div>
		<div class="upload-car__color-list">
			<div class="upload-car__color-item">
				<input type="radio" id="color_1" name="color" value="">
				<label for="color_1"></label>
			</div>
		</div>
	</div>
	<?php yar_get_car_component( 'actions', $actions ); ?>
</div>