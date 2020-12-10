<?php
/**
 * Theme functions & bits
 *
 * @package Sixstar_Theme
 */

// check if is blog or post
function is_blog () {
  return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

// check if is paginated
function is_paginated() {
  global $wp_query;
  if ( $wp_query->max_num_pages > 1 ) {
    return true;
  } else {
    return false;
  }
}

// change the seperator for yoast's breadcrumb
function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
  return '<i class="fas fa-angle-right fa-sm"></i>';
};
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);

// change the post type labels for the Competition cpt
function nk_custom_post_type_label_woo( $args ){
  $labels = nk_get_cpt_labels('Competition','Competitions');
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

/* add options page in backend via acf */;
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
  	'page_title' 	=> 'Site Settings',
  	'menu_title'	=> 'Site Settings',
  	'menu_slug' 	=> 'site-settings',
  	'capability'	=> 'edit_posts',
  	'redirect'		=> false
	));
}

// add local php field groups from acf - the json for these groups is saved into main site directory for reimporting and editing the fields
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5e8de4fdbcea9',
	'title' => 'Entry List Group',
	'fields' => array(
		array(
			'key' => 'field_5e8de529c1f06',
			'label' => 'PDF Upload',
			'name' => 'pdf_upload',
			'type' => 'file',
			'instructions' => 'Upload your Entry List PDF',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5e8de56e8657d',
			'label' => 'Draw Date',
			'name' => 'draw_date',
			'type' => 'text',
			'instructions' => 'Enter the date the competition was drawn on',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'entry_lists',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5fc51ff79687a',
	'title' => 'Home Banner Slides Fields',
	'fields' => array(
		array(
			'key' => 'field_5fc52020bdb94',
			'label' => 'Home Banner Slide Subtitle',
			'name' => 'home_banner_slide_subtitle',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Add the subtitle for the Banner Slide',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5fc52053bdb95',
			'label' => 'Home Banner Slide Button Text',
			'name' => 'home_banner_slide_button_text',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Add the text for the button in the Banner Slide',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5fc52079bdb96',
			'label' => 'Home Banner Slide Button Link',
			'name' => 'home_banner_slide_button_link',
			'type' => 'url',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Add the URL for the Banner Slide button',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'slide',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5fc412fb178ea',
	'title' => 'Home Info Slides Fields',
	'fields' => array(
		array(
			'key' => 'field_5fc4130fc8952',
			'label' => 'Info Slide Icon HTML',
			'name' => 'info_slide_icon_html',
			'type' => 'textarea',
			'instructions' => 'See https://fontawesome.com/icons?d=gallery for icon html examples.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Example: <i class="fas fa-hand-point-up fa-2x"></i>',
			'maxlength' => '',
			'rows' => 2,
			'new_lines' => '',
		),
		array(
			'key' => 'field_5fc414d618055',
			'label' => 'Info Slide Link URL',
			'name' => 'info_slide_link_url',
			'type' => 'url',
			'instructions' => 'Enter in the URL for a destination to send the info slide to',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '#',
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'info_slide',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5e8dfddec654c',
	'title' => 'Live Draw Group',
	'fields' => array(
		array(
			'key' => 'field_5e8dfe94a5dae',
			'label' => 'Live Draw Link',
			'name' => 'live_draw_link',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'text',
			'media_upload' => 0,
			'toolbar' => 'full',
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'live_draws',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5fd13d8701119',
	'title' => 'Mobile Menu Fields',
	'fields' => array(
		array(
			'key' => 'field_5fd13de20e524',
			'label' => 'Menu Item Icon',
			'name' => 'menu_item_icon',
			'type' => 'text',
			'instructions' => 'Add the HTML for the Menu Item Icon. Only works for Mobile Menu & doesn\'t work for sub menu items. Refer to https://fontawesome.com/icons?d=gallery for icons for icons to use.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '<i class="fas fa-home"></i>',
			'placeholder' => '<i class="fas fa-home"></i>',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'nav_menu_item',
				'operator' => '==',
				'value' => 'location/mobile',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5eb0962f1e5ce',
	'title' => 'Site Settings',
	'fields' => array(
		array(
			'key' => 'field_5eb0964970749',
			'label' => 'General Settings',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'left',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5eb0a31cf5872',
			'label' => 'General Settings',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'These are settings for the site in general.',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array(
			'key' => 'field_5f5a59df95885',
			'label' => 'Header Embed Codes',
			'name' => 'header_embed_codes',
			'type' => 'textarea',
			'instructions' => 'Insert your Head embed codes, e.g Facebook Pixel, Google Analytics',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5eb0969ea3fcb',
			'label' => 'Homepage Settings',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'left',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5eb0a34ef5873',
			'label' => 'Homepage Settings',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'These are the settings for the Homepage',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array(
			'key' => 'field_5eb0a23f99267',
			'label' => 'Homepage How to Play Blocks',
			'name' => 'homepage_how_to_play_blocks',
			'type' => 'group',
			'instructions' => 'Add the Homepage How to Play Blocks: 1, 2 & 3.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5eb0a42624491',
					'label' => 'How to Blocks',
					'name' => '',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 3,
					'max' => 3,
					'layout' => 'row',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_5f5a55c11a86c',
							'label' => 'How To Number',
							'name' => 'how_to_number',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5f5a55d21a86d',
							'label' => 'How To Title',
							'name' => 'how_to_title',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5f5a55de1a86e',
							'label' => 'How To Description',
							'name' => 'how_to_description',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 0,
							'delay' => 1,
						),
					),
				),
			),
		),
		array(
			'key' => 'field_5eb0a26399268',
			'label' => 'Homepage Featured Competitions',
			'name' => 'homepage_featured_competitions',
			'type' => 'group',
			'instructions' => 'Select the Homepage Featured Competitions: minimum 3, maximum 12.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5eb0e676c959d',
					'label' => 'Featured Competitions Title',
					'name' => 'featured_competitions_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5eb0e7d0e009c',
					'label' => 'Featured Competitions Objects',
					'name' => 'featured_competitions_objects',
					'type' => 'post_object',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => array(
						0 => 'product',
					),
					'taxonomy' => '',
					'allow_null' => 0,
					'multiple' => 1,
					'return_format' => 'id',
					'ui' => 1,
				),
			),
		),
		array(
			'key' => 'field_5f5a53d344398',
			'label' => 'Homepage CTA Block',
			'name' => 'homepage_cta_block',
			'type' => 'group',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5f5a53d344399',
					'label' => 'CTA Title',
					'name' => 'cta_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5f5a53fa4439b',
					'label' => 'CTA Button Text',
					'name' => 'cta_button_text',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5f5a54204439c',
					'label' => 'CTA Button Link',
					'name' => 'cta_button_link',
					'type' => 'page_link',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'post_type' => '',
					'taxonomy' => '',
					'allow_null' => 0,
					'allow_archives' => 1,
					'multiple' => 0,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'site-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;

// stuff to say we need timber activated!! see TGM Plugin activation library for php
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

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
add_action('tgmpa_register', 'sixstar_theme_register_required_plugins');