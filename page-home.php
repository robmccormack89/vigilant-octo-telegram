<?php
/**
 * The custom template for page with slug 'home'
 *
 * @package Sixstar_Theme
 */

$context = Timber::get_context();

$context['SiteTitle'] = '6Star Competitions';
$context['TagLine'] = "We are currently under construction";
$context['SiteDescription'] = 'Please check back soon for more info or just...';
$context['SiteEmail'] = 'digitalassistdev@gmail.com';
$context['SiteNumber'] = '087 23 11 300';
$context['LaunchDate'] = 'date: 2020-04-08T20:49:46+00:00';
$context['MainTitle'] = 'We\'re Coming soon';
$context['ButtonText1'] = 'Get more info';
$context['ButtonText2'] = 'Stay Updated';
$context['CopyInfo'] = 'Some Text';
$context['Year'] = '2020';
$context['FacebookURL'] = '#';
$context['TwitterURL'] = '#';

Timber::render(  'page-home.twig' , $context );