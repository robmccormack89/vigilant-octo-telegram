<?php
/**
* The Front Page template. Will appy where Reading Settings is Latest Posts or Static Page->Homepage
*
* @package Vigilant_Octo_Telegram
*/

$context = Timber::context();

$timber_post = Timber::get_post();
$context['post'] = $timber_post;

//featured products 
$featured_ids = get_field('homepage_product_selection', 'option');
$featured_args = array(
   'post_type'             => 'product',
   'post_status'           => 'publish',
	 'post__in'      				 => $featured_ids,
   'posts_per_page'        => '12',
);
$context['featured_products'] = new Timber\PostQuery($featured_args);
// home slides
$slides_args = array(
   'post_type' => 'slide',
   'post_status' => 'publish',
   'orderby' => 'date',
   'order' => 'asc',
);
$context['home_slides'] = new Timber\PostQuery($slides_args);
// recent products
$args = array(
   'post_type'             => 'product',
   'post_status'           => 'publish',
   'posts_per_page'        => '8',
);
$context['recent_products'] = new Timber\PostQuery($args);
// product series
$context['product_series'] = get_terms([
	'taxonomy'    => 'product_series',
	'hide_empty'  => false,
	'parent'   => 0,
	'orderby' => 'meta_value_num', 
]);
// product categories
$context['product_cats'] = get_terms([
	'taxonomy'    => 'product_cat',
	'hide_empty'  => true,
	'parent'   => 0,
	'number' => 9,
	'exclude' => '15', // excludes uncategorized
]);

Timber::render( array( 'front-page.twig' ), $context );