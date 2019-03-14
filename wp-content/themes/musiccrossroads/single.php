<?php
/**
Template Name: Single Blog Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $post = new TimberPost();
    $context['post'] = $post;
    $context['author'] = new TimberUser($context['post']->post_author);
    $postargs = array(
        'post_type' => 'post',
        'post__not_in' => array($context['post']->ID),
        'posts_per_page' => 3,
    );
    $context['posts'] = Timber::get_posts($postargs);
    Timber::render(array('template-single-blog.twig', 'page.twig'), $context);

}