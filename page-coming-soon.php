<?php
/**
 * The custom template for page with slug 'home'
 *
 * @package Sixstar_Theme
 */

$context = Timber::get_context();

$context['SiteTitle'] = '6Star Competitions';
$context['SiteDescription'] = 'Loads of Amazing Prizes that anyone can win';
$context['TagLine'] = "UK & Ireland's Best Raffle Competition";
$context['SiteEmail'] = 'digitalassistdev@gmail.com';
$context['SiteNumber'] = '087 23 11 300';
$context['LaunchDate'] = 'date: 2020-02-06T13:57:00+00:00';
$context['MainTitle'] = 'Coming soon';
$context['MainDesciption1'] = 'Shaping your creative project and bring it to the top in a minute';
$context['MainDesciption2'] = 'Advanced design for modern and awesome people';
$context['ButtonText1'] = 'Get more info';
$context['ButtonText2'] = 'Stay Updated';
$context['CopyInfo'] = 'Some Text';
$context['Year'] = '2020';
$context['FacebookURL'] = '#';
$context['TwitterURL'] = '#';

Timber::render(  'coming-soon.twig' , $context );