<?php

/**
 * Contains functions responsible for functionality at admin side
 *
 * @since      1.0
 *
 */

/**
 * This class defines all code necessary for functionality at admin side
 *
 * @since      1.0
 *
 */
class Reaction_Buttons_For_Wordpress_Admin {

	/**
	 * Options saved in database
	 *
	 * @since    1.0
	 */
	private $options;

	/**
	 * Current version of the plugin
	 *
	 * @since    1.0
	 */
	private $version;

	/**
	 * Flag to check if BuddyPress is active
	 *
	 * @since    1.0
	 */
	private $is_bp_active = false;

	/**
	 * Get saved options
	 *
	 * @since    1.0
     * @param    array    $options    Plugin options saved in database
	 */
	public function __construct( $options, $version ) {

		$this->options = $options;
		$this->version = $version;

	}

	/**
	 * Creates plugin menu in admin area
	 *
	 * @since    1.0
	 */
	public function create_admin_menu() {

		$page = add_menu_page( __( 'Reaction Buttons by Heateor', 'reaction-buttons-by-heateor' ), 'Reaction Buttons', 'manage_options', 'heateor-rb-options', array( $this, 'options_page' ), plugins_url( '../images/logo.png', __FILE__ ) );
		
		add_action( 'admin_print_scripts-' . $page, array( $this, 'admin_scripts' ) );
		add_action( 'admin_print_scripts-' . $page, array( $this, 'admin_style' ) );
		add_action( 'admin_print_scripts-' . $page, array( $this, 'fb_sdk_script' ) );
	
	}

	/**
	 * Register plugin settings and its sanitization callback.
	 *
	 * @since    1.0
	 */
	public function options_init() {

		register_setting( 'heateor_rb_options', 'heateor_rb', array( $this, 'validate_options' ) );
		
		if ( current_user_can( 'manage_options' ) ) {
			// show option to disable reaction on particular page/post
			$post_types = get_post_types( array( 'public' => true ), 'names', 'and' );
			$post_types = array_unique( array_merge( $post_types, array( 'post', 'page' ) ) );
			foreach ( $post_types as $type ) {
				add_meta_box( 'heateor_rb_meta', 'Reaction Buttons For Wordpress', array( $this, 'reaction_meta_setup' ), $type );
			}
			// save reaction meta on post/page save
			add_action( 'save_post', array( $this, 'save_reaction_meta' ) );
		}

	}
	
	/**
	 * Update options in all the old blogs
	 *
	 * @since    1.0
	 */
	public function update_old_blogs( $old_config ) {
		
		$option_parts = explode( '_', current_filter() );
		$option = $option_parts[2] . '_' . $option_parts[3] . '_' . $option_parts[4];
		$new_config = get_option( $option );
		if ( isset( $new_config['config_multisite'] ) && $new_config['config_multisite'] == 1 ) {
			$blogs = get_blog_list( 0, 'all' );
			foreach ( $blogs as $blog ) {
				update_blog_option( $blog['blog_id'], $option, $new_config );
			}
		}
	
	}

	/**
	 * Replicate the options to the new blog created.
	 *
	 * @since    1.0
	 */
	public function replicate_settings( $blog_id ) {

		add_blog_option( $blog_id, 'heateor_rb', $this->options );
	
	}
	
