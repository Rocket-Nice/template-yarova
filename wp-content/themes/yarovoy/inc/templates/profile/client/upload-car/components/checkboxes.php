<?php

$checkboxes = yar_get_part_arg( $args, 'checkboxes' );
$percent    = (int) yar_get_part_arg( $args, 'percent' );
$count      = count( $checkboxes );
$counter    = 1;

if ( ! $percent ) {
	$percent = 2;
}

?>

<div class="upload-car__checkboxes <?= ( $count < 4 ? '_100' : '' ); ?>">
	<?php if ( $count > 4 ){ ?>
		<div class="upload-car__checkboxes-col">
			<?php foreach ( $checkboxes as $key => $checkbox ) {
				yar_get_car_component( 'checkbox', [
					'name' => $key,
					'text' => $checkbox
				] );

				echo ( count( $checkboxes ) > $counter && $counter % $percent === 0 ? '</div><div class="upload-car__checkboxes-col">' : '' );

				$counter ++;
			} ?>
		</div>
	<?php } else {
		foreach ( $checkboxes as $key => $checkbox ) {
			yar_get_car_component( 'checkbox', [
				'name' => $key,
				'text' => $checkbox
			] );
		}
	} ?>
</div>
