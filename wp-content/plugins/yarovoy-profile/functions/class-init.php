<?php


class YAR_Init
{
	public function run()
	{
		add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
		add_action('plugins_loaded', [$this, 'register_dependencies']);

		(new YAR_Endpoints())->init();

		// Для теста
		// add_action('wp_footer', function () {
		// 	echo '<div style="padding:20px;background:#f9f9f9;border:1px solid #ccc;max-width:400px;margin:40px auto;">';
		// 	echo '<h4>Тест AJAX запроса отчёта эксперта</h4>';
		// 	echo '<input id="yarovoy-expert-report-id" type="number" placeholder="ID отчёта" style="width:100%;margin-bottom:10px;">';
		// 	echo '<button id="yarovoy-expert-report-view-btn" style="width:100%;">Запросить отчёт</button>';
		// 	echo '</div>';
		// });
	}

	public function register_scripts()
	{
		wp_enqueue_style('yar-profile-style', plugins_url('../assets/css/style.css', __FILE__));
		wp_enqueue_script('yar-profile-script', plugins_url('../assets/js/index.min.js', __FILE__), array('jquery'), '1.0', true);
		// тут скриты аякс для теста
		// wp_enqueue_script('yarovoy-expert-report-view', plugins_url('../assets/js/yarovoy-expert-report-view.js', __FILE__), array(), '1.0', true);
		// wp_enqueue_script('yarovoy-expert-report-edit', plugins_url('../assets/js/yarovoy-expert-report-edit.js', __FILE__), array(), '1.0', true);
		// wp_localize_script('yarovoy-expert-report-edit', 'yarovoyApi', [
		// 	'nonce' => wp_create_nonce('wp_rest')
		// ]);
		// // Для теста
		// add_action('wp_footer', function () {
		// 	echo '<div style="padding:20px;background:#f9f9f9;border:1px solid #ccc;max-width:400px;margin:40px auto;">';
		// 	echo '<h4>Тест AJAX запроса редактирования отчёта (edit)</h4>';
		// 	echo '<input id="yarovoy-expert-report-edit-id" type="number" placeholder="ID отчёта" style="width:100%;margin-bottom:10px;">';
		// 	echo '<button id="yarovoy-expert-report-edit-btn" style="width:100%;">Запросить отчёт (edit)</button>';
		// 	echo '</div>';
		// });
		// // nonce для REST API
		// wp_localize_script('yarovoy-expert-report-view', 'yarovoyApi', [
		// 	'nonce' => wp_create_nonce('wp_rest')
		// ]);
	}

	public function register_dependencies()
	{
		if (is_admin()) {
			require_once YAR_PROFILE_DIR . 'admin/main.php';
		}

		// Helpers
		require_once YAR_PROFILE_DIR . 'functions/helpers.php';
		require_once YAR_PROFILE_DIR . 'functions/template-redirects.php';

		// Repositories
		require_once YAR_PROFILE_DIR . 'classes/repository/class-yar-user-repository.php';

		// Expert
		require_once YAR_PROFILE_DIR . 'classes/repository/class-yar-expert-repository.php';

		// Report
		require_once YAR_PROFILE_DIR . 'classes/repository/report/class-yar-report-repository.php';

		require_once YAR_PROFILE_DIR . 'classes/repository/report/class-yar-report-fields-repository.php';
		require_once YAR_PROFILE_DIR . 'classes/repository/report/class-yar-report-list-repository.php';
		require_once YAR_PROFILE_DIR . 'classes/repository/report/class-yar-report-get-id-repository.php';
		//require_once YAR_PROFILE_DIR . 'classes/repository/report/class-yar-report-public-repository.php';

		// Car
		require_once YAR_PROFILE_DIR . 'classes/repository/car/class-yar-car-fields-repository.php';
		require_once YAR_PROFILE_DIR . 'classes/repository/car/class-yar-car-repository.php';
		require_once YAR_PROFILE_DIR . 'classes/repository/car/class-yar-car-public-repository.php';

		require_once YAR_PROFILE_DIR . 'classes/repository/class-yar-contacts-repository.php';

		// Common classes for client / expert
		require_once YAR_PROFILE_DIR . 'classes/common/class-yar-login.php';
		require_once YAR_PROFILE_DIR . 'classes/common/class-yar-register.php';
		require_once YAR_PROFILE_DIR . 'classes/common/class-yar-profile.php';
		require_once YAR_PROFILE_DIR . 'classes/common/class-yar-update-password.php';
		require_once YAR_PROFILE_DIR . 'classes/common/class-yar-reset-password.php';

		new YAR_Login();
		new YAR_Register();
		new YAR_Profile();
		new YAR_Update_Password();
		new YAR_Reset_Password();

		// Client
		if (yar_is_client()) {
			require_once YAR_PROFILE_DIR . 'classes/client/class-yar-upload-car.php';
			require_once YAR_PROFILE_DIR . 'classes/client/class-yar-car-sold.php';
			require_once YAR_PROFILE_DIR . 'classes/client/class-yar-client-payment.php';

			new YAR_Upload_Car();
			new YAR_Car_Sold();
			new YAR_Client_Payment();
		}

		if (yar_is_expert()) {
			require_once YAR_PROFILE_DIR . 'classes/expert/class-yar-save-report.php';
			require_once YAR_PROFILE_DIR . 'classes/expert/class-yar-search-report.php';
			require_once YAR_PROFILE_DIR . 'classes/expert/class-yar-save-notifications.php';
			require_once YAR_PROFILE_DIR . 'classes/expert/class-yar-completed-contact.php';

			new YAR_Expert_Save_Report();
			new YAR_Expert_Search_Report();
			new YAR_Expert_Save_Notifications();
			new YAR_Expert_Completed_Contract();
		}

		// REST API
		require_once YAR_PROFILE_DIR . 'api/main.php';
	}
}