	/**
	 * Show reaction meta options
	 *
	 * @since    1.0
	 */
	public function reaction_meta_setup() {

		global $post;
		$postType = $post->post_type;
		$reaction_meta = get_post_meta( $post->ID, '_heateor_rb_meta', true );
		?>
		<p>
			<label for="heateor_rb_reaction">
				<input type="checkbox" name="_heateor_rb_meta[reaction]" id="heateor_rb_reaction" value="1" <?php echo is_array( $reaction_meta ) && isset( $reaction_meta['reaction'] ) && $reaction_meta['reaction'] == '1' ? 'checked' : ''; ?> />
				<?php _e( 'Disable Standard Reaction interface on this ' . $postType, 'reaction-buttons-by-heateor' ) ?>
			</label>
			<br/>
			<label for="heateor_rb_vertical_reaction">
				<input type="checkbox" name="_heateor_rb_meta[vertical_reaction]" id="heateor_rb_vertical_reaction" value="1" <?php echo is_array( $reaction_meta ) && isset( $reaction_meta['vertical_reaction'] ) && $reaction_meta['vertical_reaction'] == '1' ? 'checked' : ''; ?> />
				<?php _e( 'Disable Floating Reaction interface on this ' . $postType, 'reaction-buttons-by-heateor' ) ?>
			</label>
			<?php
			$valid_networks = array( 'facebook', 'twitter', 'linkedin', 'buffer', 'reddit', 'pinterest', 'vkontakte', 'Odnoklassniki', 'Fintel' );
			if ( isset( $this->options['hor_enable'] ) && isset( $this->options['horizontal_re_providers'] ) && count( $this->options['horizontal_re_providers'] ) > 0 ) {
				?>
				<p>
				<strong style="font-weight: bold"><?php _e( 'Standard reaction', 'reaction-buttons-by-heateor' ) ?></strong>
				<?php
				foreach ( array_intersect( $this->options['horizontal_re_providers'], $valid_networks ) as $network ) {
					?>
					<br/>
					<label for="heateor_rb_<?php echo esc_attr( $network ) ?>_horizontal_reaction_count">
						<span style="width: 242px; float:left"><?php _e( 'Starting reaction count for ' . ucfirst( str_replace ( '_', ' ', $network ) ), 'reaction-buttons-by-heateor' ) ?></span>
						<input type="text" name="_heateor_rb_meta[<?php echo esc_attr( $network ) ?>_horizontal_count]" id="heateor_rb_<?php echo esc_attr( $network ) ?>_horizontal_reaction_count" value="<?php echo is_array( $reaction_meta ) && isset( $reaction_meta[$network . '_horizontal_count'] ) ? esc_attr( $reaction_meta[$network . '_horizontal_count'] ) : '' ?>" />
					</label>
					<?php
				}
				?>
				</p>
				<?php
			}
			
			if ( isset( $this->options['vertical_enable'] ) && isset( $this->options['vertical_counts'] ) && isset( $this->options['vertical_re_providers'] ) && count( $this->options['vertical_re_providers'] ) > 0 ) {
				?>
				<p>
				<strong style="font-weight: bold"><?php _e( 'Floating reaction', 'reaction-buttons-by-heateor' ) ?></strong>
				<?php
				foreach ( array_intersect( $this->options['vertical_re_providers'], $valid_networks ) as $network ) {
					?>
					<br/>
					<label for="heateor_rb_<?php echo esc_attr( $network ) ?>_vertical_reaction_count">
						<span style="width: 242px; float:left"><?php _e( 'Starting reaction count for ' . ucfirst( str_replace ( '_', ' ', $network ) ), 'reaction-buttons-by-heateor' ) ?></span>
						<input type="text" name="_heateor_rb_meta[<?php echo esc_attr( $network ) ?>_vertical_count]" id="heateor_rb_<?php echo esc_attr( $network ) ?>_vertical_reaction_count" value="<?php echo is_array( $reaction_meta ) && isset( $reaction_meta[$network . '_vertical_count'] ) ? esc_attr( $reaction_meta[$network . '_vertical_count'] ) : '' ?>" />
					</label>
					<?php
				}
				?>
				</p>
				<?php
			}
			?>
		</p>
		<?php
	    echo '<input type="hidden" name="heateor_rb_meta_nonce" value="' . esc_attr( wp_create_nonce( __FILE__ ) ) . '" />';
	
	}

