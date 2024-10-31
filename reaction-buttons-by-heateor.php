<?php
/**
 * Plugin bootstrap file
 *
 * @reaction-buttons-by-heateor
 * Plugin Name:       Reaction Buttons by Heateor
 * Plugin URI:        https://www.heateor.com
 * Description:       Integrate Reaction buttons. Happy, Sad, Lol, Love, Wow, Angry and Like
 * Version:           1.0
 * Author:            Team Heateor
 * Author URI:        https://www.heateor.com
 * Text Domain:       reaction-buttons-by-heateor
 * Domain Path:       /languages
 */
defined( 'ABSPATH' ) or die( "Cheating........Uh!!" );

// If this file is called directly, halt
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'HEATEOR_RB_VERSION', '1.0' );
define( 'HEATEOR_RB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// plugin core class object
$heateor_rb = null;

// attributes to allow in the HTML of the Reaction Buttons
$heateor_rb_default_attribs = array(
    'id' => array(),
    'class' => array(),
    'title' => array(),
    'style' => array(),
    'data' => array(),
    'focusable' => array(),
    'width' => array(),
    'height' => array(),
    'opacity' => array(),
    'data-heateor-rb-href' => array(),
    'data-heateor-rb-no-counts' => array()
);

// tags to allow in the HTML of the reaction buttons
$heateor_rb_allowed_tags = array(
    'div'           => $heateor_rb_default_attribs,
    'span'          => array_merge( $heateor_rb_default_attribs, array(
        'onClick' => array(),
        'onclick' => array(),
    ) ),
    'p'             => $heateor_rb_default_attribs,
    'a'             => array_merge( $heateor_rb_default_attribs, array(
        'href' => array( 'Javascript:void(0)', 'javascript:void(0)' ),
        'onClick' => array(),
        'onclick' => array(),
        'target' => array( '_blank', '_top' ),
        'rel' => array(),
        'data-url' => array(),
        'data-counturl' => array(),
        'data-text' => array(),
        'data-via' => array(),
        'data-lang' => array(),
    ) ),
    'svg'           => array_merge( $heateor_rb_default_attribs, array(
        'viewBox' => array(),
        'viewbox' => array(),
        'aria-hidden' => array(),
        'xmlns' => array(),
        'xml:space' => array(),
        'version' => array(),
        'xmlns:xlink' => array(),
    ) ),
    'script'           => array_merge( $heateor_rb_default_attribs, array(
        'src' => array(),
        'type' => array(),
        'data-url' => array(),
        'data-counter' => array(),
        'async' => array(),
    ) ),
    'u'             => $heateor_rb_default_attribs,
    'i'             => $heateor_rb_default_attribs,
    'q'             => $heateor_rb_default_attribs,
    'b'             => $heateor_rb_default_attribs,
    'ul'            => $heateor_rb_default_attribs,
    'ol'            => $heateor_rb_default_attribs,
    'li'            => $heateor_rb_default_attribs,
    'br'            => $heateor_rb_default_attribs,
    'hr'            => $heateor_rb_default_attribs,
    'strong'        => $heateor_rb_default_attribs,
    'blockquote'    => $heateor_rb_default_attribs,
    'del'           => $heateor_rb_default_attribs,
    'strike'        => $heateor_rb_default_attribs,
    'em'            => $heateor_rb_default_attribs,
    'code'          => $heateor_rb_default_attribs,
    'path'          => array_merge( $heateor_rb_default_attribs, array(
        'stroke-width' => array(),
        'stroke'  => array(),
        'fill' => array(),
        'd' => array()
    ) ),
    'circle'        => array_merge( $heateor_rb_default_attribs, array(
        'stroke-width' => array(),
        'stroke'  => array(),
        'fill' => array(),
        'cx' => array(),
        'cy' => array(),
        'r' => array()
    ) ),
    'polygon'        => array_merge( $heateor_rb_default_attribs, array(
        'stroke-width' => array(),
        'stroke'  => array(),
        'fill' => array(),
        'points' => array()
    ) ),
    'g'          => array_merge( $heateor_rb_default_attribs, array(
        'stroke-width' => array(),
        'stroke'  => array(),
        'stroke-linecap' => array(),
        'stroke-miterlimit' => array(),
        'fill' => array(),
        'fill' => array(),
        'fill' => array(),
        'fill' => array(),
    ) ),
    'style'          => array_merge( $heateor_rb_default_attribs, array(
        'type' => array(),
    ) )
);

/**
 * Updates SVG CSS file according to chosen logo color
 */
function heateor_rb_update_svg_css( $color_to_be_replaced, $css_file ) {
	$path = plugin_dir_url( __FILE__ ) . 'admin/css/' . $css_file . '.css';
	try {
		$content = file( $path );
		if ( $content !== false ) {
			$handle = fopen( dirname( __FILE__ ) . '/admin/css/' . $css_file . '.css', 'w' );
			if ( $handle !== false ) {
				foreach ( $content as $value ) {
				    fwrite( $handle, str_replace( '%23000', str_replace( '#', '%23', $color_to_be_replaced ), $value ) );
				}
				fclose( $handle );
			}
		}
	} catch ( Exception $e ) {  }
}

/**
 * Save default plugin options
 */
function heateor_rb_save_default_options() {

	// default options
	add_option( 'heateor_rb', array(
	   'horizontal_reaction_shape' => 'round',
	   'horizontal_reaction_size' => '35',
	   'horizontal_reaction_width' => '70',
	   'horizontal_reaction_height' => '35',
	   'horizontal_border_radius' => '',
	   'horizontal_font_color_default' => '#000',
	   'horizontal_font_color_hover' => '',
	   'horizontal_bg_color_default' => '#ffff0d',
	   'horizontal_bg_color_hover' => '',
	   'horizontal_border_width_default' => '',
	   'horizontal_border_color_default' => '',
	   'horizontal_border_width_hover' => '',
	   'horizontal_border_color_hover' => '',
	   'vertical_reaction_shape' => 'square',
	   'vertical_reaction_size' => '40',
	   'vertical_reaction_width' => '80',
	   'vertical_reaction_height' => '40',
	   'vertical_border_radius' => '',
	   'vertical_font_color_default' => '#000',
	   'vertical_font_color_hover' => '',
	   'vertical_bg_color_default' => '#ffff0d',
	   'vertical_bg_color_hover' => '',
	   'vertical_border_width_default' => '',
	   'vertical_border_color_default' => '',
	   'vertical_border_width_hover' => '',
	   'vertical_border_color_hover' => '',
	   'hor_enable' => '1',
	   'title' => 'React',
	   'horizontal_re_providers' => array( 'smile', 'lol', 'love', 'sad', 'angry', 'wow', 'up' ),
	   'hor_reaction_alignment' => 'left',
	   'bottom' => '1',
	   'post' => '1',
	   'page' => '1',
	   'vertical_re_providers' => array( 'smile', 'lol', 'love', 'sad', 'angry', 'wow', 'up' ),
	   'vertical_bg' => '',
	   'alignment' => 'left',
	   'left_offset' => '-10',
	   'right_offset' => '-10',
	   'top_offset' => '100',
	   'vertical_post' => '1',
	   'vertical_page' => '1',
	   'hide_mobile_reaction' => '1',
	   'vertical_screen_width' => '783',
	   'bottom_mobile_reaction' => '1',
	   'horizontal_screen_width' => '783',
	   'bottom_reaction_position' => '0',
	   'bottom_reaction_alignment' => 'left',
	   'bottom_reaction_position_radio' => 'responsive',
	   'delete_options' => '1',
	   'custom_css' => '',
	   'amp_enable' => '1'
	) );

	// plugin version
	add_option( 'heateor_rb_version', HEATEOR_RB_VERSION );

}

/**
 * Plugin activation function
 */
function heateor_rb_activate_plugin( $network_wide ) {

	if ( ! current_user_can( 'activate_plugins' ) ) {
        return;
    }

	global $wpdb;

	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		if ( $network_wide ) {
			$old_blog =  $wpdb->blogid;
			//Get all blog ids
			$blog_ids =  $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				heateor_rb_save_default_options();
			}
			switch_to_blog( $old_blog );
			return;
		}
	}
	heateor_rb_save_default_options();
	set_transient( 'heateor-rb-admin-notice-on-activation', true, 5 );

}
register_activation_hook( __FILE__, 'heateor_rb_activate_plugin' );

/**
 * Save default options for the new subsite created
 */
function heateor_rb_new_subsite_default_options( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

    if ( is_plugin_active_for_network( 'reaction-buttons-for-wordpress/reaction-buttons-for-wordpress.php' ) ) { 
        switch_to_blog( $blog_id );
        heateor_rb_save_default_options();
        restore_current_blog();
    }

}
add_action( 'wpmu_new_blog', 'heateor_rb_new_subsite_default_options', 10, 6 );

/**
 * The core plugin class
 */
require plugin_dir_path( __FILE__ ) . 'includes/reaction-buttons-for-wordpress.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0
 */
function heateor_rb_run() {

	global $heateor_rb;
	$heateor_rb = new Reaction_Buttons_For_Wordpress( HEATEOR_RB_VERSION );

}
heateor_rb_run();
