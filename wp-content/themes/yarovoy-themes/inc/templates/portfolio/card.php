<?php

$service = get_field( 'service' );

?>

<a href="<?php the_permalink(); ?>" class="portfolio__item">
	<?php the_post_thumbnail( 'big' ); ?>
	<div class="portfolio__item-head">
		<?php if ( $service ) { ?>
			<div class="portfolio__item-service"><?= $service; ?></div>
		<?php } ?>
		<h5 class="portfolio__item-title"><?php the_title(); ?></h5>
	</div>
</a>
