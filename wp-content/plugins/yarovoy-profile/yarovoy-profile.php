<?php

/**
 * Plugin Name: ЯПодбор - Личный кабинет
 * Description: ЯПодбор - Личный кабинет. Фукнционал и шаблоны для ЛК
 * Author:      Filipp Romanov
 * Version:     1.0
 */


define( 'YAR_PROFILE_VERSION', '1.0.0' );

if ( ! defined( 'YAR_PROFILE_DIR' ) ) {
	define( 'YAR_PROFILE_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'YAR_PROFILE_TEMPLATES' ) ) {
	define( 'YAR_PROFILE_TEMPLATES', plugin_dir_path( __FILE__ ) . 'templates' );
}

if ( ! defined( 'YAR_PROFILE_URL' ) ) {
	define( 'YAR_PROFILE_URL', plugin_dir_url( __FILE__ ) );
}

require_once YAR_PROFILE_DIR . 'functions/autoloader.php';
require_once YAR_PROFILE_DIR . 'functions/class-init.php';
require_once YAR_PROFILE_DIR . 'functions/class-endpoints.php';

$init = new YAR_Init();
$init->run();

register_activation_hook( __FILE__, 'add_roles_on_plugin_activation' );
function add_roles_on_plugin_activation() {
	add_role( 'basic_expert', 'Эксперт' );
}