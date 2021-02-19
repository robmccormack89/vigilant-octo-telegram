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
  
  // get the main posts query
  $posts = new Timber\PostQuery();
  // set main query as products cariable 
  $context['products'] = $posts;
  // main template for woo archives is woo-archive
  $templates = array( 'shop.twig' );
  // main tease template
  $tease_template = array('tease-product.twig');
  // set the woo archive columns setting
  $context['products_grid_columns'] = wc_get_loop_prop('columns');
  
  $term_slug = get_query_var('product_cat');
  $context['the_term'] = get_term_by('slug', $term_slug, 'product_cat');
  
  // if is list-view
  if ( get_query_var('grid_list') == 'list-view' ) {
    // reset the woo archive columns setting
    $context['products_grid_columns'] = '1';
    // unshit the tease template variable with the new list tease template
  	array_unshift( $tease_template, 'tease-product-list.twig' );
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  $context['tease_template'] = $tease_template; 

  if ( is_product_category() ) {
    
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $context['term_id'] = $term_id;
    // Get subcategories of the current category
    $context['term_subs'] = get_terms([
      'taxonomy'    => 'product_cat',
      'hide_empty'  => true,
      'parent'      => $term_id,
    ]);

    // get the category & set variable with get_term using the term id
    $context['category'] = get_term( $term_id, 'product_cat' );
    // set the archive title
    $context['title'] = single_term_title( '', false );
    // get product category thumbnail
    $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
    $archive_header_bg = wp_get_attachment_url( $thumbnail_id );
    if (!empty($archive_header_bg)) {
      $context['archive_header_bg'] = $archive_header_bg;
    } else {
      $context['archive_header_bg'] = get_template_directory_uri() . '/assets/images/field.jpg';
    }
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
    
  };
  
  if ( is_tax('product_series') ) {
    
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $context['term_slug'] = $queried_object->slug;
    $context['term_id'] = $term_id;
    // Get subcategories of the current category
    $context['term_subs'] = get_terms([
      'taxonomy'    => 'product_series',
      'hide_empty'  => true,
      'parent'      => $term_id,
    ]);
    
    $context['new_terms'] = '';
    
    if (empty($context['term_subs'])) {
      
      $the_term_id = array();
      foreach($context['products'] as $item) {
        $product_cats = get_the_terms( $item->get_id(), 'product_cat' );
        foreach($product_cats as $product_cat) {
          $the_term_id[] .= $product_cat->term_id;
        }
        $sep = $the_term_id;
      };

      $context['prod_ids'] = $sep;
      $context['new_terms'] = get_terms([
        'taxonomy'    => 'product_cat',
        'hide_empty'  => true,
        'include' => $sep,
      ]);

    }
    
    // set the archive title
    $context['title'] = single_term_title( '', false );
    // get product category thumbnail
    $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
    $archive_header_bg = wp_get_attachment_url( $thumbnail_id );
    if (!empty($archive_header_bg)) {
      $context['archive_header_bg'] = $archive_header_bg;
    } else {
      $context['archive_header_bg'] = get_template_directory_uri() . '/assets/images/field.jpg';
    }
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  
  // if is main shop archive page
  if ( is_shop() ) {
    // set shop page archive title
    $context['title'] = 'Shop';
    $context['archive_header_bg'] = get_template_directory_uri() . '/assets/images/field.jpg';
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  
  Timber::render( $templates, $context );
  
}