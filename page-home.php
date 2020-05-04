<?php
/**
 * The custom template for page with slug 'home'
 *
 * @package Sixstar_Theme
 */

$context = Timber::get_context();

$args = array(
   'post_type'             => 'product',
   'post_status'           => 'publish',
   'posts_per_page'        => '-1',
);
$context['slider_products'] = Timber::get_posts($args);

Timber::render(  'page-home.twig' , $context );