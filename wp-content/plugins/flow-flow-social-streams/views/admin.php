<?php if ( ! defined( 'WPINC' ) ) die;
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 * @link      http://looks-awesome.com
 * @copyright 2014-2016 Looks Awesome
 */

$dbm = $context['db_manager'];
$plugin_directory = $this->context['plugin_url'] . $this->context['plugin_dir_name'];
if (!$dbm->canCreateCssFolder()){
	echo '<p class="ff-error" xmlns="http://www.w3.org/1999/html">Error: Plugin cannot create folder <strong>wp-content/resources/flow-flow/css</strong>, please add permissions or create this folder manually.</p>';
}
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=345260089015373";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div id="fade-overlay" class="loading">
	<i class="flaticon-settings"></i>
</div>
<!-- @TODO: Provide markup for your options page here. -->
<form id="flow_flow_form" method="post" action="<?php echo $context['form-action']; ?>" enctype="multipart/form-data">
	<script id="flow_flow_script">
		var _ajaxurl = '<?php echo $context['admin_url']; ?>';
		var la_plugin_slug_down = '<?php echo $context['slug_down']; ?>';
		var plugin_url = '<?php echo $plugin_directory; ?>';
		var server_time = '<?php echo time() ; ?>';
		var plugin_ver = '<?php echo $context['version'] ; ?>';
		<?php if (isset($context['js-vars'])) echo $context['js-vars'];?>
	</script>
	<?php
		settings_fields('ff_opts');
		if (isset($context['hidden-inputs'])) echo $context['hidden-inputs'];
	?>
	<div class="wrapper">
		<?php
			if (FF_USE_WP) {
                echo '<h2>' . str_replace(' Lite', '', $context['admin_page_title']) . ($context['slug'] == 'flow-flow' ? ' Social Stream Lite v. ' : ' Feed Gallery v. ' ) . $context['version'] . ' <a href="' . $context['faq_url'] . '" target="_blank">Documentation & FAQ</a></h2>';

                echo '<div id="ff-cats">';
                if (FF_USE_WP) {
                    wp_dropdown_categories();
                }
                echo '</div>';
            }
		?>
		<ul class="section-tabs">
			<?php
				/** @var LATab $tab*/
				foreach ( $context['tabs'] as $tab ) {
                    echo '<li id="'.$tab->id().'"><i class="'.$tab->flaticon().'"></i> <span>'.$tab->title().'</span></li>';
				}
				if (isset($context['buttons-after-tabs'])) echo $context['buttons-after-tabs'];
			?>
		</ul>
		<div class="section-contents">
			<?php
				/** @var LATab $tab*/
				foreach ( $context['tabs'] as $tab ) {
					$tab->includeOnce($context);
				}
			?>
		</div>
	</div>
</form>
<div class="cd-popup" role="alert">
    <div class="cd-popup-container">
        <p>Are you sure you want to delete this element?</p>
        <ul class="cd-buttons">
            <li><a href="#0" id="cd-button-no">No</a></li>
            <li><a href="#0" id="cd-button-yes">Yes</a></li>
        </ul>
        <a href="#0" class="cd-popup-close img-replace">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

<script>jQuery(document).trigger('html_ready')</script>