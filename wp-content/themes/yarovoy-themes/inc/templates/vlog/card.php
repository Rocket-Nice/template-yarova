<?php

$video = get_field( 'video_link' );

if ( ! has_post_thumbnail() ) {
	return '';
}

?>

<a href="<?= ( $video ? $video : '#' ); ?>" class="vlog__card" data-title="<?php the_title(); ?>" data-fancybox>
	<?php the_post_thumbnail(); ?>
</a>
