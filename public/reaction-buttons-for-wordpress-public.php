<?php
/**
 * Contains functions responsible for functionality at front-end of website
 *
 * @since      1.0
 *
 */

/**
 * This class defines all code necessary for functionality at front-end of website
 *
 * @since      1.0
 *
 */
class Reaction_Buttons_For_Wordpress_Public {

	/**
	 * Options saved in database.
	 *
	 * @since    1.0
	 */
	private $options;

	/**
	 * Options saved in database.
	 *
	 * @since    1.0
	 */
	private $logo_color;

	/**
	 * Current version of the plugin.
	 *
	 * @since    1.0
	 */
	public $version;

	/**
	 * Variable to track number of times 'the_content' hook called at homepage.
	 *
	 * @since    1.0
	 */
	private $vertical_home_count = 0;

	/**
	 * Variable to track number of times 'the_content' hook called at excerpts.
	 *
	 * @since    1.0
	 */
	private $vertical_excerpt_count = 0;

	/**
	 * Short urls calculated for current webpage.
	 *
	 * @since    1.0
	 */
	private $short_urls = array();

	/**
	 * Share Count Transient ID
	 *
	 * @since    1.0
	 */
	public $reaction_count_transient_id = '';

	/**
	 * Get saved options.
	 *
	 * @since    1.0
     * @param    array     $options    Plugin options saved in database
     * @param    string    $version    Current version of the plugin
	 */
	public function __construct( $options, $version ) {

		$this->options = $options;
		$this->version = $version;

	}

	/**
	 * Hook the plugin function on 'init' event.
	 *
	 * @since    1.0
	 */
	public function init() {

		// Javascript for front-end of website
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
		// inline style for front-end of website
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_inline_style' ) );
		// stylesheet files for front-end of website
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_css' ) );

		if ( isset( $this->options['amp_enable'] ) && function_exists( 'is_amp_endpoint' ) ) {
			add_action( 'wp_print_styles', array( $this, 'frontend_amp_css' ) );
        	add_action( 'amp_post_template_css', array( $this, 'frontend_amp_css' ) );
    	}
	
	}

