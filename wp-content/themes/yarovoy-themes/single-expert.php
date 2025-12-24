<?php get_header( null, [ 'classes' => 'body--dark' ] );

$post_id = get_the_ID();

$full_description   = get_field( 'full_description' );
$documents_approved = get_field( 'documents_approved' );
$rating             = get_field( 'rating' );
$services           = get_field( 'services' );
$portfolio          = get_field( 'portfolio' );

$qualification = wp_get_object_terms( $post_id, 'expert_qualifications' );

$count = get_comment_count( $post_id );

?>

<div class="page-container container expert">
	<section class="section section--banner section--transparent">
		<?php get_template_part( 'inc/templates/breadcrumbs' ); ?>
		<div class="section__head">
			<h2 class="section__title section__title--white">Специалист по автоподбору</h2>
		</div>

		<div class="expert__main">
			<div class="expert__header">
				<div class="expert__header-info expert__info">
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
				<div class="expert__header-actions">
					<button class="btn btn--accent">Документы эксперта</button>
					<button class="btn btn--light expert__get--phone" data-id="<?= $post_id; ?>">Показать телефон</button>
				</div>
			</div>
			<?php if ( $full_description ) { ?>
				<div class="expert__text">
					<?= $full_description; ?>
				</div>
			<?php } ?>
		</div>
	</section>

	<?php if ( ! empty( $portfolio ) ) { ?>
		<div class="section expert__portfolio">
			<div class="section__head">
				<h2 class="section__title section__title--white">Портфолио</h2>
			</div>
			<div class="expert__portfolio-slider">
				<div class="expert__portfolio-swiper swiper">
					<div class="swiper-wrapper">
						<?php foreach ( $portfolio as $item ) { ?>
							<div class="swiper-slide">
								<div class="expert__portfolio-item">
									<img src="<?= $item; ?>" class="expert__portfolio-img" alt="">
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				<button class="swiper__arrow swiper__arrow--prev expert__portfolio-prev"></button>
				<button class="swiper__arrow swiper__arrow--next expert__portfolio-next"></button>
			</div>
		</div>
	<?php } ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/expert/comments' ); ?>

	<?php get_template_part( YAR_THEME_TEMPLATES . '/common_sections/contacts' ); ?>
</div>


<?php get_footer(); ?>
