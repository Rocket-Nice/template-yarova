<?php

$title   = yar_get_part_arg( $args, 'title' );
$status  = yar_get_part_arg( $args, 'status' );
$post_id = yar_get_part_arg( $args, 'post_id' );
$car_id  = yar_get_part_arg( $args, 'car_id' );
$is_sold = yar_get_part_arg( $args, 'is_sold', false );
?>

<div class="profile-upload__car-item">
	<?= $title; ?>
	<div class="profile-upload__car-actions">
		<a href="/profile/upload-car/edit/<?= $car_id; ?>" class="profile-upload__car-edit">
			<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M20.8575 12.5741L14.7463 6.46289L0.320312 20.8889V27H6.43148L20.8575 12.5741ZM2.13776 25.1826V21.6386L14.7463 9.03004L18.2903 12.5741L5.68178 25.1826H2.13776Z" fill="black"/>
				<path d="M22.5858 25.1826H12.5898V27.0001H22.5858V25.1826Z" fill="black"/>
				<path d="M26.6729 25.1826H24.8555V27.0001H26.6729V25.1826Z" fill="black"/>
				<path d="M16.3594 4.87251L22.4705 10.9837L26.628 6.78083L20.5395 0.692383L16.3594 4.87251ZM22.4478 8.39382L18.9265 4.87251L20.5395 3.25953L24.0608 6.78083L22.4478 8.39382Z" fill="black"/>
			</svg>
		</a>
		<?php if ( $status === 'publish' && ! $is_sold ) { ?>
			<button class="profile-upload__car-sold btn--loader" data-id="<?= $post_id; ?>" data-nonce="<?= wp_create_nonce( 'yar_profile_sold_car' ) ?>">Снять объявление</button>
		<?php } ?>
	</div>
</div>
