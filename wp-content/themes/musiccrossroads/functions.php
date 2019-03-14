<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), '0.1.4' );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), '0.1.1', true );

    if (is_page_template( 'template-home.php' )) {
        wp_enqueue_script( 'home-scripts', get_stylesheet_directory_uri() . '/js/home.js', array(), '0.1.0', true );
    }

    if (is_page_template( 'template-about.php' )) {
        wp_enqueue_script( 'about-scripts', get_stylesheet_directory_uri() . '/js/about.js', array(), '0.1.0', true );
    }

    if (is_page_template('template-media.php')) {
        wp_enqueue_script('media-scripts', get_stylesheet_directory_uri() . '/js/media.js', array(), '0.1.2', true);

        wp_localize_script( 'media-scripts', 'pango_ajax_object', array( 'ajaxurl' => get_stylesheet_directory_uri() . '/pango_ajax.php') );
    }

    if (is_page_template('template-donate.php')) {
        wp_enqueue_script( 'donate-scripts', get_stylesheet_directory_uri() . '/js/donate.js', array(), '0.1.0', true );
    }

    if (is_page_template('template-getinvoled.php')) {
        wp_enqueue_script( 'getinvolved-scripts', get_stylesheet_directory_uri() . '/js/getinvolved.js', array(), '0.1.0', true );
    }


    if (is_singular( 'mc_countries' )) {
        wp_enqueue_script( 'country-scripts', get_stylesheet_directory_uri() . '/js/country.js', array(), '0.1.0', true );
    }
    if (is_page_template('template-countries.php')) {
        wp_enqueue_script( 'countries-scripts', get_stylesheet_directory_uri() . '/js/countries.js', array(), '0.1.0', true );
    }
    if (is_page_template('template-academies.php')) {
        wp_enqueue_script( 'academies-scripts', get_stylesheet_directory_uri() . '/js/academies.js', array(), '0.1.0', true );
    }
    if (is_singular( 'mc_academies' )) {
        wp_enqueue_script( 'academies-scripts', get_stylesheet_directory_uri() . '/js/academy.js', array(), '0.1.0', true );
    }
    if (is_home()) {
        wp_enqueue_script( 'news-scripts', get_stylesheet_directory_uri() . '/js/blog.js', array(), '0.1.0', true );
        wp_localize_script( 'news-scripts', 'pango_ajax_object', array( 'ajaxurl' => get_stylesheet_directory_uri() . '/pango_ajax.php') );

    }
}
/*
 * Include Timber functionality
 * @Pango
 */

include('functions-timber.php');

function custom_admin_js() {
    echo '<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAoosYa_BIYD1SNc6JTKnYVEei2OZhw2NM"></script>';
}
add_action('admin_footer', 'custom_admin_js');


add_action('PANGO_AJAX_HANDLER_mc_media_images_ajax', 'mc_media_images_ajax');
add_action('PANGO_AJAX_HANDLER_nopriv_mc_media_images_ajax', 'mc_media_images_ajax');

function mc_media_images_ajax()
{

    if (isset($_REQUEST)) {
        $post_id = $_REQUEST['post_id'];
        $context = Timber::get_context();
        $context['post'] = new TimberPost($post_id);
        Timber::render(array('template-media-images-item.twig', 'page.twig'), $context);
    }
}

add_action('PANGO_AJAX_HANDLER_mc_media_videos_ajax', 'mc_media_videos_ajax');
add_action('PANGO_AJAX_HANDLER_nopriv_mc_media_videos_ajax', 'mc_media_videos_ajax');

function mc_media_videos_ajax()
{

    if (isset($_REQUEST)) {
        $post_id = $_REQUEST['post_id'];
        $context = Timber::get_context();
        $context['post'] = new TimberPost($post_id);
        Timber::render(array('template-media-videos-item.twig', 'page.twig'), $context);
    }
}

add_action('PANGO_AJAX_HANDLER_mc_media_music_ajax', 'mc_media_music_ajax');
add_action('PANGO_AJAX_HANDLER_nopriv_mc_media_music_ajax', 'mc_media_music_ajax');

function mc_media_music_ajax()
{

    if (isset($_REQUEST)) {
        $post_id = $_REQUEST['post_id'];
        $context = Timber::get_context();
        $context['post'] = new TimberPost($post_id);
        Timber::render(array('template-media-music-item.twig', 'page.twig'), $context);
    }
}

