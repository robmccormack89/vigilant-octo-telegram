<?php
/**
* Woo custom
*
* @package Rmcc_Woo_Theme
*/
  
function custom_filter_wc_cart_item_remove_link( $sprintf, $cart_item_key ) {
  if ( is_admin() && ! defined( 'DOING_AJAX' ) )
      return $sprintf;
  $sprintf = str_replace('&times;', '<span uk-icon="close"></span>', $sprintf);
  return $sprintf;
};
add_filter( 'woocommerce_cart_item_remove_link', 'custom_filter_wc_cart_item_remove_link', 10, 2 );

// filters the mini-cart results count for ajax; see php file
function iconic_cart_count_fragments( $fragments ) {
  $fragments['span.header-cart-count'] = '<span class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

// filters the mini-cart subtotal for ajax; she php file
function iconic_subtotal_fragments( $fragments ) {
  $fragments['span.subtotal-cart'] = '<span class="subtotal-cart">' . WC()->cart->get_cart_subtotal() . '</span>';
  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_subtotal_fragments', 10, 1 );