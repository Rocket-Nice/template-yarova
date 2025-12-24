<?php

$blocks = ( new YAR_Report_List_Repository() )->get_list();

?>

<a href="create" class="profile-reports__add btn btn--huge btn--wide btn--accent">Создать отчет</a>

<div class="profile-reports__main profile-reports__expert">
	<?php foreach ( $blocks as $status => $block ) { ?>
		<div class="profile-reports__block" data-status="<?= $status; ?>">
			<div class="profile-reports__title profile__subtitle"><?= $block['title']; ?></div>
			<?php if ( ! empty( $block['posts'] ) ) { ?>
				<div class="profile-reports__row reports-expert">
					<?php foreach ( $block['posts'] as $post ){ ?>
						<div class="reports-expert__item">
							<?php if ( $post['number'] ){ ?>
								<div class="reports-expert__item-treaty">№ договора: <?= $post['number']; ?></div>
							<?php } ?>
							<div class="reports-expert__item-title">
								<?= $post['post_title']; ?><?= ( $post['service'] ? ', ' . $post['service'] : ''  ); ?>
							</div>
							<?php if (
								$status !== 'on_moderated'
								&& $status !== 'completed'
								&& $status !== 'rejected'
							) { ?>
								<div class="reports-expert__item-actions">
									<a href="edit/<?= $post['_report_id']; ?>/" class="btn btn--wide btn--accent btn--huge reports-expert__item-more">
										Отчет
									</a>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } else { ?>
				<div class="profile-reports__empty">Отчетов пока нет</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>