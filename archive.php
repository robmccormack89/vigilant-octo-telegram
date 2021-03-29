<?php
/**
* The template for displaying general archive pages when more specific templates dont exist. e.g author.php, $archive-$post_type.php
* In this theme, this template will function for: date, category, tag & post_type/taxonomy archives
* Overwrites will exist for author & post_type->tractor; see author.php & archive-tractor.php
*
* @package Vigilant_Octo_Telegram
*/

$context = Timber::context();
$context['posts'] = new Timber\PostQuery();
$templates = array( 'archive.twig', 'index.twig' );

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Day: ' . get_the_date( 'D M Y' );
} elseif ( is_month() ) {
	$context['title'] = 'Month: ' . get_the_date( 'M Y' );
} elseif ( is_year() ) {
	$context['title'] = 'Year: ' . get_the_date( 'Y' );
} elseif ( is_tag() ) {
	$context['title'] = 'Tag: ' . single_tag_title( '', false );
} elseif ( is_category() ) {
	$context['title'] = 'Category: ' . single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} elseif ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
} elseif ( is_tax('tractor_type') ) {
	$context['title'] = single_term_title( 'Tractor type: ', false );;
  array_unshift( $templates, 'archive-tractor-types.twig' );
}

$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

Timber::render( $templates, $context );