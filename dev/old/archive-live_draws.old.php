<?php

$context = Timber::context();
$context['posts'] = new Timber\PostQuery();

Timber::render( 'archive-live_draws.twig' , $context );