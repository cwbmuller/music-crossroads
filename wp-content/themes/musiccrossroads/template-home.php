<?php
/**
Template Name: Home Page Template
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
    $context['countries'] = Timber::get_posts($country_args);

    $news_args = array(
        'post_type' => 'post',
        'numberposts' => 3,
    );
    $context['news'] = Timber::get_posts($news_args);

    Timber::render(array('template-home.twig', 'page.twig'), $context);

}