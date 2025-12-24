<?php get_header( null, [ 'classes' => 'body--dark' ] );

$mini_description = get_field( 'mini_description' );
$full_description = get_field( 'full_description' );

?>
	<div class="page-container container text__page blog-single">
		<section class="section section--banner">
			<?php get_template_part( YAR_THEME_TEMPLATES . '/breadcrumbs' ); ?>
			<div class="text__page-content">
				<?php if ( $mini_description || has_post_thumbnail() ) { ?>
					<div class="blog-single__grid">
						<?php if ( $mini_description ) { ?>
							<div class="blog-single__content">
								<h1 class="title white"><?php the_title(); ?></h1>
								<?= $mini_description; ?>
							</div>
						<?php } ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="blog-single__image">
								<?php the_post_thumbnail( 'big' ); ?>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
					<h1><?php the_title(); ?></h1>
				<?php } ?>
				<?= ( $full_description ? $full_description : get_the_content() ); ?>
			</div>
		</section>
	</div>
<?php get_footer(); ?>