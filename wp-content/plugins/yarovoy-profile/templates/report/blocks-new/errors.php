<?php

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="report-form__errors">
	<div class="report-form__errors-title profile-form__block-title">Ошибки в отчете</div>
	<div class="report-form__errors-text">
		<?= $data; ?>
	</div>
</div>
