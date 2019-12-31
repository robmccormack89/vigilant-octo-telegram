<?php
/**
 * Competitions Theme functions and definitions
 *
 * @package Competitions_Theme
 */

/**
* Theme functions
*/
require get_template_directory() . '/inc/theme-functions.php';

/**
* Timber class
*/
if( class_exists( 'Timber' ) ) {
	require get_template_directory() . '/inc/timber-functions.php';
}

/**
* Custom Widget
*/
require get_template_directory() . '/widgets/uikit-html-widget.php';