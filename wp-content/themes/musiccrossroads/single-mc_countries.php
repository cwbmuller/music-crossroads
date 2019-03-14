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
    $context['roles'] = get_terms('team_role');
    $context['team'] = [];
    foreach ($context['roles'] as $role) {


        $team_args = array(
            'post_type' => 'mc_team',
            'numberposts' => 99,
            //query events by category
            'tax_query' => array(
                array(
                    'taxonomy' => 'team_country',
                    'field' => 'slug',
                    'terms' => $post->slug,
                ),
                array(
                    'taxonomy' => 'team_role',
                    'field' => 'slug',
                    'terms' => $role->slug,
                ),
            )
        );

        $team = Timber::get_posts($team_args);

        foreach ($team as $member) {
            $member->role = $role;
            $context['team'][] = $member;
        }
    }
    Timber::render(array('template-country.twig', 'page.twig'), $context);

}