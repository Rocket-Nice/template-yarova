<?php

class YAR_Admin_Publish_Expert {
	private $data = [];
	private $user_id;
	private $user_prefix;
	private $post_id;

	private function get_data() {
		$this->user_prefix = 'user_' . $this->user_id;
		$this->data        = [
			'avatar'     => get_field( 'avatar', $this->user_prefix ),
			'first_name' => get_field( 'first_name', $this->user_prefix ),
			'last_name'  => get_field( 'last_name', $this->user_prefix ),
			'surname'    => get_field( 'surname', $this->user_prefix ),
			'phone'      => get_field( 'phone', $this->user_prefix ),
			'services'   => get_field( 'services', $this->user_prefix ),
			'about'      => get_field( 'about', $this->user_prefix ),
			'documents'  => get_field( 'documents', $this->user_prefix ),
			'portfolio'  => get_field( 'portfolio', $this->user_prefix ),
		];
	}

	private function get_post_title() {
		return
			$this->data['last_name'] . ' '
			. $this->data['first_name'] .
			( $this->data['surname'] ? ' ' . $this->data['surname'] : '' );
	}

	private function get_post() {
		$post = get_posts( [
			'post_type'      => 'expert',
			'posts_per_page' => 1,
			'post_status'    => [ 'publish', 'draft' ],
			'meta_query'     => [
				[
					'key'   => '_expert_user',
					'value' => $this->user_id,
				]
			]
		] );

		if ( ! empty( $post ) ) {
			return $post[0]->ID;
		}

		return false;
	}

	private function create_post() {
		return wp_insert_post( wp_slash( [
			'post_title'  => sanitize_text_field( $this->get_post_title() ),
			'post_type'   => 'expert',
			'post_status' => 'draft',
			'post_author' => 1
		] ) );
	}

	private function set_expert_id(){
		update_field( '_expert_user', $this->user_id, $this->post_id );
	}

	private function get_post_id() {
		$post = $this->get_post();
		if ( $post ) {
			$this->post_id = $post;

			return true;
		}

		$post = $this->create_post();
		if ( is_wp_error( $post ) ) {
			return $post;
		}

		$this->post_id = $post;

		return $this->post_id;
	}

	private function set_avatar() {
		if ( ! empty( $this->data['avatar'] ) ) {
			set_post_thumbnail( $this->post_id, $this->data['avatar']['ID'] );
		}
	}

	private function set_services() {
		if ( ! empty( $this->data['services'] ) ) {
			delete_field( 'services_posts', $this->post_id );
			update_field( 'services_posts', $this->data['services'], $this->post_id );

			// Old
//			delete_field( 'services', $this->post_id );
//
//			foreach ( $this->data['services'] as $service ) {
//				$data = [
//					'field_669249b4d86fb' => get_post( (int) $service['select'] )->post_title,
//					'field_669249c9d86fc' => $service['price'],
//				];
//
//				add_row( 'field_669249a6d86fa', $data, $this->post_id );
//			}
		}
	}

	private function set_description() {
		if ( ! empty( $this->data['about'] ) ) {
			// Short
			$text = mb_substr( $this->data['about'], 0, 140 );
			update_field( 'mini_description', $text, $this->post_id );

			// Full
			update_field( 'full_description', $this->data['about'], $this->post_id );
		}
	}

	private function set_documents(){
		if ( ! empty( $this->data['documents'] ) ) {
			$documents = [];

			foreach ( $this->data['documents'] as $document ) {
				$documents[] = $document['ID'];
			}

			update_field( 'documents_approved', 1, $this->post_id );
			update_field( 'documents', $documents, $this->post_id );
		}
	}

	private function set_portfolio(){
		if ( ! empty( $this->data['portfolio'] ) ) {
			$portfolio = [];

			foreach ( $this->data['portfolio'] as $document ) {
				$portfolio[] = $document['ID'];
			}

			update_field( 'portfolio', $portfolio, $this->post_id );
		}
	}

	private function set_title() {
		wp_update_post( [
			'ID'         => $this->post_id,
			'post_title' => sanitize_text_field( $this->get_post_title() )
		] );
	}

	private function set_fields() {
		$this->set_title();
		$this->set_avatar();
		$this->set_services();
		$this->set_description();
		$this->set_documents();
		$this->set_portfolio();
	}

	public function publish( $user_id ) {
		$user = get_user_by( 'id', $user_id );
		if ( ! in_array( 'basic_expert', $user->roles ) ) {
			return new WP_Error( 'error_denied_access', '' );
		}

		$this->user_id = $user_id;
		$this->get_data();

		$post_id = $this->get_post_id();
		if ( is_wp_error( $post_id ) ) {
			return new WP_Error( 'error_denied_access', '' );
		}

		$this->set_expert_id();
		$this->set_fields();

		update_field( 'status', 'publish', $this->user_prefix );

		return true;
	}
}