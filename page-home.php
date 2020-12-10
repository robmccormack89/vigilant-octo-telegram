<?php
/**
 * The custom template for page with slug 'home'
 *
 * @package Sixstar_Theme
 */

$context = Timber::context();

$homepage_featured_competitions = get_field('homepage_featured_competitions', 'option');
$featured_ids = $homepage_featured_competitions['featured_competitions_objects'];

$args = array(
   'post_type'             => 'product',
   'post_status'           => 'publish',
   'posts_per_page'        => '-1',
   'post__in'              => array_values($featured_ids),
);
$context['slider_products'] = new Timber\PostQuery($args);






// get some slides
$slides_args = array(
   'post_type' => 'slide',
   'post_status' => 'publish',
   'orderby' => 'date',
   'order' => 'asc',
);
$context['home_slides'] = new Timber\PostQuery($slides_args);

// get some slides
$info_slides_args = array(
   'post_type' => 'info_slide',
   'post_status' => 'publish',
   'orderby' => 'date',
   'order' => 'asc',
);
$context['info_home_slides'] = new Timber\PostQuery($info_slides_args);

Timber::render(  'page-home.twig' , $context );