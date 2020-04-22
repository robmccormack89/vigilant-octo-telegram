<?php
/**
 * Timber theme class & other functions for Twig.
 *
 * @package Sixstar_Theme
 */

// Define paths to Twig templates
Timber::$dirname = array(
  'views/',
  'views/archive',
  'views/parts',
  'views/singular',
  'views/header',
  'views/footer',
  'views/woo',
  'views/woo/partials',
  'views/styles',
);

// Define Sixstar_Theme Child Class
class SixstarTheme extends TimberSite
{
    public function __construct()
    {
        // timber stuff
        add_filter('timber_context', array( $this, 'add_to_context' ));
        add_filter('get_twig', array( $this, 'add_to_twig' ));
        add_action('init', array( $this, 'register_post_types' ));
        add_action('init', array( $this, 'register_taxonomies' ));
        add_action('init', array( $this, 'register_widget_areas' ));
        add_action('init', array( $this, 'register_navigation_menus' ));

        parent::__construct();
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
      	$rewrite = array(
      		'slug'                  => 'entry-list',
      		'with_front'            => true,
      		'pages'                 => true,
      		'feeds'                 => false,
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
      		'menu_position'         => 5,
      		'show_in_admin_bar'     => true,
      		'show_in_nav_menus'     => true,
      		'can_export'            => true,
      		'has_archive'           => 'entry-lists',
      		'exclude_from_search'   => true,
      		'publicly_queryable'    => true,
      		'rewrite'               => $rewrite,
      		'capability_type'       => 'page',
      	);
      	register_post_type( 'entry_lists', $args );
        
        	$labels = array(
        		'name'                  => _x( 'Live Draws', 'Post Type General Name', 'text_domain' ),
        		'singular_name'         => _x( 'Live Draw', 'Post Type Singular Name', 'text_domain' ),
        		'menu_name'             => __( 'Live Draws', 'text_domain' ),
        		'name_admin_bar'        => __( 'Live Draw', 'text_domain' ),
        		'archives'              => __( 'Live Draws', 'text_domain' ),
        		'attributes'            => __( 'Live Draw Attributes', 'text_domain' ),
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
        	$rewrite = array(
        		'slug'                  => 'live-draw',
        		'with_front'            => true,
        		'pages'                 => true,
        		'feeds'                 => false,
        	);
        	$args = array(
        		'label'                 => __( 'Live Draw', 'text_domain' ),
        		'description'           => __( 'Live Draws Description', 'text_domain' ),
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
        		'has_archive'           => 'live-draws',
        		'exclude_from_search'   => true,
        		'publicly_queryable'    => true,
        		'rewrite'               => $rewrite,
        		'capability_type'       => 'page',
        	);
        	register_post_type( 'live_draws', $args );

    
    }

    public function register_taxonomies()
    {
      // Register Custom Taxonomy
      
    }

    public function register_widget_areas()
    {
        // Register widget areas
        if (function_exists('register_sidebar')) {
          register_sidebar(array(
              'name' => esc_html__('Left Sidebar Area', 'sixstar-theme'),
              'id' => 'sidebar-left',
              'description' => esc_html__('Sidebar Area for Left Sidebar Templates, you can add multiple widgets here.', 'sixstar-theme'),
              'before_widget' => '',
              'after_widget' => '',
              'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
              'after_title' => '</span></h3>'
          ));
            register_sidebar(array(
                'name' => esc_html__('Right Sidebar Area', 'sixstar-theme'),
                'id' => 'sidebar-right',
                'description' => esc_html__('Sidebar Area for Right Sidebar Templates, you can add multiple widgets here.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Main Footer Area', 'sixstar-theme'),
                'id' => 'sidebar-footer',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 1', 'sixstar-theme'),
                'id' => 'sidebar-footer-1',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 2', 'sixstar-theme'),
                'id' => 'sidebar-footer-2',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 3', 'sixstar-theme'),
                'id' => 'sidebar-footer-3',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 4', 'sixstar-theme'),
                'id' => 'sidebar-footer-4',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Area 5', 'sixstar-theme'),
                'id' => 'sidebar-footer-5',
                'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="uk-text-bold widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Bottom Top Area', 'sixstar-theme'),
                'id' => 'sidebar-footer-bottom-top',
                'description' => esc_html__('Footer Bottom Top Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Bottom Bottom Area', 'sixstar-theme'),
                'id' => 'sidebar-footer-bottom-bottom',
                'description' => esc_html__('Footer Bottom Bottom Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Header Top Left Area', 'sixstar-theme'),
                'id' => 'sidebar-header-left',
                'description' => esc_html__('Main Header Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Header Top Right Area', 'sixstar-theme'),
                'id' => 'sidebar-header-right',
                'description' => esc_html__('Main Header Widget Area; works best with the current widget only.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Woo Cart Area', 'sixstar-theme'),
                'id' => 'sidebar-woo-cart',
                'description' => esc_html__('Sidebar Area for Woo Cart Area, best to add the Woo Cart Widget here.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Woo Sidebar Area', 'sixstar-theme'),
                'id' => 'sidebar-woo',
                'description' => esc_html__('Sidebar Area for Woocommerce.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Woo Filters Area', 'sixstar-theme'),
                'id' => 'sidebar-woo-filters',
                'description' => esc_html__('Sidebar Area for Woocommerce Filters.', 'sixstar-theme'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3 class="uk-text-bold widget-title"><span>',
                'after_title' => '</span></h3>'
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


    // register custom context variables
    public function add_to_context($context)
    {
      /* make site data available globally */
      $context['site']            = $this;
      
      /* get the siteurl */
      $siteurl = get_site_url();
      
      /* check is user logged in */
      $context['is_user_logged_in'] = is_user_logged_in();
      
      /* check is page paginated */
      $context['is_paginated'] = is_paginated();
      
      $context['is_shop'] = is_shop();
      
      /* get the wp logo */
      $theme_logo_id = get_theme_mod( 'custom_logo' );
      $theme_logo_url = wp_get_attachment_image_url( $theme_logo_id , 'full' );
      $context['theme_logo_url'] = $theme_logo_url;
      
      /* get product cats */
      $shopcats = get_terms( array(
          'taxonomy' => 'product_cat',
          'hide_empty' => true,
      ) );
      $context['shopcats'] = $shopcats;
      /* get product category base */
      $wc_options = get_option('woocommerce_permalinks');
      $product_category_base = $wc_options['category_base'];
      /* join the site url to product cat base */
      $context['product_category_base'] = ''. $siteurl . '/' . $product_category_base . '';
      /* if is product category */
      $context['is_product_category'] = is_product_category();
      /* get the shop base url */
      $context['shop_page_url'] = get_permalink( woocommerce_get_page_id( 'shop' ) );
      
      /* get the product category object (queried) */
      $queried_object = get_queried_object();
      /* get the id */
      $product_term_id = $queried_object->term_id;
      /* send to twig */
      $context['product_term_id'] = $product_term_id;
      
      $context['is_single_product'] = is_singular( 'product' );
      
      /* get the blog categories */
      $context['blogcats'] = get_categories();
      /* get the blog category base */
      $catbase = get_option( 'category_base' );
      /* join category base to the site url */
      $context['catbase'] = ''. $siteurl . '/' . $catbase . '';
      /* on category pages, get the category data */
      $category = get_category( get_query_var( 'cat' ) );
      /* get the category id */
      $cat_id = $category->cat_ID;
      /* category id to twig variable, for check */
      $context['cat_id'] = $cat_id;
      /* check if is category page */
      $context['is_category'] = is_category();
      
      /* get blog base id */
      $posts_page_id = get_option( 'page_for_posts');
      /* get the block page object using the blog base page id */
      $posts_page = get_page($posts_page_id);
      /* get the blog page url */
      $posts_page_url = get_page_uri($posts_page_id);
      /* joing blog base url to site url */
      $context['posts_page_url'] = ''. $siteurl . '/' . $posts_page_url . '';

      /* menu register & args */
      $main_menu_args = array( 'depth' => 3 );
      $context['menu_main'] = new \Timber\Menu( 'main' );
      $context['menu_mobile'] = new \Timber\Menu('mobile');
      $context['has_menu_main'] = has_nav_menu( 'main' );
      $context['has_menu_mobile'] = has_nav_menu( 'mobile' );
      
      $file = get_field('pdf_upload');
      $context['pdf_upload_url'] = $file['url'];;
      
      /* woo my account endpoints, for shop subnav */
      $context['dashboard_endpoint']   = wc_get_account_endpoint_url( 'dashboard' );
      $context['address_endpoint']   = wc_get_account_endpoint_url( 'edit-address' );
      $context['edit_endpoint']   = wc_get_account_endpoint_url( 'edit-account' );
      $context['payment_endpoint']   = wc_get_account_endpoint_url( 'payment-methods' );
      $context['lost_endpoint']   = wc_get_account_endpoint_url( 'lost-password' );
      $context['orders_endpoint']   = wc_get_account_endpoint_url( 'orders' );
      $context['logout_endpoint']   = wc_get_account_endpoint_url( 'customer-logout' );
      
      $context['is_posts']   = is_blog();
      $context['is_winners']   = is_post_type_archive( 'winners' );
      
      /* sidebar areas */
      $context['sidebar_cart']  = Timber::get_widgets('Woo Cart Area');
      $context['sidebar_filters'] = Timber::get_widgets('Woo Filters Area');
      $context['sidebar_woo']   = Timber::get_widgets('Woo Sidebar Area');
      $context['sidebar_footer_1']   = Timber::get_widgets('Footer Area 1');
      $context['sidebar_footer_2']   = Timber::get_widgets('Footer Area 2');
      $context['sidebar_footer_3']   = Timber::get_widgets('Footer Area 3');
      $context['sidebar_footer_4']   = Timber::get_widgets('Footer Area 4');
      $context['sidebar_footer_5']   = Timber::get_widgets('Footer Area 5');
      $context['sidebar_footer_bottom_top']   = Timber::get_widgets('Footer Bottom Top Area');
      $context['sidebar_footer_bottom_bottom']   = Timber::get_widgets('Footer Bottom Bottom Area');
      $context['sidebar_left']  = Timber::get_widgets('Left Sidebar Area');
      $context['sidebar_right'] = Timber::get_widgets('Right Sidebar Area');
      $context['sidebar_header_left']   = Timber::get_widgets('Header Top Left Area');
      $context['sidebar_header_right']   = Timber::get_widgets('Header Top Right Area');
      $context['sidebar_footer']   = Timber::get_widgets('Main Footer Area');
      
      /* width classes for sidebar layouts */
      if ( is_page_template( 'page-templates/no-sidebar-template.php' ) ) {
        $context['article_width_class'] = 'uk-width-1-1';
      } else {
        $context['article_width_class'] = 'uk-width-2-3@m';
      };
      $context['is_left_sidebar'] = is_page_template( 'page-templates/left-sidebar-template.php' );
      $context['is_right_sidebar'] = is_single() || is_page() && ! is_page_template( array( 'page-templates/left-sidebar-template.php', 'page-templates/no-sidebar-template.php' ) );

      return $context;
    }

    public function add_to_twig($twig)
    {
        /* this is where you can add your own functions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());

        return $twig;
    }
}

new SixstarTheme();
