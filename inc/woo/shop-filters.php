<?php
/**
* Shop Filters
*
* @package Vigilant_Octo_Telegram
*/

// grid_list badge name
function gridlist_badge_name() {
	if (get_query_var('grid_list') == 'grid-view') {
    $name = __( 'Grid View', 'woocommerce' );
  } elseif (get_query_var('grid_list') == 'list-view') {
    $name = __( 'List View', 'woocommerce' );
  }
  return $name;
}
// orderby badge name
function orderby_badge_name() {
	if ($_GET['orderby'] == 'price') {
    $name = __( 'Price: low to high', 'vigilant-octo-telegram' );
  } elseif ($_GET['orderby'] == 'price-desc') {
    $name =  __( 'Price: high to low', 'vigilant-octo-telegram' );
  } elseif ($_GET['orderby'] == 'menu_order') {
    $name =  __( 'Default', 'vigilant-octo-telegram' );
  } elseif ($_GET['orderby'] == 'popularity') {
    $name =  __( 'Popularity', 'vigilant-octo-telegram' );
  } elseif ($_GET['orderby'] == 'rating') {
    $name =  __( 'Rating', 'vigilant-octo-telegram' );
  } elseif ($_GET['orderby'] == 'date') {
    $name =  __( 'Latest', 'vigilant-octo-telegram' );
  }
  return $name;
}

// helper function: finding strings; see below
function strpos_recursive($haystack, $needle, $offset = 0, &$results = array()) {
  $offset = strpos($haystack, $needle, $offset);
  if($offset === false) {
    return $results;           
  } else {
    $results[] = $offset;
    return strpos_recursive($haystack, $needle, ($offset + 1), $results);
  }
}

/**
* Getting the current query var value/s with given key/s
*
*/

function current_product_cat_var() {
  if (isset($_GET['product_cat'])) {
    return $_GET['product_cat'];
  }
};
function current_product_series_var() {
  if (isset($_GET['product_series'])) {
    return $_GET['product_series'];
  }
};
function current_product_orderby_var() {
  if (isset($_GET['orderby'])) {
    return $_GET['orderby'];
  }
};
function current_product_gridlist_var() {
  if (isset($_GET['grid_list'])) {
    return $_GET['grid_list'];
  }
};

/**
* Getting the data for the product taxonomy filters (category & series),
* then when subs exists, getting them
*/

// get the product cat filters
function product_cats_for_filters() {
  $cats_args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'orderby' => 'slug',
    'parent' => 0,
  );
  return get_terms($cats_args);
}
// check to see if product cat has children
function product_cat_has_children($term_id) { 
  if ( count( get_term_children( $term_id, 'product_cat' ) ) > 0 ) {
    return true;
  } else {
    return false;
  };
};
// get the sub product_cat filters based on parent term_id
function sub_cats_for_filters($term_id) {
  $subs_cats_args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'orderby' => 'slug',
    'parent' => $term_id,
  );
  return get_terms($subs_cats_args);
}
// get the product series filters
function product_series_for_filters() {
  $cats_args = array(
    'taxonomy' => 'product_series',
    'hide_empty' => true,
    'orderby' => 'slug',
    'parent' => 0,
  );
  return get_terms($cats_args);
}
// check to see if product series has children
function product_series_has_children($term_id) { 
  if ( count( get_term_children( $term_id, 'product_series' ) ) > 0 ) {
    return true;
  } else {
    return false;
  };
};
// get the sub series filters based on parent term_id
function sub_series_for_filters($term_id) {
  $subs_cats_args = array(
    'taxonomy' => 'product_series',
    'hide_empty' => true,
    'orderby' => 'slug',
    'parent' => $term_id,
  );
  return get_terms($subs_cats_args);
}

/**
* Getting the links for the product filters using add_query_args/remove_query-args;
* Checks whether current url is an archive for a taxonomy (category & series),
* then when using filters, adds/removes the correct query-args, with the shop base, minus the taxonomy archive path,
* e.g: /product-category/clothing/hoodies -> /shop/?product_cat=hoodies
*/

