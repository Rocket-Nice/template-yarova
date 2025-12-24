<?php

$taxonomy = yar_get_part_arg( $args, 'taxonomy' ) ? yar_get_part_arg( $args, 'taxonomy' ) : 'vlog_category';
$type     = yar_get_part_arg( $args, 'type' ) ? yar_get_part_arg( $args, 'type' ) : 'vlog';

$terms = get_terms( [
	'taxonomy'   => $taxonomy,
	'hide_empty' => false
] );

if ( empty( $terms ) ) {
	return '';
}

?>


<div class="vlog__menu" data-type="<?= $type; ?>" data-taxonomy="<?= $taxonomy; ?>">
	<button data-id="all" class="_active">Все</button>
	<?php foreach ( $terms as $term ) { ?>
		<button data-id="<?= $term->term_id; ?>"><?= $term->name; ?></button>
	<?php } ?>
</div>