add_action('PANGO_AJAX_HANDLER_mc_media_artist_ajax', 'mc_media_artist_ajax');
add_action('PANGO_AJAX_HANDLER_nopriv_mc_media_artist_ajax', 'mc_media_artist_ajax');

function mc_media_artist_ajax()
{
    if (isset($_REQUEST)) {
        $genre = $_REQUEST['genre'];
        $country = $_REQUEST['country'];
        // Retrieve the artists

        if (((isset($genre)) && ($genre != "")) && ((isset($country)) && ($country != "")) ) {
            $artist_args = array(
                'post_type' => 'mc_artists',
                'numberposts' => 99,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'team_country',
                        'field' => 'slug',
                        'terms' => $country,
                        'include_children' => true,
                        'operator' => 'IN',
                    ),
                    array(
                        'taxonomy' => 'music_genres',
                        'field' => 'slug',
                        'terms' => $genre,
                        'include_children' => true,
                        'operator' => 'IN',
                    ),
                )
            );

        } elseif (((isset($genre)) && ($genre != "")) ) {
            $artist_args = array(
                'post_type' => 'mc_artists',
                'numberposts' => 99,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'music_genres',
                        'field' => 'slug',
                        'terms' => $genre,
                        'include_children' => true,
                        'operator' => 'IN',
                    ),
                )
            );
        } elseif ((isset($country)) && ($country != "") ) {
            $artist_args = array(
                'post_type' => 'mc_artists',
                'numberposts' => 99,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'team_country',
                        'field' => 'slug',
                        'terms' => $country,
                        'include_children' => true,
                        'operator' => 'IN',
                    ),
                )
            );
        } else {
            $artist_args = array(
                'post_type' => 'mc_artists',
                'numberposts' => 99,

            );
        }
        $context = Timber::get_context();
        $context['posts'] = Timber::get_posts($artist_args);
        Timber::render(array('template-media-artists-item.twig', 'page.twig'), $context);
    }
}


add_action('PANGO_AJAX_HANDLER_mc_news_ajax', 'mc_news_ajax');
add_action('PANGO_AJAX_HANDLER_nopriv_mc_news_ajax', 'mc_news_ajax');


function mc_news_ajax()
{
    if (isset($_REQUEST)) {
        $category = $_REQUEST['category'];
        $country = $_REQUEST['country'];
        // Retrieve the news posts

        if (((isset($category)) && ($category != "")) && ((isset($country)) && ($country != "")) ) {
            $news_args = array(
                'post_type' => 'post',
                'numberposts' => 99,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'team_country',
                        'field' => 'slug',
                        'terms' => $country,
                        'include_children' => true,
                        'operator' => 'IN',
                    ),
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $category,
                        'include_children' => true,
                        'operator' => 'IN',
                    ),
                )
            );

        } elseif (((isset($category)) && ($category != "")) ) {
            $news_args = array(
                'post_type' => 'post',
                'numberposts' => 99,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $category,
                        'include_children' => true,
                        'operator' => 'IN',
                    ),
                )
            );
        } elseif ((isset($country)) && ($country != "") ) {
            $news_args = array(
                'post_type' => 'post',
                'numberposts' => 99,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'team_country',
                        'field' => 'slug',
                        'terms' => $country,
                        'include_children' => true,
                        'operator' => 'IN',
                    ),
                )
            );
        } else {
            $news_args = array(
                'post_type' => 'post',
                'numberposts' => 99,

            );
        }
        $context = Timber::get_context();
        $context['posts'] = Timber::get_posts($news_args);
        Timber::render(array('template-news-item.twig', 'page.twig'), $context);
    }
}




