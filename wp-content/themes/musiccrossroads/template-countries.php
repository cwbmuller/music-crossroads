<?php
/**
Template Name: Countries Page Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $post = new TimberPost();
    $context['post'] = $post;



    $country_args = array(
        'post_type' => 'mc_countries',
        'numberposts' => 99,
    );
    $context['countries'] = Timber::get_posts($country_args);

    Timber::render(array('template-countries.twig', 'page.twig'), $context);

}