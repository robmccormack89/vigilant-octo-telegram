<?php
/**
 * RMcC Woo Theme functions and definitions
 *
 * @package Rmcc_Woo_Theme
 */

/**
* Theme functions
*/
require get_template_directory() . '/inc/theme-functions.php';
/**
* Timber class & functions
*/
if( class_exists( 'Timber' ) ) {
	require get_template_directory() . '/inc/timber-functions.php';
}
/**
* Woocommerce - set the global product object variable
*/
if ( class_exists( 'WooCommerce' ) ) {
	function timber_set_product( $post ) {
		global $product;
		$product = wc_get_product( $post->ID );
	}
	require get_template_directory() . '/inc/woo-filters.php';
	require get_template_directory() . '/inc/woo-functions.php';
}
/**
* Load our Custom Widget
*/
require get_template_directory() . '/widgets/uikit-html-widget.php';