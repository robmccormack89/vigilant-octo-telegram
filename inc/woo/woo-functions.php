
<?php
/**
* Woo functions
*
* @package Vigilant_Octo_Telegram
*/

// function bbloomer_remove_product_tabs( $tabs ) {
//     unset( $tabs['additional_information'] ); 
//     return $tabs;
// }
// add_filter( 'woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 9999 );

// custom data tab
function parts_custom_tab( $tabs ) {
	$tabs['parts_custom_tab'] = array(
		'title'    => __( 'Parts Information', 'vigilant-octo-telegram' ),
		'callback' => 'parts_custom_tab_content', // the function name, which is on line 15
		'priority' => 50,
	);
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'parts_custom_tab' );

// custom data tab content
function parts_custom_tab_content( $slug, $tab ) {
  
  global $product;
  
  // get the product's cats
  $terms_cats = get_the_terms($product->ID,'product_cat');
  // get the product's series (all)
  $terms_series = get_the_terms($product->ID,'product_series');
  // get the sku
  $item_sku = $product->get_sku();

  // if there is series
  if ($terms_series) :

    // all the series id's will be stored as an array
    $terms_series_ids = array();
    
    // for each series, we store the term_id into the array for later
    foreach($terms_series as $series) {
      $terms_series_ids[] .= $series->term_id;
    }
    $series_ids = $terms_series_ids;

    // get the series(parent only) using the using the series_ids from above
    $parent_series = get_terms([
      'taxonomy'    => 'product_series',
      'hide_empty'  => true,
      'parent' => 0,
      'include' => $series_ids,
    ]);
    // get the models(series children) using the using the series_ids from above 
    $models = get_terms([
      'taxonomy'  => 'product_series',
      'hide_empty'  => true,
      'childless' => true,
      'hierarchical'  => false,
      'include' => $series_ids,
    ]);
    
  endif;
  
  if ($terms_cats) :
    echo '<div>Categories: ';
    foreach ($terms_cats as $cat) {
      $cat_names[] = $cat->name;
    };
    echo '<span>' . implode(", ", $cat_names) . '</span>';
    echo '</div>';
  endif;
  
  if ($terms_series) :
    
    if ($parent_series) :
      foreach ($parent_series as $series) {
        $series_names[] = $series->name;
      };
      echo '<span>' . implode(", ", $series_names) . '</span>';
    endif;
    
    if ($models) :
      foreach ($models as $model) {
        $model_names[] = $model->name;
      };
      echo '<span>' . implode(", ", $model_names) . '</span>';
    endif;
    
  endif;
  
}
  
// remove woo scripts and styles selectively
function theme_woo_script_styles() {
  remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
  wp_dequeue_style( 'woocommerce_frontend_styles' );
  wp_dequeue_style( 'woocommerce-general');
  wp_dequeue_style( 'woocommerce-layout' );
  wp_dequeue_style( 'woocommerce-smallscreen' );
  wp_dequeue_style( 'woocommerce_fancybox_styles' );
  wp_dequeue_style( 'woocommerce_chosen_styles' );
  wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
  wp_dequeue_script( 'selectWoo' );
  wp_deregister_script( 'selectWoo' );
  wp_dequeue_script( 'select2' );
  wp_deregister_script( 'select2' );
}
add_action( 'wp_enqueue_scripts', 'theme_woo_script_styles', 99 );

// ajax result count
function cart_ajax_result_count() {
  echo '<span class="header-cart-count">';
  echo WC()->cart->get_cart_contents_count();
  echo '</span>';
}
add_action( 'cart_ajax_result_count', 'cart_ajax_result_count' );

// ajax subtotal
function cart_ajax_subtotal() {
  echo '<span class="subtotal-cart">';
  echo WC()->cart->get_cart_subtotal();
  echo '</span>';
}
add_action( 'cart_ajax_subtotal', 'cart_ajax_subtotal' );

function custom_stock_quantity() {
  global $product; 
  $numleft  = $product->get_stock_quantity(); 
  $instock_text  = __( 'in stock', 'vigilant-octo-telegram' );
  if($numleft==0) {
     // out of stock
      echo "<span class='uk-text-danger'>0 ". $instock_text .".</span>"; 
  }
  else if($numleft==1) {
      echo "<span class='uk-text-warning'>Just ".$numleft ." ". $instock_text .".</span>";
  }
  else {
      echo "<span class='uk-text-success'>".$numleft ." ". $instock_text .".</span>";
  }
}
add_action( 'custom_stock_quantity', 'custom_stock_quantity' );

// custom store notice
function custom_store_notice () { 
  if ( ! is_store_notice_showing() ) { 
    return; 
  } 

  $notice = get_option( 'woocommerce_demo_store_notice' ); 

  if ( empty( $notice ) ) { 
    $notice = __( 'This is a demo store for testing purposes — no orders shall be fulfilled.', 'woocommerce' ); 
  } 

  echo apply_filters( 'woocommerce_demo_store', '<div class="woocommerce-store-notice demo_store"><div class="store-notice-wrap">' . wp_kses_post( $notice ) . ' <a href="#" class="woocommerce-store-notice__dismiss-link">' . esc_html__( 'Dismiss', 'woocommerce' ) . ' <i class="fas fa-times"></i></a></div></div>', $notice ); 
} 
add_action( 'custom_store_notice', 'custom_store_notice');

function custom_filter_wc_cart_item_remove_link( $sprintf, $cart_item_key ) {
  if ( is_admin() && ! defined( 'DOING_AJAX' ) )
  return $sprintf;
  $sprintf = str_replace('&times;', '<i class="fas fa-times"></i>', $sprintf);
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

// archive
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 ); // remove woo breads
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
// reorder catalog in ProductToolbar from 3rd to 1st
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); // unset catalog ordering
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 ); // and reset it as first
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 ); // remove woo wrapper div start
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 ); // remove woo wrapper div end
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
// tease
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' ); // remove unnecessary link open html 
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' ); // remove unnecessary link close html 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' ); // remove standard product image; we will do our own image with custom markup
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' ); // remove standard product title; we will do our own title with custom markup
// single product
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'wp_footer', 'woocommerce_demo_store' ); // remove store notice; uses custom notice above