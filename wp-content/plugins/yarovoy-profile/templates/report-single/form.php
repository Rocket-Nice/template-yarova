<?php

$report_id = yar_get_part_arg( $args, 'report_id', get_query_var( 'profile/reports/view' ) );

$repository = new YAR_Report_Get_Id_Repository();
$report     = $repository->get_single( $report_id );
$title      = $repository->get_title();

$blocks = [
	'features' => [
		'title' => 'Характеристики ТС',
		'data'  => $report['features'],
	],

	'client' => [
		'title' => 'Данные владельца',
		'data'  => $report['owners']
	],

	'gallery' => [
		'title' => 'Фото',
		'data'  => $report['gallery']
	],

	'videos' => [
		'title' => 'Видео',
		'data'  => $report['videos']
	],

	'vin' => [
		'title'    => 'Проверка VIN',
		'data'     => $report['vin'],
		'template' => 'summary',
	],

	'body_inspection' => [
		'title'    => 'Осмотр кузова',
		'data'     => $report['body_inspection'],
		'template' => 'inspection',
	],

	'dashboard' => [
		'title'    => 'Приборная панель',
		'data'     => $report['dashboard'],
		'template' => 'completion',
	],

	'interior' => [
		'title'    => 'Осмотр интерьера',
		'data'     => $report['interior_inspection'],
		'template' => 'inspection',
	],

	'interior_equipment' => [
		'title'      => 'Комплектация салона',
		'data'       => $report['interior_equipment'],
		'template'   => 'comment',
	],

	'summary' => [
		'title'    => 'Резюме осмотра',
		'data'     => $report['summary'],
		'template' => 'summary',
	],

//	'total' => [
//		'title'    => 'Итог',
//		'data'     => $report['total'],
//		'template' => 'total'
//	],
];
?>

<div class="profile profile-report">
	<div class="container profile__container">
		<?php

		yar_plugin_get_template( 'common/page-header' );

		?>

		<div class="profile-report__subtitle">Технический отчёт</div>
		<div class="profile-report__title"><?= $title; ?></div>
		<div class="profile-report__row">
			<?php if ( ! empty( $blocks ) ) {
				foreach ( $blocks as $type => $block ) { ?>
					<div class="profile-report__block">
						<div class="profile-report__block-title">
							<span><?= $block['title']; ?></span>
							<svg width="21" height="18" viewBox="0 0 21 18" fill="none"
								 xmlns="http://www.w3.org/2000/svg">
								<path d="M10.4683 17.2158L0.748737 0.381104L20.1878 0.381105L10.4683 17.2158Z"
									  fill="#252525" />
							</svg>
						</div>
						<div class="profile-report__block-content">
							<?php
							$template = $type;
							if ( isset( $block['template'] ) ) {
								$template = $block['template'];
							}

							yar_plugin_get_template( 'report-single/blocks/' . $template, [
								'data' => $block['data'],
								'type' => $type
							], false ) ?>
						</div>
					</div>
				<?php }
			} ?>
		</div>
	</div>
</div>