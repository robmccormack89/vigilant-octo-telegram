<?php
/**
 * Template Name: Narrow Template
 *
 * @package Rmcc_Woo_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'narrow.twig' , $context );