	/**
	 * Javascript files to load at front end.
	 *
	 * @since    1.0
	 */
	public function frontend_scripts() {

		if ( ! ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) && ! ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) ) {
			$inline_script = 'function heateorRbLoadEvent(e) {var t=window.onload;if (typeof window.onload!="function") {window.onload=e}else{window.onload=function() {t();e()}}};	';
			global $post;
			if ( $post ) {
				$reaction_meta = get_post_meta( $post->ID, '_heateor_rb_meta', true );
				if ( is_front_page() || ! isset( $reaction_meta['reaction'] ) || $reaction_meta['reaction'] != 1 || ! isset( $reaction_meta['vertical_reaction'] ) || $reaction_meta['vertical_reaction'] != 1 ) {
					if ( ! isset( $this->options['js_when_needed'] ) || ( ( ( isset( $this->options['home'] ) || isset( $this->options['vertical_home'] ) ) && is_front_page() ) || ( ( isset( $this->options['category'] ) || isset($this->options['vertical_category'] ) ) && is_category() ) ||( ( isset( $this->options['archive'] ) || isset( $this->options['vertical_archive'] ) ) && is_archive() ) || ( ( isset( $this->options['post'] ) || isset( $this->options['vertical_post'] ) ) && is_single() && isset( $post->post_type ) && $post->post_type == 'post' ) || ( ( isset( $this->options['page'] ) || isset( $this->options['vertical_page'] ) ) && is_page() && isset( $post->post_type ) && $post->post_type == 'page' ) || ( ( isset( $this->options['excerpt'] ) || isset( $this->options['vertical_excerpt'] ) ) && ( is_home() || current_filter() == 'the_excerpt' ) ) || (  ( isset( $this->options['bb_forum'] ) || isset( $this->options['vertical_bb_forum'] ) ) && current_filter() == 'bbp_template_before_single_forum' ) || ( ( isset( $this->options['bb_topic'] ) || isset( $this->options['vertical_bb_topic'] ) ) && in_array( current_filter(), array( 'bbp_template_before_single_topic', 'bbp_template_before_lead_topic' ) ) ) || ( current_filter() == 'bp_before_group_header' && ( isset( $this->options['bp_group'] ) || isset( $this->options['vertical_bb_group'] ) ) ) ) ) {
						$inline_script .= 'var heateorRbReactionAjaxUrl = \''. get_admin_url() .'admin-ajax.php\', heateorRbCloseIconPath = \''. plugins_url( '../images/close.png', __FILE__ ) .'\', heateorRbPluginIconPath = \''. plugins_url( '../images/logo.png', __FILE__ ) .'\', heateorRbHorizontalReactionCountEnable = '. ( isset( $this->options['hor_enable'] ) ? 1 : 0 ) .', heateorRbVerticalReactionCountEnable = '. ( isset( $this->options['vertical_enable'] ) ? 1 : 0 ) .', heateorRbReactionOffset = '. ( isset( $this->options['alignment'] ) && $this->options['alignment'] != '' && isset( $this->options[$this->options['alignment'].'_offset'] ) && $this->options[$this->options['alignment'].'_offset'] != '' ? $this->options[$this->options['alignment'].'_offset'] : 0 ) . '; var heateorRbMobileStickyReactionEnabled = ' . ( isset( $this->options['vertical_enable'] ) && isset( $this->options['bottom_mobile_reaction'] ) && $this->options['horizontal_screen_width'] != '' ? 1 : 0 ) . ';';
						$inline_script .= 'var heateorRbCopyLinkMessage = "' . htmlspecialchars( __( 'Link copied.', 'reaction-buttons-by-heateor' ), ENT_QUOTES ) . '";';
						if ( isset( $this->options['horizontal_counter_position'] ) ) {
							$inline_script .= in_array( $this->options['horizontal_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var heateorRbReduceHorizontalSvgWidth = true;' : '';
							$inline_script .= in_array( $this->options['horizontal_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var heateorRbReduceHorizontalSvgHeight = true;' : '';
						}
						
						$inline_script .= isset( $this->options['vertical_counter_position'] ) && in_array( $this->options['vertical_counter_position'], array( 'inner_left', 'inner_right' ) ) ? 'var heateorRbReduceVerticalSvgWidth = true;' : '';
						$inline_script .= ! isset( $this->options['vertical_counter_position'] ) || in_array( $this->options['vertical_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ? 'var heateorRbReduceVerticalSvgHeight = true;' : '';
						$inline_script .= 'var heateorRbUrlCountFetched = [], heateorRbReactionsText = \''. htmlspecialchars(__('Reactions', 'reaction-buttons-by-heateor'), ENT_QUOTES) .'\', heateorRbShareText = \''. htmlspecialchars(__('Share', 'reaction-buttons-by-heateor'), ENT_QUOTES) .'\';';
						$inline_script .= 'function heateorRbTrackEmojiClicks(r,e){jQuery.ajax({type:"GET",url:heateorRbReactionAjaxUrl,data:{action:"heateor_rb_track_emoji_clicks",emoji:e,url:jQuery(r).parents("div.heateor_rb_reaction_container").attr("data-heateor-rb-href")},success:function(r,e,a){console.log(r)}})}';
						wp_add_inline_script( 'jquery', $inline_script, $position = 'before' );
					}
				}
			}
		}
	}

	/**
	 * Check if current page is AMP
	 *
	 * @since    1.0
	 */
	public function is_amp_page() {

		if ( ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) || ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) ) {
			return true;
		}
		return false;

	}

	/**
	 * Sanitize post title
	 *
	 * @since    1.0
	 */
	public function sanitize_post_title( $post_title ) {

		$post_title = html_entity_decode( $post_title, ENT_QUOTES, 'UTF-8' );
	    $post_title = rawurlencode( $post_title );
	    $post_title = str_replace( '#', '%23', $post_title );
	    $post_title = esc_html( $post_title );

	    return $post_title;

	}

	/**
	 * Get Yoast SEO post meta Twitter title
	 *
	 * @since    1.0
	 */
	public function wpseo_twitter_title( $post ) {

		if ( $post && ( $this->is_plugin_active( 'wordpress-seo/wp-seo.php' ) || $this->is_plugin_active( 'wordpress-seo-premium/wp-seo.php' ) ) && ( $wpseo_twitter_title = WPSEO_Meta::get_value( 'twitter-title', $post->ID ) ) ) {
			return $wpseo_twitter_title;
		}
		return '';

	}

	/**
	 * Render reaction interface html
	 *
	 * @since    1.0
	 */
	public function prepare_reaction_html( $post_url, $reaction_type, $display_count, $total_reactions, $standard_widget = false ) {
	
		global $post;

		if ( NULL === $post ) {
	        $post = get_post( $this->reaction_count_transient_id );
		}

		if ( ! is_object( $post ) ) {
	        return '';
		}

		if ( ( $reaction_type == 'vertical' && ! is_singular() ) || $standard_widget ) {
			$post_title = get_bloginfo( 'name' ) . " - " . get_bloginfo( 'description' );
			if ( is_category() ) {
				$post_title = esc_attr( wp_strip_all_tags( stripslashes( single_cat_title( '', false ) ), true ) );
			} elseif ( is_tag() ) {
				$post_title = esc_attr( wp_strip_all_tags( stripslashes( single_tag_title( '', false ) ), true ) );
			} elseif ( is_tax() ) {
				$post_title = esc_attr( wp_strip_all_tags( stripslashes( single_term_title( '', false ) ), true ) );
			} elseif ( is_search() ) {
				$post_title = esc_attr( wp_strip_all_tags( stripslashes( __( 'Search for' ) .' "' .get_search_query() .'"' ), true ) );
			} elseif ( is_author() ) {
				$post_title = esc_attr( wp_strip_all_tags( stripslashes( get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ), true ) );
			} elseif ( is_archive() ) {
				if ( is_day() ) {
					$post_title = esc_attr( wp_strip_all_tags( stripslashes( get_query_var( 'day' ) . ' ' .single_month_title( ' ', false ) . ' ' . __( 'Archives' ) ), true ) );
				} elseif ( is_month() ) {
					$post_title = esc_attr( wp_strip_all_tags( stripslashes( single_month_title( ' ', false ) . ' ' . __( 'Archives' ) ), true ) );
				} elseif ( is_year() ) {
					$post_title = esc_attr( wp_strip_all_tags( stripslashes( get_query_var( 'year' ) . ' ' . __( 'Archives' ) ), true ) );
				}
			}
		} else {
			$post_title = $post->post_title;
		}

		$original_post_title = html_entity_decode( $post_title, ENT_QUOTES, 'UTF-8' );
		$post_title = $this->sanitize_post_title( $post_title );

		$output = apply_filters( 'heateor_rb_reaction_interface_filter', '', $this, $post_title, $original_post_title, $post_url, $reaction_type, $this->options, $post, $display_count, $total_reactions );
		if ( $output != '' ) {
			return $output;
		}
		$html = '';
		$reaction_meta = get_post_meta( $post->ID, '_heateor_rb_meta', true );

		if ( isset( $this->options[$reaction_type.'_re_providers'] ) ) {

			$reaction_networks_object = new Reaction_Buttons_For_Wordpress_Reaction_Networks( $this->options );
			if ( $this->is_amp_page() ) {
				$reaction_networks = $reaction_networks_object->fetch_amp_reaction_networks();
			} else {
				$reaction_networks = $reaction_networks_object->fetch_reaction_networks( $reaction_type );
			}

			$html = $this->is_amp_page() ? '' : '<div class="heateor_rb_reaction_ul">';
			$icon_height = $this->options[$reaction_type . '_reaction_shape'] != 'rectangle' ? $this->options[$reaction_type . '_reaction_size'] : $this->options[$reaction_type . '_reaction_height'];
			$style = 'width:' . ( $this->options[$reaction_type . '_reaction_shape'] != 'rectangle' ? $this->options[$reaction_type . '_reaction_size'] : $this->options[$reaction_type . '_reaction_width'] ) . 'px;height:' . $icon_height . 'px;';
			$counter_container_init_html = '<span class="heateor_rb_square_count';
			$counter_container_end_html = '</span>';
			$inner_style = 'display:block;';
			$li_class = 'heateorRbReactionRound';
			if ( $this->options[$reaction_type . '_reaction_shape'] == 'round' ) {
				$style .= 'border-radius:999px !important;';
				$inner_style .= 'border-radius:999px!important;';
			} elseif ( $this->options[$reaction_type . '_border_radius'] != '' ) {
				$style .= 'border-radius:' . $this->options[$reaction_type . '_border_radius'] . 'px;';
			}
			if ( $reaction_type == 'vertical' && $this->options[$reaction_type . '_reaction_shape'] == 'square' ) {
				$style .= 'margin:0;';
				$li_class = '';
			}
			$li_items = '';
			$like_button_count_container = '';
			if ( $display_count ) {
				$like_button_count_container = $counter_container_init_html . '">&nbsp;' . $counter_container_end_html;
			}

			// reaction count
			if ( $saved_reaction_count = $this->get_saved_reaction_counts( $this->reaction_count_transient_id, $post_url ) ) {
			    $reaction_counts = $saved_reaction_count;
			} elseif ( false !== ( $cached_reaction_count = $this->get_cached_reaction_count( $this->reaction_count_transient_id ) ) ) {
			    $reaction_counts = $cached_reaction_count;
			} else {
				$reaction_counts = '&nbsp;';
			}
			

			$reaction_counts = maybe_unserialize( $reaction_counts );

			$counter_placeholder = '';
			$counter_placeholder_value = '';
			$inner_style_conditional = '';

			if ( $display_count ) {
				if ( ! isset( $this->options[$reaction_type . '_counter_position'] ) ) {
					$counter_position = $reaction_type == 'horizontal' ? 'top' : 'inner_top';
				} else {
					$counter_position = $this->options[$reaction_type . '_counter_position'];
				}
				
				switch ( $counter_position ) {
					case 'left':
						$inner_style_conditional = 'display:block;';
						$counter_placeholder = '><span class="heateor_rb_svg';
						break;
					case 'top':
						$counter_placeholder = '><span class="heateor_rb_svg';
						break;
					case 'right':
						$inner_style_conditional = 'display:block;';
						$counter_placeholder = 'span><';
						break;
					case 'bottom':
						$inner_style_conditional = 'display:block;';
						$counter_placeholder = 'span><';
						break;
					case 'inner_left':
						$inner_style_conditional = 'float:left;';
						$counter_placeholder = '><svg';
						break;
					case 'inner_top':
						$inner_style_conditional = 'margin-top:0;';
						$counter_placeholder = '><svg';
						break;
					case 'inner_right':
						$inner_style_conditional = 'float:left;';
						$counter_placeholder = 'svg><';
						break;
					case 'inner_bottom':
						$inner_style_conditional = 'margin-top:0;';
						$counter_placeholder = 'svg><';
						break;
					default:
				}

				$counter_placeholder_value = str_replace( '>', '>' . $counter_container_init_html . ' heateor_rb_%network%_count">&nbsp;' . $counter_container_end_html, $counter_placeholder );
			}
			
			$total_reaction_count = 0;
			
			$reaction_count = array();
			$to_be_replaced = array();
			$replace_by = array();
			if ( $this->is_amp_page() ) {
				$icon_width = $this->options[$reaction_type . '_reaction_shape'] != 'rectangle' ? $this->options[$reaction_type . '_reaction_size'] : $this->options[$reaction_type . '_reaction_width'];

				$to_be_replaced[] = '%img_url%';
				$to_be_replaced[] = '%width%';
				$to_be_replaced[] = '%height%';

				$replace_by[] = plugins_url( '../images/amp', __FILE__ );
				$replace_by[] = $icon_width;
				$replace_by[] = $icon_height;
			}
			
			$wpseo_post_title = $post_title;
			$decoded_post_title = esc_html( str_replace( array( '%23', '%27', '%22', '%21', '%3A' ), array( '#', "'", '"', '!', ':' ), urlencode( $original_post_title ) ) );
			if ( $wpseo_twitter_title = $this->wpseo_twitter_title( $post ) ) {
				$wpseo_post_title = $this->sanitize_post_title( $wpseo_twitter_title );
				$decoded_post_title = esc_html( str_replace( array( '%23', '%27', '%22', '%21', '%3A' ), array( '#', "'", '"', '!', ':' ), urlencode( html_entity_decode( $wpseo_twitter_title, ENT_QUOTES, 'UTF-8' ) ) ) );
			}
			
			$logo_color = '#000';
			if( $reaction_type == 'horizontal' && $this->options['horizontal_font_color_default'] ) {
				$logo_color = $this->options['horizontal_font_color_default'];
			}elseif ( $reaction_type == 'vertical' && $this->options['vertical_font_color_default'] ) {
				$logo_color = $this->options['vertical_font_color_default'];
			}
			$this->logo_color = $logo_color;

			foreach ( $this->options[$reaction_type.'_re_providers'] as $provider ) {
				$reaction_count[$provider] = $reaction_counts == '&nbsp;' ? '' : ( isset( $reaction_counts[$provider] ) ? $reaction_counts[$provider] : '' );
				$isset_starting_reaction_count = isset( $reaction_meta[$provider . '_' . $reaction_type . '_count'] ) && $reaction_meta[$provider . '_' . $reaction_type . '_count'] != '' ? true : false;
				$total_reaction_count += intval( $reaction_count[$provider] ) + ( $isset_starting_reaction_count ? $reaction_meta[$provider . '_' . $reaction_type . '_count'] : 0) ;
				$reaction_networks[$provider] = str_replace( $to_be_replaced, $replace_by, $reaction_networks[$provider] );
				$li_items .= str_replace(
					array(
						'%padding%',
						'%network%',
						'%like_count_container%',
						'%post_url%',
						'%encoded_post_url%',
						'%post_title%',
						'%wpseo_post_title%',
						'%decoded_post_title%',
						'%style%',
						'%inner_style%',
						'%li_class%',
						$counter_placeholder,
						'%title%',
						'%logo_color%'
					),
					array(
						( $this->options[$reaction_type . '_reaction_shape'] == 'rectangle' ? $this->options[$reaction_type . '_reaction_height'] : $this->options[$reaction_type . '_reaction_size'] ) * 21/100,
						$provider,
						$like_button_count_container,
						$post_url,
						urlencode( $post_url ),
						$post_title,
						$wpseo_post_title,
						$decoded_post_title,
						$style,
						$inner_style . ( $reaction_count[$provider] || ( $isset_starting_reaction_count && $reaction_counts != '&nbsp;' ) ? $inner_style_conditional : '' ),
						$li_class,
						str_replace( '%network%', $provider, $isset_starting_reaction_count ? str_replace( '>&nbsp;', ' sss_st_count="' . $reaction_meta[$provider . '_' . $reaction_type . '_count'] . '"' . ( $reaction_counts == '&nbsp;' ? '>&nbsp;' : ' style="visibility:visible;' . ( $inner_style_conditional ? 'display:block;' : '' ) . '">' . $this->round_off_counts( intval( $reaction_count[$provider] ) + $reaction_meta[$provider . '_' . $reaction_type . '_count'] ) ) , $counter_placeholder_value ) : str_replace( '>&nbsp;', $reaction_count[$provider] ? ' style="visibility:visible;' . ( $inner_style_conditional ? 'display:block;' : '' ) . '">' . $this->round_off_counts( intval( $reaction_count[$provider] ) ) : ' style="display:none">&nbsp;', $counter_placeholder_value ) ),
						ucfirst( str_replace( '_', ' ', $provider ) ),
						$logo_color
					),
					$reaction_networks[$provider]
				);
			}
	
			$total_reactions_html = '';
			if ( $total_reactions && ! $this->is_amp_page() ) {
				$total_reactions_html = '<a style="background-color:transparent;font-size:24px!important;box-shadow:none;display:inline-block;vertical-align:middle;">';
				// if ( $display_count) {
				// 	$total_reactions_html .= $counter_container_init_html . '">&nbsp;' . $counter_container_end_html;
				// }
				if ( $reaction_type == 'horizontal' ) {
					$add_style = ';margin-left:9px !important;';
				} else {
					$add_style = ';margin-bottom:9px !important;';
				}
				$add_style .= ( $total_reaction_count && $reaction_counts != '&nbsp;' ? 'visibility:visible;' : '' ) . '"';
				$style = str_replace( ';"', $add_style, $style );
				$total_reactions_html .= '<div style="' . $style . '" title="' . __( 'Total Reactions', 'reaction-buttons-by-heateor' ) . '" class="heateorRbReaction heateorRbTCBackground">' . ( $total_reaction_count ? '<div class="heateorRbTotalShareCount" style="font-size: ' . ( $icon_height * 62/100 ) . 'px">' . $this->round_off_counts( intval( $total_reaction_count ) ) . '</div><div class="heateorRbTotalShareText" style="font-size: ' . ( $icon_height * 38/100 ) . 'px">' . ( $total_reaction_count < 2 ? __( 'Share', 'reaction-buttons-by-heateor' ) : __( 'Reactions', 'reaction-buttons-by-heateor' ) ) . '</div>' : '' ) . '</div></a>';
			}

			if ( $reaction_type == 'vertical' ) {
				$html .= $total_reactions_html . $li_items;
			} else {
				$html .= $li_items . $total_reactions_html;
			}
			$html .= $this->is_amp_page() ? '' : '</div>';
			$html .= '<div class="heateorRbClear"></div>';
		}
		return $html;
	}

	/**
	 * Roud off reaction counts
	 *
	 * @since    1.0
	 * @param    integer    $reactionCount    Share counts
	 */
	public function round_off_counts( $reaction_count ) {

		if ( $reaction_count > 999 && $reaction_count < 10000 ) {
			$reaction_count = round( $reaction_count/1000, 1 ) . 'K';
		} elseif ( $reaction_count > 9999 && $reaction_count < 100000 ) {
			$reaction_count = round( $reaction_count/1000, 1 ) . 'K';
		} else if ( $reaction_count > 99999 && $reaction_count < 1000000 ) {
			$reaction_count = round( $reaction_count/1000, 1 ) . 'K';
		} else if ( $reaction_count > 999999 ) {
			$reaction_count = round( $reaction_count/1000000, 1 ) . 'M';
		}

		return $reaction_count;
	
	}

	/**
	 * Get cached reaction counts for given post ID
	 *
	 * @since    1.0
	 * @param    integer    $post_id    ID of the post to fetch cached reaction counts for
	 */
	public function get_cached_reaction_count( $post_id ) {

		$reaction_count_transient = get_transient( 'heateor_rb_reaction_count_' . $post_id );
		do_action( 'heateor_rb_reaction_count_transient_hook', $reaction_count_transient, $post_id );
		return $reaction_count_transient;
	
	}

	/**
	 * Get saved reaction counts for given post ID
	 *
	 * @since    1.0
	 */
	public function get_saved_reaction_counts( $post_id, $post_url ) {
		
		$reaction_counts = false;

		if ( $post_id == 'custom' ) {
			$reaction_counts = maybe_unserialize( get_option( 'heateor_rb_custom_url_reactions' ) );
		} elseif ( $post_url == home_url() ) {
			$reaction_counts = maybe_unserialize( get_option( 'heateor_rb_homepage_reactions' ) );
		} elseif ( $post_id > 0 ) {
			$reaction_counts = get_post_meta( $post_id, '_heateor_rb_reactions_meta', true );
		}
		
		return $reaction_counts;
	
	}

	/**
	 * Get http/https protocol at the website
	 *
	 * @since    1.0
	 */
	public function get_http_protocol() {
		
		if ( isset( $_SERVER['HTTPS'] ) && ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
			return "https://";
		} else {
			return "http://";
		}
	
	}

	/**
	 * Apply reaction url filter to customize reaction target url
	 *
	 * @since    1.0
	 */
	public function apply_target_reaction_url_filter( $post_url, $reaction_type, $standard_widget = false ) {
		
		$post_url = apply_filters( 'heateor_rb_target_reaction_url_filter', $post_url, $reaction_type, $standard_widget );

		return $post_url;

	}

	/**
	 * Enable reaction interface at selected areas
	 *
	 * @since    1.0
	 */
	public function render_reaction( $content ) {
		
		// if reaction is disabled on AMP, return content as is
		if ( ! isset( $this->options['amp_enable'] ) && $this->is_amp_page() ) {
			return $content;
		}

		global $post;

		if ( ! is_object( $post ) ) {
			return $content;
		}

		// hook to bypass reaction
		$disable_reaction = apply_filters( 'heateor_rb_disable_reaction', $post, $content );
		// if $disable_reaction value is 1, return content without reaction interface
		if ( $disable_reaction === 1 ) {
			return $content;
		}
		$reaction_meta = get_post_meta( $post->ID, '_heateor_rb_meta', true );
		
		$reaction_bp_activity = false;

		if ( current_filter() == 'bp_activity_entry_meta' ) {
			if ( isset( $this->options['bp_activity'] ) ) {
				$reaction_bp_activity = true;
			}
		}
		
		$post_types = get_post_types( array( 'public' => true ), 'names', 'and' );
		$post_types = array_diff( $post_types, array( 'post', 'page' ) );

		// reaction interface
		if ( isset( $this->options['hor_enable'] ) && ! ( isset( $reaction_meta['reaction'] ) && $reaction_meta['reaction'] == 1 && ( ! is_front_page() || ( is_front_page() && 'page' == get_option( 'show_on_front' ) ) ) ) ) {
			$post_id = $post->ID;
			// default post url
			$post_url = get_permalink( $post->ID );
			$reaction_count_url = $post_url;
			if ( $reaction_bp_activity ) {
				$post_url = bp_get_activity_thread_permalink();
				$reaction_count_url = $post_url;
				$post_id = 0;
			} else {
				if ( ( isset( $_SERVER['QUERY_STRING'] ) && $_SERVER['QUERY_STRING'] ) || $post_url == '' ) {
					$post_url = sanitize_url( $this->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ;
				}
				if ( $reaction_count_url == '' ) {
					$reaction_count_url = $post_url;
				}
			}

			$custom_post_url = $this->apply_target_reaction_url_filter( $post_url, 'horizontal', false );
			if ( $custom_post_url != $post_url ) {
				$post_url = $custom_post_url;
				$reaction_count_url = $post_url;
			}

			// reaction count transient ID
			$this->reaction_count_transient_id = $this->get_reaction_count_transient_id( $post_url );
			$reaction_div = $this->prepare_reaction_html( $post_url, 'horizontal', true, true );
			$reaction_container_style = '';
			$reaction_title_style = 'style="font-weight:bold"';
			
			if ( $this->options['hor_reaction_alignment'] == 'right' ) {
				$reaction_container_style = 'style="float: right"';
			}
			
			$horizontal_div = "<div class='heateorRbClear'></div><div ". $reaction_container_style ." class='heateor_rb_reaction_container heateor_rb_horizontal_reaction' " . ( $this->is_amp_page() ? "" : "data-heateor-rb-href='" . ( isset( $reaction_count_url ) && $reaction_count_url ? $reaction_count_url : $post_url ) . "'" ) . ( ( $this->get_cached_reaction_count( $this->reaction_count_transient_id ) === false || $this->is_amp_page() ) ? '' : ' data-heateor-rb-no-counts="1"' ) . "><div class='heateor_rb_reaction_title' " . $reaction_title_style . " >" . ucfirst( get_option( 'heateor_rb' )['title'] ) . "</div>" . $reaction_div . "</div><div class='heateorRbClear'></div>";
			if ( $reaction_bp_activity ) {
				global $heateor_rb_allowed_tags;
				echo wp_kses( $horizontal_div, $heateor_rb_allowed_tags );
			}
			// show horizontal reaction
			if ( ( isset( $this->options['home'] ) && is_front_page() ) || ( isset( $this->options['category'] ) && is_category() ) || ( isset( $this->options['archive'] ) && is_archive() ) || ( isset( $this->options['post'] ) && is_single() && isset( $post->post_type ) && $post->post_type == 'post' ) || ( isset( $this->options['page'] ) && is_page() && isset( $post->post_type ) && $post->post_type == 'page' ) || ( isset( $this->options['excerpt'] ) && (is_home() || current_filter() == 'the_excerpt' ) ) || ( isset( $this->options['bb_reply'] ) && current_filter() == 'bbp_get_reply_content' ) || ( isset( $this->options['bb_forum'] ) && ( isset( $this->options['top'] ) && current_filter() == 'bbp_template_before_single_forum' || isset( $this->options['bottom'] ) && current_filter() == 'bbp_template_after_single_forum' ) ) || ( isset( $this->options['bb_topic'] ) && ( isset( $this->options['top'] ) && in_array( current_filter(), array( 'bbp_template_before_single_topic', 'bbp_template_before_lead_topic' ) ) || isset( $this->options['bottom'] ) && in_array( current_filter(), array( 'bbp_template_after_single_topic', 'bbp_template_after_lead_topic' ) ) ) ) || ( isset( $this->options['woocom_shop'] ) && current_filter() == 'woocommerce_after_shop_loop_item' ) || ( isset( $this->options['woocom_product'] ) && current_filter() == 'woocommerce_reaction' ) || ( isset( $this->options['woocom_thankyou'] ) && current_filter() == 'woocommerce_thankyou' ) || (current_filter() == 'bp_before_group_header' && isset( $this->options['bp_group'] ) ) ) {
				if ( in_array( current_filter(), array( 'bbp_template_before_single_topic', 'bbp_template_before_lead_topic', 'bbp_template_before_single_forum', 'bbp_template_after_single_topic', 'bbp_template_after_lead_topic', 'bbp_template_after_single_forum', 'woocommerce_after_shop_loop_item', 'woocommerce_reaction', 'woocommerce_thankyou', 'bp_before_group_header' ) ) ) {
					global $heateor_rb_allowed_tags;
					echo wp_kses( '<div class="heateorRbClear"></div>' . $horizontal_div . '<div class="heateorRbClear"></div>', $heateor_rb_allowed_tags );
				} else {
					if ( isset( $this->options['top'] ) && isset( $this->options['bottom'] ) ) {
						$content = $horizontal_div . '<br/>' . $content . '<br/>' . $horizontal_div;
					} else {
						if ( isset( $this->options['top'] ) ) {
							$content = $horizontal_div.$content;
						} elseif ( isset( $this->options['bottom'] ) ) {
							$content = $content.$horizontal_div;
						}
					}
				}
			} elseif ( count( $post_types ) ) {
				foreach ( $post_types as $post_type ) {
					if ( isset( $this->options[$post_type] ) && ( is_single() || is_page() ) && isset( $post->post_type ) && $post->post_type == $post_type ) {
						if ( isset( $this->options['top'] ) && isset( $this->options['bottom'] ) ) {
							$content = $horizontal_div . '<br/>' . $content.'<br/>'.$horizontal_div;
						} else {
							if ( isset( $this->options['top'] ) ) {
								$content = $horizontal_div.$content;
							} elseif ( isset( $this->options['bottom'] ) ) {
								$content = $content.$horizontal_div;
							}
						}
					}
				}
			}
		}
		if ( isset( $this->options['vertical_enable'] ) && ! ( isset( $reaction_meta['vertical_reaction'] ) && $reaction_meta['vertical_reaction'] == 1 && ( ! is_front_page() || ( is_front_page() && 'page' == get_option( 'show_on_front' ) ) ) ) ) {
			$post_id = $post->ID;
			$post_url = get_permalink( $post->ID );
			$reaction_count_url = $post_url;
			
			$post_url = get_permalink( $post->ID );
			if ( ! is_singular() ) {
				$post_url = sanitize_url( $this->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ;
				$post_id = 0;
				$reaction_count_url = $post_url;
			} elseif ( ( isset( $_SERVER['QUERY_STRING'] ) && $_SERVER['QUERY_STRING'] ) || $post_url == '' ) {
				$post_url = sanitize_url( $this->get_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ;
			}
			if ( $reaction_count_url == '' ) {
				$reaction_count_url = $post_url;
			}
			
			$custom_post_url = $this->apply_target_reaction_url_filter( $post_url, 'vertical', false );
			if ( $custom_post_url != $post_url ) {
				$post_url = $custom_post_url;
				$reaction_count_url = $post_url;
			}

			$vertical_reaction_width = ( $this->options['vertical_reaction_shape'] == 'rectangle' ? $this->options['vertical_reaction_width'] : $this->options['vertical_reaction_size'] );
			if ( isset( $this->options['vertical_counter_position'] ) && in_array( $this->options['vertical_counter_position'], array( 'left', 'right' ) ) ) {
				$vertical_reaction_width += $vertical_reaction_width*60/100;
			}
			// reaction count transient ID
			$this->reaction_count_transient_id = $this->get_reaction_count_transient_id( $post_url );
			$reaction_div = $this->prepare_reaction_html( $post_url, 'vertical', true, true );
			$offset = ( $this->options['alignment'] != '' && $this->options[$this->options['alignment'].'_offset'] != '' ? $this->options['alignment'] . ': ' . $this->options[$this->options['alignment'].'_offset'] . 'px;' : '' ) . ( $this->options['top_offset'] != '' ? 'top: '.$this->options['top_offset'] . 'px;' : '' );
			$vertical_div = "<div class='heateor_rb_reaction_container heateor_rb_vertical_reaction" . ( isset( $this->options['bottom_mobile_reaction'] ) ? ' heateor_rb_bottom_reaction' : '' ) . "' style='width:" . ( $vertical_reaction_width + 4 ) . "px;" . $offset . ( $this->options['vertical_bg'] != '' ? 'background-color: '.$this->options['vertical_bg'] : '-webkit-box-shadow:none;box-shadow:none;' ) . "' " . ( $this->is_amp_page() ? "" : "data-heateor-rb-href='" . ( isset( $reaction_count_url ) && $reaction_count_url ? $reaction_count_url : $post_url ) . "'" ) . ( ( $this->get_cached_reaction_count( $this->reaction_count_transient_id ) === false || $this->is_amp_page() ) ? "" : ' data-heateor-rb-no-counts="1"' ) . ">" . $reaction_div . "</div>";
			// show vertical reaction
			if ( ( isset( $this->options['vertical_home'] ) && is_front_page() ) || ( isset( $this->options['vertical_category'] ) && is_category() ) || ( isset( $this->options['vertical_archive'] ) && is_archive() ) || ( isset( $this->options['vertical_post'] ) && is_single() && isset( $post->post_type ) && $post->post_type == 'post' ) || ( isset( $this->options['vertical_page'] ) && is_page() && isset( $post->post_type ) && $post->post_type == 'page' ) || ( isset( $this->options['vertical_excerpt'] ) && (is_home() || current_filter() == 'the_excerpt' ) ) || ( isset( $this->options['vertical_bb_forum'] ) && current_filter() == 'bbp_template_before_single_forum' ) || ( isset( $this->options['vertical_bb_topic'] ) && in_array( current_filter(), array( 'bbp_template_before_single_topic', 'bbp_template_before_lead_topic' ) ) ) || (current_filter() == 'bp_before_group_header' && isset( $this->options['vertical_bp_group'] ) ) ) {
				if ( in_array( current_filter(), array( 'bbp_template_before_single_topic', 'bbp_template_before_lead_topic', 'bbp_template_before_single_forum', 'bp_before_group_header' ) ) ) {
					global $heateor_rb_allowed_tags;
					echo wp_kses( $vertical_div, $heateor_rb_allowed_tags );
				} else {
					if ( is_front_page() ) {
						if ( current_filter() == 'the_content' ) {
							$var = $this->vertical_home_count;
						} elseif ( is_home() || current_filter() == 'the_excerpt' ) {
							$var = $this->vertical_excerpt_count;
						}
						if ( $var == 0 ) {
							$post_url = home_url();
							$reaction_count_url = $post_url;
							$custom_post_url = $this->apply_target_reaction_url_filter( $post_url, 'vertical', false );
							if ( $custom_post_url != $post_url ) {
								$post_url = $custom_post_url;
								$reaction_count_url = $post_url;
							}
							// reaction count transient ID
							$this->reaction_count_transient_id = 0;
							$reaction_div = $this->prepare_reaction_html( $post_url, 'vertical', true, true );
							$vertical_div = "<div class='heateor_rb_reaction_container heateor_rb_vertical_reaction" . ( isset( $this->options['bottom_mobile_reaction'] ) ? ' heateor_rb_bottom_reaction' : '' ) . "' style='width:" . ( $vertical_reaction_width + 4 ) . "px;" . $offset . ( $this->options['vertical_bg'] != '' ? 'background-color: ' . $this->options['vertical_bg'] : '-webkit-box-shadow:none;box-shadow:none;' ) . "' " . ( $this->is_amp_page() ? "" : " data-heateor-rb-href='" . ( isset( $reaction_count_url ) && $reaction_count_url ? $reaction_count_url : $post_url ) . "'" ) . ( ( $this->get_cached_reaction_count( 0 ) === false || $this->is_amp_page() ) ? "" : 'data-heateor-rb-no-counts="1"' ) . ">" . $reaction_div . "</div>";
							
							$content = $content . $vertical_div;
							if ( current_filter() == 'the_content' ) {
								$this->vertical_home_count++;
							} elseif ( is_home() || current_filter() == 'the_excerpt' ) {
								$this->vertical_excerpt_count++;
							}
						}
					} else {
						$content = $content . $vertical_div;
					}
				}
			} elseif ( count( $post_types ) ) {
				foreach ( $post_types as $post_type ) {
					if ( isset( $this->options['vertical_' . $post_type] ) && ( is_single() || is_page() ) && isset( $post->post_type ) && $post->post_type == $post_type ) {
						$content = $content . $vertical_div;
					}
				}
			}
		}
		return $content;
	}

	/**
	 * Return ajax response
	 *
	 * @since    1.0
	 */
	private function ajax_response( $response ) {
		
		$response = apply_filters( 'heateor_rb_ajax_response_filter', $response );
		header( 'Content-Type: application/json' );
		die( json_encode( $response ) );

	}

	/**
	 * Save reaction counts in post-meta
	 *
	 * @since    1.0
	 */
	public function update_reaction_counts( $target_url, $emoji ) {
		
		$post_id = $this->get_reaction_count_transient_id( $target_url );

		if ( $post_id == 'custom' ) {

			$meta_name = 'heateor_rb_custom_url_reactions';
			$emoji_counts = get_option( $meta_name );
			$emoji_counts = maybe_unserialize( $emoji_counts );
			if ( ! is_array( $emoji_counts )) {
				$emoji_counts = array();
			}
			if ( ! isset( $emoji_counts[$emoji] ) ) {
				$emoji_counts[$emoji] = 0;
			}
			$emoji_counts[$emoji] = intval( $emoji_counts[$emoji] ) + 1;
			update_option( $meta_name, maybe_serialize( $emoji_counts ) );
		} elseif ( $target_url == home_url() ) {
			$meta_name = 'heateor_rb_homepage_reactions';
			$emoji_counts = get_option( $meta_name );
			$emoji_counts = maybe_unserialize( $emoji_counts );
			if ( ! is_array( $emoji_counts )) {
				$emoji_counts = array();
			}
			if ( ! isset( $emoji_counts[$emoji] ) ) {
				$emoji_counts[$emoji] = 0;
			}
			$emoji_counts[$emoji] = intval( $emoji_counts[$emoji] ) + 1;
			update_option( $meta_name, maybe_serialize( $emoji_counts ) );
		} elseif ( $post_id > 0 ) {
			$emoji_counts = get_post_meta( $post_id, '_heateor_rb_reactions_meta', true );
			$emoji_counts = maybe_unserialize( $emoji_counts );
			if ( ! is_array( $emoji_counts ) ) {
				$emoji_counts = array();
			}
			if ( ! isset( $emoji_counts[$emoji] ) ) {
				$emoji_counts[$emoji] = 0;
			}
			$emoji_counts[$emoji] = intval( $emoji_counts[$emoji] ) + 1;
			update_post_meta( $post_id, '_heateor_rb_reactions_meta', maybe_serialize( $emoji_counts ) );
		}

		

	}

	/**
	 * Get ID of the reaction count transient
	 *
	 * @since    1.0
	 */
	public function get_reaction_count_transient_id( $target_url ) {

		return url_to_postid( $target_url );

	}

	/**
	 * Check if plugin is active
	 *
	 * @since    1.0
	 */
	private function is_plugin_active( $plugin_file ) {
		return in_array( $plugin_file, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	}

	/**
	 * Inline style to load at front end.
	 *
	 * @since    1.0
	 */
	public function frontend_inline_style() {
		
		if ( current_filter() == 'wp_enqueue_scripts' ) {
			$important = '';
			?><style type="text/css"><?php
		} else {
			$important = '!important';
		}
		if ( isset( $this->options['plain_instagram_bg'] ) ) {
			?>
			.heateorRbInstagramBackground{background-color:#527fa4}
			<?php
		} else {
			?>
			.heateorRbInstagramBackground{background:radial-gradient(circle at 30% 107%,#fdf497 0,#fdf497 5%,#fd5949 45%,#d6249f 60%,#285aeb 90%)}
			<?php
		}
		if ( $this->options['horizontal_bg_color_default'] != '' ) { ?>
			div.heateor_rb_horizontal_reaction i.heateorRbInstagramBackground{background:<?php echo esc_html( $this->options['horizontal_bg_color_default'] ) ?>!important;}div.heateor_rb_standard_follow_icons_container i.heateorRbInstagramBackground{background:<?php echo esc_html( $this->options['horizontal_bg_color_default'] ) ?>;}
		<?php } ?>
		<?php if ( $this->options['horizontal_bg_color_hover'] != '' ) { ?>
			div.heateor_rb_horizontal_reaction i.heateorRbInstagramBackground:hover{background:<?php echo esc_html( $this->options['horizontal_bg_color_hover'] ) ?>!important;}div.heateor_rb_standard_follow_icons_container i.heateorRbInstagramBackground:hover{background:<?php echo esc_html( $this->options['horizontal_bg_color_hover'] ) ?>;}
		<?php } ?>
		<?php if ( $this->options['vertical_bg_color_default'] != '' ) { ?>
			div.heateor_rb_vertical_reaction  i.heateorRbInstagramBackground{background:<?php echo esc_html( $this->options['vertical_bg_color_default'] ) ?>!important;}div.heateor_rb_floating_follow_icons_container i.heateorRbInstagramBackground{background:<?php echo esc_html( $this->options['vertical_bg_color_default'] ) ?>;}
		<?php } ?>
		<?php if ( $this->options['vertical_bg_color_hover'] != '' ) { ?>
			div.heateor_rb_vertical_reaction i.heateorRbInstagramBackground:hover{background:<?php echo esc_html( $this->options['vertical_bg_color_hover'] ) ?>!important;}div.heateor_rb_floating_follow_icons_container i.heateorRbInstagramBackground:hover{background:<?php echo esc_html( $this->options['vertical_bg_color_hover'] ) ?>;}
		<?php } ?>
		.heateor_rb_horizontal_reaction .heateor_rb_svg,.heateor_rb_standard_follow_icons_container .heateor_rb_svg{
			<?php if ( $this->options['horizontal_bg_color_default'] != '' ) { ?>
				background-color: <?php echo esc_html( $this->options['horizontal_bg_color_default'] ) ?> !important;
			<?php  } ?>
				color: <?php echo $this->options['horizontal_font_color_default'] ? esc_html( $this->options['horizontal_font_color_default'] ) : '#000' ?>;
			<?php
			$border_width = 0;
			if ( $this->options['horizontal_border_width_default'] != '' ) {
				$border_width = $this->options['horizontal_border_width_default'];
			} elseif ( $this->options['horizontal_border_width_hover'] != '' ) {
				$border_width = $this->options['horizontal_border_width_hover'];
			}
			?>
			border-width: <?php echo esc_html( $border_width ) . 'px !important ' ?>;
			border-style: solid !important;
			border-color: <?php echo $this->options['horizontal_border_color_default'] != '' ? esc_html( $this->options['horizontal_border_color_default'] ) . '!important' : 'transparent !important;' ?>;
		}
		<?php if ( $this->options['horizontal_font_color_default'] == '' ) { ?>
		.heateor_rb_horizontal_reaction .heateorRbTCBackground{
			color:#666;
		}
		<?php }
		if ( $this->options['horizontal_font_color_hover'] != '' ) { ?>
			div.heateor_rb_horizontal_reaction span.heateor_rb_svg svg:hover path:not(.heateor_rb_no_fill),div.heateor_rb_horizontal_reaction span.heateor_rb_svg svg:hover ellipse, div.heateor_rb_horizontal_reaction span.heateor_rb_svg svg:hover circle, div.heateor_rb_horizontal_reaction span.heateor_rb_svg svg:hover polygon{
		        fill:<?php echo esc_html( $this->options['horizontal_font_color_hover'] ) ?>;
		    }
		    div.heateor_rb_horizontal_reaction span.heateor_rb_svg svg:hover path.heateor_rb_svg_stroke{
		    	stroke:<?php echo esc_html( $this->options['horizontal_font_color_hover'] ) ?>;
		    }
		<?php } ?>
		.heateor_rb_horizontal_reaction .heateor_rb_svg:hover,.heateor_rb_standard_follow_icons_container .heateor_rb_svg:hover{
			<?php if ( $this->options['horizontal_bg_color_hover'] != '' ) { ?>
				background-color: <?php echo esc_html( $this->options['horizontal_bg_color_hover'] ) ?>;
			<?php } ?>
			border-color: <?php echo $this->options['horizontal_border_color_hover'] != '' ? esc_html( $this->options['horizontal_border_color_hover'] ) . '!important' : 'transparent !important;' ?>;
		}
		.heateor_rb_vertical_reaction .heateor_rb_svg,.heateor_rb_floating_follow_icons_container .heateor_rb_svg{
			<?php if ( $this->options['vertical_bg_color_default'] != '' ) { ?>
				background-color: <?php echo esc_html( $this->options['vertical_bg_color_default'] ) ?>;
			<?php } ?>
				color: <?php echo $this->options['vertical_font_color_default'] ? esc_html( $this->options['vertical_font_color_default'] ) : '#000' ?>;
			<?php
			$verticalBorderWidth = 0;
			if ( $this->options['vertical_border_width_default'] != '' ) {
				$verticalBorderWidth = $this->options['vertical_border_width_default'];
			} elseif ( $this->options['vertical_border_width_hover'] != '' ) {
				$verticalBorderWidth = $this->options['vertical_border_width_hover'];
			}
			?>
			border-width: <?php echo esc_html( $verticalBorderWidth ) .'px !important' ?>;
			border-style: solid !important;
			border-color: <?php echo $this->options['vertical_border_color_default'] != '' ? esc_html( $this->options['vertical_border_color_default'] ) . '!important' : 'transparent! $important' ?>;
		}
		<?php if ( $this->options['horizontal_font_color_default'] == '' ) { ?>
		.heateor_rb_vertical_reaction .heateorRbTCBackground{
			color:#666;
		}
		<?php } ?>
		<?php if ( $this->options['vertical_font_color_hover'] != '' ) { ?>
		    div.heateor_rb_vertical_reaction span.heateor_rb_svg svg:hover path:not(.heateor_rb_no_fill),div.heateor_rb_vertical_reaction span.heateor_rb_svg svg:hover ellipse, div.heateor_rb_vertical_reaction span.heateor_rb_svg svg:hover circle, div.heateor_rb_vertical_reaction span.heateor_rb_svg svg:hover polygon{
		        fill:<?php echo esc_html( $this->options['vertical_font_color_hover'] ) ?>;
		    }
		    div.heateor_rb_vertical_reaction span.heateor_rb_svg svg:hover path.heateor_rb_svg_stroke{
		    	stroke:<?php echo esc_html( $this->options['vertical_font_color_hover'] ) ?>;
		    }
		<?php } ?>
		.heateor_rb_vertical_reaction .heateor_rb_svg:hover,.heateor_rb_floating_follow_icons_container .heateor_rb_svg:hover{
			<?php if ( $this->options['vertical_bg_color_hover'] != '' ) { ?>
				background-color: <?php echo esc_html( $this->options['vertical_bg_color_hover'] ) ?>;
			<?php }
			if ( $this->options['vertical_font_color_hover'] != '' ) { ?>
				color: <?php echo esc_html( $this->options['vertical_font_color_hover'] ) ?>;
			<?php  } ?>
			border-color: <?php echo $this->options['vertical_border_color_hover'] != '' ? esc_html( $this->options['vertical_border_color_hover'] ) . '!important' : 'transparent !important;' ?>;
		}
		<?php
		$svg_height = $this->options['horizontal_reaction_shape'] == 'rectangle' ? $this->options['horizontal_reaction_height'] : $this->options['horizontal_reaction_size'];
		if ( isset( $this->options['horizontal_counter_position'] ) && in_array( $this->options['horizontal_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ) {
			$line_height_percent = $this->options['horizontal_counter_position'] == 'inner_top' ? 38 : 19;
			?>
			div.heateor_rb_horizontal_reaction svg{height:70%;margin-top:<?php echo esc_html( $svg_height )*15/100 ?>px}div.heateor_rb_horizontal_reaction .heateor_rb_square_count{line-height:<?php echo esc_html( $svg_height*$line_height_percent )/100 ?>px;}
			<?php
		} elseif ( isset( $this->options['horizontal_counter_position'] ) && in_array( $this->options['horizontal_counter_position'], array( 'inner_left', 'inner_right' ) ) ) { ?>
			div.heateor_rb_horizontal_reaction svg{width:50%;margin:auto;}div.heateor_rb_horizontal_reaction .heateor_rb_square_count{float:left;width:50%;line-height:<?php echo esc_html( $svg_height ); ?>px;}
			<?php
		} elseif ( isset( $this->options['horizontal_counter_position'] ) && in_array( $this->options['horizontal_counter_position'], array( 'left', 'right' ) ) ) { ?>
			div.heateor_rb_horizontal_reaction .heateor_rb_square_count{float:<?php echo esc_html( $this->options['horizontal_counter_position'] ) ?>;margin:0 8px;line-height:<?php echo esc_html( $svg_height ) ?>px;}
			<?php
		} elseif ( ! isset( $this->options['horizontal_counter_position'] ) || $this->options['horizontal_counter_position'] == 'top' ) { ?>
			div.heateor_rb_horizontal_reaction .heateor_rb_square_count{display: block}
			<?php
		}

		$vertical_svg_height = $this->options['vertical_reaction_shape'] == 'rectangle' ? $this->options['vertical_reaction_height'] : $this->options['vertical_reaction_size'];
		$vertical_svg_width = $this->options['vertical_reaction_shape'] == 'rectangle' ? $this->options['vertical_reaction_width'] : $this->options['vertical_reaction_size'];
		if ( ( isset( $this->options['vertical_counter_position'] ) && in_array( $this->options['vertical_counter_position'], array( 'inner_top', 'inner_bottom' ) ) ) || ! isset( $this->options['vertical_counter_position'] ) ) {
			$vertical_line_height_percent = ! isset( $this->options['vertical_counter_position'] ) || $this->options['vertical_counter_position'] == 'inner_top' ? 38 : 19;
			?>
			div.heateor_rb_vertical_reaction svg{height:70%;margin-top:<?php echo esc_html( $vertical_svg_height )*15/100 ?>px}div.heateor_rb_vertical_reaction .heateor_rb_square_count{line-height:<?php echo esc_html( $vertical_svg_height*$vertical_line_height_percent )/100; ?>px;}
			<?php
		} elseif ( isset( $this->options['vertical_counter_position'] ) && in_array( $this->options['vertical_counter_position'], array( 'inner_left', 'inner_right' ) ) ) { ?>
			div.heateor_rb_vertical_reaction svg{width:50%;margin:auto;}div.heateor_rb_vertical_reaction .heateor_rb_square_count{float:left;width:50%;line-height:<?php echo esc_html( $vertical_svg_height ); ?>px;}
			<?php
		}  elseif ( isset( $this->options['vertical_counter_position'] ) && in_array( $this->options['vertical_counter_position'], array( 'left', 'right' ) ) ) { ?>
			div.heateor_rb_vertical_reaction .heateor_rb_square_count{float:<?php echo esc_html( $this->options['vertical_counter_position'] ) ?>;margin:0 8px;line-height:<?php echo esc_html( $vertical_svg_height ); ?>px; <?php echo $this->options['vertical_counter_position'] == 'left' ? 'min-width:' . esc_html( $vertical_svg_width )*30/100 . 'px;display: block' : '';?>}
			<?php
		} elseif ( isset( $this->options['vertical_counter_position'] ) && $this->options['vertical_counter_position'] == 'top' ) { ?>
			div.heateor_rb_vertical_reaction .heateor_rb_square_count{display: block}
			<?php
		}
		echo isset( $this->options['hide_mobile_reaction'] ) && $this->options['vertical_screen_width'] != '' ? '@media screen and (max-width:' . esc_html( $this->options['vertical_screen_width'] ) . 'px) {.heateor_rb_vertical_reaction{display:none!important}}' : '';
		
		echo isset( $this->options['hide_mobile_reaction'] ) && $this->options['vertical_screen_width'] != '' ? '@media screen and (max-width:' . esc_html( $this->options['vertical_screen_width'] ) . 'px) {.heateor_rb_floating_follow_icons_container{display:none!important}}' : '';
		
		$bottom_reaction_postion_inverse = $this->options['bottom_reaction_alignment'] == 'left' ? 'right' : 'left';
		$bottom_reaction_responsive_css = '';
		if ( isset( $this->options['vertical_enable'] ) && $this->options['bottom_reaction_position_radio'] == 'responsive' ) {
			$vertical_reaction_icon_height = $this->options['vertical_reaction_shape'] == 'rectangle' ? $this->options['vertical_reaction_height'] : $this->options['vertical_reaction_size'];
			$num_reaction_icons = isset($this->options['vertical_re_providers']) ? count($this->options['vertical_re_providers']) : 0;
			$total_reaction_count_enabled = isset($this->options['vertical_total_reactions']) ? 1 : 0;
			$bottom_reaction_responsive_css = 'div.heateor_rb_bottom_reaction{width:100%!important;left:0!important;}div.heateor_rb_bottom_reaction li{width:'.(100/($num_reaction_icons+$total_reaction_count_enabled)).'% !important;}div.heateor_rb_bottom_reaction .heateorRbReaction{width: 100% !important;}div.heateor_rb_bottom_reaction div.heateorRbTotalShareCount{font-size:1em!important;line-height:' . ( $vertical_reaction_icon_height*70/100 ) . 'px!important}div.heateor_rb_bottom_reaction div.heateorRbTotalShareText{font-size:.7em!important;line-height:0px!important}';
		}
		echo isset( $this->options['vertical_enable'] ) && isset( $this->options['bottom_mobile_reaction'] ) && $this->options['horizontal_screen_width'] != '' ? 'div.heateor_rb_mobile_footer{display:none;}@media screen and (max-width:' . esc_html( $this->options['horizontal_screen_width'] ) . 'px){div.heateor_rb_bottom_reaction ul.heateor_rb_reaction_ul i.heateorRbTCBackground{background-color:white}' . esc_html( $bottom_reaction_responsive_css ) . 'div.heateor_rb_mobile_footer{display:block;height:' . esc_html( $this->options['vertical_reaction_shape'] == 'rectangle' ? $this->options['vertical_reaction_height'] : $this->options['vertical_reaction_size'] ) . 'px;}.heateor_rb_bottom_reaction{padding:0!important;' . esc_html( $this->options['bottom_reaction_position_radio'] == 'nonresponsive' && $this->options['bottom_reaction_position'] != '' ? $this->options['bottom_reaction_alignment'] . ':' . $this->options['bottom_reaction_position'] . 'px!important;' . $bottom_reaction_postion_inverse . ':auto!important;' : '' ) . 'display:block!important;width: auto!important;bottom:' . ( isset( $this->options['vertical_total_reactions'] ) ? '-10' : '-2' ) . 'px!important;top: auto!important;}.heateor_rb_bottom_reaction .heateor_rb_square_count{line-height: inherit;}.heateor_rb_bottom_reaction .heateorRbReactionArrow{display:none;}.heateor_rb_bottom_reaction .heateorRbTCBackground{margin-right: 1.1em !important}}' : '';
		echo esc_html( $this->options['custom_css'] );
		echo isset( $this->options['hide_slider'] ) ? 'div.heateorRbReactionArrow{display:none}' : '';
		if ( isset( $this->options['hor_enable'] ) && $this->options['hor_reaction_alignment'] == "center" ) {
			echo 'div.heateor_rb_reaction_title{text-align:center}div.heateor_rb_reaction_ul{width:100%;text-align:center;}div.heateor_rb_horizontal_reaction div.heateor_rb_reaction_ul a{float:none!important;display:inline-block;}';
		}
		if ( current_filter() == 'wp_enqueue_scripts' ) {
			?></style><?php
		}
	}

	/**
	 * Stylesheets to load at front end.
	 *
	 * @since    1.0
	 */
	public function frontend_css() {
		
		wp_enqueue_style( 'heateor_rb_frontend_css', plugins_url( 'css/reaction-buttons-for-wordpress-public.css', __FILE__ ), false, $this->version );
	
	}

	/**
	 * Stylesheets to load at front end for AMP.
	 *
	 * @since    1.0
	 */
	public function frontend_amp_css() {
		
		if ( ! $this->is_amp_page() ) {
			return;
		}

		$css = '';

		if ( current_action() == 'wp_print_styles' ) {
			$css .= '<style type="text/css">';
		}
		// background color of amp icons
		$css .= 'a.heateor_rb_amp{padding:0 4px;text-decoration:none;}a.heateor_rb_amp:hover{text-decoration:none;}div.heateor_rb_horizontal_reaction a amp-img{display:inline-block;}.heateor_rb_amp img{background-color:#ffff0d}';

		// css for horizontal reaction bar
		if ( $this->options['horizontal_reaction_shape'] == 'round' ) {
			$css .= '.heateor_rb_amp amp-img{border-radius:999px;}';
		} elseif ( $this->options['horizontal_border_radius'] != '' ) {
			$css .= '.heateor_rb_amp amp-img{border-radius:' . esc_html( $this->options['horizontal_border_radius'] ) . 'px;}';
		}

		if ( current_action() == 'wp_print_styles' ) {
			$css .= '</style>';
		}

		echo $css;
	
	}

	/**
	 * Append myCRED referral ID to reaction and like button urls
	 *
	 * @since    1.0
	 */
	public function append_mycred_referral_id( $post_url, $reaction_type, $standard_widget ) {
		
		$mycred_referral_id = do_shortcode( '[mycred_affiliate_id]' );
		if ( $mycred_referral_id ) {
			$connector = strpos( urldecode( $post_url ), '?' ) === false ? '?' : '&';
			$post_url .= $connector . 'mref=' . $mycred_referral_id;
		}

		return $post_url;

	}

	/**
	 * 
	 *
	 * @since    1.0
	 */
	function track_emoji_clicks() {

		if ( isset( $_GET['emoji'] ) && isset( $_GET['url'] ) ) {
			$this->update_reaction_counts( $_GET['url'], $_GET['emoji'] );
		}
		die;

	}

}