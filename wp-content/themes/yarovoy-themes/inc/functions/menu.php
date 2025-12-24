<?php

add_filter( 'nav_menu_css_class', 'yar_nav_menu_css_class_filter', 10, 4 );
function yar_nav_menu_css_class_filter( $classes, $menu_item, $args, $depth ) {
	if ( isset( $args->menu_bem_class ) ) {
		$classes[] = ' ' . $args->menu_bem_class . '-item';
	}

	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'yar_change_nav_menu_link_attributes', 10, 3 );
function yar_change_nav_menu_link_attributes( $atts, $menu_item, $args ) {
	if ( isset( $args->menu_bem_class ) ) {
		$atts['class'] = $args->menu_bem_class . '-link';
	}

	return $atts;
}

add_filter( 'wp_nav_menu_objects', 'yar_add_icon_for_child_menu' );
function yar_add_icon_for_child_menu( $items ) {
	foreach ( $items as $item ) {
		if ( in_array( 'menu-item-has-children', $item->classes ) ) {
			$item->title .= ' <span class="header__nav-arrow"></span>';
		}
	}

	return $items;
}