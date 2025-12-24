<?php

if ( yar_is_expert() ) {
	$data = [
		'in_work'       => [
			'title'    => 'Отчеты в работе',
			'posts'    => [],
			'statuses' => [ 'in_work', 'saved' ],
		],
		'on_moderated'  => [
			'title'    => 'Ожидают проверки модератора',
			'posts'    => [],
			'statuses' => [ 'on_moderated' ]
		],
		'not_correctly' => [
			'title'    => 'Отчет выполнен не верно',
			'posts'    => [],
			'statuses' => [ 'not_correctly' ]
		],
		'completed' => [
			'title'    => 'Выполненные отчеты',
			'posts'    => [],
			'statuses' => [ 'approved' ]
		],
		'rejected' => [
			'title'    => 'Отклоненные отчеты',
			'posts'    => [],
			'statuses' => [ 'rejected' ]
		],
	];
} elseif ( yar_is_client() ) {
	$data = [
		'approved' => [
			'title'    => 'Одобренные менеджером отчёты',
			'posts'    => [],
			'statuses' => [ 'approved' ]
		],
		'in_work'  => [
			'title'    => 'Ожидающие одобрения',
			'posts'    => [],
			'statuses' => [ 'in_work', 'on_moderated', 'not_correctly' ]
		],
		'rejected' => [
			'title'    => 'Отклонённые',
			'posts'    => [],
			'statuses' => [ 'rejected' ]
		],
	];
}

return $data;