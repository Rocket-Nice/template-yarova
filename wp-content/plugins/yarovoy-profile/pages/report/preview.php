<?php get_header();

$post_id = $_GET['post_id'];
if ( ! $post_id ) {
	return '';
}

$status                = get_field( 'status', $post_id );
$not_correctly_comment = get_field( 'not_correctly_comment', $post_id );

?>

<section class="section section--banner banner--dark">
	<div class="container">
	</div>
</section>

<div class="profile profile-report">
	<div class="container profile__container">
		<div class="profile-report__preview-edit">
			<?php yar_plugin_get_template( 'report/edit' ); ?>
		</div>

		<div class="profile-report__preview-actions form">
			<?php

			yar_plugin_get_template( 'form/select', [
				'label'         => 'Выбрать статус',
				'name'          => 'status',
				'value'         => $status['value'],
				'options'       => [
					'not_correctly' => 'Отчет выполнен не верно',
					'approved'      => 'Одобрить',
					'rejected'      => 'Отклонить',
				],
				'is_text_value' => true
			], false );

			yar_plugin_get_template( 'form/textarea', [
				'classes'     => 'profile-report__preview-comment ' . ( $status['value'] === 'not_correctly' ? '_active' : '' ),
				'name'        => 'not_correctly_comment',
				'placeholder' => 'Напишите ошибки отчета',
				'label'       => 'Дополнительные комментарии',
				'value'       =>  $not_correctly_comment ? strip_tags( $not_correctly_comment ) : '',
			], false );

			?>

			<?php wp_nonce_field( 'yar_admin_report_set_status', '_nonce' ); ?>
			<input type="hidden" name="report_id" value="<?= get_query_var( 'profile/reports/preview' ); ?>">
			<button class="profile-report__preview-btn btn btn--accent btn--wide btn--huge">Сохранить</button>
		</div>
	</div>
</div>

<?php yar_plugin_get_template( 'modals/message' ); ?>

<?php get_footer(); ?>