function cm_comment_form( $args = array(), $post_id = null ) {
    if ( null === $post_id )
        $post_id = get_the_ID();

    // Exit the function when comments for the post are closed.
    if ( ! comments_open( $post_id ) ) {
        /**
         * Fires after the comment form if comments are closed.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_comments_closed' );

        return;
    }

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    $args = wp_parse_args( $args );
    if ( ! isset( $args['format'] ) )
        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

    $req      = get_option( 'require_name' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );
    $html5    = 'html5' === $args['format'];
    $fields   =  array(
        'author' => '
        <input placeholder="Name" id="author" class="mb-3" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' />',
        'email'  => '
        <input placeholder="Email" id="email"  class="mb-3" name="email" type="email"  value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />',

    );

    $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

    /**
     * Filters the default comment form fields.
     *
     * @since 3.0.0
     *
     * @param array $fields The default comment fields.
     */

    $defaults = array(
        'fields'               => $fields,
        'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Your response" cols="auto" class="w-100" rows="4" maxlength="65525" aria-required="true" required="required"></textarea></p>',
        /** This filter is documented in wp-includes/link-template.php */
        'must_log_in'          => '<p class="must-log-in">' . sprintf(
            /* translators: %s: login URL */
                __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
            ) . '</p>',
        /** This filter is documented in wp-includes/link-template.php */
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf(
            /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
                __( '<a href="%1$s" class="ctaLink" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
                get_edit_user_link(),
                /* translators: %s: user name */
                esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
                $user_identity,
                wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
            ) . '</p>',
        'comment_notes_before' => '<p class="comment-notes"></p>',
        'comment_notes_after'  => '',
        'action'               => site_url( '/wp-comments-post.php' ),
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_form'           => 'comment-form',
        'class_submit'         => 'submit',
        'name_submit'          => 'submit',
        'title_reply'          => __( 'Leave a response' ),
        'title_reply_to'       => __( 'Leave a reply to %s' ),
        'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        'cancel_reply_before'  => ' <small class="ml-3">',
        'cancel_reply_after'   => '</small>',
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Post Comment' ),
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s ctaBtn" value="%4$s" />',
        'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
        'format'               => 'xhtml',
    );

    /**
     * Filters the comment form default arguments.
     *
     * Use {@see 'comment_form_default_fields'} to filter the comment fields.
     *
     * @since 3.0.0
     *
     * @param array $defaults The default comment form arguments.
     */
    $args = wp_parse_args(  $defaults  );

    // Ensure that the filtered args contain all required default values.
    $args = array_merge( $defaults, $args );

    /**
     * Fires before the comment form.
     *
     * @since 3.0.0
     */
    do_action( 'comment_form_before' );
    ?>
    <div id="respond" class="comment-respond">
        <?php
        echo $args['title_reply_before'];

        comment_form_title( $args['title_reply'], $args['title_reply_to'] );

        echo $args['cancel_reply_before'];

        cancel_comment_reply_link( $args['cancel_reply_link'] );

        echo $args['cancel_reply_after'];

        echo $args['title_reply_after'];

        if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
            echo $args['must_log_in'];
            /**
             * Fires after the HTML-formatted 'must log in after' message in the comment form.
             *
             * @since 3.0.0
             */
            do_action( 'comment_form_must_log_in_after' );
        else : ?>
            <form action="<?php echo esc_url( $args['action'] ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="<?php echo esc_attr( $args['class_form'] ); ?>"<?php echo $html5 ? ' novalidate' : ''; ?>>
                <?php
                /**
                 * Fires at the top of the comment form, inside the form tag.
                 *
                 * @since 3.0.0
                 */
                do_action( 'comment_form_top' );

                if ( is_user_logged_in() ) :
                    /**
                     * Filters the 'logged in' message for the comment form for display.
                     *
                     * @since 3.0.0
                     *
                     * @param string $args_logged_in The logged-in-as HTML-formatted message.
                     * @param array  $commenter      An array containing the comment author's
                     *                               username, email, and URL.
                     * @param string $user_identity  If the commenter is a registered user,
                     *                               the display name, blank otherwise.
                     */
                    echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );

                    /**
                     * Fires after the is_user_logged_in() check in the comment form.
                     *
                     * @since 3.0.0
                     *
                     * @param array  $commenter     An array containing the comment author's
                     *                              username, email, and URL.
                     * @param string $user_identity If the commenter is a registered user,
                     *                              the display name, blank otherwise.
                     */
                    do_action( 'comment_form_logged_in_after', $commenter, $user_identity );

                else :

                    echo $args['comment_notes_before'];

                endif;

                // Prepare an array of all fields, including the textarea
                $comment_fields = array( 'comment' => $args['comment_field'] ) + (array) $args['fields'];

                /**
                 * Filters the comment form fields, including the textarea.
                 *
                 * @since 4.4.0
                 *
                 * @param array $comment_fields The comment fields.
                 */
                $comment_fields = apply_filters( 'comment_form_fields', $comment_fields );

                // Get an array of field names, excluding the textarea
                $comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );

                // Get the first and the last field name, excluding the textarea
                $first_field = reset( $comment_field_keys );
                $last_field  = end( $comment_field_keys );

                foreach ( $comment_fields as $name => $field ) {

                    if ( 'comment' === $name ) {

                        /**
                         * Filters the content of the comment textarea field for display.
                         *
                         * @since 3.0.0
                         *
                         * @param string $args_comment_field The content of the comment textarea field.
                         */
                        echo apply_filters( 'comment_form_field_comment', $field );

                        echo $args['comment_notes_after'];

                    } elseif ( ! is_user_logged_in() ) {

                        if ( $first_field === $name ) {
                            /**
                             * Fires before the comment fields in the comment form, excluding the textarea.
                             *
                             * @since 3.0.0
                             */
                            do_action( 'comment_form_before_fields' );
                        }

                        /**
                         * Filters a comment form field for display.
                         *
                         * The dynamic portion of the filter hook, `$name`, refers to the name
                         * of the comment form field. Such as 'author', 'email', or 'url'.
                         *
                         * @since 3.0.0
                         *
                         * @param string $field The HTML-formatted output of the comment form field.
                         */
                        echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";

                        if ( $last_field === $name ) {
                            /**
                             * Fires after the comment fields in the comment form, excluding the textarea.
                             *
                             * @since 3.0.0
                             */
                            do_action( 'comment_form_after_fields' );
                        }
                    }
                }

                $submit_button = sprintf(
                    $args['submit_button'],
                    esc_attr( $args['name_submit'] ),
                    esc_attr( $args['id_submit'] ),
                    esc_attr( $args['class_submit'] ),
                    esc_attr( $args['label_submit'] )
                );

                /**
                 * Filters the submit button for the comment form to display.
                 *
                 * @since 4.2.0
                 *
                 * @param string $submit_button HTML markup for the submit button.
                 * @param array  $args          Arguments passed to `comment_form()`.
                 */
                $submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );

                $submit_field = sprintf(
                    $args['submit_field'],
                    $submit_button,
                    get_comment_id_fields( $post_id )
                );

                /**
                 * Filters the submit field for the comment form to display.
                 *
                 * The submit field includes the submit button, hidden fields for the
                 * comment form, and any wrapper markup.
                 *
                 * @since 4.2.0
                 *
                 * @param string $submit_field HTML markup for the submit field.
                 * @param array  $args         Arguments passed to comment_form().
                 */
                echo apply_filters( 'comment_form_submit_field', $submit_field, $args );

                /**
                 * Fires at the bottom of the comment form, inside the closing </form> tag.
                 *
                 * @since 1.5.0
                 *
                 * @param int $post_id The post ID.
                 */
                do_action( 'comment_form', $post_id );
                ?>
            </form>
        <?php endif; ?>
    </div><!-- #respond -->
    <?php

    /**
     * Fires after the comment form.
     *
     * @since 3.0.0
     */
    do_action( 'comment_form_after' );


}