// add query arg link for product_cats in filters & escape the url
function add_query_arg_product_cats_for_filters($cat_slug) {
  // set the query arg url for product_cat from the product_cat->slug
  $query_arg_product_cats_args = array(
    'product_cat' => $cat_slug,
  );
  $the_url = add_query_arg($query_arg_product_cats_args);
  // parse the url into an array
  $parsed_url = wp_parse_url($the_url);
  // get the page path from the array
  $url_path = $parsed_url['path'];
  // the value we will use to search for in string
  $key_value = 'category'; 
  // find key_value string in the page path
  $found = strpos_recursive($url_path, $key_value);
  // if the 'category' exists in the current page path
  if($found) {
    // before new path
    $new_path = get_permalink(woocommerce_get_page_id('shop'));
    // remove the current url page path from url string & set new path
    $new_path .= str_replace($url_path,'/',$the_url);
  } else {
    // if 'category' doesnt exist in current page url, set the add_query_arg url to the default state abouve
    $new_path = $the_url;
  }
  // return the new path
  return esc_url($new_path);
}
// add query arg link for product_cats in filters & escape the url
function remove_query_arg_product_cats_for_filters() {
  // paths
  $current_uri = home_url( add_query_arg( NULL, NULL ) ); // full current url with params
  $current_url_page_path = strtok($_SERVER["REQUEST_URI"], '?'); // with https & host
  // $current_url_page_path = strtok($current_uri, '?'); // without https & host
  $current_url_query_string = $_SERVER['QUERY_STRING']; // isolated query string: key=value
  // shop base url
  $shop_base = get_permalink(woocommerce_get_page_id('shop'));
  // key values
  $query_key_value = 'product_cat';
  $cat_key_value = 'product-category';
  // check keys in paths
  $found_in_query = strpos_recursive($current_url_query_string, $query_key_value);
  $found_in_path = strpos_recursive($current_url_page_path, $cat_key_value);
  // if query_string exists & contains product_cat, remove product_cat query value
  if(($found_in_query)&&(!empty($current_url_query_string))) {
    $output = remove_query_arg('product_cat');
  };
  // if page path exists & contains product-category
  if(($found_in_path)&&(!empty($current_url_page_path))) {
    $strp_path = substr_replace($current_url_page_path, '', strrpos($current_url_page_path, '/'), 1);
    $output = str_replace($strp_path, $shop_base, $current_uri);
  };
  // return url with esc
  return esc_url($output);  
}
// add query arg link for product_series in filters & escape the url
function add_query_arg_product_series_for_filters($cat_slug) {
  // set the query arg url for product_cat from the product_cat->slug, removing _pjax
  $query_arg_product_cats_args = array(
    'product_series' => $cat_slug,
  );
  $the_url = add_query_arg($query_arg_product_cats_args);
  // parse the url into an array
  $parsed_url = wp_parse_url($the_url);
  // get the page path from the array
  $url_path = $parsed_url['path'];
  // the value we will use to search for in string
  $key_value = 'product-series-model'; 
  // find key_value string in the page path
  $found = strpos_recursive($url_path, $key_value);
  // if the 'category' exists in the current page path
  if($found) {
    // before new path
    $new_path = get_permalink(woocommerce_get_page_id('shop'));
    // remove the current url page path from url string & set new path
    $new_path .= str_replace($url_path,'/',$the_url);
  } else {
    // if 'category' doesnt exist in current page url, set the add_query_arg url to the default state abouve
    $new_path = $the_url;
  }
  // return the new path
  return esc_url($new_path);
}
// add query arg link for product_series in filters & escape the url
function remove_query_arg_product_series_for_filters() {
  // paths
  $current_uri = home_url( add_query_arg( NULL, NULL ) ); // full current url with params
  $current_url_page_path = strtok($_SERVER["REQUEST_URI"], '?'); // with https & host
  // $current_url_page_path = strtok($current_uri, '?'); // without https & host
  $current_url_query_string = $_SERVER['QUERY_STRING']; // isolated query string: key=value
  // shop base url
  $shop_base = get_permalink(woocommerce_get_page_id('shop'));
  // key values
  $query_key_value = 'product_series';
  $cat_key_value = 'product-series-model';
  // check keys in paths
  $found_in_query = strpos_recursive($current_url_query_string, $query_key_value);
  $found_in_path = strpos_recursive($current_url_page_path, $cat_key_value);
  // if query_string exists & contains product_cat, remove product_cat query value
  if(($found_in_query)&&(!empty($current_url_query_string))) {
    $output = remove_query_arg('product_series');
  };
  // if page path exists & contains product-category
  if(($found_in_path)&&(!empty($current_url_page_path))) {
    $strp_path = substr_replace($current_url_page_path, '', strrpos($current_url_page_path, '/'), 1);
    $output = str_replace($strp_path, $shop_base, $current_uri);
  };
  // return url with esc
  return esc_url($output);  
}

/**
* Checks to see if we are on a taxonomy archive; as opposed to query var archive
*
*/

// check if is product-series via uri paramaters
function is_product_series() {
  $current_url_page_path = strtok($_SERVER["REQUEST_URI"], '?'); 
  $cat_key_value = 'product-series-model';
  $found_in_path = strpos_recursive($current_url_page_path, $cat_key_value);
  if($found_in_path) {
    return true;
  };
}
// check if is product-series via uri paramaters
function is_product_cat() {
  $current_url_page_path = strtok($_SERVER["REQUEST_URI"], '?'); 
  $cat_key_value = 'product-category';
  $found_in_path = strpos_recursive($current_url_page_path, $cat_key_value);
  if($found_in_path) {
    return true;
  };
}