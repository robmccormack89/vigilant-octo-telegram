<?php
/**
 * Timber theme class & other functions for Twig.
 *
 * @package Rmcc_Woo_Theme
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
  'views/woo/parts',
);

// set the $autoescape value
Timber::$autoescape = false;

// Define Rmcc_Woo_Theme Child Class
class RmccWooTheme extends Timber\Site
{
  public function __construct()
  {
    // timber stuff
    add_filter('timber_context', array( $this, 'add_to_context' ));
    add_filter('get_twig', array( $this, 'add_to_twig' ));
    add_action('after_setup_theme', array( $this, 'theme_supports' ));
    add_action('wp_enqueue_scripts', array( $this, 'rmcc_woo_theme_enqueue_assets'));
    add_action('widgets_init', array( $this, 'rmcc_woo_custom_uikit_widgets_init'));
    add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
    add_filter( 'timber/context', array( $this, 'add_to_context' ) );
    add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action('init', array( $this, 'register_widget_areas' ));
    add_action('init', array( $this, 'register_navigation_menus' ));
    parent::__construct();
  }

  public function register_post_types()
  {

  }

  public function register_taxonomies()
  {

  }

  public function register_widget_areas()
  {
    // Register widget areas
    if (function_exists('register_sidebar')) {
      register_sidebar(array(
        'name' => esc_html__('Footer Top Left Area', 'sixstar-theme'),
        'id' => 'sidebar-footer-top-left',
        'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'rmcc-woo-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<span hidden>',
        'after_title' => '</span>'
      ));
      register_sidebar(array(
        'name' => esc_html__('Footer Top Right Area', 'sixstar-theme'),
        'id' => 'sidebar-footer-top-right',
        'description' => esc_html__('Main Footer Widget Area; works best with the current widget only.', 'rmcc-woo-theme'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="uk-text-uppercase uk-h4 widget-title">',
        'after_title' => '</h3>'
      ));
    }
  }

  public function register_navigation_menus()
  {
    // This theme uses wp_nav_menu() in one locations.
    register_nav_menus(array(
      // 'main_menu' => __('Main Menu', 'rmcc-woo-theme'),
      'help_menu' => __('Help Menu', 'rmcc-woo-theme'),
      'trade_menu' => __('Trade Menu', 'rmcc-woo-theme'),
      'account_menu' => __('Account Menu', 'rmcc-woo-theme'),
      'accessories_menu' => __('Accessories Menu', 'rmcc-woo-theme'),
      'parts_menu' => __('Parts Menu', 'rmcc-woo-theme'),
      'mobile_menu' => __('Mobile Menu', 'rmcc-woo-theme'),
      'footer_nav_menu' => __('Footer Nav Menu', 'rmcc-woo-theme'),
      'footer_customers_menu' => __('Footer Customers Menu', 'rmcc-woo-theme'),
    ));
  }

  public function add_to_context( $context )
  {
    // global site context
    $context['site'] = $this;
    // general conditionals
    $context['is_user_logged_in'] = is_user_logged_in();
    $context['is_shop'] = is_shop();
    $context['is_category'] = is_category();
    $context['is_single_product'] = is_singular( 'product' );
    $context['is_product_category'] = is_product_category();
    // get the wp logo
    $theme_logo_id = get_theme_mod( 'custom_logo' );
    $theme_logo_url = wp_get_attachment_image_url( $theme_logo_id , 'full' );
    $context['theme_logo_url'] = $theme_logo_url;
    // menu register & args
    $main_menu_args = array( 'depth' => 3 );
    $context['menu_main'] = new Timber\Menu( 'main' );
    $context['has_menu_main'] = has_nav_menu( 'main' );
    $context['menu_mobile'] = new Timber\Menu('mobile');
    $context['has_menu_mobile'] = has_nav_menu( 'mobile' );
    $context['footer_nav_menu'] = new Timber\Menu( 'footer_nav_menu' );
    $context['has_footer_nav_menu'] = has_nav_menu( 'footer_nav_menu' );
    $context['footer_customers_menu'] = new Timber\Menu( 'footer_customers_menu' );
    $context['has_footer_customers_menu'] = has_nav_menu( 'footer_customers_menu' );
    $context['help_menu'] = new Timber\Menu( 'help_menu' );
    $context['has_help_menu'] = has_nav_menu( 'help_menu' );
    $context['trade_menu'] = new Timber\Menu( 'trade_menu' );
    $context['has_trade_menu'] = has_nav_menu( 'trade_menu' );
    $context['account_menu'] = new Timber\Menu( 'account_menu' );
    $context['has_account_menu'] = has_nav_menu( 'account_menu' );
    // sidebar areas
    $context['sidebar_footer_top_left'] = Timber::get_widgets('Footer Top Left Area');
    $context['sidebar_footer_top_right'] = Timber::get_widgets('Footer Top Right Area');
    // woo my account endpoints
    $context['dashboard_endpoint'] = wc_get_account_endpoint_url( 'dashboard' );
    $context['address_endpoint'] = wc_get_account_endpoint_url( 'edit-address' );
    $context['edit_endpoint'] = wc_get_account_endpoint_url( 'edit-account' );
    $context['payment_endpoint'] = wc_get_account_endpoint_url( 'payment-methods' );
    $context['lost_endpoint'] = wc_get_account_endpoint_url( 'lost-password' );
    $context['orders_endpoint'] = wc_get_account_endpoint_url( 'orders' );
    $context['logout_endpoint'] = wc_get_account_endpoint_url( 'customer-logout' );
    // get the woo cart url
    global $woocommerce;
    $context['cart_url'] = $woocommerce->cart->get_cart_url();
    // return context
    return $context;    
  }
  
  public function theme_supports()
  {
    // theme supports
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
    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption'
    ));
    // Add support for core custom logo
    add_theme_support('custom-logo', array(
      'height' => 30,
      'width' => 261,
      'flex-width' => true,
      'flex-height' => true
    ));
    // woo supports
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    // custom thumbnail sizes
    add_image_size('rmcc-woo-theme-featured-image-archive', 800, 300, true);
    add_image_size('rmcc-woo-theme-featured-image-single-post', 1200, 450, true);
    add_image_size('rmcc-woo-theme-product-main-image', 1200, 700, true);
    add_image_size('rmcc-woo-theme-cart-image', 80, 80, true);
  }
  
  public function rmcc_woo_theme_enqueue_assets()
  {
    // theme base scripts
    wp_enqueue_script(
      'rmcc-woo-theme',
      get_template_directory_uri() . '/assets/js/main/global.js',
      '',
      '',
      false
    );
    // theme base css
    wp_enqueue_style(
      'rmcc-woo-theme',
      get_template_directory_uri() . '/assets/css/base.css'
    );
    // theme stylesheet
    wp_enqueue_style(
      'rmcc-woo-theme-styles', get_stylesheet_uri()
    );
  }
  
  public function rmcc_woo_custom_uikit_widgets_init()
  {
    register_widget("Rmcc_Woo_Theme_Custom_UIKIT_Widget_Class");
  }

  public function add_to_twig($twig)
  {
    /* this is where you can add your own functions to twig */
    $twig->addExtension(new Twig_Extension_StringLoader());
    return $twig;
  }
  
}

new RmccWooTheme();
