<?php
/**
* The Blog Posts/Index template. Will appy where Reading Settings is Static Page->Posts page
*
* @package Vigilant_Octo_Telegram
*/

$context = Timber::context();
$context['posts'] = new Timber\PostQuery();

$post = new Timber\Post();
$context['title'] =  get_the_title( $post->ID );

$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

Timber::render( array( 'blog.twig', 'home.twig', 'archive.twig', 'index.twig' ), $context );