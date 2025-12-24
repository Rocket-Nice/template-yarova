<?php

$title = yar_get_part_arg( $args, 'title', '' );
$list  = yar_get_part_arg( $args, 'list', [] );
$name  = yar_get_part_arg( $args, 'name', [] );

if ( empty( $list ) || empty( $name ) ){
	return '';
}

?>

<div class="multi-checkbox">
	<div class="multi-checkbox__title"><?= $title; ?></div>
	<div class="multi-checkbox__list">
		<?php foreach ( $list as $key => $item ) {
			yar_plugin_get_template( 'form/checkbox', [
				'title'    => $item,
				'name'     => $name,
				'value'    => $key,
				'is_array' => true,
				'class'    => 'multi-checkbox__item'
			], false );
		} ?>
	</div>
</div>


