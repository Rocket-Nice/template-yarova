<?php

$action    = 'create';
$report_id = get_query_var( 'profile/reports/edit' );
if ( ! empty( $report_id ) ) {
	$action = 'edit';
}

?>

<div class="report-form form">
	<?php

	if ( $action === 'edit' ) {
		yar_plugin_get_template( 'report/edit' );
	} else {
		yar_plugin_get_template( 'report/create' );
	}

	?>

	<div class="report-form__actions">
		<button class="btn btn--dark btn--wide btn--huge btn--loader report-form__btn report-form__save" data-action="save">Сохранить</button>
		<button class="btn btn--accent btn--wide btn--huge btn--loader report-form__btn report-form__send" data-action="moderate">Сохранить и отправить на проверку</button>
	</div>
	<div class="form__message--error"></div>
</div>

<?php yar_plugin_get_template( 'modals/message' ); ?>