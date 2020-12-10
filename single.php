<?php
/**
 * The default template for displaying all single posts
 *
 * @package Sixstar_Theme
 */

// get the main context
$context = Timber::context();

// get the singular post object
$timber_post = Timber::get_post();

// set the post object variable
$context['post'] = $timber_post;

// if is password protect post, render that template first with context, or else render the regular template hierarchy with context
if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig' ), $context );
}