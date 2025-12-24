<?php

$title    = isset( $args['title'] ) ? $args['title'] : '';
$position = isset( $args['position'] ) ? $args['position'] : '';
$order    = isset( $args['order'] ) ? $args['order'] : '';
$is_green = isset( $args['is_green'] ) ? $args['is_green'] : '';

?>

<div class="admin-report__dashboard-field <?= ( $is_green ? '_green' : '' ); ?>">
	<div class="admin-report__dashboard-icon"></div>
	<input type="checkbox" name="<?= $position; ?>" value="1">
	<label for=""><?= $title; ?></label>
	<div class="admin-report__dashboard-toggle"></div>
</div>
