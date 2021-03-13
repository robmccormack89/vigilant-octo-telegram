<?php
/**
 * Template Name: Expanded Width Template
 *
 * @package Vigilant_Octo_Telegram
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'expand.twig' , $context );