<?php
/**
 * Timber theme class & other functions for Twig.
 *
 * @package Sixstar_Theme
 */

// Define paths to Twig templates
Timber::$dirname = array(
  'views',
  'views/wp',
  'views/wp/archive',
  'views/wp/parts',
  'views/wp/parts/tease',
  'views/wp/singular',
  'views/woo',
);

// set the $autoescape value
Timber::$autoescape = false;

// Define Sixstar_Theme Child Class
class SixstarTheme extends Timber\Site
{
  public function __construct()
  {
    // timber stuff
    add_filter('timber_context', array( $this, 'add_to_context' ));
    add_filter('get_twig', array( $this, 'add_to_twig' ));
    add_filter( 'pre_get_posts', array($this, 'add_custom_types_to_tax') );
    add_action('after_setup_theme', array( $this, 'theme_supports' ));
    add_action('wp_enqueue_scripts', array( $this, 'sixstar_theme_enqueue_assets'));
    add_action('widgets_init', array( $this, 'sixstar_custom_uikit_widgets_init'));
    add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
    add_filter( 'timber/context', array( $this, 'add_to_context' ) );
    add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action('init', array( $this, 'register_widget_areas' ));
    add_action('init', array( $this, 'register_navigation_menus' ));
    parent::__construct();
  }

  // this makes custom taxonomy (status) work with archive.php->archive.twig templates with pre_get_post filter added to class construct above
  public function add_custom_types_to_tax( $query )
  {
    if( is_category() || is_tax('status') || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
      // Get all your post types
      $post_types = get_post_types();
      $query->set( 'post_type', $post_types );
      return $query;
    }
  }

