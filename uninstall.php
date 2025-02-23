<?php
/**
 * Fired when the plugin is deleted.
 *
 * Works in single as well as in Multisite/Network installs.
 *
 * @since    1.0
 */

defined( 'ABSPATH' ) or die( "Cheating........Uh!!" );

//if uninstall not called from WordPress, exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// check if current user is eligible to perform uninstall
if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}

$heateor_rb_options = get_option( 'heateor_rb' );
$heateor_rb_options_to_delete = array(
	'heateor_rb',
	'heateor_rb_version',
	'heateor_rb_custom_url_reactions',
	'heateor_rb_homepage_reactions',
	'widget_heateor_rb_standard',
	'widget_heateor_rb_floating'
);

if ( isset( $heateor_rb_options['delete_options'] ) ) {
	global $wpdb;
	
	// For Multisite
	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		$heateor_rb_blog_ids = heateor_rb_get_blog_ids();
		$heateor_rb_original_blog_id = get_current_blog_id();
		foreach ( $heateor_rb_blog_ids as $blog_id ) {
			switch_to_blog( $blog_id );
			foreach ( $heateor_rb_options_to_delete as $option ) {
				delete_site_option( $option );
			}
		}
		switch_to_blog( $heateor_rb_original_blog_id );    // should use "restore_current_blog"?
	} else {
		foreach ( $heateor_rb_options_to_delete as $option ) {
			delete_option( $option );
		}
	}
}

/**
 * Get all blog IDs of blogs in the current network that are not:
 * archived, spam, deleted
 *
 * @since    1.0
 * @return   array|boolean    The blog IDs, (bool) FALSE if: no matches.
 */
function heateor_rb_get_blog_ids() {
	global $wpdb;

	$sql = <<<SQL
SELECT blog_id
FROM {$wpdb->blogs}
WHERE archived = '0'
AND spam = '0'
AND deleted = '0'
SQL;

	return $wpdb->get_col( esc_sql( $sql ) );
}
