<?php


return [
	'user' => [
		'avatar'    => [
			'multiple' => false,
			'field'    => 'avatar',
			'validate' => 'file|type:jpg,jpeg|max_files:1'
		],
		'documents' => [
			'multiple'  => true,
			'field'     => 'documents',
			'validate'  => 'file|type:jpg,jpeg|max_files:15',
			'field_key' => 'field_66e4117e5ec09'
		],
		'portfolio' => [
			'multiple'  => true,
			'field'     => 'portfolio',
			'validate'  => 'file|type:jpg,jpeg|max_files:15',
			'field_key' => 'field_66e4119c7a688'
		]
	],

	'report' => [
		'gallery'   => [
			'multiple'  => true,
			'field'     => 'gallery',
			'validate'  => 'file|type:jpg,jpeg|min_files:3',
			'field_key' => 'field_671b61e041a87'
		],
		'documents' => [
			'multiple'  => true,
			'field'     => 'documents',
			'validate'  => 'file|type:jpg,jpeg|max_files:24',
			'field_key' => 'field_67a0ac7c69ff4'
		],
		'video_1'   => [
			'multiple'  => false,
			'field'     => 'video_1',
			'validate'  => 'file|type:mp4,mov|max_files:1',
			'field_key' => 'field_676e5fd7b180b'
		],
		'video_2'   => [
			'multiple' => false,
			'field'    => 'video_2',
			'validate' => 'file|type:mp4,mov|max_files:1'
		],
		'video_3'   => [
			'multiple' => false,
			'field'    => 'video_3',
			'validate' => 'file|type:mp4,mov|max_files:1'
		],
	]
];