<?php
/**
Template Name: Media Page Template
 *
 * @package Pango
 */

if ( class_exists( 'Timber' ) ) {

    $context = Timber::get_context();
    $post = new TimberPost();
    $context['post'] = $post;
    $artist_args = array(
        'post_type' => 'mc_artists',
        'numberposts' => 99,
        //query events by category
//        'tax_query' => array(
//            array(
//                'taxonomy' => 'team_country',
//                'field' => 'slug',
//                'terms' => $country->slug,
//            ),
//        )
    );
    $context['artists'] = Timber::get_posts($artist_args);

    $context['genres'] = get_terms( 'music_genres');
    $context['countries'] = get_terms( 'team_country');




    function sort_posts( $posts, $orderby, $order = 'ASC', $unique = true ) {
        if ( ! is_array( $posts ) ) {
            return false;
        }

        usort( $posts, array( new Sort_Posts( $orderby, $order ), 'sort' ) );

        // use post ids as the array keys
        if ( $unique && count( $posts ) ) {
            $posts = array_combine( wp_list_pluck( $posts, 'ID' ), $posts );
        }

        return $posts;
    }
    class Sort_Posts {
        var $order, $orderby;

        function __construct( $orderby, $order ) {
            $this->orderby = $orderby;
            $this->order = ( 'desc' == strtolower( $order ) ) ? 'DESC' : 'ASC';
        }

        function sort( $a, $b ) {
            if ( $a->{$this->orderby} == $b->{$this->orderby} ) {
                return 0;
            }

            if ( $a->{$this->orderby} < $b->{$this->orderby} ) {
                return ( 'ASC' == $this->order ) ? -1 : 1;
            } else {
                return ( 'ASC' == $this->order ) ? 1 : -1;
            }
        }
    }

    Timber::render(array('template-media.twig', 'page.twig'), $context);

}