<?php
/**
* ACF Functions
* @package Vigilant_Octo_Telegram
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

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5fc51ff79687a',
	'title' => 'Home Banner Slides Fields',
	'fields' => array(
		array(
			'key' => 'field_5fc52079bdb96',
			'label' => 'Banner Link',
			'name' => 'banner_link',
			'type' => 'url',
			'instructions' => 'Add the URL for the Banner Slide to link to. This can be any URL of the website or elsewhere. If this field is left empty, the banner slide won\'t be linked to anything, which may be useful for slides with just general information or announcements etc.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		array(
			'key' => 'field_604f89a9caf01',
			'label' => 'Mobile Banner',
			'name' => 'mobile_banner',
			'type' => 'image',
			'instructions' => 'Upload the mobile image version for this slide banner; the recommended size is 480 pixels wide & 358 pixels high. The mobile image works on phones in Portrait orientation.

The featured image on the right-hand side is used for the phones (landscape), tablet, laptop & desktop. The recommended size for the featured image is 1920 pixels wide x 383 pixels high, and is scaled down at this aspect from desktop to phone (landscape). The mobile version image will then kick-in on phone screens in Portrait orientation.

If the mobile banner is empty, the featured image will be scaled down to 480 pixels wide & used instead. For banners that use the full width in terms of their text layout, this would obviously make the banner harder to read on mobile Portrait.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
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
	'key' => 'group_60412cb05f9c9',
	'title' => 'Product Series Fields',
	'fields' => array(
		array(
			'key' => 'field_60412cddbdefd',
			'label' => 'Series Thumbnail',
			'name' => 'series_thumbnail',
			'type' => 'image',
			'instructions' => 'Upload the thumbnail image for Series/Model. Recommended to upload image with dimensions of 215px by 150px	(jpg or png)',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => 1000,
			'max_height' => 1000,
			'max_size' => 2,
			'mime_types' => '.jpg, .png',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'product_series',
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
	'key' => 'group_5fc3ebf0d7bb9',
	'title' => 'Site Settings',
	'fields' => array(
		array(
			'key' => 'field_5fc3ecc02877c',
			'label' => 'Global Settings',
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
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_60425edbc8b65',
			'label' => 'Company Phone Number',
			'name' => 'company_phone_number',
			'type' => 'text',
			'instructions' => 'Enter the Business Phone number; to be used in navigation, contact page links etc.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '+01 234 5678',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_60425f1ec8b67',
			'label' => 'Display email',
			'name' => 'display_email',
			'type' => 'email',
			'instructions' => 'Enter the email for the business; to be used in navigation, contact page links etc.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'info@masseyfergusontractors.ie',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_60425efdc8b66',
			'label' => 'Facebook Link',
			'name' => 'facebook_link',
			'type' => 'url',
			'instructions' => 'Enter the URL to the business\' Facebook page; to be used in navigation etc.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '#',
			'placeholder' => '',
		),
		array(
			'key' => 'field_60425e52c8b64',
			'label' => 'Above Footer Text',
			'name' => 'above_footer_text',
			'type' => 'text',
			'instructions' => 'Enter the text you want to appear in the section which appears above the footer (muted grey section). This section is used across several templates.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_604fa7a49509b',
			'label' => 'Default Series Image',
			'name' => 'default_series_image',
			'type' => 'image',
			'instructions' => 'Upload the default image for Series items; will be used where Series image is not yet present, & for All Series links. Recommended image size is 215px by 150px',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_604fa8059509c',
			'label' => 'Default Category Image',
			'name' => 'default_category_image',
			'type' => 'image',
			'instructions' => 'Upload the default image for Category items; will be used where Category image is not yet present, & for All Categories links. Recommended image size is 210px by 210px (square)',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5fc3ec1c28779',
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
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_5fc3ec732877b',
			'label' => 'Featured Products',
			'name' => 'homepage_product_selection',
			'type' => 'post_object',
			'instructions' => 'Pick the featured products to display on the homepage',
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
		array(
			'key' => 'field_604f9fcff58aa',
			'label' => 'Parts by Category Link',
			'name' => 'homepage_all_categories_link',
			'type' => 'page_link',
			'instructions' => 'Select the page you have applied the Parts by Category Template to; this link is used for the View all Categories link on Homepage',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'page',
			),
			'taxonomy' => '',
			'allow_null' => 0,
			'allow_archives' => 0,
			'multiple' => 0,
		),
		array(
			'key' => 'field_604fa04bf58ab',
			'label' => 'Parts by Series Link',
			'name' => 'homepage_all_series_link',
			'type' => 'page_link',
			'instructions' => 'Select the page you have applied the Parts by Series Template to; this link is used for final item in the Homepage Series Carousel',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'page',
			),
			'taxonomy' => '',
			'allow_null' => 0,
			'allow_archives' => 0,
			'multiple' => 0,
		),
		array(
			'key' => 'field_604fa15a4005d',
			'label' => 'Contact Page Settings',
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
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_604fa197c2e1a',
			'label' => 'Contact Page Link',
			'name' => 'contact_page_link',
			'type' => 'page_link',
			'instructions' => 'Select the page you have applied the Contact page Template to; this link is used in various navigation elements to link to the contact page.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'page',
			),
			'taxonomy' => '',
			'allow_null' => 0,
			'allow_archives' => 0,
			'multiple' => 0,
		),
		array(
			'key' => 'field_604fa0b943cfe',
			'label' => 'Contact Form Select',
			'name' => 'contact_form_select',
			'type' => 'post_object',
			'instructions' => 'Select the Contact Forms to be used on the Contact page. The titles for forms (as used in the contact page tabbed navigation), is taken from the Contact Form titles. The description seen at the top of the form/s can be edited by going into Contact Forms & editing the particular form itself.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'wpcf7_contact_form',
			),
			'taxonomy' => '',
			'allow_null' => 0,
			'multiple' => 1,
			'return_format' => 'object',
			'ui' => 1,
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

acf_add_local_field_group(array(
	'key' => 'group_60502a0ac480c',
	'title' => 'Tractors Fields',
	'fields' => array(
		array(
			'key' => 'field_60502a14e5bae',
			'label' => 'Tractor Price',
			'name' => 'tractor_price',
			'type' => 'text',
			'instructions' => 'Add the Price for the item',
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
				'value' => 'tractor',
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