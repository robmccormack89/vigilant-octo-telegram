<?php
/**
* ACF Functions
* @package Rmcc_Woo_Theme
*/

function editor_settings( $settings ) {
  global $post_type;
  
  if ( $post_type == 'slide' ) {
    $settings[ 'tinymce' ] = false;
  };
  
  if ( $post_type == 'mega_menu' ) {
    $settings[ 'tinymce' ] = false;
  };
  
  return $settings;
}
add_filter( 'wp_editor_settings', 'editor_settings' );

/* add options page in backend via acf */;
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Site Settings',
		'menu_title'	=> 'Site Settings',
		'menu_slug' 	=> 'site-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
};