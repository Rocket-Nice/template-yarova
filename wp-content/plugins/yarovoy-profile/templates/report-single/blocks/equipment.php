<?php

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="profile-report__equipment">
	<?php if ( ! empty( $data ) ){
		foreach ( $data as $datum ) { ?>
			<div class="profile-report__equipment-item"><?= $datum['title']; ?></div>
		<?php }
	} ?>
</div>
