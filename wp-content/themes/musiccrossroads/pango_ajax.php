<?php
//mimic the actuall admin-ajax
define('DOING_AJAX', true);

if (!isset( $_REQUEST['action']))
    die('-1');

//make sure you update this line
//to the relative location of the wp-load.php
require_once('../../../wp-load.php');

//Typical headers
header('Content-Type: text/html');
send_nosniff_header();

//Disable caching
header('Cache-Control: no-cache');
header('Pragma: no-cache');


$action = esc_attr(trim($_REQUEST['action']));

//A bit of security
$allowed_actions = array(
    'mc_media_images_ajax',
    'mc_media_videos_ajax',
    'mc_media_music_ajax',
    'mc_media_artist_ajax',
    'mc_news_ajax',
);

if(in_array($action, $allowed_actions)){
    if(is_user_logged_in())
        do_action('PANGO_AJAX_HANDLER_'.$action);
    else
        do_action('PANGO_AJAX_HANDLER_nopriv_'.$action);
}
else{
    die('-1');
}
