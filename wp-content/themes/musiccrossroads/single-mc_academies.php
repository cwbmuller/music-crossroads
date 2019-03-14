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
    $context['roles'] = get_terms('team_role');
    $academy_country = str_replace("-academy","",$post->slug);
    foreach ($context['roles'] as $role) {


        $team_args = array(
            'post_type' => 'mc_team',
            'numberposts' => 99,
            //query events by category
            'tax_query' => array(
                array(
                    'taxonomy' => 'team_country',
                    'field' => 'slug',
                    'terms' => $academy_country,
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

    Timber::render(array('template-academy.twig', 'page.twig'), $context);

}