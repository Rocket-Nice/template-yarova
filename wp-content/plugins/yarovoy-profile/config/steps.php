<?php

/**
 *
 * $return [
 *  title = string,
 *  gallery = array,
 *  fields = array (from database),
 *  checkboxes = array (from database),
 *  colors = array
 *  settings = array
 *  textarea = string
 *  file = array
 * ]
 */

return [
	'main'       => [
		'title'      => 'Основные параметры',
		'settings'   => [],
		'blocks'     => [
			'gallery'    => [
				'name' => 'gallery',
			],
			'fields'     => [],
			'checkboxes' => [],
			'textarea'   => [
				'title' => 'Описание автомобиля',
				'name'  => 'about'
			],
			'order'      => '',
			'files'      => [
				'report'      => 'Отчет эксперта (PDF, DOCX)',
				'report_from' => 'Отчет из автотеки, авто ру, инфобот и прочее (PDF, DOCX)',
			],
			'colors'     => [],
		],
		'validation' => [
			'gallery'         => 'file',
			'gallery_removed' => '',
			'vin'             => 'required|min:17|vin',
			'brand'           => 'required',
			'model'           => '',
			'generation'      => '',
			'body_style'      => '',
			'transmission'    => 'required',
			'fuel_type'       => 'required',
			'wheel_drive'     => 'required',
			'pts_owners'      => 'required|number',
			'price'           => 'required|number',
			'mileage'         => 'required|number',
			'year'            => 'required|number',
			'engine_size'     => 'required|number',
			'horse_power'     => 'required|number',
			'consumption'     => 'required|number',
			'about'           => 'required',
			'report'          => 'file',
			'report_from'     => 'file',
			'color'           => '',
		]
	],
	'safety'     => [
		'title'      => 'Безопасность',
		'settings'   => [],
		'blocks'     => [
			'fields'     => [],
			'checkboxes' => [],
		],
		'validation' => [
			'airbags'            => '',
			'support_systems'    => '',
			'isofix'             => '',
			'is_pressure_sensor' => '',
			'is_glonass'         => '',
			'is_armor'           => '',
			'is_esp'             => '',
			'is_abs'             => '',
			'is_doorlocks'       => '',
		],
	],
	'overview'   => [
		'title'      => 'Обзор',
		'settings'   => [ 'cols' => 2 ],
		'blocks'     => [
			'fields'     => [],
			'checkboxes' => [],
		],
		'validation' => [
			'headlight'            => '',
			'heating'              => '',
			'is_fog_lights'        => '',
			'is_high_beam'         => '',
			'is_headlight_control' => '',
			'is_adaptive_lights'   => '',
			'is_headlight_washer'  => '',
			'is_rain_sensor'       => '',
			'is_light_sensor'      => '',
		]
	],
	'other'      => [
		'settings'   => [ 'cols' => 2 ],
		'title'      => 'Прочее',
		'blocks'     => [
			'fields'     => [],
			'checkboxes' => [],
		],
		'validation' => [
			'pendant'      => '',
			'keycount'     => '',
			'is_crankcase' => '',
			'is_towbar'    => '',
		]
	],
	'comfort'    => [
		'title'      => 'Комфорт',
		'settings'   => [
			'cols'    => 2,
			'percent' => 6,
			'classes' => '_nowrap'
		],
		'blocks'     => [
			'fields'     => [],
			'checkboxes' => [],
		],
		'validation' => [
			'conditioning'                => '',
			'camera'                      => '',
			'power_windows'               => '',
			'power_steering'              => '',
			'steering_wheel'              => '',
			'parking_assist'              => '',
			'cruise'                      => '',
			'is_crankcase'                => '',
			'is_program_preheater'        => '',
			'is_start_stop_system'        => '',
			'is_projection_display'       => '',
			'is_multifunctional_steering' => '',
			'is_gearshift_paddles'        => '',
			'is_on_board_computer'        => '',
			'is_driving_selection_system' => '',
			'is_trunk_open'               => '',
			'is_power_trunk_lid'          => '',
			'is_electro_dashboard'        => '',
			'is_remote_engine_start'      => '',
			'is_pedal_assembly'           => '',
			'is_engine_button_start'      => '',
			'is_keyless_entry_system'     => '',
			'is_electro_folding_mirror'   => '',
		]
	],
	'exterior'   => [
		'title'      => 'Элементы экстерьера',
		'settings'   => [ 'cols' => 2 ],
		'blocks'     => [
			'fields'     => [],
			'checkboxes' => [],
		],
		'validation' => [
			'disk_type'    => '',
			'disk_size'    => '',
			'is_crankcase' => '',
			'is_body_kit'  => '',
			'is_airbush'   => '',
		]
	],
	'protection' => [
		'title'      => 'Защита от угона',
		'settings'   => [ 'cols' => 2 ],
		'blocks'     => [
			'fields'     => [],
			'checkboxes' => [],
		],
		'validation' => [
			'alarm'              => '',
			'is_immobilizer'     => '',
			'is_center_lock'     => '',
			'is_interior_sensor' => '',
		]
	],
	'salon'      => [
		'title'      => 'Салон',
		'settings'   => [
			'cols'    => 2,
			'percent' => 4,
			'classes' => '_nowrap'
		],
		'blocks'     => [
			'fields'     => [],
			'checkboxes' => [],
		],
		'validation' => [
			'inter_color'          => '',
			'power_seats'          => '',
			'seat_vent'            => '',
			'interior_material'    => '',
			'seat_memory'          => '',
			'seat_height'          => '',
			'seat_heating'         => '',
			'is_sport_frontseat'   => '',
			'is_luke'              => '',
			'is_fold_backseat'     => '',
			'is_leather_wheel'     => '',
			'is_leather_gearstick' => '',
			'is_tinted'            => '',
			'is_armrest'           => '',
			'is_panoramic_roof'    => '',
			'is_third_row'         => '',
			'is_heat_wheel'        => '',
		]
	],
	'multimedia' => [
		'title'      => 'Мультимедия',
		'is_last'    => true,
		'settings'   => [
			'cols'    => 2,
			'percent' => 4,
			'classes' => '_nowrap'
		],
		'blocks'     => [
			'fields'     => [],
			'checkboxes' => [],
		],
		'validation' => [
			'audio_system'     => '',
			'is_usb'           => '',
			'is_navigator'     => '',
			'is_voice_control' => '',
			'is_carplay'       => '',
			'is_yandex_auto'   => '',
			'is_aux'           => '',
			'is_12v'           => '',
			'is_220v'          => '',
			'is_lcd'           => '',
			'is_android_auto'  => '',
			'is_bluetooth'     => '',
			'is_lcd_rear'      => '',
		]
	],
];