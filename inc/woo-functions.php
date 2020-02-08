<?php
/**
* Woo functions
*
* @package Sixstar_Theme
*/

// if woocommerce is activated, do this stuff, or not
if ( class_exists( 'WooCommerce' ) ) {
  
  function get_login_form() {

    get_template_part( 'template-parts/form-login' );

  }
  add_action( 'woo_login_form', 'get_login_form' );
  

  
 
}