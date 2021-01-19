<?php
/**
 * Template Name: Expanded Width Template
 *
 * @package Rmcc_Woo_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'expand.twig' , $context );