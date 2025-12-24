<?php

define( 'YAR_THEME_ASSETS', get_template_directory_uri() . '/assets' );
define( 'YAR_THEME_INC', get_template_directory_uri() . '/inc' );
define( 'YAR_THEME_TEMPLATES',  '/inc/templates' );

register_nav_menus( [
	'main'  => 'Верхнее меню',
	'footer_services'  => 'Футер: Услуги',
	'footer_about'  => 'Футер: О компании',
] );

if ( ! is_admin() ) {
	function theme_styles() {
		wp_enqueue_style( 'libs.swiper', YAR_THEME_ASSETS . '/libs/swiper/swiper-bundle.min.css' );
		wp_enqueue_style( 'libs.fancybox', '//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css' );
		wp_enqueue_style( 'styles.main', YAR_THEME_ASSETS . '/styles/main.css' );
		wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css' );
		if ( is_singular( 'service' ) && is_page_template( 'pages/new-service.php' ) ) {
			wp_enqueue_style( 'custom-styles', get_template_directory_uri() . '/assets/css/style-3.css' );
		}
	}

	function theme_js() {
		wp_enqueue_script( 'libs.fancybox', '//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'libs.swiper', YAR_THEME_ASSETS . '/libs/swiper/swiper-bundle.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'libs.inputmask', YAR_THEME_ASSETS . '/libs/inputmask/inputmask.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'libs.ajax', YAR_THEME_ASSETS . '/js/ajax.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'helpers.main', YAR_THEME_ASSETS . '/js/main.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'main', YAR_THEME_ASSETS . '/scripts/main.js', array( 'jquery' ), '', true );
		if ( is_singular( 'service' ) && is_page_template( 'pages/new-service.php' ) ) {
			wp_enqueue_script( 'custom-script', get_template_directory_uri(). '/assets/js/new-service-main.js', array( 'jquery' ), '', true );
		}
	}

	add_action( 'wp_enqueue_scripts', 'theme_styles' );
	add_action( 'wp_enqueue_scripts', 'theme_js' );
}

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( [
		'page_title' => 'Настройки сайта',
		'menu_title' => 'Настройки сайта',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	] );
}

function dd( $array ) {
	echo '<pre>';
	var_dump( $array );
	echo '</pre>';
}

function yar_get_normal_price( $price ) {
	if ( ! $price || ! is_numeric( $price )) {
		return $price;
	}
	$price = floatval( $price );
	$price = number_format( $price, 0, '', ' ' );

	return $price;
}

function yar_get_section_classes( $args ) {
	$classes = '';

	if ( isset( $args['classes'] ) ) {
		$classes = $args['classes'];
	}

	return $classes;
}

function yar_get_part_arg( $args, $key, $default = '' ) {
	if ( ! empty( $args[ $key ] ) ) {
		return $args[ $key ];
	}

	return $default;
}

add_action( 'pre_get_posts', 'yar_pre_get_posts', 1 );
function yar_pre_get_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_post_type_archive( 'service' ) ) {
		$query->set( 'posts_per_page', -1 );
	}

	if ( $query->is_post_type_archive( 'portfolio' ) ) {
		$query->set( 'posts_per_page', 18 );
		$query->set( 'meta_key', 'price' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'DESC' );
	}

	if ( $query->is_post_type_archive( 'vlog' ) ) {
		$query->set( 'posts_per_page', 9 );
	}

	if ( $query->is_post_type_archive( 'blog' ) ) {
		$query->set( 'posts_per_page', 9 );
	}

	if ( $query->is_post_type_archive( 'auto' ) ) {
		$query->set( 'posts_per_page', 9 );
		$query->set( 'meta_key', 'price' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'DESC' );
	}
}

function yar_pagination() {
	global $wp_query;

	$big = 999999999;

	$args = [
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'type'      => 'list',
		'prev_text' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.3646 12.0587L13.948 15.642L12.9443 16.6457L8.35723 12.0587L12.9443 7.47161L13.948 8.47529L10.3646 12.0587Z" fill="white"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M11.6256 23.6505C5.22355 23.6505 0.0336914 18.4607 0.0336914 12.0587C0.0336914 5.65665 5.22355 0.466797 11.6256 0.466797C18.0276 0.466797 23.2174 5.65665 23.2174 12.0587C23.2174 18.4607 18.0276 23.6505 11.6256 23.6505ZM11.6256 22.2311C17.2437 22.2311 21.798 17.6768 21.798 12.0587C21.798 6.44057 17.2437 1.88621 11.6256 1.88621C6.00747 1.88621 1.4531 6.44057 1.4531 12.0587C1.4531 17.6768 6.00747 22.2311 11.6256 22.2311Z" fill="white"/>
</svg>',
		'next_text' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M13.3385 12.0587L9.75516 15.642L10.7588 16.6457L15.3459 12.0587L10.7588 7.47161L9.75516 8.47529L13.3385 12.0587Z" fill="white"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M12.0776 23.6505C18.4796 23.6505 23.6694 18.4607 23.6694 12.0587C23.6694 5.65665 18.4796 0.466797 12.0776 0.466797C5.67555 0.466797 0.485699 5.65665 0.485699 12.0587C0.485699 18.4607 5.67555 23.6505 12.0776 23.6505ZM12.0776 22.2311C6.45947 22.2311 1.90511 17.6768 1.90511 12.0587C1.90511 6.44057 6.45947 1.88621 12.0776 1.88621C17.6957 1.88621 22.25 6.44057 22.25 12.0587C22.25 17.6768 17.6957 22.2311 12.0776 22.2311Z" fill="white"/>
</svg>
',
		'total'     => $wp_query->max_num_pages
	];

	$result = paginate_links( $args );

	echo $result;
}

function yar_roung_to_half( $num ) {
	return round( $num * 2 ) / 2;
}

function yar_get_number_format( $num ) {
	return number_format( (int) $num, 0, '', ' ' );;
}

function yar_get_current_url() {
	$url = ( ( ! empty( $_SERVER['HTTPS'] ) ) ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	return $url;
}

function yar_reset_phone( $phone ) {
	return preg_replace( '![^0-9]+!', '', $phone );
}

function yar_base_acf_load_value( $value, $post_id, $field ) {
	if (
		$value === false
		&& get_post_status( $post_id ) === 'auto-draft'
	) {
		$adds = [
			'Год выпуска',
			'Поколение',
			'Кузов',
			'Двигатель',
			'Трансмиссия',
			'Привод',
			'Расход смешанный, л/100 км',
			'Разгон 0-100 км/ч, с',
			'Клиренс, мм',
			'Объём багажника, л',
			'Пробег',
		];

		$value = [];

		foreach ( $adds as $add ) {
			$value[] = [
				'field_66cd9e1c0f2e7' => $add
			];
		}
	}

	return $value;
}

add_filter( 'acf/load_value/key=field_66cd9dd80f2e6', 'yar_base_acf_load_value', 10, 3 );

require_once __DIR__ . '/functions/breadcrumbs.php';
require_once __DIR__ . '/functions/comments.php';
require_once __DIR__ . '/functions/expert.php';
require_once __DIR__ . '/functions/menu.php';
require_once __DIR__ . '/functions/bmg.php';
require_once __DIR__ . '/functions/filter_blog_vlog.php';
require_once __DIR__ . '/functions/base.php';

require_once __DIR__ . '/functions/forms/payment.php';
require_once __DIR__ . '/functions/forms/feedback.php';

// Parsing
require_once __DIR__ . '/functions/parsing/OLD_Parse.php';
require_once __DIR__ . '/functions/parsing/parsing.php';
