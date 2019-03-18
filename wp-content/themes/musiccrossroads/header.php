<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php if (is_page_template('template-donate.php')) { ?>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <?php }; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
    
    <!-- ******************* The Navbar Area ******************* -->
    <div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">
	
        <a class="skip-link screen-reader-text sr-only" href="#content"><?php _e( 'Skip to content', 'understrap' ); ?></a>

        <nav class="navbar site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                            

                <div class="container-fluid w-100 px-4 ">


                            <div class="navbar-header float-left">

                                <!-- Your site title as branding in the menu -->
	                                <?php if (!has_custom_logo()) { ?>
		                                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		                                	<?php bloginfo( 'name' ); ?>
		                                </a>
	                                <?php } else { the_custom_logo(); } ?><!-- end custom logo -->

                            </div>
                            <div class="hidden-md-down">
                                <!-- The WordPress Menu goes here -->
                                <?php wp_nav_menu(
                                        array(
                                            'theme_location' => 'primary',
                                            'container_class' => '',
                                            'menu_class' => 'nav navbar-nav d-inline-block',
                                            'fallback_cb' => '',
                                            'menu_id' => 'main-menu',
                                            'walker' => new wp_bootstrap_navwalker()
                                        )
                                ); ?>
                                <div class="float-right text-white social-icons" >
                                    <?php if (get_field('_facebook_url','option')) {?>
                                    <a href="<?php echo get_field('_facebook_url','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <?php } ?>
                                    <?php if (get_field('_twitter_url','option')) {?>
                                        <a href="<?php echo get_field('_twitter_url','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <?php } ?>
                                    <?php if (get_field('_linkedin_url','option')) {?>
                                        <a href="<?php echo get_field('_linkedin_url','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    <?php } ?>
                                    <?php if (get_field('_soundcloud_url','option')) {?>
                                        <a href="<?php echo get_field('_soundcloud_url','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-soundcloud"></i></a>
                                    <?php } ?>
                                    <?php if (get_field('_email_address','option')) {?>
                                        <a href="mailto:<?php echo get_field('_email_address','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-envelope"></i></a>
                                    <?php } ?>
                                </div>
                            </div>

                            <button class="c-hamburger c-hamburger--htx mt-3 hidden-md-up" data-toggle="modal" data-target="#mc-menu">
                                <span>toggle menu</span>
                            </button>

                </div> <!-- .container -->
            
        </nav><!-- .site-navigation -->
        <div class="modal fade " id="mc-menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog container" role="document">
                <div class="modal-content ">
                    <div id="menu-content" class="text-center">

                        <!-- The WordPress Menu goes here -->
                        <?php wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'container_class' => '',
                                'menu_class' => 'nav navbar-nav d-inline-block',
                                'fallback_cb' => '',
                                'menu_id' => 'main-menu',
                                'walker' => new wp_bootstrap_navwalker()
                            )
                        ); ?>
                        <div class="text-white" style="font-size: 1.5rem">
                            <?php if (get_field('_facebook_url','option')) {?>
                                <a href="<?php echo get_field('_facebook_url','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-facebook"></i></a>
                            <?php } ?>
                            <?php if (get_field('_twitter_url','option')) {?>
                                <a href="<?php echo get_field('_twitter_url','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-twitter"></i></a>
                            <?php } ?>
                            <?php if (get_field('_linkedin_url','option')) {?>
                                <a href="<?php echo get_field('_linkedin_url','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <?php } ?>
                            <?php if (get_field('_soundcloud_url','option')) {?>
                                <a href="<?php echo get_field('_soundcloud_url','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-soundcloud"></i></a>
                            <?php } ?>
                            <?php if (get_field('_email_address','option')) {?>
                                <a href="<?php echo get_field('_email_address','option') ?>" class="text-white mx-2" target="_blank"><i class="fa fa-envelope"></i></a>
                            <?php } ?>
                        </div>

                        <a href="#" data-toggle="modal" data-target="#mc-menu" class="mt-4 ctaLink text-white"><?php echo pll__('Close') ?></a>

                    </div>


                </div>
            </div>
        </div>

    </div><!-- .wrapper-navbar end -->

