<?php
/**
* The 404 wrror template
*
* @package Vigilant_Octo_Telegram
*/

$context = Timber::context();

$context['title'] =  'Page not found';

Timber::render( '404.twig', $context );