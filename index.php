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

// get data for the draws status nav
$context['draws_statuses'] = get_terms( array(
		'taxonomy' => 'status',
		'hide_empty' => false
) );
$context['status'] = get_term( get_queried_object()->term_id );
$context['draws_page_url'] = get_post_type_archive_link( 'live_draws' );

// get the pagination
$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

// templates to render
$templates = array( 'index.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'home.twig' );
}

// render templates & context
Timber::render( $templates, $context );