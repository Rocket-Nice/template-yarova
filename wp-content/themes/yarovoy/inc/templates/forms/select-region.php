<?php

$regions = get_posts( [
	'post_type'      => 'region',
	'posts_per_page' => - 1,
	'orderby'        => 'title',
	'order'          => 'ASC'
] );

if ( empty( $regions ) ) {
	return '';
}

?>

<select class="input__cell" name="region">
	<option disabled="" selected="">Выберите регион</option>
	<?php foreach ( $regions as $region ) { ?>
		<option value="<?= $region->post_title; ?>"><?= $region->post_title; ?></option>
	<?php } ?>
</select>