function cm_custom_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' : ?>
            <li <?php comment_class(); ?> id="comment<?php comment_ID(); ?>">
            <div class="back-link">< ?php comment_author_link(); ?></div>
            <?php break;
        default : ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <article <?php comment_class(); ?> class="comment">

                <div class="comment-body">
                    <div class="commentBodyContent">
                        <?php comment_text(); ?>
                        <div class="author vcard txtMGrey">
                            <span><i class="fa fa-long-arrow-right"></i> </span>
                            <?php echo get_avatar( $comment, 32 ); ?>
                            <span class="author-name"><?php comment_author(); ?>,</span>
                            <span class="date">
                                <?php comment_date(); ?>
                            </span>
                        </div><!-- .vcard -->
                    </div>

                </div><!-- comment-body -->
                <?php $author = get_comment_author(); ?>
                <footer class="comment-footer">
                    <time <?php comment_time( 'c' ); ?> class="comment-time">

                    </time>
                    <div class="reply mt-2"><small><?php
                            comment_reply_link( array_merge( $args, array(
                                'reply_text' => 'Reply to ' .$author,
                                'after' => '',
                                'depth' => $depth,
                                'max_depth' => $args['max_depth']
                            ) ) ); ?></small>
                    </div><!-- .reply -->
                </footer><!-- .comment-footer -->

            </article><!-- #comment-<?php comment_ID(); ?> -->
            <?php // End the default styling of comment
            break;
    endswitch;
}

function alx_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' ); // Jetpack
