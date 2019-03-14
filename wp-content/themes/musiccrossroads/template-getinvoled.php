<?php
/**
Template Name: Get Involved Page Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $post = new TimberPost();
    $context['post'] = $post;
    $context['home'] = new TimberPost(12);


    $job_args = array(
        'post_type' => 'mc_jobs',
        'numberposts' => 99,
    );

    $context['jobs'] = Timber::get_posts($job_args);
    Timber::render(array('template-getinvolved.twig', 'page.twig'), $context);

}