  public function register_post_types()
  {
  	$labels = array(
  		'name'                  => _x( 'Competition Winners', 'Post Type General Name', 'text_domain' ),
  		'singular_name'         => _x( 'Competition Winner', 'Post Type Singular Name', 'text_domain' ),
  		'menu_name'             => __( 'Competition Winners', 'text_domain' ),
  		'name_admin_bar'        => __( 'Competition Winner', 'text_domain' ),
  		'archives'              => __( 'Competition Winners', 'text_domain' ),
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
  	$args = array(
  		'label'                 => __( 'Winner', 'text_domain' ),
  		'description'           => __( 'Winners content type', 'text_domain' ),
  		'labels'                => $labels,
  		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes' ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 3,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => true,
  		'can_export'            => true,
  		'has_archive'           => 'competition-winners',
  		'exclude_from_search'   => true,
  		'publicly_queryable'    => true,
  		'query_var'             => false,
  		'capability_type'       => 'page',
  		'show_in_rest'          => false,
  	);
  	register_post_type( 'winners', $args );

  	$labels = array(
  		'name'                  => _x( 'Entry Lists', 'Post Type General Name', 'text_domain' ),
  		'singular_name'         => _x( 'Entry List', 'Post Type Singular Name', 'text_domain' ),
  		'menu_name'             => __( 'Entry Lists', 'text_domain' ),
  		'name_admin_bar'        => __( 'Entry List', 'text_domain' ),
  		'archives'              => __( 'Entry Lists', 'text_domain' ),
  		'attributes'            => __( 'Entry List Attributes', 'text_domain' ),
  		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
  		'all_items'             => __( 'All Entry Lists', 'text_domain' ),
  		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
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
  	$args = array(
  		'label'                 => __( 'Entry List', 'text_domain' ),
  		'description'           => __( 'Entry List Description', 'text_domain' ),
  		'labels'                => $labels,
  		'supports'              => array( 'title', 'editor', 'revisions', 'custom-fields', 'page-attributes' ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 4,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => true,
  		'can_export'            => true,
  		'has_archive'           => 'entry-lists',
  		'exclude_from_search'   => true,
  		'publicly_queryable'    => true,
      'query_var'             => false,

  		'capability_type'       => 'page',
  	);
  	register_post_type( 'entry_lists', $args );
      
  	$labels = array(
  		'name'                  => _x( 'Competition Draws', 'Post Type General Name', 'text_domain' ),
  		'singular_name'         => _x( 'Competition Draw', 'Post Type Singular Name', 'text_domain' ),
  		'menu_name'             => __( 'Competition Draws', 'text_domain' ),
  		'name_admin_bar'        => __( 'Competition Draw', 'text_domain' ),
  		'archives'              => __( 'Competition Draws', 'text_domain' ),
  		'attributes'            => __( 'Competition Draw Attributes', 'text_domain' ),
  		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
  		'all_items'             => __( 'All Live Draws', 'text_domain' ),
  		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
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
  	$args = array(
  		'label'                 => __( 'Competition Draw', 'text_domain' ),
  		'description'           => __( 'Competition Draws Description', 'text_domain' ),
  		'labels'                => $labels,
  		'supports'              => array( 'title', 'editor', 'custom-fields' ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 5,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => true,
  		'can_export'            => true,
  		'has_archive'           => 'competition-draws',
  		'exclude_from_search'   => true,
      'publicly_queryable'    => true,
      'query_var'             => true,
  		'capability_type'       => 'page',
  	);
  	register_post_type( 'live_draws', $args );
    
    $labels_one = array(
  		'name'                  => _x( 'Banner Slides', 'Post Type General Name', 'text_domain' ),
  		'singular_name'         => _x( 'Banner Slide', 'Post Type Singular Name', 'text_domain' ),
  		'menu_name'             => __( 'Home Banner Slides', 'text_domain' ),
  		'name_admin_bar'        => __( 'Banner Slide', 'text_domain' ),
  		'archives'              => __( 'Banner Slide Archives', 'text_domain' ),
  		'attributes'            => __( 'Item Attributes', 'text_domain' ),
  		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
  		'all_items'             => __( 'All Slides', 'text_domain' ),
  		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
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
  	$args_one = array(
  		'label'                 => __( 'Banner Slide', 'text_domain' ),
  		'description'           => __( 'Banner Slides for the Home Page Banner', 'text_domain' ),
  		'labels'                => $labels_one,
  		'supports'              => array( 'title', 'editor', 'thumbnail' ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 2,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => false,
  		'can_export'            => true,
  		'has_archive'           => false,
  		'exclude_from_search'   => true,
  		'publicly_queryable'    => false,
  		'capability_type'       => 'page',
  		'show_in_rest'          => false,
  	);
  	register_post_type( 'slide', $args_one );
    
    $labels_three = array(
  		'name'                  => _x( 'Info Slides', 'Post Type General Name', 'text_domain' ),
  		'singular_name'         => _x( 'Info Slide', 'Post Type Singular Name', 'text_domain' ),
  		'menu_name'             => __( 'Home Info Slides', 'text_domain' ),
  		'name_admin_bar'        => __( 'Info Slide', 'text_domain' ),
  		'archives'              => __( 'Info Slides Archives', 'text_domain' ),
  		'attributes'            => __( 'Item Attributes', 'text_domain' ),
  		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
  		'all_items'             => __( 'All Items', 'text_domain' ),
  		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
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
  	$args_three = array(
  		'label'                 => __( 'Home Info Slide', 'text_domain' ),
  		'description'           => __( 'Home Info Slides for Homepage (under banner)', 'text_domain' ),
  		'labels'                => $labels_three,
  		'supports'              => array( 'title', 'editor' ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 2,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => false,
  		'can_export'            => true,
  		'has_archive'           => false,
  		'exclude_from_search'   => true,
  		'publicly_queryable'    => false,
  		'capability_type'       => 'page',
  		'show_in_rest'          => false,
  	);
  	register_post_type( 'info_slide', $args_three );
  }

  public function register_taxonomies()
  {
    $labels = array(
      'name'                       => _x( 'Draw Status', 'Taxonomy General Name', 'text_domain' ),
      'singular_name'              => _x( 'Draw Status', 'Taxonomy Singular Name', 'text_domain' ),
      'menu_name'                  => __( 'Draw Status', 'text_domain' ),
      'all_items'                  => __( 'All Items', 'text_domain' ),
      'parent_item'                => __( 'Parent Item', 'text_domain' ),
      'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
      'new_item_name'              => __( 'New Item Name', 'text_domain' ),
      'add_new_item'               => __( 'Add New Item', 'text_domain' ),
      'edit_item'                  => __( 'Edit Item', 'text_domain' ),
      'update_item'                => __( 'Update Item', 'text_domain' ),
      'view_item'                  => __( 'View Item', 'text_domain' ),
      'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
      'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
      'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
      'popular_items'              => __( 'Popular Items', 'text_domain' ),
      'search_items'               => __( 'Search Items', 'text_domain' ),
      'not_found'                  => __( 'Not Found', 'text_domain' ),
      'no_terms'                   => __( 'No items', 'text_domain' ),
      'items_list'                 => __( 'Items list', 'text_domain' ),
      'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $rewrite = array(
  		'slug'                       => 'competition-draws/status',
  		'with_front'                 => true,
  		'hierarchical'               => false,
  	);
  	$args = array(
  		'labels'                     => $labels,
  		'hierarchical'               => true,
  		'public'                     => true,
  		'show_ui'                    => true,
  		'show_admin_column'          => true,
  		'show_in_nav_menus'          => true,
  		'show_tagcloud'              => false,
  		'rewrite'                    => $rewrite,
  	);
  	register_taxonomy( 'status', array( 'live_draws' ), $args );
  }

  public function register_widget_areas()
  {
    // Register widget areas
    if (function_exists('register_sidebar')) {
      register_sidebar(array(
        'name' => esc_html__('Main Footer Area', 'sixstar-theme'),
        'id' => 'sidebar-footer',
        'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title" hidden>',
        'after_title' => '</h4>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer Area 1', 'sixstar-theme'),
        'id' => 'sidebar-footer-1',
        'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<i class="far fa-star"></i> <h4 class="uk-text-bold widget-title">',
        'after_title' => '</h4>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer Area 2', 'sixstar-theme'),
        'id' => 'sidebar-footer-2',
        'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<i class="far fa-star"></i> <h4 class="uk-text-bold widget-title">',
        'after_title' => '</h4>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer Area 3', 'sixstar-theme'),
        'id' => 'sidebar-footer-3',
        'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<i class="far fa-star"></i> <h4 class="uk-text-bold widget-title">',
        'after_title' => '</h4>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer Area 4', 'sixstar-theme'),
        'id' => 'sidebar-footer-4',
        'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<i class="far fa-star"></i> <h4 class="uk-text-bold widget-title">',
        'after_title' => '</h4>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer Bottom Left Area', 'sixstar-theme'),
        'id' => 'sidebar-footer-bottom-left',
        'description' => esc_html__('Footer Bottom Left Widget Area; works best with the current widget only.', 'sixstar-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title" hidden>',
        'after_title' => '</h4>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer Bottom Right Area', 'sixstar-theme'),
        'id' => 'sidebar-footer-bottom-right',
        'description' => esc_html__('Footer Bottom Right Widget Area; works best with the current widget only.', 'sixstar-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title" hidden>',
        'after_title' => '</h4>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Header Top Left Area', 'sixstar-theme'),
        'id' => 'sidebar-header-left',
        'description' => esc_html__('Main Header Widget Area; works best with the current widget only.', 'sixstar-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title" hidden>',
        'after_title' => '</h4>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Header Top Right Area', 'sixstar-theme'),
        'id' => 'sidebar-header-right',
        'description' => esc_html__('Main Header Widget Area; works best with the current widget only.', 'sixstar-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title" hidden>',
        'after_title' => '</h4>'
      ));
    }
  }

  public function register_navigation_menus()
  {
    // This theme uses wp_nav_menu() in one locations.
    register_nav_menus(array(
      'main' => __('Main Menu', 'sixstar-theme'),
      'mobile' => __('Mobile Menu', 'sixstar-theme'),
    ));
  }

  public function add_to_context( $context )
  {
    // make site data available globally
    $context['site'] = $this;
    // get the siteurl
    $siteurl = get_site_url();
    // check is user logged in
    $context['is_user_logged_in'] = is_user_logged_in();
    // check is page paginated
    $context['is_paginated'] = is_paginated();
    // check is shop page
    $context['is_shop'] = is_shop();
    // check if is catgeory page
    $context['is_category'] = is_category();
    // check if is status page
    $context['is_status'] = is_tax('status');
    /* check is post types */
    $context['is_posts']   = is_blog();
    $context['is_winners']   = is_post_type_archive( 'winners' );
    $context['is_entry_lists']   = is_post_type_archive( 'entry_lists' );
    $context['is_live_draws']   = is_post_type_archive( 'live_draws' );
    /* check if is single product page */
    $context['is_single_product'] = is_singular( 'product' );
    /* if is product category */
    $context['is_product_category'] = is_product_category();
    
    // get the wp logo */
    $theme_logo_id = get_theme_mod( 'custom_logo' );
    $theme_logo_url = wp_get_attachment_image_url( $theme_logo_id , 'full' );
    $context['theme_logo_url'] = $theme_logo_url;
    
    /* menu register & args */
    $main_menu_args = array( 'depth' => 3 );
    $context['menu_main'] = new Timber\Menu( 'main' );
    $context['menu_mobile'] = new Timber\Menu('mobile');
    $context['has_menu_main'] = has_nav_menu( 'main' );
    $context['has_menu_mobile'] = has_nav_menu( 'mobile' );
    
    /* sidebar areas */
    $context['sidebar_footer_1']   = Timber::get_widgets('Footer Area 1');
    $context['sidebar_footer_2']   = Timber::get_widgets('Footer Area 2');
    $context['sidebar_footer_3']   = Timber::get_widgets('Footer Area 3');
    $context['sidebar_footer_4']   = Timber::get_widgets('Footer Area 4');
    $context['sidebar_footer_bottom_left']   = Timber::get_widgets('Footer Bottom Left Area');
    $context['sidebar_footer_bottom_right']   = Timber::get_widgets('Footer Bottom Right Area');
    $context['sidebar_header_left']   = Timber::get_widgets('Header Top Left Area');
    $context['sidebar_header_right']   = Timber::get_widgets('Header Top Right Area');
    $context['sidebar_footer']   = Timber::get_widgets('Main Footer Area');
    
    /* get acf options data */
    $context['options'] = get_fields('option');
    
    /* get pdf upload field - entry lists */
    $file = get_field('pdf_upload');
    $context['pdf_upload_url'] = $file['url'];

    /* woo my account endpoints, for shop subnav */
    $context['dashboard_endpoint']   = wc_get_account_endpoint_url( 'dashboard' );
    $context['address_endpoint']   = wc_get_account_endpoint_url( 'edit-address' );
    $context['edit_endpoint']   = wc_get_account_endpoint_url( 'edit-account' );
    $context['payment_endpoint']   = wc_get_account_endpoint_url( 'payment-methods' );
    $context['lost_endpoint']   = wc_get_account_endpoint_url( 'lost-password' );
    $context['orders_endpoint']   = wc_get_account_endpoint_url( 'orders' );
    $context['logout_endpoint']   = wc_get_account_endpoint_url( 'customer-logout' );

    /* get the woo cart url */
    global $woocommerce;
    $context['cart_url'] = $woocommerce->cart->get_cart_url();

    return $context;
    
  }
  
  public function theme_supports()
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
    add_image_size('sixstar-theme-featured-image-single-post', 1200, 450, true);
    add_image_size('sixstar-theme-product-main-image', 1200, 700, true);
    add_image_size('sixstar-theme-cart-image', 80, 80, true);
  }
  
  public function sixstar_theme_enqueue_assets()
  {
    
    // theme base scripts; not jquery dependent
    wp_enqueue_script(
      'sixstar-theme',
      get_template_directory_uri() . '/assets/js/main/main.js',
      '',
      '',
      true
    );
    
    // enqueue wp jquery
    wp_enqueue_script( 'jquery' );
    
    // global (site wide) scripts; uses jquery
    wp_enqueue_script(
      'global',
      get_template_directory_uri() . '/assets/js/global.js',
      'jquery',
      '1.0.0',
      true
    );
    
    // font awesome
    wp_enqueue_style(
      'fontawesome-theme',
      get_template_directory_uri() . '/assets/css/all.min.css'
    );
    // theme base css
    wp_enqueue_style(
      'sixstar-theme',
      get_template_directory_uri() . '/assets/css/base.css'
    );
    // theme stylesheet; used for globals (site wide)
    wp_enqueue_style(
      'sixstar-theme-styles', get_stylesheet_uri()
    );
    wp_enqueue_style(
      'global-theme',
      get_template_directory_uri() . '/assets/css/global.css'
    );
  }
  
  public function sixstar_custom_uikit_widgets_init()
  {
    register_widget("Sixstar_Theme_Custom_UIKIT_Widget_Class");
  }

  public function add_to_twig($twig)
  {
    /* this is where you can add your own functions to twig */
    $twig->addExtension(new Twig_Extension_StringLoader());
    return $twig;
  }
  
}

new SixstarTheme();
