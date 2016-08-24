<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Cell
 */

function cell_jetpack_setup() {

	/**
	 * Add theme support for Responsive Videos.
	 * See: http://jetpack.me/support/responsive-videos/
	 */
	add_theme_support( 'jetpack-responsive-videos' );

}
add_action( 'after_setup_theme', 'cell_jetpack_setup' );
