<?php
/**
 * The default template for displaying all pages
 *
 * @package Sixstar_Theme
 */

// get the main context
$context = Timber::context();

// get the singular page object
$timber_post = new Timber\Post();

// set the page object as a variable
$context['post'] = $timber_post;
 
// render template hierarchy with context: custom page templates take precedence over page.twig
Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );