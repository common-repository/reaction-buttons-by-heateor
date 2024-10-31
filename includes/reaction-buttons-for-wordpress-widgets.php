<?php

/**
 * The file that defines classes for widgets
 *
 * Class definitions that include functions used for widgets.
 *
 * @since    1.0
 *
 */

/**
 * Standard Widget class.
 *
 * This is used to define functions for Standard Reaction Widget.
 *
 * @since    1.0
 */
class Reaction_Buttons_For_Wordpress_Standard_Widget extends WP_Widget { 
	
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
	 * Assign plugin options to private member $options and define widget title, description etc.
	 *
	 * @since    1.0
	 */
	public function __construct() { 
		
		global $heateor_rb;

		$this->options = $heateor_rb->options;

		$this->public_class_object = new Reaction_Buttons_For_Wordpress_Public( $heateor_rb->options, HEATEOR_RB_VERSION );

		parent::__construct( 
			'Heateor_RB_Standard', // unique id 
			__( 'Reaction Buttons For Wordpress - Standard Widget' ), // Widget title 
			array( 'description' => __( 'Standard reaction widget. Let your website visitors react to your posts by adding Standard reaction buttons to your web pages', 'reaction-buttons-by-heateor' ) ) 
		); 
	}  

	/**
	 * Render widget at front-end
	 *
	 * @since    1.0
	 */
	public function widget( $args, $instance ) { 
		// return if standard reaction is disabled
		if ( ! isset( $this->options['hor_enable'] ) ) {
			return;
		}
		extract( $args );
		if ( $instance['hide_for_logged_in'] == 1 && is_user_logged_in() ) return;
		
		global $post;

		if ( isset( $this->options['js_when_needed'] ) && ! wp_script_is('heateor_rb_reaction_js' ) ) {
			$inline_script = 'function heateorRbLoadEvent(e) {var t=window.onload;if (typeof window.onload!="function") {window.onload=e}else{window.onload=function() {t();e()}}};';
			$inline_script .= 'var heateorRbReactionAjaxUrl = \''. get_admin_url() .'admin-ajax.php\', heateorRbCloseIconPath = \''. plugins_url( '../images/close.png', __FILE__ ) .'\', heateorRbPluginIconPath = \''. plugins_url( '../images/logo.png', __FILE__ ) .'\', heateorRbHorizontalReactionCountEnable = '. isset( $this->options['hor_enable'] ) .', heateorRbVerticalReactionCountEnable = '. ( isset( $this->options['vertical_enable'] ) && ( isset( $this->options['vertical_counts'] ) || isset( $this->options['vertical_total_reactions'] ) ) ? 1 : 0 ) .', heateorRbReactionOffset = '. ( isset( $this->options['alignment'] ) && $this->options['alignment'] != '' && isset( $this->options[$this->options['alignment'].'_offset'] ) && $this->options[$this->options['alignment'].'_offset'] != '' ? $this->options[$this->options['alignment'].'_offset'] : 0 ) . '; var heateorRbMobileStickyReactionEnabled = ' . ( isset( $this->options['vertical_enable'] ) && isset( $this->options['bottom_mobile_reaction'] ) && $this->options['horizontal_screen_width'] != '' ? 1 : 0 ) . ';';
			$inline_script .= 'var heateorRbCopyLinkMessage = "' . htmlspecialchars( __( 'Link copied.', 'reaction-buttons-by-heateor' ), ENT_QUOTES ) . '";';
			if ( isset( $this->options['horizontal_counter_position'] ) ) {
				$inline_script .= in_array( $this->options['horizontal_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var heateorRbReduceHorizontalSvgWidth = true;' : '';
				$inline_script .= in_array( $this->options['horizontal_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var heateorRbReduceHorizontalSvgHeight = true;' : '';
			}
			if ( isset( $this->options['vertical_counts'] ) ) {
				$inline_script .= isset( $this->options['vertical_counter_position'] ) && in_array( $this->options['vertical_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var heateorRbReduceVerticalSvgWidth = true;' : '';
				$inline_script .= ! isset( $this->options['vertical_counter_position'] ) || in_array( $this->options['vertical_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var heateorRbReduceVerticalSvgHeight = true;' : '';
			}
			$inline_script .= 'var heateorRbUrlCountFetched = [], heateorRbReactionsText = \''. htmlspecialchars(__('Reactions', 'reaction-buttons-by-heateor'), ENT_QUOTES) .'\', heateorRbShareText = \''. htmlspecialchars(__('Share', 'reaction-buttons-by-heateor'), ENT_QUOTES) .'\';';
			$inline_script .= 'function heateorRbTrackEmojiClicks(r,e){jQuery.ajax({type:"GET",url:heateorRbReactionAjaxUrl,data:{action:"heateor_rb_track_emoji_clicks",emoji:e,url:jQuery(r).parents("div.heateor_rb_reaction_container").attr("data-heateor-rb-href")},success:function(r,e,a){console.log(r)}})}';
			wp_add_inline_script( 'jquery', $inline_script, $position = 'before' );
		}

		if ( NULL === $post ) {
			$post_id = 0;
		} else {
			$post_id = $post->ID;
		}
		if ( isset( $instance['target_url'] ) ) {
			if ( $instance['target_url'] == 'default' ) {
				$reaction_url = sanitize_url( $this->public_class_object->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );
				if ( is_home() ) {
					$reaction_url = home_url();
					$post_id = 0;
				} elseif ( ! is_singular() ) {
					$post_id = 0;
				} elseif ( isset( $_SERVER['QUERY_STRING'] ) && $_SERVER['QUERY_STRING'] ) {
					$reaction_url = sanitize_url( $this->public_class_object->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );
				} elseif ( get_permalink( $post->ID ) ) {
					$reaction_url = get_permalink( $post->ID );
				}
			} elseif ( $instance['target_url'] == 'homepage' ) {
				$reaction_url = home_url();
				$post_id = 0;
			} elseif ( $instance['target_url'] == 'custom' ) {
				$reaction_url = isset( $instance['target_url_custom'] ) ? trim( $instance['target_url_custom'] ) : get_permalink( $post->ID );
				$post_id = 0;
			}
		} else {
			$reaction_url = get_permalink( $post->ID );
		}
		$reaction_count_url = $reaction_url;
		if ( isset( $instance['target_url'] ) && $instance['target_url'] == 'default' && is_singular() ) {
			$reaction_count_url = get_permalink( $post->ID );
		}
		$custom_post_url = $this->public_class_object->apply_target_reaction_url_filter( $reaction_url, 'horizontal', ! is_singular() ? true : false );
		if ( $custom_post_url != $reaction_url ) {
			$reaction_url = $custom_post_url;
			$reaction_count_url = $reaction_url;
		}
		// reaction count transient ID
		$this->public_class_object->reaction_count_transient_id = $this->public_class_object->get_reaction_count_transient_id( $reaction_url );
		$cached_reaction_count = $this->public_class_object->get_cached_reaction_count( $this->public_class_object->reaction_count_transient_id );
		global $heateor_rb_allowed_tags;
		echo wp_kses( "<div class='heateor_rb_reaction_container heateor_rb_horizontal_reaction' " . ( $this->public_class_object->is_amp_page() ? "" : "data-heateor-rb-href='" . ( isset( $reaction_count_url ) && $reaction_count_url ? $reaction_count_url : $reaction_url ) . "'" ) . ( ( $cached_reaction_count === false || $this->public_class_object->is_amp_page() ) ? "" : ' data-heateor-rb-no-counts="1"' ) . ">", $heateor_rb_allowed_tags );
		
		echo $before_widget;
		
		if ( ! empty( $instance['title'] ) ) { 
			$title = apply_filters( 'widget_title', $instance[ 'title' ] ); 
			echo $before_title . esc_html( $title ) . $after_title;
		}

		if ( ! empty( $instance['before_widget_content'] ) ) { 
			echo '<div>' . esc_html( $instance['before_widget_content'] ) . '</div>'; 
		}

		echo $this->public_class_object->prepare_reaction_html( $reaction_url, 'horizontal', isset( $instance['show_counts'] ), isset( $instance['total_reactions'] ), ! is_singular() ? true : false );

		if ( ! empty( $instance['after_widget_content'] ) ) { 
			echo '<div>' . esc_html( $instance['after_widget_content'] ) . '</div>'; 
		}
		
		echo '</div>';
		if ( ( isset( $instance['show_counts'] ) || isset( $instance['total_reactions'] ) ) && $cached_reaction_count === false ) {
			echo '<script>heateorRbLoadEvent(
		function() {
			// reaction counts
			heateorRbCallAjax(function() {
				heateorRbGetReactionCounts();
			});
		}
	);</script>';
		}
		echo $after_widget;
	} 

	/** 
	 * Everything which should happen when user edit widget at admin panel.
	 *
	 * @since    1.0
	 */
	public function update( $new_instance, $old_instance ) { 
		
		$instance = $old_instance; 
		$instance['title'] = strip_tags( $new_instance['title'] ); 
		$instance['show_counts'] = $new_instance['show_counts'];
		$instance['total_reactions'] = $new_instance['total_reactions']; 
		$instance['target_url'] = $new_instance['target_url'];
		$instance['target_url_custom'] = $new_instance['target_url_custom'];  
		$instance['before_widget_content'] = $new_instance['before_widget_content']; 
		$instance['after_widget_content'] = $new_instance['after_widget_content']; 
		$instance['hide_for_logged_in'] = $new_instance['hide_for_logged_in'];  

		return $instance; 

	}  

	/** 
	 * Widget options form at admin panel
	 *
	 * @since    1.0
	 */
	public function form( $instance ) { 
		
		// default widget settings
		$defaults = array( 'title' => 'React', 'show_counts' => '', 'total_reactions' => '', 'target_url' => 'default', 'target_url_custom' => '', 'before_widget_content' => '', 'after_widget_content' => '', 'hide_for_logged_in' => '' );

		foreach ( $instance as $key => $value ) {
			if ( is_string( $value ) ) {
				$instance[ $key ] = esc_attr( $value );
			}
		}
		
		$instance = wp_parse_args( ( array ) $instance, $defaults );
		?> 
		<script type="text/javascript">
			function heateorRbToggleHorReactionTargetUrl(val) {
				if (val == 'custom' ) {
					jQuery( '.heateorRbHorReactionTargetUrl' ).css( 'display', 'block' );
				} else {
					jQuery( '.heateorRbHorReactionTargetUrl' ).css( 'display', 'none' );
				}
			}
		</script>
		<p> 
			<p><strong>Note:</strong> <?php _e( 'Make sure "Standard Reaction Interface" is enabled in "Standard Interface" section at "Reaction Buttons For Wordpress" page.', 'reaction-buttons-by-heateor' ) ?></p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'reaction-buttons-by-heateor' ); ?></label> 
			<input style="width: 95%" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /> <br/><br/>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_counts' ) ); ?>"><?php _e( 'Show individual reaction counts:', 'reaction-buttons-by-heateor' ); ?></label> 
			<input id="<?php echo esc_attr( $this->get_field_id( 'show_counts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_counts' ) ); ?>" type="checkbox" value="1" <?php echo isset( $instance['show_counts'] ) && $instance['show_counts'] == 1 ? 'checked' : ''; ?> /><br/><br/>
			<label for="<?php echo esc_attr( $this->get_field_id( 'total_reactions' ) ); ?>"><?php _e( 'Show total reactions:', 'reaction-buttons-by-heateor' ); ?></label> 
			<input id="<?php echo esc_attr( $this->get_field_id( 'total_reactions' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'total_reactions' ) ); ?>" type="checkbox" value="1" <?php echo isset( $instance['total_reactions'] ) && $instance['total_reactions'] == 1 ? 'checked' : ''; ?> /><br/> <br/>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target_url' ) ); ?>"><?php _e( 'Target Url:', 'reaction-buttons-by-heateor' ); ?></label> 
			<select style="width: 95%" onchange="heateorRbToggleHorReactionTargetUrl(this.value)" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target_url' ) ); ?>">
				<option value="">--<?php _e( 'Select', 'reaction-buttons-by-heateor' ) ?>--</option>
				<option value="default" <?php echo isset( $instance['target_url'] ) && $instance['target_url'] == 'default' ? 'selected' : '' ; ?>><?php _e( 'Url of the webpage where icons are located (default)', 'reaction-buttons-by-heateor' ) ?></option>
				<option value="homepage" <?php echo isset( $instance['target_url'] ) && $instance['target_url'] == 'homepage' ? 'selected' : '' ; ?>><?php _e( 'Url of the homepage of your website', 'reaction-buttons-by-heateor' ) ?></option>
				<option value="custom" <?php echo isset( $instance['target_url'] ) && $instance['target_url'] == 'custom' ? 'selected' : '' ; ?>><?php _e( 'Custom Url', 'reaction-buttons-by-heateor' ) ?></option>
			</select>
			<input placeholder="<?php _e( 'Custom URL', 'reaction-buttons-by-heateor' ); ?>" style="margin-top:5px; <?php echo ! isset( $instance['target_url'] ) || $instance['target_url'] != 'custom' ? 'display: none' : '' ; ?>" class="widefat heateorRbHorReactionTargetUrl" id="<?php echo esc_attr( $this->get_field_id( 'target_url_custom' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target_url_custom' ) ); ?>" type="text" value="<?php echo isset( $instance['target_url_custom'] ) ? esc_attr( $instance['target_url_custom'] ) : ''; ?>" /> 
			<label for="<?php echo esc_attr( $this->get_field_id( 'before_widget_content' ) ); ?>"><?php _e( 'Before widget content:', 'reaction-buttons-by-heateor' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'before_widget_content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'before_widget_content' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['before_widget_content'] ); ?>" /> 
			<label for="<?php echo esc_attr( $this->get_field_id( 'after_widget_content' ) ); ?>"><?php _e( 'After widget content:', 'reaction-buttons-by-heateor' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'after_widget_content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'after_widget_content' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['after_widget_content'] ); ?>" /> 
			<br /><br /><label for="<?php echo esc_attr( $this->get_field_id( 'hide_for_logged_in' ) ); ?>"><?php _e( 'Hide for logged in users:', 'reaction-buttons-by-heateor' ); ?></label> 
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide_for_logged_in' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_for_logged_in' ) ); ?>" type="text" value="1" <?php if ( isset( $instance['hide_for_logged_in'] )  && $instance['hide_for_logged_in'] == 1 ) echo 'checked="checked"'; ?> /> 
		</p> 
	<?php 
    }

} 

/**
 * Floating Widget class
 *
 * This is used to define functions for Floating Reaction Widget.
 *
 * @since    1.0
 */
class Reaction_Buttons_For_Wordpress_Floating_Widget extends WP_Widget { 
	
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
	 * Assign plugin options to private member $options and define widget title, description etc.
	 *
	 * @since    1.0
	 */
	public function __construct() { 
		
		global $heateor_rb;

		$this->options = $heateor_rb->options;

		$this->public_class_object = new Reaction_Buttons_For_Wordpress_Public( $heateor_rb->options, HEATEOR_RB_VERSION );

		parent::__construct( 
			'Heateor_RB_Floating', // unique id 
			'Reaction Buttons For Wordpress - Floating Widget', // widget title 
			// additional parameters 
			array(
				'description' => __( 'Floating reaction widget. Let your website visitors react to your posts by adding floating reaction buttons to your web pages', 'reaction-buttons-by-heateor' ) ) 
			); 
	}  

	/**
	 * Render widget at front-end
	 *
	 * @since    1.0
	 */
	public function widget( $args, $instance ) { 
		
		// return if vertical reaction is disabled
		if ( ! isset( $this->options['vertical_enable'] ) ) {
			return;
		}
		extract( $args );
		if ( $instance['hide_for_logged_in'] == 1 && is_user_logged_in() ) return;
		
		global $post;

		if ( isset( $this->options['js_when_needed'] ) && ! wp_script_is('heateor_rb_reaction_js' ) ) {
			$inline_script = 'function heateorRbLoadEvent(e) {var t=window.onload;if (typeof window.onload!="function") {window.onload=e}else{window.onload=function() {t();e()}}};';
			$inline_script .= 'var heateorRbReactionAjaxUrl = \''. get_admin_url() .'admin-ajax.php\', heateorRbCloseIconPath = \''. plugins_url( '../images/close.png', __FILE__ ) .'\', heateorRbPluginIconPath = \''. plugins_url( '../images/logo.png', __FILE__ ) .'\', heateorRbHorizontalReactionCountEnable = '. isset( $this->options['hor_enable'] ) .', heateorRbVerticalReactionCountEnable = '. ( isset( $this->options['vertical_enable'] ) && ( isset( $this->options['vertical_counts'] ) || isset( $this->options['vertical_total_reactions'] ) ) ? 1 : 0 ) .', heateorRbReactionOffset = '. ( isset( $this->options['alignment'] ) && $this->options['alignment'] != '' && isset( $this->options[$this->options['alignment'].'_offset'] ) && $this->options[$this->options['alignment'].'_offset'] != '' ? $this->options[$this->options['alignment'].'_offset'] : 0 ) . '; var heateorRbMobileStickyReactionEnabled = ' . ( isset( $this->options['vertical_enable'] ) && isset( $this->options['bottom_mobile_reaction'] ) && $this->options['horizontal_screen_width'] != '' ? 1 : 0 ) . ';';
			$inline_script .= 'var heateorRbCopyLinkMessage = "' . htmlspecialchars( __( 'Link copied.', 'reaction-buttons-by-heateor' ), ENT_QUOTES ) . '";';
			if ( isset( $this->options['horizontal_counter_position'] ) ) {
				$inline_script .= in_array( $this->options['horizontal_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var heateorRbReduceHorizontalSvgWidth = true;' : '';
				$inline_script .= in_array( $this->options['horizontal_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var heateorRbReduceHorizontalSvgHeight = true;' : '';
			}
			if ( isset( $this->options['vertical_counts'] ) ) {
				$inline_script .= isset( $this->options['vertical_counter_position'] ) && in_array( $this->options['vertical_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var heateorRbReduceVerticalSvgWidth = true;' : '';
				$inline_script .= ! isset( $this->options['vertical_counter_position'] ) || in_array( $this->options['vertical_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var heateorRbReduceVerticalSvgHeight = true;' : '';
			}
			$inline_script .= 'var heateorRbUrlCountFetched = [], heateorRbReactionsText = \''. htmlspecialchars(__('Reactions', 'reaction-buttons-by-heateor'), ENT_QUOTES) .'\', heateorRbShareText = \''. htmlspecialchars(__('Share', 'reaction-buttons-by-heateor'), ENT_QUOTES) .'\';';
			$inline_script .= 'function heateorRbTrackEmojiClicks(r,e){jQuery.ajax({type:"GET",url:heateorRbReactionAjaxUrl,data:{action:"heateor_rb_track_emoji_clicks",emoji:e,url:jQuery(r).parents("div.heateor_rb_reaction_container").attr("data-heateor-rb-href")},success:function(r,e,a){console.log(r)}})}';
			wp_add_inline_script('jquery', $inline_script, $position = 'before' );
		}

		$post_id = $post->ID;
		if ( isset( $instance['target_url'] ) ) {
			if ( $instance['target_url'] == 'default' ) {
				$reaction_url = sanitize_url( $this->public_class_object->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );
				if ( is_home() ) {
					$reaction_url = home_url();
					$post_id = 0;
				}  elseif ( ! is_singular() ) {
					$post_id = 0;
				} elseif ( isset( $_SERVER['QUERY_STRING'] ) && $_SERVER['QUERY_STRING'] ) {
					$reaction_url = sanitize_url( $this->public_class_object->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );
				} elseif ( get_permalink( $post->ID ) ) {
					$reaction_url = get_permalink( $post->ID );
				}
			} elseif ( $instance['target_url'] == 'homepage' ) {
				$reaction_url = home_url();
				$post_id = 0;
			} elseif ( $instance['target_url'] == 'custom' ) {
				$reaction_url = isset( $instance['target_url_custom'] ) ? trim( $instance['target_url_custom'] ) : get_permalink( $post->ID );
				$post_id = 0;
			}
		} else {
			$reaction_url = get_permalink( $post->ID );
		}
		$reaction_count_url = $reaction_url;
		if ( isset( $instance['target_url'] ) && $instance['target_url'] == 'default' && is_singular() ) {
			$reaction_count_url = get_permalink( $post->ID );
		}
		$custom_post_url = $this->public_class_object->apply_target_reaction_url_filter( $reaction_url, 'vertical', false );
		if ( $custom_post_url != $reaction_url ) {
			$reaction_url = $custom_post_url;
			$reaction_count_url = $reaction_url;
		}
		$ssOffset = 0;
		if ( isset( $instance['alignment'] ) && isset( $instance[$instance['alignment'] . '_offset'] ) ) {
			$ssOffset = $instance[$instance['alignment'] . '_offset'];
		}
		
		// reaction count transient ID
		$this->public_class_object->reaction_count_transient_id = $this->public_class_object->get_reaction_count_transient_id( $reaction_url );
		$cached_reaction_count = $this->public_class_object->get_cached_reaction_count( $this->public_class_object->reaction_count_transient_id );

		echo $before_widget;

		global $heateor_rb_allowed_tags;
		echo wp_kses( "<div class='heateor_rb_reaction_container heateor_rb_vertical_reaction" . ( isset( $this->options['hide_mobile_reaction'] ) ? ' heateor_rb_hide_reaction' : '' ) . ( isset( $this->options['bottom_mobile_reaction'] ) ? ' heateor_rb_bottom_reaction' : '' ) . "' rb-offset='" . $ssOffset . "' style='width:" . ( ( $this->options['vertical_reaction_size'] ? $this->options['vertical_reaction_size'] : 35) + 4) . "px;".( isset( $instance['alignment'] ) && $instance['alignment'] != '' && isset( $instance[$instance['alignment'].'_offset'] ) ? $instance['alignment'].': '. ( $instance[$instance['alignment'].'_offset'] == '' ? 0 : $instance[$instance['alignment'].'_offset'] ) .'px;' : '' ).( isset( $instance['top_offset'] ) ? 'top: '. ( $instance['top_offset'] == '' ? 0 : $instance['top_offset'] ) .'px;' : '' ) . ( isset( $instance['vertical_bg'] ) && $instance['vertical_bg'] != '' ? 'background-color: '.$instance['vertical_bg'] . ';' : '-webkit-box-shadow:none;box-shadow:none;' ) . "' " . ( $this->public_class_object->is_amp_page() ? "" : "data-heateor-rb-href='" . ( isset( $reaction_count_url ) && $reaction_count_url ? $reaction_count_url : $reaction_url ) . "'" ) . ( ( $cached_reaction_count === false || $this->public_class_object->is_amp_page() ) ? "" : ' data-heateor-rb-no-counts="1"' ) .">", $heateor_rb_allowed_tags );
		
		echo $this->public_class_object->prepare_reaction_html( $reaction_url, 'vertical', isset( $instance['show_counts'] ), isset( $instance['total_reactions'] ) );

		echo '</div>';
		if ( ( isset( $instance['show_counts'] ) || isset( $instance['total_reactions'] ) ) && $cached_reaction_count === false ) {
			echo '<script>heateorRbLoadEvent(
		function() {
			// reaction counts
			heateorRbCallAjax(function() {
				heateorRbGetReactionCounts();
			});
		}
	);</script>';
		}
		echo $after_widget;
	}  

	/** 
	 * Everything which should happen when user edit widget at admin panel.
	 *
	 * @since    1.0
	 */
	public function update( $new_instance, $old_instance ) { 
		
		$instance = $old_instance; 
		$instance['target_url'] = $new_instance['target_url'];
		$instance['show_counts'] = $new_instance['show_counts']; 
		$instance['total_reactions'] = $new_instance['total_reactions']; 
		$instance['target_url_custom'] = $new_instance['target_url_custom'];
		$instance['alignment'] = $new_instance['alignment'];
		$instance['left_offset'] = $new_instance['left_offset'];
		$instance['right_offset'] = $new_instance['right_offset'];
		$instance['top_offset'] = $new_instance['top_offset'];
		$instance['vertical_bg'] = $new_instance['vertical_bg'];
		$instance['hide_for_logged_in'] = $new_instance['hide_for_logged_in'];  

		return $instance; 

	}  

	/** 
	 * Widget options form at admin panel.
	 *
	 * @since    1.0
	 */
	public function form( $instance ) { 
		
		/* Set up default widget settings. */ 
		$defaults = array( 'alignment' => 'left', 'show_counts' => '', 'total_reactions' => '', 'left_offset' => '40', 'right_offset' => '0', 'target_url' => 'default', 'target_url_custom' => '', 'top_offset' => '100', 'vertical_bg' => '', 'hide_for_logged_in' => '' );

		foreach ( $instance as $key => $value ) {
			if ( is_string( $value ) ) {
				$instance[ $key ] = esc_attr( $value );
			}
		}
		
		$instance = wp_parse_args( ( array ) $instance, $defaults ); 
		?> 
		<p> 
			<script>
			function heateorRbToggleReactionOffset(alignment) {
				if (alignment == 'left' ) {
					jQuery( '.heateorRbReactionLeftOffset' ).css( 'display', 'block' );
					jQuery( '.heateorRbReactionRightOffset' ).css( 'display', 'none' );
				} else {
					jQuery( '.heateorRbReactionLeftOffset' ).css( 'display', 'none' );
					jQuery( '.heateorRbReactionRightOffset' ).css( 'display', 'block' );
				}
			}
			function heateorRbToggleVerticalReactionTargetUrl(val) {
				if (val == 'custom' ) {
					jQuery( '.heateorRbVerticalReactionTargetUrl' ).css( 'display', 'block' );
				} else {
					jQuery( '.heateorRbVerticalReactionTargetUrl' ).css( 'display', 'none' );
				}
			}
			</script>
			<p><strong>Note:</strong> <?php _e( 'Make sure "Floating Interface" is enabled in "Floating Interface" section at "Reaction Buttons For Wordpress" page.', 'reaction-buttons-by-heateor' ) ?></p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_counts' ) ); ?>"><?php _e( 'Show individual reaction counts:', 'reaction-buttons-by-heateor' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'show_counts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_counts' ) ); ?>" type="checkbox" value="1" <?php echo isset( $instance['show_counts'] ) && $instance['show_counts'] == 1 ? 'checked' : ''; ?> /><br/><br/> 
			<label for="<?php echo esc_attr( $this->get_field_id( 'total_reactions' ) ); ?>"><?php _e( 'Show total reactions:', 'reaction-buttons-by-heateor' ); ?></label> 
			<input id="<?php echo esc_attr( $this->get_field_id( 'total_reactions' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'total_reactions' ) ); ?>" type="checkbox" value="1" <?php echo isset( $instance['total_reactions'] ) && $instance['total_reactions'] == 1 ? 'checked' : ''; ?> /><br/> <br/>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target_url' ) ); ?>"><?php _e( 'Target Url:', 'reaction-buttons-by-heateor' ); ?></label> 
			<select style="width: 95%" onchange="heateorRbToggleVerticalReactionTargetUrl(this.value)" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target_url' ) ); ?>">
				<option value="">--<?php _e( 'Select', 'reaction-buttons-by-heateor' ) ?>--</option>
				<option value="default" <?php echo isset( $instance['target_url'] ) && $instance['target_url'] == 'default' ? 'selected' : '' ; ?>><?php _e( 'URL of the webpage where icons are located (default)', 'reaction-buttons-by-heateor' ) ?></option>
				<option value="homepage" <?php echo isset( $instance['target_url'] ) && $instance['target_url'] == 'homepage' ? 'selected' : '' ; ?>><?php _e( 'URL of the homepage of your website', 'reaction-buttons-by-heateor' ) ?></option>
				<option value="custom" <?php echo isset( $instance['target_url'] ) && $instance['target_url'] == 'custom' ? 'selected' : '' ; ?>><?php _e( 'Custom URL', 'reaction-buttons-by-heateor' ) ?></option>
			</select>
			<input placeholder="<?php _e( 'Custom URL', 'reaction-buttons-by-heateor' ) ?>" style="width:95%; margin-top: 5px; <?php echo ! isset( $instance['target_url'] ) || $instance['target_url'] != 'custom' ? 'display: none' : '' ; ?>" class="widefat heateorRbVerticalReactionTargetUrl" id="<?php echo esc_attr( $this->get_field_id( 'target_url_custom' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target_url_custom' ) ); ?>" type="text" value="<?php echo isset( $instance['target_url_custom'] ) ? esc_attr( $instance['target_url_custom'] ) : ''; ?>" /> 
			<label for="<?php echo esc_attr( $this->get_field_id( 'alignment' ) ); ?>"><?php _e( 'Alignment', 'reaction-buttons-by-heateor' ); ?></label> 
			<select onchange="heateorRbToggleReactionOffset(this.value)" style="width: 95%" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'alignment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'alignment' ) ); ?>">
				<option value="left" <?php echo $instance['alignment'] == 'left' ? 'selected' : ''; ?>><?php _e( 'Left', 'reaction-buttons-by-heateor' ) ?></option>
				<option value="right" <?php echo $instance['alignment'] == 'right' ? 'selected' : ''; ?>><?php _e( 'Right', 'reaction-buttons-by-heateor' ) ?></option>
			</select>
			<div class="heateorRbReactionLeftOffset" <?php echo $instance['alignment'] == 'right' ? 'style="display: none"' : ''; ?>>
				<label for="<?php echo esc_attr( $this->get_field_id( 'left_offset' ) ); ?>"><?php _e( 'Left Offset', 'reaction-buttons-by-heateor' ); ?></label> 
				<input style="width: 95%" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'left_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'left_offset' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['left_offset'] ); ?>" />px<br/>
			</div>
			<div class="heateorRbReactionRightOffset" <?php echo $instance['alignment'] == 'left' ? 'style="display: none"' : ''; ?>>
				<label for="<?php echo esc_attr( $this->get_field_id( 'right_offset' ) ); ?>"><?php _e( 'Right Offset', 'reaction-buttons-by-heateor' ); ?></label> 
				<input style="width: 95%" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'right_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'right_offset' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['right_offset'] ); ?>" />px<br/>
			</div>
			<label for="<?php echo esc_attr( $this->get_field_id( 'top_offset' ) ); ?>"><?php _e( 'Top Offset', 'reaction-buttons-by-heateor' ); ?></label> 
			<input style="width: 95%" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'top_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'top_offset' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['top_offset'] ); ?>" />px<br/>
			
			<label for="<?php echo esc_attr( $this->get_field_id( 'vertical_bg' ) ); ?>"><?php _e( 'Background Color', 'reaction-buttons-by-heateor' ); ?></label> 
			<input style="width: 95%" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vertical_bg' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vertical_bg' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['vertical_bg'] ); ?>" />
			
			<br /><br /><label for="<?php echo esc_attr( $this->get_field_id( 'hide_for_logged_in' ) ); ?>"><?php _e( 'Hide for logged in users:', 'reaction-buttons-by-heateor' ); ?></label> 
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide_for_logged_in' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_for_logged_in' ) ); ?>" type="text" value="1" <?php if ( isset( $instance['hide_for_logged_in'] )  && $instance['hide_for_logged_in'] == 1 ) echo 'checked="checked"'; ?> /> 
		</p> 
	<?php 
    } 
}
