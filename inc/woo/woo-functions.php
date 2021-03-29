
<?php
/**
* Woo functions
*
* @package Vigilant_Octo_Telegram
*/

// change the post type labels for the Competition cpt
function nk_custom_post_type_label_woo( $args ){
  $labels = nk_get_cpt_labels( __( 'Tractor Part', 'vigilant-octo-telegram' ), __( 'Tractor Parts', 'vigilant-octo-telegram' ));
  $args['labels'] = $labels;
  return $args;
}
add_filter( 'woocommerce_register_post_type_product', 'nk_custom_post_type_label_woo' );

function nk_get_cpt_labels($single,$plural){
   $arr = array(
    'name' => $plural,
    'singular_name' => $single,
    'menu_name' => $plural,
    'add_new' => 'Add '.$single,
    'add_new_item' => 'Add New '.$single,
    'edit' => 'Edit',
    'edit_item' => 'Edit '.$single,
    'new_item' => 'New '.$single,
    'view' => 'View '.$plural,
    'view_item' => 'View '.$single,
    'search_items' => 'Search '.$plural,
    'not_found' => 'No '.$plural.' Found',
    'not_found_in_trash' => 'No '.$plural.' Found in Trash',
    'parent' => 'Parent '.$single
 );
   return $arr;
}

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
  
  $context['post'] = Timber::get_post();
  $product = wc_get_product( $context['post']->ID );
  $context['product'] = $product;
  
  wp_reset_postdata();
  
  Timber::render( 'data-tab.twig', $context );
  
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
    $notice = __( 'This is a demo store for testing purposes — no orders shall be fulfilled.', 'vigilant-octo-telegram' ); 
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