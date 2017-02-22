<?php

/**
 * A simple 5.2 compatible namespace class to keep the global scope clean.
 */
class lkwdwrd_extras {
	/**
	 * Runs load methods and fires an action other plugins can hook into.
	 *
	 * @return void.
	 */
	public static function load() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'styles' ) );
	}

	/**
	 * Enqueue the the main styles
	 *
	 * @return void.
	 */
	public static function styles( $debug = false ) {
		$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		wp_enqueue_style( 'lkwdwrd_extras', LKWDWRD_URL . "assets/css/lkwdwrd-extras{$min}.css" );
	}
}
