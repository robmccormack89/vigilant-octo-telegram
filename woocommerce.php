<?php
/**
 * The template for making woocommerce work with timber/twig. sets the templates & context for woo's archive & singular views
 *
 * @package Sixstar_Theme
 */

// make sure timber is activated first
if ( ! class_exists( 'Timber' ) ) {
  echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
  return;
}
// get the main context
$context = Timber::context();

// if is single product
if ( is_singular( 'product' ) ) {
  // get the post object
  $context['post'] = Timber::get_post();
  // get the product using the post id
  $product = wc_get_product( $context['post']->ID );
  // set the product object as a context variable
  $context['product'] = $product;
  // get the product gallery attachment ids
  $context['attachment_ids'] = $product->get_gallery_image_ids();
  // Restore the context and loop back to the main query loop.
  wp_reset_postdata();
  // render the woo single template
  Timber::render( 'single-product.twig', $context );
} 
// else (if is woo archive)
else {
  // get the posts
  $posts = new Timber\PostQuery();
  // set the products as a variable for looping
  $context['products'] = $posts;
  
  /* get product cats */
  $context['shopcats'] = get_terms( array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
  ) );
  /* get product category base */
  $wc_options = get_option('woocommerce_permalinks');
  /* join the site url to product cat base */
  $context['product_category_base'] = ''. $siteurl . '/' . $wc_options['category_base'] . '';
  /* get the shop base url */
  $context['shop_page_url'] = get_permalink( woocommerce_get_page_id( 'shop' ) );
  
  // if is product category archive page
  if ( is_product_category() ) {
    // get the queried object
    $queried_object = get_queried_object();
    // get the term id and set it
    $term_id = $queried_object->term_id;
    /* get the product category object (queried) */
    $context['product_term_id'] = $term_id;
    // set the category variable using the term id
    $context['category'] = get_term( $term_id, 'product_cat' );
    // set the title variable
    $context['title'] = single_term_title( '', false );
    // Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  // if is main shop page, set the title
  if ( is_shop() ) {
    $context['title'] = 'Our Competitions';
  };
  //  render the woo archive template with the context
  Timber::render( 'shop-archive.twig', $context );
}