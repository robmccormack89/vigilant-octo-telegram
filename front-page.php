<?php
/**
* The front page template (when backend settings for front page display are set to static or latest posts)
* @package Rmcc_Woo_Theme
*/

// get the context
$context = Timber::context();

// get the post object (singular)
$post = Timber::query_post();
$context['post'] = $post;

// get the posts object (archive)
$context['posts'] = new Timber\PostQuery();

// get & set the title. if is blog & home, use site.title, else post.title 
if ( is_home() && is_front_page() ) {
	$context['title'] =  get_bloginfo( 'name' );
} else {
	$context['title'] =  get_the_title( $post->ID );
};

$featured_ids = get_field('homepage_product_selection', 'option');
$featured_args = array(
   'post_type'             => 'product',
   'post_status'           => 'publish',
	 'post__in'      				 => $featured_ids,
   'posts_per_page'        => '12',
);
$context['featured_products'] = new Timber\PostQuery($featured_args);

// get & set home_slides
$slides_args = array(
   'post_type' => 'slide',
   'post_status' => 'publish',
   'orderby' => 'date',
   'order' => 'asc',
);
$context['home_slides'] = new Timber\PostQuery($slides_args);

// get & set recent_products
$args = array(
   'post_type'             => 'product',
   'post_status'           => 'publish',
   'posts_per_page'        => '8',
);
$context['recent_products'] = new Timber\PostQuery($args);

$context['product_series'] = get_terms([
	'taxonomy'    => 'product_series',
	'hide_empty'  => false,
	'parent'   => 0
]);

$context['product_cats'] = get_terms([
	'taxonomy'    => 'product_cat',
	'hide_empty'  => true,
	'parent'   => 0,
	'number' => 9,
	'exclude' => '15', // excludes uncategorized
]);

// render the context with template
Timber::render( array('front-page.twig'), $context );