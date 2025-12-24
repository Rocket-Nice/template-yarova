<?php

$next_step  = yar_get_part_arg( $args, 'next_step' );
$prev_step  = yar_get_part_arg( $args, 'prev_step' );

?>

<div class="upload-car__actions">
	<?php if ( ! empty( $prev_step['key'] ) ){ ?>
		<button class="upload-car__actions-button upload-car__actions--prev" data-open-step="<?= $prev_step['key']; ?>" data-settings='<?= json_encode( $prev_step ); ?>'>
			<svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M16.5205 5.6709L5.89725 5.6709L9.28627 2.28188L7.39624 0.457031L0.878907 6.97437L7.39624 13.4917L9.28627 11.6668L5.89725 8.27783L16.5205 8.27783L16.5205 5.6709Z" fill="#252525"/>
			</svg>
			<span>НАЗАД</span>
		</button>
	<?php } ?>
	<?php if ( ! empty( $next_step['key'] ) ){ ?>
		<button class="upload-car__actions-button upload-car__actions--next" data-open-step="<?= $next_step['key']; ?>" data-settings='<?= json_encode( $next_step ); ?>'>
			<span>Следующий шаг</span>
			<svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M0.67871 5.69629L11.302 5.69629L7.91295 2.30728L9.80298 0.482422L16.3203 6.99976L9.80298 13.5171L7.91295 11.6922L11.302 8.30322L0.67871 8.30322L0.67871 5.69629Z" fill="white"/>
			</svg>
		</button>
	<?php } else { ?>
		<button class="upload-car__actions-save">Сохранить</button>
	<?php } ?>
</div>
