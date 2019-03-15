<?php
/**
Template Name: Contact Page Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $post = new TimberPost();
    $context['post'] = $post;



    Timber::render(array('template-contact.twig', 'page.twig'), $context);

}