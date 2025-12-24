<?php

function yar_get_comment_rating($post_id)
{
	$return = 0;

	if (! $post_id) {
		return $return;
	}

	$comments = get_comments([
		'post_id' => $post_id,
		'status'  => 'approve',
	]);

	if (! empty($comments)) {
		$rating = 0;

		foreach ($comments as $comment) {
			$rating += (int) get_field('rating', 'comment_' . $comment->comment_ID);
		}

		$return = $rating / count($comments);
		$return = yar_roung_to_half($return);
	}

	return $return;
}

add_action('wp_ajax_yar_save_comment', 'yar_save_comment');
function yar_save_comment()
{
	if (empty($_POST) || ! wp_verify_nonce($_POST['_wpnonce'], 'action_add_comment')) {
		wp_send_json_error();
	}

	$comment = strip_tags($_POST['comment']);
	$post_id = $_POST['_post_id'];

	$errors  = new WP_Error();

	if (empty($comment)) {
		$errors->add('comment', 'Это поле необходимо заполнить');
	}

	if (! empty($errors->errors)) {
		wp_send_json_error([
			'errors' => $errors->errors
		]);
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

	$comment_id = wp_insert_comment(wp_slash($data));

	if ($comment_id) {
		if (isset($_POST['_rating'])) {
			$rating = (int) $_POST['_rating'];
			if ($rating > 5) {
				$rating = 5;
			} elseif ($rating < 1) {
				$rating = 1;
			}

			update_field('rating', $rating, get_comment($comment_id));
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

add_action('add_meta_boxes', 'yar_admin_add_meta_boxes', 10, 2);
function yar_admin_add_meta_boxes($post_type, $comment)
{
	add_meta_box('comment_post_id_box', 'Выбрать эксперта:', 'yar_admin_add_meta_boxes_callback', 'comment', 'normal', 'default', $comment);
}

function yar_admin_add_meta_boxes_callback($comment)
{
	$experts = get_posts([
		'post_type'      => 'expert',
		'posts_per_page' => -1
	]);

?>
	<div class="admin-meta-box-comment">
		<select name="comment_post_id_new" id="" class="admin-meta-box-comment__select">
			<option value="0">Выбрать</option>
			<?php foreach ($experts as $expert) { ?>
				<option value="<?= $expert->ID; ?>" <?= ($comment->comment_post_ID === $expert->ID ? 'selected' : ''); ?>><?= $expert->post_title; ?></option>
			<?php } ?>
		</select>
	</div>
<?php }

add_filter('wp_update_comment_data', 'yar_admin_save_comment');
function yar_admin_save_comment($data)
{
	if (isset($data['comment_post_id_new'])) {
		$data['comment_post_ID'] = $data['comment_post_id_new'];
	}

	return $data;
}

function yar_decl_of_num($num, $titles)
{
	$cases = [2, 0, 1, 1, 1, 2];

	return $num . " " . $titles[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
}


add_action('admin_menu', function () {
	add_submenu_page(
		'edit-comments.php',
		'Добавить отзыв',
		'Добавить отзыв',
		'moderate_comments',
		'add-comment',
		'render_add_comment_page'
	);
});

function render_add_comment_page()
{
?>
	<style>
		.add-comment-form {
			max-width: 600px;
		}

		.add-comment-form__row {
			margin-bottom: 20px;
		}

		.add-comment-form__row:last-child {
			margin-bottom: 0;
		}

		.add-comment-form__row label {
			display: block;
			margin-bottom: 5px;
			font-weight: 700;
		}

		.add-comment-form input,
		.add-comment-form textarea {
			width: 100%;
			resize: none;
		}

		.add-comment-form textarea {
			min-height: 250px;
		}
	</style>
	<div class="wrap">
		<h1>Добавить отзыв</h1>
		<form id="add-comment-form" class="add-comment-form">
			<div class="add-comment-form__row">
				<label for="expert">Эксперт (пост):</label>
				<select name="expert">
					<option value="">Выберите эксперта</option>
					<?php
					$experts = get_posts(['post_type' => 'expert', 'numberposts' => -1]);
					foreach ($experts as $expert) {
						echo '<option value="' . $expert->ID . '">' . esc_html($expert->post_title) . '</option>';
					}
					?>
				</select>
			</div>
			<div class="add-comment-form__row">
				<label for="client_name">Имя клиента:</label>
				<input type="text" name="client_name">
			</div>
			<div class="add-comment-form__row">
				<label for="comment">Комментарий:</label>
				<textarea name="comment" id="" cols="30" rows="10"></textarea>
			</div>
			<div class="add-comment-form__row">
				<label for="rating">Рейтинг: </label>
				<input type="number" name="rating" min="1" max="5" value="5">
			</div>
			<div class="add-comment-form__row">
				<label for="date">Дата отзыва: </label>
				<input type="date" name="date">
			</div>
			<button type="submit">Добавить</button>
		</form>
		<div id="comment-response"></div>
	</div>

	<script>
		document.getElementById('add-comment-form').addEventListener('submit', function(e) {
			e.preventDefault();

			let formData = new FormData(this);
			formData.append('action', 'add_admin_comment');
			formData.append('_wpnonce', '<?php echo wp_create_nonce('add-comment-nonce'); ?>');

			fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
					method: 'POST',
					body: formData
				})
				.then(response => response.json())
				.then(data => {
					document.getElementById('comment-response').innerHTML = data.message;
					if (data.success) {
						window.location.reload();
					}
				});
		});
	</script>
<?php
}

add_action('wp_ajax_add_admin_comment', function () {
	check_ajax_referer('add-comment-nonce', '_wpnonce');

	if (! current_user_can('moderate_comments')) {
		wp_send_json_error(['message' => 'Недостаточно прав']);
	}

	$expert_id    = $_POST['expert'] ?? 0;
	$client_name  = sanitize_text_field($_POST['client_name'] ?? '');
	$comment_text = sanitize_textarea_field($_POST['comment'] ?? '');
	$rating       = intval($_POST['rating'] ?? 5);
	$date         = $_POST['date'] ? date('Y-m-d', strtotime($_POST['date'])) : date('Y-m-d');

	if (empty($expert_id) || empty($comment_text)) {
		wp_send_json_error(['message' => 'Заполните все поля']);
	}

	$comment_id = wp_insert_comment([
		'comment_post_ID'  => $expert_id,
		'comment_author'   => $client_name,
		'comment_content'  => $comment_text,
		'comment_approved' => 1,
		'comment_date'     => $date
	]);

	if ($comment_id) {
		update_comment_meta($comment_id, 'rating', $rating);
		wp_send_json_success(['message' => 'Комментарий добавлен']);
	} else {
		wp_send_json_error(['message' => 'Ошибка при добавлении']);
	}
});
