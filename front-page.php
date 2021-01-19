<?php
/**
 * The front page template (when backend settings for front page display are set to static or latest posts)
 *
 * @package Rmcc_CV_Theme
 */

$context = Timber::context();
$templates = array('front-page.twig');

$post = new Timber\Post();

if ( is_home() && is_front_page() ) {
	$context['title'] =  get_bloginfo( 'name' );
} else {
	$context['title'] =  get_the_title( $post->ID );
};

$context['posts'] = new Timber\PostQuery();

Timber::render( $templates, $context );