<?php

$classes   = isset( $args['classes'] ) ? $args['classes'] : '';
$rating    = isset( $args['rating'] ) ? $args['rating'] : 5;
$max_stars = 5;

?>

<div class="expert__rating <?= $classes; ?>">
	<div class="expert__rating-stars">
		<?php
		for ( $i = 1; $i <= $max_stars; $i ++ ) {
			if ( $rating < $i ) {
				if ( is_float( $rating ) && ( round( $rating ) == $i ) ) { ?>
					<img src="<?= YAR_THEME_ASSETS; ?>/img/icons/review-star-half.svg" alt="">
				<?php } else { ?>
					<img src="<?= YAR_THEME_ASSETS; ?>/img/icons/review-star-empty.svg" alt="">
				<?php }
			} else { ?>
				<img src="<?= YAR_THEME_ASSETS; ?>/img/icons/review-star.svg" alt="">
			<?php }
		}
		?>
	</div>
	<div class="expert__rating-sum">
		<?= number_format( $rating, 1, '.', '' ); ?>
	</div>
</div>