	/**
	 * Save reaction meta fields.
	 *
	 * @since    1.0
	 */
	public function save_reaction_meta( $post_id ) {
	    
	    // make sure data came from our meta box
	    if ( ! isset( $_POST['heateor_rb_meta_nonce'] ) || ! wp_verify_nonce( $_POST['heateor_rb_meta_nonce'], __FILE__ ) ) {
			return $post_id;
	 	}
	    // check user permissions
	    if ( $_POST['post_type'] == 'page' ) {
	        if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
	    	}
		} else {
	        if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
	    	}
		}
	    if ( isset( $_POST['_heateor_rb_meta'] ) ) {
			$new_data = array_map( 'intval', $_POST['_heateor_rb_meta'] );
		} else {
			$new_data = array( 'reaction' => 0, 'vertical_reaction' => 0 );
		}
		update_post_meta( $post_id, '_heateor_rb_meta', $new_data );
	    return $post_id;

	}

	/** 
	 * Sanitization callback for plugin options.
	 *
	 * IMPROVEMENT: complexity can be reduced (this function is called on each option page validation and "if ( $k == 'providers' ) {"
	 * condition is being checked every time)
     * @since    1.0
	 */ 
	public function validate_options( $heateorRbOptions ) {
		
		foreach ( $heateorRbOptions as $k => $v ) {
			if ( is_string( $v ) ) {
				$heateorRbOptions[$k] = esc_attr( trim( $v ) );
			}
		}
		return $heateorRbOptions;

	}

	/**
	 * Include Javascript at plugin options page in admin area
	 *
	 * @since    1.0
	 */	
	public function admin_options_scripts() {

		wp_enqueue_script( 'heateor_rb_admin_options_script', plugins_url( 'js/reaction-buttons-for-wordpress-options.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ), $this->version );
	
	}

	/**
	 * Include Javascript SDK in admin.
	 *
	 * @since    1.0
	 */	
	public function fb_sdk_script() {

		wp_enqueue_script( 'heateor_rb_fb_sdk_script', plugins_url( 'js/reaction-buttons-for-wordpress-fb-sdk.js', __FILE__ ), false, $this->version );
	
	}

	/**
	 * Include CSS files in admin.
	 *
	 * @since    1.0
	 */	
	public function admin_style() {

		wp_enqueue_style( 'heateor_rb_admin_style', plugins_url( 'css/reaction-buttons-for-wordpress-admin.css', __FILE__ ), false, $this->version );
		wp_enqueue_style( 'heateor_rb_admin_svg', plugins_url( 'css/reaction-buttons-for-wordpress-svg.css', __FILE__ ), false, $this->version );
	
	}

	/**
	 * Update CSS file
	 *
	 * @since    1.0
	 */
	private function update_css( $replace_color_option, $logo_color_option, $css_file ) {
		
		if ( $this->options[$replace_color_option] != $this->options[$logo_color_option] ) {
			$path = plugin_dir_url( __FILE__ ) . 'css/' . $css_file . '.css';
			try {
				$content = file( $path );
				if ( $content !== false ) {
					$handle = fopen( dirname( __FILE__ ) . '/css/' . $css_file . '.css','w' );
					if ( $handle !== false ) {
						foreach ( $content as $value ) {
						    fwrite( $handle, str_replace( str_replace( '#', '%23', $this->options[$replace_color_option] ), str_replace( '#', '%23', $this->options[$logo_color_option] ), $value ) );
						}
						fclose( $handle );
						$this->options[$replace_color_option] = $this->options[$logo_color_option];
						update_option( 'heateor_rb', $this->options );
						return true;
					}
				}
			} catch ( Exception $e ) {  }
		}
		return false;

	}

	/**
	 * Include javascript files in admin.
	 *
	 * @since    1.0
	 */	
	public function admin_scripts() {
		
		?>
		<script type="text/javascript">var heateorRbWebsiteUrl = '<?php echo esc_js( home_url() ) ?>', heateorRbHelpBubbleTitle = "<?php echo __( 'Click to toggle help', 'reaction-buttons-by-heateor' ) ?>", heateorRbReactionAjaxUrl = '<?php echo esc_attr( get_admin_url() ) ?>admin-ajax.php';</script>
		<?php
		wp_enqueue_script( 'heateor_rb_admin_script', plugins_url( 'js/reaction-buttons-for-wordpress-admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-tabs' ), $this->version );
		wp_enqueue_script( 'heateor_rb_admin_options_script', plugins_url( 'js/reaction-buttons-for-wordpress-options.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ), $this->version );
	
	}

	/**
	 * Renders options page
	 *
	 * @since    1.0
	 */
	public function options_page() {

		// message on saving options
		echo $this->settings_saved_notification();
		$options = $this->options;
		/**
		 * The file rendering options page
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/reaction-buttons-for-wordpress-options-page.php';
	
	}

	/**
	 * Display notification message when plugin options are saved
	 *
	 * @since    1.0
     * @return   string    Notification after saving options
	 */
	private function settings_saved_notification() {

		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ) {
			return '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible below-h2"> 
	<p><strong>' . __( 'Settings saved', 'reaction-buttons-by-heateor' ) . '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice', 'reaction-buttons-by-heateor' ) . '</span></button></div>';
		}
	
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
	 * Set BuddyPress active flag to true
	 *
	 * @since    1.0
	 */
	public function is_bp_loaded() {
		
		$this->is_bp_active = true;
	
	}

	/**
	 * Show notices in admin area
	 *
	 * @since    2.4
	 */
	public function show_notices() {
		
		if ( current_user_can( 'manage_options' ) ) {
			if( get_transient( 'heateor-rb-admin-notice-on-activation' ) ) { ?>
		        <div class="reaction-buttons-for-wordpress-message notice notice-success is-dismissible">
		            <p><strong><?php printf( __( 'Thanks for installing Reaction Buttons For Wordpress plugin', 'reaction-buttons-by-heateor' ), 'http://support.heateor.com/configure-reaction-buttons-for-wordpress' ); ?></strong></p>
		            <p>
						<a href="http://support.heateor.com/configure-reaction-buttons-for-wordpress" target="_blank" class="button button-primary"><?php _e( 'Configure the Plugin', 'reaction-buttons-by-heateor' ); ?></a>
					</p>
		        </div> <?php
		        /* Delete transient, only display this notice once. */
		        delete_transient( 'heateor-rb-admin-notice-on-activation' );
		    }

			if ( defined( 'HEATEOR_SOCIAL_SHARE_MYCRED_INTEGRATION_VERSION' ) && version_compare( '1.3.3', HEATEOR_SOCIAL_SHARE_MYCRED_INTEGRATION_VERSION ) > 0 ) {
				?>
				<div class="error notice">
					<h3>Social Share - myCRED Integration</h3>
					<p><?php _e( 'Update "Social Share myCRED Integration" add-on for maximum compatibility with current version of Reaction Buttons For Wordpress', 'reaction-buttons-by-heateor' ) ?></p>
				</div>
				<?php
			}
		}

	}

	/**
	 * Show links at "Plugins" page in admin area
	 *
	 * @since    1.0
	 */
	public function add_links( $links ) {
	    
	    if ( is_array( $links ) ) {
		    $addons_link = '<a href="https://www.heateor.com/add-ons" target="_blank">' . __( 'Add-Ons', 'reaction-buttons-by-heateor' ) . '</a>';
		    $support_link = '<br/><a href="http://support.heateor.com" target="_blank">' . __( 'Support Documentation', 'reaction-buttons-by-heateor' ) . '</a>';
		    $settings_link = '<a href="admin.php?page=heateor-rb-options">' . __( 'Settings', 'reaction-buttons-by-heateor' ) . '</a>';
		    
		    // place it before other links
			array_unshift( $links, $settings_link );
			
			$links[] = $addons_link;
			$links[] = $support_link;
		}
		
		return $links;

	}

	/**
	 * Update options based on plugin version
	 *
	 * @since    1.0
	 */
	public function update_db_check() {

		$current_version = get_option( 'heateor_rb_version' );
		if ( $current_version != $this->version ) {
			// update plugin version in database
			update_option( 'heateor_rb_version', $this->version );
		}
	
	}

}
