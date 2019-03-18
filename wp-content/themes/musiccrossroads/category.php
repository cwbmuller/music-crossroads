<?php
/**
 * Template Name: Blog Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $category = new TimberTerm();
    $context['category'] = $category;
    $postargs = array(
        'post_type' => 'post',
        'numberposts' => 99,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => array ( $category->slug ),
            )
        )
    );
    $context['news'] = Timber::get_posts($postargs);
    Timber::render(array('template-category.twig', 'page.twig'), $context);

}
