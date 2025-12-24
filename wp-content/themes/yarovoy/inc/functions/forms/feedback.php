<?php

add_action('wp_ajax_yar_feedback_form', 'yar_feedback_form');
add_action('wp_ajax_nopriv_yar_feedback_form', 'yar_feedback_form');
function yar_feedback_form()
{
	if (empty($_POST) || ! wp_verify_nonce($_POST['_wpnonce'], 'action_on_feedback')) {
		wp_send_json_error();
	}

	// *
	$name  = $_POST['name'];
	$phone = $_POST['phone'];

	$mark       = $_POST['mark'];
	$model      = $_POST['model'];
	$generation = $_POST['generation'];
	$year       = $_POST['year'];
	$budget     = $_POST['budget'];
	$region     = $_POST['region'];
	$service    = $_POST['service'];
	$preference = $_POST['preference'];
	$page       = $_POST['page_url'];

	$errors  = new WP_Error();

	if (empty($name)) {
		$errors->add('name', 'Это поле необходимо заполнить');
	}

	if (empty($phone)) {
		$errors->add('phone', 'Это поле необходимо заполнить');
	}

	if (! empty($errors->errors)) {
		wp_send_json_error([
			'errors' => $errors->errors
		]);
	}

	$message = "Заявка: \n";
	$message .= "Имя: $name \n";
	$message .= "Телефон: $phone \n";

	if ($mark) {
		$message .= "Марка: $mark \n";

		if ($model) {
			$message .= "Модель: $model \n";
		}

		if ($generation) {
			$message .= "Поколение: $generation \n";
		}
	}

	if ($year) {
		$message .= "Год: $year \n";
	}

	if ($budget) {
		$message .= "Бюджет: $budget \n";
	}

	if ($region) {
		$message .= "Регион: $region \n";
	}

	if ($service) {
		$message .= "Услуга: $service \n";
	}

	if ($preference) {
		$message .= "Какие марки рассматриваются: $preference \n";
	}

	if ($page) {
		$message .= "Страница откуда заявка: $page";
	}

	$response = wp_remote_post('https://api.telegram.org/bot7132338626:AAHNHxYdUXnxY-tOQhpU-Tc_jMN6sJRGS0U/sendMessage', [
		'body' => [
			'chat_id' => -1002010083232,
			'text'    => $message
		]
	]);

	if (! is_wp_error($response) && wp_remote_retrieve_body($response)) {
		wp_send_json_success();
	}

	wp_die();
}

//Новые две формы
add_action('wp_ajax_yar_modal_form', 'yar_modal_form');
add_action('wp_ajax_nopriv_yar_modal_form', 'yar_modal_form');

function yar_modal_form()
{
	if (empty($_POST) || !wp_verify_nonce($_POST['_wpnonce'], 'modal_form_nonce')) {
		wp_send_json_error(['errors' => ['Ошибка валидации данных']]);
	}

	$name  = sanitize_text_field($_POST['name']);
	$phone = sanitize_text_field($_POST['phone']);
	$budget = isset($_POST['budget']) ? sanitize_text_field($_POST['budget']) : '';

	$errors = [];

	if (empty($name)) {
		$errors[] = 'Введите ваше имя.';
	}

	if (empty($phone)) {
		$errors[] = 'Введите ваш телефон.';
	}

	if (!empty($errors)) {
		wp_send_json_error(['errors' => $errors]);
	}

	$message = "Новая заявка:\n";
	$message .= "Имя: $name\n";
	$message .= "Телефон: $phone\n";

	if (!empty($budget)) {
		$message .= "Бюджет: $budget\n";
	}

	$response = wp_remote_post('https://api.telegram.org/bot7132338626:AAHNHxYdUXnxY-tOQhpU-Tc_jMN6sJRGS0U/sendMessage', [
		'body' => [
			'chat_id' => -1002010083232,
			'text'    => $message,
		]
	]);

	if (!is_wp_error($response) && wp_remote_retrieve_body($response)) {
		wp_send_json_success();
	}

	wp_send_json_error(['errors' => ['Ошибка отправки данных']]);
}
