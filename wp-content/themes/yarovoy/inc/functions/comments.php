<?php

function yar_get_comment_rating( $post_id ) {
	$return = 0;

	if ( ! $post_id ) {
		return $return;
	}

	$comments = get_comments( [
		'post_id' => $post_id,
		'status'  => 'approve',
	] );

	if ( ! empty( $comments ) ) {
		$rating = 0;

		foreach ( $comments as $comment ) {
			$rating += (int) get_field( 'rating', 'comment_' . $comment->comment_ID );
		}

		$return = $rating / count( $comments );
		$return = yar_roung_to_half( $return );
	}

	return $return;
}

add_action( 'wp_ajax_yar_save_comment', 'yar_save_comment' );
function yar_save_comment() {
	if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'action_add_comment' ) ) {
		wp_send_json_error();
	}

	$comment = strip_tags( $_POST['comment'] );
	$post_id = $_POST['_post_id'];

	$errors  = new WP_Error();

	if ( empty( $comment ) ) {
		$errors->add( 'comment', 'Это поле необходимо заполнить' );
	}

	if ( ! empty( $errors->errors ) ) {
		wp_send_json_error( [
			'errors' => $errors->errors
		] );
	}

	$user = wp_get_current_user();

	$data = [
		'comment_post_ID'      => $post_id,
		'comment_author'       => $user->user_firstname . ' ' . $user->user_lastname,
		'comment_author_email' => $user->user_email,
		'user_id'              => $user->ID,
		'comment_author_url'   => 'http://',
		'comment_content'      => $comment,
		'comment_type'         => 'comment',
		'comment_parent'       => 0,
		'comment_approved'     => 0,
	];

	$comment_id = wp_insert_comment( wp_slash( $data ) );

	if ( $comment_id ) {
		if ( isset( $_POST['_rating'] ) ) {
			$rating = (int) $_POST['_rating'];
			if ( $rating > 5 ) {
				$rating = 5;
			} elseif ( $rating < 1 ) {
				$rating = 1;
			}

			update_field( 'rating', $rating, get_comment( $comment_id ) );
		}

		wp_send_json_success();
	}

	wp_send_json_error();
}

//function yar_random_date( $firstDate, $secondDate, $format = 'Y-m-d' ): string {
//	$firstDateTimeStamp  = strtotime( $firstDate );
//	$secondDateTimeStamp = strtotime( $secondDate );
//
//	if ( $firstDateTimeStamp < $secondDateTimeStamp ) {
//		return date( $format, mt_rand( $firstDateTimeStamp, $secondDateTimeStamp ) );
//	}
//
//	return date( $format, mt_rand( $secondDateTimeStamp, $firstDateTimeStamp ) );
//}
//
//function yar_comment_search_post_id( $name ) {
//	$query = new WP_Query( [
//		's' => $name
//	] );
//
//	if ( ! $query->have_posts() ){
//		return 0;
//	}
//
//	//dd($query->get_posts());
//
//	return $query->get_posts()[0]->ID;
//}
//
//function yar_add_comments(){
//	$comments = [];
//	$row      = 1;
//
//	if ( ( $handle = fopen( __DIR__ . '/comments/reviews.csv', "r" ) ) !== false ) {
//		while ( ( $data = fgetcsv( $handle, 1000, "," ) ) !== false ) {
//			$row ++;
//
//			$comments[] = [
//				'name'    => $data[0],
//				'user'    => $data[1],
//				'text'    => $data[2],
//				'rating'  => $data[3],
//				'post_id' => yar_comment_search_post_id( $data[0] )
//			];
//		}
//		fclose( $handle );
//	}
//
//	foreach ( $comments as $comment ) {
//		$data = [
//			'comment_post_ID'      => $comment['post_id'],
//			'comment_author'       => $comment['user'],
//			'comment_author_email' => '',
//			'user_id'              => 1,
//			'comment_author_url'   => 'http://',
//			'comment_content'      => $comment['text'],
//			'comment_type'         => 'comment',
//			'comment_parent'       => 0,
//			'comment_approved'     => 1,
//			'comment_date' => yar_random_date( '2022-01-04', '2024-10-15' )
//		];
//
//		$comment_id = wp_insert_comment( wp_slash( $data ) );
//		update_field( 'rating', 5, get_comment( $comment_id ) );
//
//	}
//}

add_action( 'add_meta_boxes', 'yar_admin_add_meta_boxes', 10, 2 );
function yar_admin_add_meta_boxes( $post_type, $comment ) {
	add_meta_box( 'comment_post_id_box', 'Выбрать эксперта:', 'yar_admin_add_meta_boxes_callback', 'comment', 'normal', 'default', $comment );
}

function yar_admin_add_meta_boxes_callback( $comment ){
	$experts = get_posts( [
		'post_type'      => 'expert',
		'posts_per_page' => - 1
	] );

	?>
	<div class="admin-meta-box-comment">
		<select name="comment_post_id_new" id="" class="admin-meta-box-comment__select">
			<option value="0">Выбрать</option>
			<?php foreach ( $experts as $expert ) { ?>
				<option value="<?= $expert->ID; ?>" <?= ( $comment->comment_post_ID === $expert->ID ? 'selected' : '' ); ?>><?= $expert->post_title; ?></option>
			<?php } ?>
		</select>
	</div>
<?php }

add_filter( 'wp_update_comment_data', 'yar_admin_save_comment' );
function yar_admin_save_comment( $data ) {
	if ( isset( $data['comment_post_id_new'] ) ) {
		$data['comment_post_ID'] = $data['comment_post_id_new'];
	}

	return $data;
}

function yar_decl_of_num( $num, $titles ) {
	$cases = [ 2, 0, 1, 1, 1, 2 ];

	return $num . " " . $titles[ ( $num % 100 > 4 && $num % 100 < 20 ) ? 2 : $cases[ min( $num % 10, 5 ) ] ];
}
