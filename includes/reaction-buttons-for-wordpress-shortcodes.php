<?php

/**
 * The file that defines Shortcodes class
 *
 * A class definition that includes functions used for Shortcodes.
 *
 * @since      1.0
 *
 */

/**
 * Shortcodes class.
 *
 * This is used to define functions for Shortcodes.
 *
 * @since      1.0
 */
class Reaction_Buttons_For_Wordpress_Shortcodes {

	/**
	 * Options saved in database.
	 *
	 * @since    1.0
	 */
	private $options;

	/**
	 * Member to assign object of Reaction_Buttons_For_Wordpress_Public Class.
	 *
	 * @since    1.0
	 */
	private $public_class_object;

	/**
	 * Assign plugin options to private member $options.
	 *
	 * @since    1.0
	 */
	public function __construct( $options, $public_class_object ) {

		$this->options = $options;
		$this->public_class_object = $public_class_object;

	}
	
	/** 
	 * Shortcode for Social Reaction
	 *
	 * @since    1.0
	 */ 
	public function reaction_buttons_shortcode( $params ) {
		
		extract( shortcode_atts( array(
			'style' => '',
			'type' => 'standard',
			'left' => '0',
			'right' => '0',
			'top' => '100',
			'url' => '',
			'count' => 0,
			'align' => 'left',
			'title' => '',
			'total_reactions' => 'OFF'
		), $params ) );
		
		$type = strtolower( $type );

		if ( ( $type == 'standard' && ! isset( $this->options['hor_enable'] ) ) || ( $type == 'floating' && ! isset( $this->options['vertical_enable'] ) ) || ( ! isset( $this->options['amp_enable'] ) && $this->public_class_object->is_amp_page() ) ) {
			return;
		}
		global $post;
		if ( ! is_object( $post ) ) {
	        return;
		}
		if ( $url ) {
			$target_url = $url;
			$post_id = 0;
		} elseif ( is_front_page() ) {
			$target_url = sanitize_url( home_url() );
			$post_id = 0;
		} elseif ( ! is_singular() && $type == 'vertical' ) {
			$target_url = sanitize_url( $this->public_class_object->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ;
			$post_id = 0;
		} elseif ( isset( $_SERVER['QUERY_STRING'] ) && $_SERVER['QUERY_STRING'] ) {
			$target_url = sanitize_url( $this->public_class_object->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ;
			$post_id = $post->ID;
		} elseif ( get_permalink( $post->ID ) ) {
			$target_url = get_permalink( $post->ID );
			$post_id = $post->ID;
		} else {
			$target_url = sanitize_url( $this->public_class_object->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ;
			$post_id = 0;
		}
		$reaction_count_url = $target_url;
		if ( $url == '' && is_singular() ) {
			$reaction_count_url = get_permalink( $post->ID );
		}
		$custom_post_url = $this->public_class_object->apply_target_reaction_url_filter( $target_url, $type, false );
		if ( $custom_post_url != $target_url ) {
			$target_url = $custom_post_url;
			$reaction_count_url = $target_url;
		}
		$alignment_offset = 0;
		if ( $left ) {
			$alignment_offset = $left;
		} elseif ( $right ) {
			$alignment_offset = $right;
		}

		// reaction count transient ID
		$this->public_class_object->reaction_count_transient_id = $this->public_class_object->get_reaction_count_transient_id( $target_url );
		$cached_reaction_count = $this->public_class_object->get_cached_reaction_count( $this->public_class_object->reaction_count_transient_id );

		if ( isset( $this->options['js_when_needed'] ) && ! wp_script_is('heateor_rb_reaction_js' ) ) {
			$inline_script = 'function heateorRbLoadEvent(e) {var t=window.onload;if (typeof window.onload!="function") {window.onload=e}else{window.onload=function() {t();e()}}};';
			$inline_script .= 'var heateorRbReactionAjaxUrl = \''. get_admin_url() .'admin-ajax.php\', heateorRbCloseIconPath = \''. plugins_url( '../images/close.png', __FILE__ ) .'\', heateorRbPluginIconPath = \''. plugins_url( '../images/logo.png', __FILE__ ) .'\', heateorRbHorizontalReactionCountEnable = '. ( isset( $this->options['hor_enable'] ) ) .', heateorRbVerticalReactionCountEnable = '. ( isset( $this->options['vertical_enable'] ) && ( isset( $this->options['vertical_counts'] ) || isset( $this->options['vertical_total_reactions'] ) ) ? 1 : 0 ) .', heateorRbReactionOffset = '. ( isset( $this->options['alignment'] ) && $this->options['alignment'] != '' && isset( $this->options[$this->options['alignment'].'_offset'] ) && $this->options[$this->options['alignment'].'_offset'] != '' ? $this->options[$this->options['alignment'].'_offset'] : 0 ) . '; var heateorRbMobileStickyReactionEnabled = ' . ( isset( $this->options['vertical_enable'] ) && isset( $this->options['bottom_mobile_reaction'] ) && $this->options['horizontal_screen_width'] != '' ? 1 : 0 ) . ';';
			$inline_script .= 'var heateorRbCopyLinkMessage = "' . htmlspecialchars( __( 'Link copied.', 'reaction-buttons-by-heateor' ), ENT_QUOTES ) . '";';
			if ( isset( $this->options['horizontal_counter_position'] ) ) {
				$inline_script .= in_array( $this->options['horizontal_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var heateorRbReduceHorizontalSvgWidth = true;' : '';
				$inline_script .= in_array( $this->options['horizontal_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var heateorRbReduceHorizontalSvgHeight = true;' : '';
			}
			if ( isset( $this->options['vertical_counts'] ) ) {
				$inline_script .= isset( $this->options['vertical_counter_position'] ) && in_array( $this->options['vertical_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var heateorRbReduceVerticalSvgWidth = true;' : '';
				$inline_script .= ! isset( $this->options['vertical_counter_position'] ) || in_array( $this->options['vertical_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var heateorRbReduceVerticalSvgHeight = true;' : '';
			}
			$inline_script .= 'var heateorRbUrlCountFetched = [], heateorRbReactionsText = \''. htmlspecialchars( __( 'Reactions', 'reaction-buttons-by-heateor' ), ENT_QUOTES ) . '\', heateorRbShareText = \'' . htmlspecialchars( __( 'Reaction', 'reaction-buttons-by-heateor' ), ENT_QUOTES ) . '\';';
			$inline_script .= 'function heateorRbTrackEmojiClicks(r,e){jQuery.ajax({type:"GET",url:heateorRbReactionAjaxUrl,data:{action:"heateor_rb_track_emoji_clicks",emoji:e,url:jQuery(r).parents("div.heateor_rb_reaction_container").attr("data-heateor-rb-href")},success:function(r,e,a){console.log(r)}})}';
			wp_add_inline_script('jquery', $inline_script, $position = 'before' );
		}

		$html = '<div class="heateor_rb_reaction_container heateor_rb_' . ( $type == 'standard' ? 'horizontal' : 'vertical' ) . '_reaction' . ( $type == 'floating' && isset( $this->options['hide_mobile_reaction'] ) ? ' heateor_rb_hide_reaction' : '' ) . ( $type == 'floating' && isset( $this->options['bottom_mobile_reaction'] ) ? ' heateor_rb_bottom_reaction' : '' ) . '" rb-offset="' . $alignment_offset . '" ' . ( $this->public_class_object->is_amp_page() ? "" : "data-heateor-rb-href='" . ( isset( $reaction_count_url ) && $reaction_count_url ? $reaction_count_url : $target_url ) . "'" ) . ( ( $cached_reaction_count === false || $this->public_class_object->is_amp_page() ) ? "" : ' data-heateor-rb-no-counts="1" ' );
		$vertical_offsets = '';
		if ( $type == 'floating' ) {
			$vertical_offsets = $align . ': ' . $$align . 'px; top: ' . $top . 'px;width:' . ( ( $this->options['vertical_reaction_size'] ? $this->options['vertical_reaction_size'] : '35' ) + 4 ) . "px;";
		}
		// style 
		if ( $style != "" || $vertical_offsets != '' ) {
			$html .= 'style="';
			if ( strpos( $style, 'background' ) === false ) { $html .= '-webkit-box-shadow:none;box-shadow:none;'; }
			$html .= $vertical_offsets;
			$html .= $style;
			$html .= '"';
		}
		$html .= '>';
		if ( $type == 'standard' && $title != '' ) {
			$html .= '<div class="heateor_rb_reaction_title" style="font-weight:bold">' . ucfirst( $title ) . '</div>';
		}
		
		$html .= $this->public_class_object->prepare_reaction_html( $target_url, $type == 'standard' ? 'horizontal' : 'vertical', $count, $total_reactions == 'ON' ? 1 : 0 );
		$html .= '</div>';
		if ( ( $count || $total_reactions == 'ON' )  && $cached_reaction_count === false ) {
			$html .= '<script>heateorRbLoadEvent(function(){heateorRbCallAjax(function(){heateorRbGetReactionCounts();});});</script>';
		}
		return $html;
	}

}
