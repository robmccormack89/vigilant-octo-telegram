<?php
/**
 * The search
 *
 * @package Sixstar_Theme
 */

// render the template hierarchy with search.twig first
$templates = array( 'search.twig', 'archive.twig', 'index.twig' );

// get the main context
$context = Timber::context();

// set the title variable
$context['title'] = 'Search results for ' . get_search_query();

// set the posts variable for looping the search results
$context['posts'] = new Timber\PostQuery();

// set the pagination variable
$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

// render the templates with the context
Timber::render( $templates, $context );