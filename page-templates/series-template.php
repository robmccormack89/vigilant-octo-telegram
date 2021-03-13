<?php
/**
 * Template Name: Parts by Series/Model Template
 *
 * @package Vigilant_Octo_Telegram
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

Timber::render(  'collections.twig' , $context );