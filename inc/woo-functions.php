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
  
  
  // ajax result count
  function cart_ajax_result_count() {

    echo '<span class="header-cart-count">';
    echo WC()->cart->get_cart_contents_count();
    echo '</span>';

  }
  add_action( 'cart_ajax_result_count', 'cart_ajax_result_count' );
  
  // ajax result count
  function cart_ajax_subtotal() {

    echo '<span class="subtotal-cart">';
    echo WC()->cart->get_cart_subtotal();
    echo '</span>';

  }
  add_action( 'cart_ajax_subtotal', 'cart_ajax_subtotal' );
 
}