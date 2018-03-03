<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package iTek
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function itek_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'itek_jetpack_setup' );
