<?php
/**
 * The main index template file, functions at the main archive
 *
 * @package Rmcc_Woo_Theme
 */

// get the main context
$context = Timber::context();

// get the posts from the main query
$context['posts'] = new Timber\PostQuery();

// get the singular post object from within the loop, for setting the title below
$post = new Timber\Post();

// set the title for blog page etc
if ( is_home() && is_front_page() ) {
	$context['title'] =  get_bloginfo( 'name' );
} else {
	$context['title'] =  get_the_title( $post->ID );
};

// get data for the blog category nav
$context['blogcats'] = get_categories();
$current_cat = get_category( get_query_var( 'cat' ) );
$context['current_cat_id'] = $current_cat->cat_ID;
$context['posts_page_url'] = get_post_type_archive_link( 'post' );

// get the pagination
$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

// templates to render
$templates = array( 'index.twig' );

// render templates & context
Timber::render( $templates, $context );