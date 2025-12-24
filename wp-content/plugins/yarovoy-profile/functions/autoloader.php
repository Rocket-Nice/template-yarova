<?php

spl_autoload_register( function ( $class ) {
	$namespace = 'YAR_Profile\\';
	$path      = '';

	if ( 0 !== strpos( $class, $namespace ) ) {
		return;
	}

	$plugin_parts = explode( '\\', $class );
	$name         = array_pop( $plugin_parts );
	$name         = preg_match( '/^(Interface|Trait)/', $name )
		? $name . '.php'
		: 'class-' . $name . '.php';

	$class = implode( '/', $plugin_parts ) . '/' . $name;
	$class = str_replace( $namespace, '', $class );
	$class = strtolower( str_replace( [ '\\', '_' ], [ '/', '-' ], $class ) );
	$class = str_replace( 'yar-profile/', '', $class );

	$file = realpath(  YAR_PROFILE_DIR . "classes/{$path}" );
	$file = $file . DIRECTORY_SEPARATOR . str_replace( '\\', DIRECTORY_SEPARATOR, $class );

	if ( file_exists( $file ) ) {
		include( $file );
	}
} );