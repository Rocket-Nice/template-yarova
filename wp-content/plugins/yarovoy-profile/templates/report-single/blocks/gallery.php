<?php

$gallery = yar_get_part_arg( $args, 'data' );

?>

<div class="profile-report__gallery">
	<?php if ( ! empty( $gallery ) ) {
		foreach ( $gallery as $item ) { ?>
			<a href="<?= $item; ?>" class="profile-report__gallery-item item--cover" data-fancybox="report_gallery">
				<img src="<?= $item; ?>" alt=""> </a>
		<?php }
	} ?>
</div>