<?php
/**
Template Name: Academy Page Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $post = new TimberPost();
    $context['post'] = $post;
    $context['countries'] = get_terms('team_country');
    $context['team'] = [];
    $team_args = array(
        'post_type' => 'mc_team',
        'numberposts' => 99,
        //query events by category
        'tax_query' => array(
            array(
                'taxonomy' => 'team_country',
                'field' => 'slug',
                'terms' => $country->slug,
            ),
        )
    );

    $team = Timber::get_posts($team_args);
    Timber::render(array('template-artist.twig', 'page.twig'), $context);

}