<?php

return [
	'owners'              => [
		'title'  => 'Данные владельца',
		'type'   => 'fields',
		'fields' => [
			[
				'slug'        => 'fio',
				'type'        => 'text',
				'label'       => 'ФИО владельца',
				'placeholder' => 'ФИО владельца',
				'name'        => 'owners_fio',
			],
			[
				'slug'        => 'phone',
				'type'        => 'text',
				'label'       => 'Телефон владельца',
				'placeholder' => 'Телефон владельца',
				'name'        => 'owners_phone',
			],
		]
	],
	'features'            => [
		'title'  => 'Характеристики ТС',
		'fill'   => 'features',
		'type'   => 'fields',
		'fields' => []
	],
	'vin'                 => [
		'title'  => 'VIN номер',
		'fill'   => 'vin',
		'type'   => 'inspection-values',
		'fields' => []
	],
	'gallery'             => [
		'title'     => 'Фото автомобиля <span>(не менее 24шт)</span>',
		'title_api' => 'Фото автомобиля (не менее 24шт)',
		'name'      => 'gallery',
		'type'      => 'gallery',
		'min_files' => 24,
		'max_files' => 50,
		'validate'  => [
			'ext' => [ '.jpg', '.jpeg' ]
		],
	],
	'documents'           => [
		'title'     => 'Документы <span>(ПТС, СТС, Паспорт продавца)</span>',
		'title_api' => 'Документы (ПТС, СТС, Паспорт продавца)',
		'name'      => 'documents',
		'type'      => 'gallery',
		'min_files' => 24,
		'max_files' => 50,
		'validate'  => [
			'ext' => [ '.jpg', '.jpeg' ]
		],
	],
	'video'               => [
		'title'     => 'Видео <span>(каждое не более 5 минут, формат mp4, mov, avi)</span>',
		'title_api' => 'Видео (каждое не более 5 минут, формат mp4, mov, avi)',
		'type'      => 'video',
		'name'      => 'videos',
		'fields'    => [
			[
				'title'    => 'Видео',
				'name'     => 'video_1',
				'type'     => 'video',
				'validate' => [
					'maxtime' => 300,
					'ext'     => [ '.mp4', '.mov', '.avi' ],
					'type'    => 'video'
				]
			],
			[
				'title'    => 'Видео',
				'name'     => 'video_2',
				'type'     => 'video',
				'validate' => [
					'maxtime' => 300,
					'ext'     => [ '.mp4', '.mov', '.avi' ],
					'type'    => 'video'
				]
			],
			[
				'title'    => 'Видео',
				'name'     => 'video_3',
				'type'     => 'video',
				'validate' => [
					'maxtime' => 300,
					'ext'     => [ '.mp4', '.mov', '.avi' ],
					'type'    => 'video'
				]
			],
		]
	],
	'body_inspection'     => [
		'title'      => 'Осмотр кузова',
		'with_image' => true,
		'type'       => 'inspection',
		'fill'       => 'front',
		'fields'     => []
	],
	'dashboard'           => [
		'title'  => 'Осмотр кузова',
		'type'   => 'completion',
		'fields' => [],
		'fill'   => 'dashboard',
	],
	'interior_inspection' => [
		'title'  => 'Осмотр интерьера',
		'type'   => 'inspection',
		'fields' => [],
		'fill'   => 'interior',
	],
	'interior_equipment'  => [
		'title'  => 'Осмотр интерьера',
		'type'   => 'fields',
		'fields' => [
			[
				'type'        => 'textarea',
				'label'       => 'Комментарий',
				'placeholder' => 'Комментарий',
				'name'        => 'interior_equipment_comment',
				'slug'        => 'comment',
			],
		],
	],
	'summary'             => [
		'title'    => 'Резюме осмотра',
		'type'     => 'inspection-values',
		'fill'     => 'summary',
		'subtitle' => 'Поставьте комплексную оценку, где 5 - “отлично”, а 1 - “очень плохо”'
	],
];