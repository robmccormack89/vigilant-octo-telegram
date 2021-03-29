<?php
/**
 * The template for making woocommerce work with timber/twig. sets the templates & context for woo's archive & singular views
 *
 * @package Vigilant_Octo_Telegram
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
  
} else { // is not singular, then it must be an archive!
  
  // get the main posts object via the standard wp archive query & assign as variable 'products'
  $posts = new Timber\PostQuery();
  $context['products'] = $posts;
  
  // define our archive & tease templates as arrays, which can be unshifted later depending on context
  $templates = array('shop.twig');
  $tease_template = array('tease-product.twig');
  $tease_term_template = array('tease-term.twig');
  
  // gets the woocommerce columns per row setting
  $context['products_grid_columns'] = wc_get_loop_prop('columns');
  
  $context['pagination'] = Timber::get_pagination();
  $context['paged'] = $paged;
  
  // if is list-view
  if (get_query_var('grid_list') == 'list-view') {
    // reset the woo archive columns setting
    $context['products_grid_columns'] = '1';
    // unshit the tease template variable with the new list tease template
  	array_unshift( $tease_template, 'tease-product-list.twig' );
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  
  // if is any new taxonomy, see is_tax wp dev handbook for details
  if (is_tax('')) {
    // get queried object stuff
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $context['term_slug'] = $queried_object->slug;
    $context['term_id'] = $term_id;
    // set the archive title
    $context['title'] = single_term_title( '', false );
    // get term thumbs
    // get product category thumbnail
    $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
    $archive_header_bg = wp_get_attachment_url( $thumbnail_id );
    if (!empty($archive_header_bg)) {
      $context['archive_header_bg'] = $archive_header_bg;
    } else {
      $context['archive_header_bg'] = get_template_directory_uri() . '/assets/images/field.jpg';
    };
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };

  // if is product category
  if (is_product_category()) {
    // get the category & set variable with get_term using the term id
    $context['category'] = get_term( $term_id, 'product_cat' );
    // Get subcategories of the current category
    $context['term_subs'] = get_terms([
      'taxonomy'    => 'product_cat',
      'hide_empty'  => true,
      'parent'      => $term_id,
    ]);
    // get term thumbs
    foreach($context['term_subs'] as $item) {
      
      $thumb_id = get_term_meta($item->term_id, 'thumbnail_id', true);
      $context['thumb_link'] = wp_get_attachment_url($thumb_id);

    };
    
    if ($context['term_subs'] && is_product_cat() == true && current_product_series_var() == true) {
    
      $context['current_series_obj_slug'] = get_query_var('product_series');
      $context['current_cat_obj_slug'] = $queried_object->slug;
    
      $someposts = get_posts(
        array(
          'post_type' => 'product',
          'posts_per_page' => -1,
          'fields' => 'ids', // return an array of ids
          'tax_query' => array(
            array(
              'taxonomy' => 'product_series',
              'field' => 'slug',
              'terms' => $context['current_series_obj_slug'],
            )
          )
        )
      );
    
      // Get subcategories of the current category
      $context['term_subs'] = get_terms([
        'taxonomy'    => 'product_cat',
        'hide_empty'  => true,
        'parent'      => $term_id,
        'object_ids' => $someposts,
      ]);
    
    } else {
    
      $context['current_series_obj_slug'] = '';
    
    }
    
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  
  // is product_series archive
  if (is_tax('product_series')) {
    
    // Get subcategories of the current category
    $context['term_subs'] = get_terms([
      'taxonomy'    => 'product_series',
      'hide_empty'  => true,
      'parent'      => $term_id,
    ]);
    // get term thumbs
    foreach($context['term_subs'] as $item) {
      $thumb_id = get_term_meta($item->term_id, 'thumbnail_id', true);
      $context['thumb_link'] = wp_get_attachment_url($thumb_id);
      // $context['url_out'] = get_term_link($item->term_id);
    };
    // set cats from series context as empty for now
    $context['cats_from_series'] = '';
    // if term subs is empty
    if (empty($context['term_subs'])) {
      // the cat ids for each product will be in an array
      $the_term_ids = array();
      // for each product
      foreach($context['products'] as $item) {
        // get the cats for that product
        $product_cats = get_the_terms( $item->get_id(), 'product_cat' );
        // for each product cat 
        foreach($product_cats as $product_cat) {
          // store cat id as a variable
          $the_term_ids[] .= $product_cat->term_id;
        }
        // we now have the cat ids for a product in the loop stored as an array, to be used in next step
        $sep = $the_term_ids;
      };
      // get the categories (parent only) related to products from the given series using the cat ids array we got above as we loop thru the products, then the cats
      $context['cats_from_series'] = get_terms([
        'taxonomy'    => 'product_cat',
        'hide_empty'  => true,
        'parent' => 0,
        'include' => $sep,
      ]);
      // get term thumbs
      foreach($context['cats_from_series'] as $item) {
        $thumb_id = get_term_meta($item->term_id, 'thumbnail_id', true);
        $context['thumb_link'] = wp_get_attachment_url($thumb_id);
        // $context['url_out'] = get_term_link($item->term_id) . '?product_series=' . $context['term_slug'];
      };
      // unshit the tease term template variable with the new term template where term_subs is empty
      array_unshift( $tease_term_template, 'tease-cat-from-series.twig' );
    };
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  
  // if is main shop archive page
  if (is_shop()) {
    
    // set shop page archive title
    $context['title'] = get_bloginfo( 'name' );
    // get shop main thumbnail
    $context['archive_header_bg'] = get_template_directory_uri() . '/assets/images/field.jpg';
    
    // then Restore the context and loop back to the main query loop.
    wp_reset_postdata();
  };
  
  // if is product category tax archive
  if (is_product_cat()) {
    $quer_obj = get_queried_object();
    $context['product_cat_obj'] = $quer_obj->slug;
  }
  // if is product cat query var
  elseif (current_product_cat_var() == true) {
    $context['product_cat_obj'] = get_query_var('product_cat');
  };
  
  // if is product series
  if (is_product_series()) {
    $quer_obj = get_queried_object();
    $context['product_series_obj'] = $quer_obj->slug;
  }
  // if is product series query var
  elseif (current_product_series_var() == true ) {
    $context['product_series_obj'] = get_query_var('product_series');
  };
  
  $context['tease_template'] = $tease_template; 
  $context['tease_term_template'] = $tease_term_template; 
  
  Timber::render( $templates, $context );
}