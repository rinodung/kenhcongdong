<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

if ( ! WP_UNINSTALL_PLUGIN ) {
	exit();
}

/**
 * @var wpdb $wpdb
 */
global $wpdb;

if ( is_a( $wpdb, 'wpdb' ) ) {
	// Deletes user meta stuff (like closed meta boxes, etc.)
	$wpdb->query( 'DELETE FROM ' . $wpdb->usermeta . ' WHERE meta_key LIKE "%wpbgdc%"' );

	// Delete options
	$wpdb->query( 'DELETE FROM ' . $wpdb->options . ' WHERE option_name LIKE "%wpbgdc%"' );

	// drop the table if it exists
	$wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->prefix . "wpbgdc_files`" );
}

delete_option( 'wpb_plugin_google-drive-cdn_version' );
delete_option( 'wpbp_u_google-drive-cdn' );