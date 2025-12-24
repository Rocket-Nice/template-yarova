<?php

register_rest_route( YAR_API_NAMESPACE, '/base', [
    'methods'  => 'GET',
    'callback' => function () {
        $posts = get_posts( [
            'post_type'      => 'auto',
            'posts_per_page' => - 1
        ] );

        if ( empty( $posts ) ) {
            return [];
        }

	    foreach ( $posts as $key => $post ) {
		    $posts[ $key ] = [
			    'ID'               => $post->ID,
			    'title'            => $post->post_title,
			    'slug'             => $post->post_name,
			    'thumbnail'        => yar_get_post_thumbnail( $post->ID ),
			    'price'            => yar_get_price_with_currency( yar_get_field( 'price', $post->ID, '' ) ),
			    'features'         => yar_get_field( 'features', $post->ID, [] ),
			    'mini_description' => yar_get_field( 'mini_description', $post->ID, '' ),
		    ];
	    }

        return $posts;
    },

    'permission_callback' => '__return_true'
] );