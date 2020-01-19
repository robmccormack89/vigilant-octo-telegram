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
* Woo stuff
*/
function timber_set_product( $post ) {
   global $product;

   if ( is_woocommerce() ) {
       $product = wc_get_product( $post->ID );
   }
}
require get_template_directory() . '/inc/woo-custom.php';
require get_template_directory() . '/inc/woo-functions.php';

/**
* Custom Widget
*/
require get_template_directory() . '/widgets/uikit-html-widget.php';