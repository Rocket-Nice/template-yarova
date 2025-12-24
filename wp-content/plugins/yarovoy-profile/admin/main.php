<?php

if ( ! defined( 'YAR_PROFILE_ADMIN_TEMPLATES' ) ) {
	define( 'YAR_PROFILE_ADMIN_TEMPLATES', plugin_dir_path( __DIR__ ) . 'admin/templates' );
}

add_action( 'admin_enqueue_scripts', 'yar_admin_load_admin_style' );
function yar_admin_load_admin_style() {
	wp_enqueue_style( 'yar_admin-css', plugins_url( 'assets/css/style.css', __FILE__ ), false, '1.0.0' );
	wp_enqueue_style( 'yar_admin-report-css', plugins_url( 'assets/css/report.css', __FILE__ ), false, '1.0.0' );
	wp_enqueue_script( 'yar_admin-script',plugins_url( 'assets/js/main.js', __FILE__ ), array( 'jquery' ), '1.0', true );
}

add_action( 'admin_menu', 'yar_register_page_separation' );
function yar_register_page_separation() {
	add_menu_page(
		'Личный кабинет',
		'Личный кабинет',
		'manage_options',
		'lk-pages',
		'yar_register_page_separation_callback',
		'dashicons-universal-access',
		6
	);

	add_menu_page(
		'Тема: миграции',
		'Тема: миграции',
		'manage_options',
		'yar-migration-page',
		'yar_migration_page_callback',
		'dashicons-universal-access',
		7
	);
}

function yar_register_page_separation_callback() {

}

function yar_migration_page_callback(){
	load_template(
		YAR_PROFILE_DIR . 'admin/templates/migrate.php',
	);
}

require_once YAR_PROFILE_DIR . 'admin/classes/services/class-yar-admin-publish-expert.php';
require_once YAR_PROFILE_DIR . 'admin/classes/services/class-yar-admin-service-migrate.php';

new YAR_Admin_Service_Migrate();

require_once YAR_PROFILE_DIR . 'admin/classes/class-yar-admin-report.php';
require_once YAR_PROFILE_DIR . 'admin/classes/class-yar-admin-contacts.php';
require_once YAR_PROFILE_DIR . 'admin/classes/class-yar-admin-users.php';

new YAR_Admin_Register_Report();
new YAR_Admin_Contracts();
new YAR_Admin_Users();