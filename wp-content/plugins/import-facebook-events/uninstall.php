<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://xylusthemes.com
 * @since      1.0.0
 *
 * @package    Import_Facebook_Events
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$ife_options = get_option( 'ife_facebook_options' );
$delete_ifedata = isset( $ife_options['delete_ifedata'] )? $ife_options['delete_ifedata'] : 'no';
if( $delete_ifedata == 'yes' ){
	// Remove options
	delete_option( 'ife_facebook_options' );

	// Remove schduled Imports
	$scheduled_import_args = array(
			'post_type'     => 'fb_scheduled_imports',
			'posts_per_page' => -1,
		);
	$scheduled_imports = get_posts( $scheduled_import_args );
	if( !empty( $scheduled_imports ) ){
		foreach ( $scheduled_imports as $import ) {
			if( $import->ID != '' ){
				wp_delete_post( $import->ID, true );
			}		
		}
	}

	// Remove import History
	$ife_import_history_args = array(
			'post_type'     => 'ife_import_history',
			'posts_per_page' => -1,
		);
	$ife_import_history = get_posts( $ife_import_history_args );
	if( !empty( $ife_import_history ) ){
		foreach ( $ife_import_history as $history ) {
			if( $history->ID != '' ){
				wp_delete_post( $history->ID, true );
			}		
		}
	}
}