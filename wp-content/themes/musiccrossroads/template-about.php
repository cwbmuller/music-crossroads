<?php
/**
Template Name: About Page Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $post = new TimberPost();
    $context['post'] = $post;
    $context['countries'] = get_terms('team_country');
    $context['team'] = [];
    foreach ($context['countries'] as $country) {


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

        foreach ($team as $member) {
            $member->country = $country;
            $context['team'][] = $member;
        }
    }
    Timber::render(array('template-about.twig', 'page.twig'), $context);

}