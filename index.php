<?php
/**
* The main index template file
* Will function as an archive when no other templates apply (which shouldn't happen anyways)
*
* @package Vigilant_Octo_Telegram
*/

$context = Timber::context();
$context['posts'] = new Timber\PostQuery();

$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

Timber::render( array( 'index.twig' ), $context );