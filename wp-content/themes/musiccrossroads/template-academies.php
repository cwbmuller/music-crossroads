<?php
/**
Template Name: Academies Page Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $post = new TimberPost();
    $context['post'] = $post;



    $country_args = array(
        'post_type' => 'mc_academies',
        'numberposts' => 99,
    );
    $context['academies'] = Timber::get_posts($country_args);

    Timber::render(array('template-academies.twig', 'page.twig'), $context);

}