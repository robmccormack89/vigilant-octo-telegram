<?php
/**
 * Theme functions & bits
 *
 * @package Sixstar_Theme
 */

function sixstar_theme_setup()
{
  // theme support for title tag
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('menus');
  add_theme_support('post-formats', array(
      'gallery',
      'quote',
      'video',
      'aside',
      'image',
      'link'
  ));
  add_theme_support('align-wide');
  add_theme_support('responsive-embeds');
  add_theme_support('woocommerce');

  // Switch default core markup for search form, comment form, and comments to output valid HTML5.
  add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption'
  ));

  // Add support for core custom logo.
  add_theme_support('custom-logo', array(
      'height' => 30,
      'width' => 261,
      'flex-width' => true,
      'flex-height' => true
  ));
  
  add_theme_support( 'woocommerce' );
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
  
  

  // add custom thumbs sizes.
  add_image_size('sixstar-theme-featured-image-archive', 800, 300, true);
  add_image_size('sixstar-theme-cart-image', 80, 80, true);
  
}
add_action('after_setup_theme', 'sixstar_theme_setup');

function sixstar_theme_enqueue_assets() {
  
  wp_enqueue_style('sixstar-theme-css', get_template_directory_uri() . '/assets/css/base.css');
  wp_enqueue_script('sixstar-theme-js', get_template_directory_uri() . '/assets/js/main/main.js', '', '', false);
  wp_enqueue_style('sixstar-theme-styles', get_stylesheet_uri());
  
}
add_action('wp_enqueue_scripts', 'sixstar_theme_enqueue_assets'); 

function is_paginated() {
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) {
        return true;
    } else {
        return false;
    }
}

// regisers custom widget
function sixstar_custom_uikit_widgets_init() {
  
  register_widget("Sixstar_Theme_Custom_UIKIT_Widget_Class");
  
}
add_action("widgets_init", "sixstar_custom_uikit_widgets_init");

// stuff to say we need timber activated!! see TGM Plugin activation library for php
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'sixstar_theme_register_required_plugins');

function sixstar_theme_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => 'Timber',
            'slug' => 'timber-library',
            'required' => true
        )
    );
    $config  = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '' // Message to output right before the plugins table.
    );
    tgmpa($plugins, $config);
}








function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
    return '<span uk-icon="icon: chevron-right; ratio: 0.6;"></span>';
};
// add the filter
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);






// Register Custom Post Type
function cpt_winners() {

	$labels = array(
		'name'                  => _x( 'Winners', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Winner', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Winners', 'text_domain' ),
		'name_admin_bar'        => __( 'Winner', 'text_domain' ),
		'archives'              => __( 'Winners Archives', 'text_domain' ),
		'attributes'            => __( 'Winner Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Winners', 'text_domain' ),
		'add_new_item'          => __( 'Add New Winner', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'competition-winner',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Winner', 'text_domain' ),
		'description'           => __( 'Winners content type', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'competition-winners',
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'query_var'             => 'winner',
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'winners', $args );

}
add_action( 'init', 'cpt_winners', 0 );




















add_filter( 'woocommerce_register_post_type_product', 'nk_custom_post_type_label_woo' );
 function nk_custom_post_type_label_woo( $args ){
 $labels = nk_get_cpt_labels('Competition','Competitions');
    $args['labels'] = $labels;
    return $args;
 }
 
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