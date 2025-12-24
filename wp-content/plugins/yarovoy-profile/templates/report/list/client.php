<?php

$blocks  = ( new YAR_Report_List_Repository() )->get_list();

?>

<div class="profile-reports__main profile-reports__client">
	<?php foreach ( $blocks as $status => $block ) {
		$counter = 1; ?>
		<div class="profile-reports__block" data-status="<?= $status; ?>">
			<div class="profile-reports__title profile__subtitle"><?= $block['title']; ?></div>
			<?php if ( ! empty( $block['posts'] ) ) { ?>
				<div class="profile-reports__row reports-client">
					<?php foreach ( $block['posts'] as $post ) {
						yar_plugin_get_template( 'report/list/client-item', $post, false );
					$counter++; } ?>
				</div>
			<?php } else { ?>
				<div class="profile-reports__empty">Отчетов пока нет</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>
