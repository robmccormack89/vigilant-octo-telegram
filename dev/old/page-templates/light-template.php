<?php
/**
 * Template Name: Light Template
 *
 * @package Sixstar_Theme
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(  'light-template.twig' , $context );