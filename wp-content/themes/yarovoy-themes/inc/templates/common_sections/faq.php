<?php

$faq = get_field( 'faq' );
if ( empty( $faq ) ) {
	return '';
}

$counter = 1;

?>

<section class="section">
	<div class="faq">
		<div class="faq__list">
			<?php foreach ( $faq as $item ) { ?>
				<div class="faq__item">
					<button class="btn--reset faq__item-btn js-accordion" aria-expanded="false"
							aria-label="Toggle accordion">
						<?= $item['title']; ?>
					</button>
					<div class="faq__item-content--wrap">
						<div class="faq__item-content">
							<?= $item['text']; ?>
						</div>
					</div>
				</div>
				<?php $counter ++;
			} ?>
		</div>
	</div>
</section>
