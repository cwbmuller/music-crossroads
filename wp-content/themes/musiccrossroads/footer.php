<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */
?>

<?php get_sidebar('footerfull'); ?>

<div class="wrapper py-5 bg-orange text-white" id="wrapper-footer">
    
    <div class="container">

        <div class="row">

            <div class="col-md-12 ">
    
                <footer id="colophon" class="site-footer" role="contentinfo">

                    <div class="site-info">
                        <div class="row">
                            <div class="col-md-9 flex-md-first flex-last">

                                <p class="mt-4 text-brown"><small>© <?php pll_e('Copyright') ?> <?php echo date("Y"); ?> Music Crossroads. </small></p>

                            </div>
                            <div class="col-md-3 text-center subscribe-block">
                                <p><?php pll_e('Keep up to date with MC news') ?></p>
                                <a href="#" data-toggle="modal" data-target="#subscribe-modal" class="mb-4 cta-btn text-white text-uppercase "><?php pll_e('Subscribe') ?></a>
                            </div>
                        </div>
                    </div><!-- .site-info -->

                </footer><!-- #colophon -->

            </div><!--col end -->

        </div><!-- row end -->
        
    </div><!-- container end -->
    
</div><!-- wrapper end -->

<!-- Subscribe modal -->
<div class="modal fadeIn bg-o-orange" id="subscribe-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="row window-height-full align-items-center no-gutters" role="document">
        <div class="col-md-6 offset-md-3 col-10 offset-1 p-4 bg-green text-white modal-block my-4">
            <div class="row">
                <h2 class="w-100 mr-3">                <a href="#" data-toggle="modal" data-target="#subscribe-modal" class="float-right text-white"><i class="fa fa-close"></i></a>
                </h2>

                <div class="col-12 text-center">
                    <section id="mc-subscribe" class=" txtWhite text-center p-md-5 py-5 px-3">
                        <div  id="mc_pango_signup">
                            <h3 class="mb-4"><?php pll_e('Signup to our newsletter') ?></h3>
                            <form id="mc-embedded-subscribe-form" class="txtDark mailchimp-pango-form validate" action="" method="post" name="mc-embedded-subscribe-form" novalidate="">
                                <div id="mc_embed_signup_scroll">
                                    <div class="mc-field-group mc-input-group">
                                        <div id="signupWrapper" >
                                            <input name="fname" id="first-name" type="text" placeholder="<?php pll_e('First Name') ?>"/>
                                            <input name="lname" id="last-name" type="text" placeholder="<?php pll_e('Last Name') ?>"/>
                                            <input id="email-address" class="required email" name="email-address" type="email" value="" placeholder="<?php pll_e('Email Address') ?>" />
                                            <a href="#" id="mc-pango-subscribe" class="d-md-inline-block d-block mt-5 bg-orange cta-btn text-white text-uppercase" name="subscribe"  value="Subscribe">
                                                <?php pll_e('Submit') ?>
                                            </a>
                                        </div>
                                        <div style="position: absolute; left: -6000px;"><input id="extra-info" tabindex="-1" name="extra-info" type="text" value="" /></div>
                                        <div id="mce-responses" class="clear"></div>
                                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                        <div style="position: absolute; left: -5000px;"><input tabindex="-1" name="b_6cab990e46116afd2aa7da42d_62cd8a8391" type="text" value="" /></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>

            </div>


        </div>


    </div>
</div>



</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
