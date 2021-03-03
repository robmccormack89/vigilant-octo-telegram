<?php
/**
 * Theme functions & bits
 *
 * @package Rmcc_Woo_Theme
 */
 
add_filter( 'body_class','theme_body_classes' );
function theme_body_classes( $classes ) {

  if ( is_front_page() || is_page_template('page-templates/categories-template.php') || is_page_template('page-templates/series-template.php') ) {

    $classes[] = 'woocommerce';
    $classes[] = 'woo-custom';
    
  }
    
  return $classes;
}

function ecs_add_post_state( $post_states, $post ) {
 
 if( get_post_meta($post->ID,'_wp_page_template',true) == 'page-templates/contact-template.php' ) {
		$post_states[] = 'Contact page';
	};
 
 if( get_post_meta($post->ID,'_wp_page_template',true) == 'page-templates/categories-template.php' ) {
		$post_states[] = 'Parts by Category page';
	};
 
 if( get_post_meta($post->ID,'_wp_page_template',true) == 'page-templates/series-template.php' ) {
		$post_states[] = 'Parts by Series/Model page';
	};

	return $post_states;
}
add_filter( 'display_post_states', 'ecs_add_post_state', 10, 2 );

// change the seperator for yoast's breadcrumb
function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
  return '<i class="fas fa-angle-right fa-sm"></i>';
};
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);