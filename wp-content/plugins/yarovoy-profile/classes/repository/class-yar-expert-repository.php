<?php

class YAR_Expert_Repository {
	/**
	 * @var $post WP_Post
	 */
	private $post;
	private $data;

	private function get_data() {
		$this->data = [
			'ID'               => $this->post->ID,
			'title'            => $this->post->post_title,
			'slug'             => $this->post->post_name,
			'thumbnail'        => yar_get_post_thumbnail( $this->post->ID ),
			'services'         => yar_get_format_services( yar_get_field( 'services', $this->post->ID, [] ) ),
			'mini_description' => yar_get_field( 'mini_description', $this->post->ID ),
			'documents'        => [
				'is_approved' => yar_get_field( 'documents_approved', $this->post->ID, false ),
				'list'        => yar_get_field( 'documents', $this->post->ID, [] )
			],
			'rating'           => yar_get_comment_rating( $this->post->ID ),
			'comments'         => [
				'count' => $this->get_comments_count(),
				'list'  => []
			],
			'phone'            => yar_get_field( 'phone', $this->post->ID ),
			'full_description' => yar_get_field( 'full_description', $this->post->ID ),
			'portfolio'        => yar_get_field( 'portfolio', $this->post->ID, [] ),
		];

		return $this->data;
	}

	public function get_list() {
		$posts = get_posts( [
			'post_type'      => 'expert',
			'posts_per_page' => - 1
		] );

		if ( empty( $posts ) ) {
			return [];
		}

		foreach ( $posts as $key => $post ) {
			$this->post    = $post;
			$posts[ $key ] = $this->get_data();
		}

		return $posts;
	}

	private function get_comments_count() {
		$count = get_comment_count( $this->post->ID );

		return $count['approved'];
	}

	private function get_reviews() {
		$comments = get_comments( [
			'post_id' => $this->post->ID,
			'status'  => 'approve',
			'number'  => '99',
		] );

		if ( ! empty( $comments ) ) {
			foreach ( $comments as $comment ) {
				$this->data['comments']['list'][] = [
					'id'     => (int) $comment->comment_ID,
					'rating' => (float) yar_get_field( 'rating', 'comment_' . $comment->comment_ID, 0 ),
					'author' => $comment->comment_author,
					'date'   => get_comment_date( 'd.m.Y', $comment->comment_ID ),
					'text'   => $comment->comment_content
				];
			}
		}
	}

	public function get_post( $post_id ) {
		$this->post = get_post( $post_id );
		if ( empty( $this->post ) ) {
			return [];
		}

		$this->get_data();
		$this->get_reviews();

		return $this->data;
	}
}