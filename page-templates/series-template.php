<?php
/**
 * Template Name: Parts by Series/Model Template
 *
 * @package Rmcc_Woo_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;

// Get all series
$context['all_terms'] = get_terms([
  'taxonomy'    => 'product_series',
  'hide_empty'  => true,
  'parent' => 0,
]);
// get title
$context['title'] = 'Parts by Series/Model';

Timber::render(  'collection.twig' , $context );