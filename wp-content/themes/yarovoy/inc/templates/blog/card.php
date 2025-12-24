<?php

$mini_description = get_field( 'mini_description' );

$terms = wp_get_post_terms( get_the_ID(), 'blog_category', [ 'fields' => 'names' ] );

?>

<div class="blog-item">
	<?php if ( has_post_thumbnail() ) { ?>
		<a href="<?php the_permalink(); ?>" class="blog-item__image">
			<?php the_post_thumbnail(); ?>
		</a>
	<?php } ?>
	<div class="blog-item__content">
		<h4 class="blog-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php if ( $mini_description ) { ?>
			<div class="blog-item__description">
				<?= $mini_description; ?>
			</div>
		<?php } ?>
		<div class="blog-item__actions">
			<div class="blog-item__date"><?= get_the_date( 'd.m.Y' ) ?></div>
			<?php if ( ! empty( $terms ) ) { ?>
				<div class="blog-item__category"><?= implode( ', ', $terms ); ?></div>
			<?php } ?>
		</div>
	</div>
</div>
