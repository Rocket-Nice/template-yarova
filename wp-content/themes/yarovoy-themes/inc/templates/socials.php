<?php

$class       = yar_get_part_arg( $args, 'classes' );
$with_title  = yar_get_part_arg( $args, 'with_title' );
$with_tiktok = yar_get_part_arg( $args, 'with_tiktok' );

$socials = get_field( 'socials', 'option' );
if ( empty( $socials ) ) {
	return '';
}
?>

<div class="social <?= $class; ?>">
	<?php foreach ( $socials as $social ) { ?>
		<a class="social__link social__link--<?= $social['class']; ?>" href="<?= $social['link']; ?>" target="_blank"
		   title="Go to <?= $social['title']; ?>">
			<?php if ( $with_title && $social['title'] ) {
				echo $social['title'];
			} ?>
		</a>
	<?php } ?>
</div>
