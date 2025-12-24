<?php

$data = yar_get_part_arg( $args, 'data' );

?>

<div class="report-form__block report-form__video profile-form__block" data-type="video">
	<div class="report-form__title profile-form__block-title">Видео <span>(каждое не более 1 минуты, формат mp4, mov, avi)</span></div>
	<div class="report-form__documents-grid">
		<?php

		load_template( YAR_PROFILE_DIR . 'templates/form/file.php', false, [
			'title'    => 'Видео',
			'name'     => 'video_1',
			'value'    => $data,
			'validate' => [
				'maxtime' => 60,
				'ext'      => [ '.mp4', '.mov', '.avi' ],
				'type'     => 'video'
			]
		] );

		load_template( YAR_PROFILE_DIR . 'templates/form/file.php', false, [
			'title'    => 'Видео',
			'name'     => 'video_2',
			'value'    => $data,
			'validate' => [
				'maxtime' => 60,
				'ext'      => [ '.mp4', '.mov', '.avi' ],
				'type'     => 'video'
			]
		] );

		load_template( YAR_PROFILE_DIR . 'templates/form/file.php', false, [
			'title'    => 'Видео',
			'name'     => 'video_3',
			'value'    => $data,
			'validate' => [
				'maxtime' => 60,
				'ext'      => [ '.mp4', '.mov', '.avi' ],
				'type'     => 'video'
			]
		] );

		?>
	</div>
</div>
