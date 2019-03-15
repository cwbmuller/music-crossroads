<?php
/**
 * Template Name: Blog Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $post = new TimberPost();
    $context['post'] = $post;
    $page = $_GET['page'];
    $postargs = array(
        'post_type' => 'post',
        'numberposts' => -1,
//        'tax_query' => array(
//            'relation' => 'AND',
//            array(
//                'taxonomy' => 'category',
//                'field' => 'slug',
//                'terms' => array ( $category[0]->slug ),
//            )
//        )
    );
    $context['categories'] = Timber::get_terms('category');
    $context['countries'] = get_terms( 'team_country');
    $context['posts'] = Timber::get_posts($postargs);
    Timber::render(array('template-blog.twig', 'page.twig'), $context);

}
