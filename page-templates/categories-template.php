<?php
/**
 * Template Name: Parts by Category Template
 *
 * @package Rmcc_Woo_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;

// Get all cats
$context['all_terms'] = get_terms([
  'taxonomy'    => 'product_cat',
  'hide_empty'  => true,
  'parent' => 0,
]);
// get title
$context['title'] = 'Parts by Category';

Timber::render(  'collection.twig' , $context );