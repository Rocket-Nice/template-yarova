<?php

$repository   = new YAR_Car_Fields_Repository();
$current_step = yar_get_part_arg( $args, 'step' );

$next = $repository->get_action( $current_step );
$prev = $repository->get_action( $current_step, true );

?>


<div class="upload-car__actions">
	<?php if ( ! empty( $prev ) ) { ?>
		<button class="upload-car__actions-button upload-car__actions--prev" data-open-step="<?= $prev; ?>">
			<svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M16.5205 5.6709L5.89725 5.6709L9.28627 2.28188L7.39624 0.457031L0.878907 6.97437L7.39624 13.4917L9.28627 11.6668L5.89725 8.27783L16.5205 8.27783L16.5205 5.6709Z"
					  fill="#252525" />
			</svg>
			<span>Назад</span>
		</button>
	<?php } ?>
	<?php if ( ! empty( $next ) ) { ?>
		<button class="upload-car__actions-button upload-car__actions--next" data-open-step="<?= $next; ?>">
			<span>Следующий шаг</span>
			<svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M0.67871 5.69629L11.302 5.69629L7.91295 2.30728L9.80298 0.482422L16.3203 6.99976L9.80298 13.5171L7.91295 11.6922L11.302 8.30322L0.67871 8.30322L0.67871 5.69629Z"
					  fill="white" />
			</svg>
		</button>
	<?php } else { ?>
		<button class="upload-car__actions-save btn--loader">Сохранить</button>
	<?php } ?>
</div>

<?php if ( empty( $next ) ) { ?>
<div class="form__message--error"></div>
<?php } ?>