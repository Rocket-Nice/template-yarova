<?php

$post_id = get_the_ID();

$comments = get_comments( [
	'post_id' => $post_id,
	'status'  => 'approve',
	'number'  => '99',
] );

$count = get_comment_count( $post_id );

?>

<div class="section section--transparent expert__comments comments">
	<div class="comments__header">
		<h2 class="section__title section__title--white">Отзывы</h2>
		<div class="comments__count"><?= yar_decl_of_num( $count['approved'], [ 'отзыв', 'отзыва', 'отзывов' ] ); ?></div>
		<div class="comments__flex">
			<div class="comments__rating">
				<span class="comments__rating-title">Общая оценка эксперта</span>
				<?php get_template_part( YAR_THEME_TEMPLATES . '/expert/rating', null, [
					'classes' => 'comments__rating-list',
					'rating'  => yar_get_comment_rating( $post_id )
				] ); ?>
			</div>
			<div class="comments__sort"></div>
		</div>
	</div>
	<?php if ( ! empty( $comments ) ) { ?>
		<div class="comments__list">
			<?php foreach ( $comments as $comment ) {

				$rating = get_field( 'rating', 'comment_' . $comment->comment_ID );

				?>
				<div class="comments-item">
					<div class="comments-item__header">
						<div class="comments-item__name"><?= $comment->comment_author; ?></div>
						<div class="comments-item__date"><?php comment_date( 'd.m.Y', $comment->comment_ID ) ?></div>
					</div>
					<?php get_template_part( YAR_THEME_TEMPLATES . '/expert/rating', null, [
						'classes' => 'comments-item__rating',
						'rating'  => (int) $rating
					] ); ?>
					<div class="comments-item__text">
						<?= $comment->comment_content; ?>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ( is_user_logged_in() ) { ?>
		<button class="btn btn--wide btn--accent comments__button" data-popup="add_comment">Оставить отзыв</button>
	<?php } ?>
</div>

<?php if ( is_user_logged_in() ) { ?>
<div class="popup" id="add_comment">
	<div class="popup__wrapper">
		<div class="popup__content">
			<div class="add-comment form">
				<h3 class="add-comment__title">Ваш отзыв</h3>
				<p class="add-comment__text">Оставьте ваш отзыв о специалисте</p>
				<div class="add-comment__rating rating-select">
					<span class="rating-select__star">
						<svg width="39" height="37" viewBox="0 0 39 37" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M19.5 0L23.9903 13.8197H38.5211L26.7654 22.3607L31.2557 36.1803L19.5 27.6393L7.7443 36.1803L12.2346 22.3607L0.47887 13.8197H15.0097L19.5 0Z" fill="#AEAEAE"/>
						</svg>
					</span>
					<span class="rating-select__star">
						<svg width="39" height="37" viewBox="0 0 39 37" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M19.5 0L23.9903 13.8197H38.5211L26.7654 22.3607L31.2557 36.1803L19.5 27.6393L7.7443 36.1803L12.2346 22.3607L0.47887 13.8197H15.0097L19.5 0Z" fill="#AEAEAE"/>
						</svg>
					</span>
					<span class="rating-select__star">
						<svg width="39" height="37" viewBox="0 0 39 37" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M19.5 0L23.9903 13.8197H38.5211L26.7654 22.3607L31.2557 36.1803L19.5 27.6393L7.7443 36.1803L12.2346 22.3607L0.47887 13.8197H15.0097L19.5 0Z" fill="#AEAEAE"/>
						</svg>
					</span>
					<span class="rating-select__star">
						<svg width="39" height="37" viewBox="0 0 39 37" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M19.5 0L23.9903 13.8197H38.5211L26.7654 22.3607L31.2557 36.1803L19.5 27.6393L7.7443 36.1803L12.2346 22.3607L0.47887 13.8197H15.0097L19.5 0Z" fill="#AEAEAE"/>
						</svg>
					</span>
					<span class="rating-select__star _active">
						<svg width="39" height="37" viewBox="0 0 39 37" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M19.5 0L23.9903 13.8197H38.5211L26.7654 22.3607L31.2557 36.1803L19.5 27.6393L7.7443 36.1803L12.2346 22.3607L0.47887 13.8197H15.0097L19.5 0Z" fill="#AEAEAE"/>
						</svg>
					</span>
				</div>
				<div class="form__row">
					<div class="form__input">
						<textarea name="comment" class="input__cell"></textarea>
					</div>
				</div>
				<div class="add-comment__button form__button">
					<button class="btn btn--accent btn--wide">Оставить отзыв</button>
					<input type="hidden" name="_action" value="yar_save_comment">
					<input type="hidden" name="_rating" value="1">
					<input type="hidden" name="_post_id" value="<?= get_the_ID(); ?>">
					<?php wp_nonce_field( 'action_add_comment' ); ?>
				</div>
				<div class="add-comment__policy form__policy">Нажимая кнопку «Оставить отзыв», вы соглашаетесь с <a href="#">политикой конфиденциальности</a></div>
				<button class="popup__close popup--close">
					<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.5 1.48828L27.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round"/>
						<path d="M27.5 1.48828L1.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round"/>
					</svg>
				</button>
			</div>
		</div>
	</div>
	<div class="popup__bg"></div>
</div>
<?php } ?>