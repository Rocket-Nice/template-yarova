<?php

$post_id = get_the_ID();

$mini_description   = get_field( 'mini_description' );
$documents_approved = get_field( 'documents_approved' );
$rating             = get_field( 'rating' );
$services           = get_field( 'services' );

$qualification = wp_get_object_terms( $post_id, 'expert_qualifications' );

$count = get_comment_count( $post_id );

?>


<div class="experts-item">
	<div class="experts-item__top expert__info">
		<div class="expert__info-l">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="expert__info-image">
					<?php the_post_thumbnail( 'big' ); ?>
				</div>
			<?php } ?>
			<?php get_template_part( YAR_THEME_TEMPLATES . '/expert/rating', null, [
				'classes' => 'expert__info-list',
				'rating'  => yar_get_comment_rating( $post_id )
			] ); ?>
			<div class="expert__info-reviews"><?= yar_decl_of_num( $count['approved'], [ 'отзыв', 'отзыва', 'отзывов' ] ); ?></div>
		</div>
		<div class="expert__info-r">
			<div class="expert__info-header">
				<a href="<?php the_permalink(); ?>" class="expert__info-name"><?php the_title(); ?></a>
				<?php if ( ! empty( $qualification ) ) { ?>
					<div class="expert__info-post"><?= $qualification[0]->name; ?></div>
				<?php } ?>
			</div>
			<?php if ( $services ) { ?>
				<ul class="expert__info-services list-reset">
					<?php foreach ( $services as $service ) { ?>
						<li class="cases__card-list-item">
							<span>
								<?= $service['title']; ?>
								<?php if ( $service['price'] ) {
									echo yar_get_normal_price( $service['price'] ) . ' ₽';
								} ?>
							</span>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>
	<?php if ( $documents_approved ) { ?>
		<div class="experts-item__documents">
			<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M19.6282 6.88738C19.1332 6.37071 18.3293 6.37104 17.8336 6.88738L9.75659 15.3063L6.1667 11.5646C5.671 11.048 4.86748 11.048 4.37178 11.5646C3.87607 12.0813 3.87607 12.9188 4.37178 13.4355L8.85894 18.1124C9.10663 18.3706 9.43143 18.5 9.75625 18.5C10.0811 18.5 10.4062 18.3709 10.6539 18.1124L19.6282 8.75819C20.1239 8.24188 20.1239 7.40401 19.6282 6.88738Z"
					fill="#F49834" />
			</svg>
			<span>Документы проверены</span>
		</div>
	<?php } ?>
	<?php if ( $mini_description ) { ?>
		<p class="experts-item__description">
			<?= $mini_description; ?>
		</p>
	<?php } ?>
	<div class="experts-item__actions">
		<button class="btn btn--light expert__get--phone" data-id="<?= $post_id; ?>">Показать телефон</button>
		<a href="<?php the_permalink(); ?>" class="btn btn--accent">Подробнее об эксперте</a>
	</div>
</div>