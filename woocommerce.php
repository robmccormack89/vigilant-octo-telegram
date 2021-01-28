<?php
/**
 * The template for making woocommerce work with timber/twig. sets the templates & context for woo's archive & singular views
 *
 * @package Rmcc_Woo_Theme
 */

// make sure timber is activated first
if ( ! class_exists( 'Timber' ) ) {
  echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
  return;
}

// get the main context
$context = Timber::context();

if ( is_singular( 'product' ) ) {
  
  $context['post'] = Timber::get_post();
  $product = wc_get_product( $context['post']->ID );
  $context['product'] = $product;
  
  // Get related products
  $related_limit = wc_get_loop_prop( 'columns' );
  $related_ids = wc_get_related_products( $context['post']->id, $related_limit );
  $context['related_products_title'] = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );
  $context['related_products'] = Timber::get_posts( $related_ids );
  
  // Get upsells
  $upsell_ids = $product->get_upsells();
  $context['up_sells_title'] = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'woocommerce' ) );
  $context['up_sells'] =  Timber::get_posts( $upsell_ids );
  
  wp_reset_postdata();
  Timber::render( 'single-product.twig', $context );
  
} else {
  
  $posts = new Timber\PostQuery();
  $context['products'] = $posts;
  
  // set the woo archive columns setting
  $context['columns'] = wc_get_loop_prop('columns');

  if ( is_product_category() ) {
    
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $context['product_term_id'] = $term_id;
    $context['category'] = get_term( $term_id, 'product_cat' );
    $context['title'] = single_term_title( '', false );
    
  };
  
  if ( is_shop() ) {
    
    $context['title'] = 'Shop';
    
  };
  
  Timber::render( 'shop.twig', $context );
}