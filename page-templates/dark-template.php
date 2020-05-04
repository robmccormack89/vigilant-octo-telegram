<?php
/**
 * Template Name: Dark Template
 *
 * @package Sixstar_Theme
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(  'dark-template.twig' , $context );