<?php
/**
* The default template for displaying all single posts, including for cpts where a specific template is not present
*
* @package Vigilant_Octo_Telegram
*/

$context = Timber::context();

$timber_post = Timber::get_post();
$context['post'] = $timber_post;

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig' ), $context );
}