<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://github.com/dinab881
 * @since      1.0.0
 *
 * @package    Houstonapps
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;

	global $wpdb;

	$cpts = array('team','technologies','contacts','process');
	foreach($cpts as $key => $post_type){

		//Returns 100 post ids from a post type.
		$limit = 100;
		$limit = $limit ? " LIMIT {$limit}" : '';
		$query = "SELECT p.ID FROM $wpdb->posts AS p WHERE p.post_type IN (%s){$limit}";
		$db_post_ids = $wpdb->get_col( $wpdb->prepare( $query, $post_type ) );

		if ( !empty( $db_post_ids ) ) {
			$deleted = 0;
			foreach ( $db_post_ids as $post_id ) {
				$del = wp_delete_post( $post_id );
				if ( false !== $del ) {
					++$deleted;
				}
			}

		}

	}

	// Delete options from default post types
	$options = arry('houstonapps_heading1','houstonapps_heading2');
	foreach($options as $k => $val){
		delete_option( $val );
	}



}
