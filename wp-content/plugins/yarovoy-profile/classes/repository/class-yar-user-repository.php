<?php

class YAR_User_Repository
{
	private $user;
	private $prefix;

	public function get_page_title()
	{
		if (yar_is_expert()) {
			return 'Личный кабинет Специалиста';
		}

		return 'Личный кабинет пользователя';
	}

	public function get_menu()
	{
		if (yar_is_expert()) {
			return [
				[
					'link'  => '/profile/',
					'title' => 'Личная информация',
				],
				[
					'link'  => '/profile/reports/',
					'title' => 'Отчёты об автомобилях',
				],
				[
					'link'  => '/profile/search-report/',
					'title' => 'Поиск отчета',
				],
				[
					'link'  => '/profile/security/',
					'title' => 'Безопасность и уведомления',
				],
				[
					'link'  => '/profile/contracts/',
					'title' => 'Договоры',
				],
			];
		}

		return [
			[
				'link'  => '/profile/',
				'title' => 'Личная информация',
			],
			[
				'link'  => '/profile/reports/',
				'title' => 'Отчёты об автомобилях',
			],
			[
				'link'  => '/profile/upload-car/',
				'title' => 'Продать свой автомобиль',
			],
			[
				'link'  => '/profile/contracts/',
				'title' => 'Договоры и оплата',
			]
		];
	}

	private function get_default()
	{
		return [
			'user_email'    => $this->user->user_email,
			'avatar'        => yar_get_file_url(
				yar_get_field('avatar', $this->prefix, '')
			),
			'last_name'     => yar_get_field('last_name', $this->prefix),
			'first_name'    => yar_get_field('first_name', $this->prefix),
			'surname'       => yar_get_field('surname', $this->prefix),
			'phone'         => yar_get_field('phone', $this->prefix),
			'notifications' => [
				'on_email' => yar_get_field('on_email', $this->prefix, false),
				'on_phone' => yar_get_field('on_phone', $this->prefix, false),
			]
		];
	}

	private function get_client()
	{
		$data = $this->get_default();

		return array_merge($data, [
			'notifications' => [
				'on_email' => yar_get_field('on_email', $this->prefix, false),
				'on_phone' => yar_get_field('on_phone', $this->prefix, false),
			]
		]);
	}

	private function get_expert()
	{
		$data = $this->get_default();

		return array_merge($data, [
			'region'    => yar_get_field('region', $this->prefix, 0),
			'documents' => yar_get_file_data(
				yar_get_field('documents', $this->prefix, [])
			),
			'portfolio' => yar_get_file_data(
				yar_get_field('portfolio', $this->prefix, [])
			),
			'services'  => yar_get_field('services', $this->prefix, []),
			'about'     => $this->get_plain_text_about(),
		]);
	}

	private function get_plain_text_about()
	{
		$about = get_field('about', $this->prefix, false);

		if (empty($about)) {
			return '';
		}

		$about = preg_replace('/<br\s*\/?>/i', "\n", $about);
		$about = strip_tags($about);
		$about = html_entity_decode($about, ENT_QUOTES | ENT_HTML5, 'UTF-8');
		$about = str_replace(["\r\n", "\r"], "\n", $about);

		return trim($about);
	}

	public function get_current_user()
	{
		$current_user = wp_get_current_user();
		$user_prefix  = 'user_' . $current_user->ID;

		$this->user   = $current_user;
		$this->prefix = $user_prefix;

		if (yar_is_client()) {
			return $this->get_client();
		} elseif (yar_is_expert()) {
			return $this->get_expert();
		}

		return [];
	}
}
