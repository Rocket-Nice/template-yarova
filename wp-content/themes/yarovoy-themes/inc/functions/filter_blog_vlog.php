<?php

add_action( 'wp_ajax_yar_filter_bv', 'yar_filter_bv' );
add_action( 'wp_ajax_nopriv_yar_filter_bv', 'yar_filter_bv' );
function yar_filter_bv() {
	$term_id  = $_POST['term_id'];
	$taxonomy = $_POST['taxonomy'];
	$type     = $_POST['type'];

	$available_types = [
		'vlog',
		'blog'
	];

	if ( empty( $term_id ) || ! in_array( $type, $available_types ) ) {
		wp_send_json_error();
	}

	$args = [
		'post_type'      => $type,
		'posts_per_page' => -1,
	];

	if ( $term_id !== 'all' ) {
		$args['tax_query'] = [
			[
				'taxonomy' => $taxonomy,
				'terms'    => [ (int) $term_id ]
			]
		];
	}

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		get_template_part( YAR_THEME_TEMPLATES . '/not-found' );

		wp_die();
	}

	echo '<div class="' . $type . '__grid">';
	while ( $query->have_posts() ) {
		$query->the_post();

		get_template_part( YAR_THEME_TEMPLATES . '/' . $type . '/card' );
	}
	echo '</div>';

	wp_die();
}