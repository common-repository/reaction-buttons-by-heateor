<?php
/**
 * Options page
 *
 * @since    1.0
 */
defined( 'ABSPATH' ) or die( "Cheating........Uh!!" );
?>

<div id="fb-root"></div>

<div class="metabox-holder columns-2" id="post-body">
	<h1>Reaction Buttons For Wordpress</h1>
		<div>
			<?php
			echo sprintf( __( 'You can appreciate the effort put in this free plugin by rating it <a href="%s" target="_blank">here</a>', 'reaction-buttons-by-heateor' ), 'https://wordpress.org/support/view/plugin-reviews/reaction-buttons-for-wordpress' );
			?>
		</div>
		<div class="menu_div" id="tabs">
			<form id="heateor_rb_form" action="options.php" method="post">
			<?php settings_fields( 'heateor_rb_options' ); ?>
			<h2 class="nav-tab-wrapper" style="height:34px">
			<ul>
				<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-1"><?php _e( 'Theme Selection', 'reaction-buttons-by-heateor' ) ?></a></li>
				<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-2"><?php _e( 'Standard Interface', 'reaction-buttons-by-heateor' ) ?></a></li>
				<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-3"><?php _e( 'Floating Interface', 'reaction-buttons-by-heateor' ) ?></a></li>
				<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-4"><?php _e( 'Miscellaneous', 'reaction-buttons-by-heateor' ) ?></a></li>
				<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-6"><?php _e( 'Shortcode & Widget', 'reaction-buttons-by-heateor' ) ?></a></li>
				<li style="margin-left:9px"><a style="margin:0; height:23px" class="nav-tab" href="#tabs-8"><?php _e( 'FAQ', 'reaction-buttons-by-heateor' ) ?></a></li>
			</ul>
			</h2>
			
			<div class="menu_containt_div" id="tabs-1">
				<div class="clear"></div>
				<div class="heateor_rb_left_column">
					<div class="stuffbox">
						<h3><label><?php _e( 'Standard interface theme', 'reaction-buttons-by-heateor' );?></label></h3>
						<div class="inside">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
								<tr>
									<th>
										<label style="float:left"><?php _e( "Icon Preview", 'reaction-buttons-by-heateor' ); ?></label>
									</th>
									<td>
										<?php
										$horizontal_bg = isset( $options['horizontal_bg_color_default'] ) ? $options['horizontal_bg_color_default'] : '';
										$border_width = isset( $options['horizontal_border_width_default'] ) ? $options['horizontal_border_width_default'] : '';
										$border_color = isset( $options['horizontal_border_color_default'] ) ? $options['horizontal_border_color_default'] : '';
										$reaction_color = isset( $options['horizontal_font_color_default'] ) ? $options['horizontal_font_color_default'] : '';
										$reaction_color_hover = isset( $options['horizontal_font_color_hover'] ) ? $options['horizontal_font_color_hover'] : '';
										$reaction_shape = isset( $options['horizontal_reaction_shape'] ) ? $options['horizontal_reaction_shape'] : 'round'; 
										$reaction_size = isset( $options['horizontal_reaction_size'] ) ? $options['horizontal_reaction_size'] : 32;
										$reaction_width = isset( $options['horizontal_reaction_width'] ) ? $options['horizontal_reaction_width'] : 32;
										$reaction_height = isset( $options['horizontal_reaction_height'] ) ? $options['horizontal_reaction_height'] : 32;
										$reaction_border_radius = isset( $options['horizontal_border_radius'] ) ? $options['horizontal_border_radius'] : '';
										$horizontal_bg_hover = isset( $options['horizontal_bg_color_hover'] ) ? $options['horizontal_bg_color_hover'] : '';
										$counter_position = isset( $options['horizontal_counter_position'] ) ? $options['horizontal_counter_position'] : '';
										$line_height = $reaction_shape == 'rectangle' ? $reaction_height : $reaction_size;
										?>
										<style type="text/css">
										<?php
										if ( isset( $options['plain_instagram_bg'] ) ) {
											?>
											.heateorRbInstagramBackground{background-color:#527fa4}
											<?php
										} else {
											?>
											.heateorRbInstagramBackground{background:radial-gradient(circle at 30% 107%,#fdf497 0,#fdf497 5%,#fd5949 45%,#d6249f 60%,#285aeb 90%)}
											<?php
										}
										?>
										#heateor_rb_preview{
											color:<?php echo $reaction_color ? esc_html( $reaction_color ) : "#000" ?>;
										}
										#heateor_rb_preview:hover{
											color:<?php echo esc_html( $reaction_color_hover ) ?>;
										}
										</style>
										<div>
											<div class="heateorRbCounterPreviewTop" style="width:<?php echo 60 + esc_attr( isset( $options['horizontal_reaction_shape'] ) && $options['horizontal_reaction_shape'] == 'rectangle' ? $options['horizontal_reaction_width'] : $options['horizontal_reaction_size'] ) ?>px">44</div>
											<div class="heateorRbCounterPreviewLeft">44</div>
											<div id="heateor_rb_preview" style="cursor:pointer;float:left">
												<div class="heateorRbCounterPreviewInnertop">44</div>
												<div class="heateorRbCounterPreviewInnerleft">44</div>
												<div id="horizontal_svg" style="float:left;width:100%;height:100%;background:url('data:image/svg+xml;charset=utf8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20enable-background%3D%22new%200%200%2064%2064%22%3E%3Cg%20fill%3D%22<?php echo $reaction_color ? esc_html( str_replace( '#', '%23', $reaction_color ) ) : "%23000" ?>%22%3E%3Ccircle%20cx%3D%2220.5%22%20cy%3D%2226.6%22%20r%3D%225%22%3E%3C%2Fcircle%3E%3Ccircle%20cx%3D%2243.5%22%20cy%3D%2226.6%22%20r%3D%225%22%3E%3C%2Fcircle%3E%3Cpath%20d%3D%22m44.6%2040.3c-8.1%205.7-17.1%205.6-25.2%200-1-.7-1.8.5-1.2%201.6%202.5%204%207.4%207.7%2013.8%207.7s11.3-3.6%2013.8-7.7c.6-1.1-.2-2.3-1.2-1.6%22%3E%3C%2Fpath%3E%3C%2Fg%3E%0A%20%20%3C%2Fsvg%3E') no-repeat center center; margin: auto"></div>
												<div class="heateorRbCounterPreviewInnerright">44</div>
												<div class="heateorRbCounterPreviewInnerbottom">44</div>
											</div>
											<div class="heateorRbCounterPreviewRight">44</div>
											<div class="heateorRbCounterPreviewBottom" style="width:<?php echo 60 + esc_attr( isset( $options['horizontal_reaction_shape'] ) && $options['horizontal_reaction_shape'] == 'rectangle' ? $options['horizontal_reaction_width'] : $options['horizontal_reaction_size'] ) ?>px">44</div>
										</div>
										
										<script type="text/javascript">
										var tempHorShape = '<?php echo esc_js( $reaction_shape ) ?>', tempHorSize = '<?php echo esc_js( $reaction_size ) ?>', tempHorHeight = '<?php echo esc_js( $reaction_height ) ?>', tempHorWidth = '<?php echo esc_js( $reaction_width ) ?>', heateorRbReactionBgHover = '<?php echo esc_js( $horizontal_bg_hover ) ?>', heateorRbReactionBg = '<?php echo $horizontal_bg ? esc_js( $horizontal_bg ) : "#3C589A" ?>', heateorRbBorderWidth = '<?php echo esc_js( $border_width ) ?>', heateorRbBorderColor = '<?php echo esc_js( $border_color ) ?>', heateorRbReactionBorderRadius = '<?php echo $reaction_border_radius ? esc_js( $reaction_border_radius ) . "px" : "0px" ?>';

										heateorRbReactionHorizontalPreview();

										jQuery( '#heateor_rb_preview' ).hover(function() {
											if (heateorRbReactionBgHover && heateorRbReactionBgHover != '#3C589A' ) {
												jQuery(this).css( 'backgroundColor', heateorRbReactionBgHover);
											}
											if (jQuery( '#heateor_rb_font_color_hover' ).val().trim() ) {
												jQuery(this).find( '#horizontal_svg' ).attr( 'style', jQuery(this).find( '#horizontal_svg' ).attr( 'style' ).replace(heateorRbReactionTempColor.replace( '#', '%23' ), jQuery( '#heateor_rb_font_color_hover' ).val().trim().replace( '#', '%23' ) ));
												jQuery(this).css( 'color', jQuery( '#heateor_rb_font_color_hover' ).val().trim() );
											}
											jQuery(this).css( 'borderStyle', 'solid' );
											jQuery(this).css( 'borderWidth', heateorRbBorderWidthHover ? heateorRbBorderWidthHover : heateorRbBorderWidth ? heateorRbBorderWidth : '0' );
											jQuery(this).css( 'borderColor', heateorRbBorderColorHover ? heateorRbBorderColorHover : 'transparent' );
										},function() {
											jQuery(this).css( 'backgroundColor', heateorRbReactionBg);
											if (jQuery( '#heateor_rb_font_color_hover' ).val().trim() ) {
												jQuery(this).find( '#horizontal_svg' ).attr( 'style', jQuery(this).find( '#horizontal_svg' ).attr( 'style' ).replace(jQuery( '#heateor_rb_font_color_hover' ).val().trim().replace( '#', '%23' ), heateorRbReactionTempColor.replace( '#', '%23' ) ));
												jQuery(this).css( 'color', heateorRbReactionTempColor);
											}
											jQuery(this).css( 'borderStyle', 'solid' );
											jQuery(this).css( 'borderWidth', heateorRbBorderWidth ? heateorRbBorderWidth : heateorRbBorderWidthHover ? heateorRbBorderWidthHover : '0' );
											jQuery(this).css( 'borderColor', heateorRbBorderColor ? heateorRbBorderColor : 'transparent' );
										});
										</script>
									</td>
								</tr>

								<tr>
									<td colspan="2">
									<div id="heateor_rb_preview_message" style="color:green;display:none;margin-top:36px"><?php _e( 'Do not forget to save the configuration after making changes by clicking the save button below', 'reaction-buttons-by-heateor' ); ?></div>
									</td>
								</tr>

								<tr>
									<th>
										<label><?php _e( "Shape", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_icon_shape_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<input id="heateor_rb_icon_round" onclick="tempHorShape = 'round';heateorRbReactionHorizontalPreview()" name="heateor_rb[horizontal_reaction_shape]" type="radio" <?php echo $reaction_shape == 'round' ? 'checked = "checked"' : ''; ?> value="round" />
										<label style="margin-right:10px" for="heateor_rb_icon_round"><?php _e( "Round", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_icon_square" onclick="tempHorShape = 'square';heateorRbReactionHorizontalPreview()" name="heateor_rb[horizontal_reaction_shape]" type="radio" <?php echo $reaction_shape == 'square' ? 'checked = "checked"' : '';?> value="square" />
										<label style="margin-right:10px" for="heateor_rb_icon_square"><?php _e( "Square", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_icon_rectangle" onclick="tempHorShape = 'rectangle';heateorRbReactionHorizontalPreview()" name="heateor_rb[horizontal_reaction_shape]" type="radio" <?php echo $reaction_shape == 'rectangle' ? 'checked = "checked"' : '';?> value="rectangle" />
										<label for="heateor_rb_icon_rectangle"><?php _e( "Rectangle", 'reaction-buttons-by-heateor' ); ?></label>
									</td>
								</tr>

								

								<tbody id="heateor_rb_size_options" <?php echo ! isset( $options['horizontal_reaction_shape'] ) || $options['horizontal_reaction_shape'] != 'rectangle' ? '' : 'style="display: none"'; ?>>	
									<tr>
										<th>
											<label><?php _e( "Size (in pixels)", 'reaction-buttons-by-heateor' ); ?></label>
											<img id="heateor_rb_icon_size_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
										</th>
										<td>
											<input style="width:50px" id="heateor_rb_icon_size" name="heateor_rb[horizontal_reaction_size]" type="text" value="<?php echo esc_attr( $reaction_size ); ?>" />
											<input id="heateor_rb_size_plus" type="button" value="+" onmouseup="tempHorSize = document.getElementById( 'heateor_rb_icon_size' ).value;heateorRbReactionHorizontalPreview()" />
											<input id="heateor_rb_size_minus" type="button" value="-" onmouseup="tempHorSize = document.getElementById( 'heateor_rb_icon_size' ).value;heateorRbReactionHorizontalPreview()" />
											<script type="text/javascript">
												heateorRbIncrement(document.getElementById( 'heateor_rb_size_plus' ), "add", document.getElementById( 'heateor_rb_icon_size' ), 300, 0.7);
												heateorRbIncrement(document.getElementById( 'heateor_rb_size_minus' ), "subtract", document.getElementById( 'heateor_rb_icon_size' ), 300, 0.7);
											</script>
										</td>
									</tr>

									<tr class="heateor_rb_help_content" id="heateor_rb_icon_size_help_cont">
										<td colspan="2">
										<div>
										<?php _e( 'Size of the reaction icons', 'reaction-buttons-by-heateor' ) ?>
										</div>
										</td>
									</tr>
								</tbody>

								<tbody id="heateor_rb_rectangle_options" <?php echo isset( $options['horizontal_reaction_shape'] ) && $options['horizontal_reaction_shape'] == 'rectangle' ? '' : 'style="display: none"'; ?>>
									<tr>
										<th>
											<label><?php _e( "Width (in pixels)", 'reaction-buttons-by-heateor' ); ?></label>
											<img id="heateor_rb_icon_width_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
										</th>
										<td>
											<input style="width:50px" id="heateor_rb_icon_width" name="heateor_rb[horizontal_reaction_width]" type="text" value="<?php echo esc_attr( $reaction_width ); ?>" />
											<input id="heateor_rb_width_plus" type="button" value="+" onmouseup="tempHorWidth = document.getElementById( 'heateor_rb_icon_width' ).value;heateorRbReactionHorizontalPreview()" />
											<input id="heateor_rb_width_minus" type="button" value="-" onmouseup="tempHorWidth = document.getElementById( 'heateor_rb_icon_width' ).value;heateorRbReactionHorizontalPreview()" />
											<script type="text/javascript">
												heateorRbIncrement(document.getElementById( 'heateor_rb_width_plus' ), "add", document.getElementById( 'heateor_rb_icon_width' ), 300, 0.7);
												heateorRbIncrement(document.getElementById( 'heateor_rb_width_minus' ), "subtract", document.getElementById( 'heateor_rb_icon_width' ), 300, 0.7);
											</script>
										</td>
									</tr>

									<tr class="heateor_rb_help_content" id="heateor_rb_icon_width_help_cont">
										<td colspan="2">
										<div>
										<?php _e( 'Width of the reaction icons', 'reaction-buttons-by-heateor' ) ?>
										</div>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e( "Height (in pixels)", 'reaction-buttons-by-heateor' ); ?></label>
											<img id="heateor_rb_icon_height_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
										</th>
										<td>
											<input style="width:50px" id="heateor_rb_icon_height" name="heateor_rb[horizontal_reaction_height]" type="text" value="<?php echo esc_attr( $reaction_height ); ?>" />
											<input id="heateor_rb_height_plus" type="button" value="+" onmouseup="tempHorHeight = document.getElementById( 'heateor_rb_icon_height' ).value;heateorRbReactionHorizontalPreview()" />
											<input id="heateor_rb_height_minus" type="button" value="-" onmouseup="tempHorHeight = document.getElementById( 'heateor_rb_icon_height' ).value;heateorRbReactionHorizontalPreview()" />
											<script type="text/javascript">
												heateorRbIncrement(document.getElementById( 'heateor_rb_height_plus' ), "add", document.getElementById( 'heateor_rb_icon_height' ), 300, 0.7);
												heateorRbIncrement(document.getElementById( 'heateor_rb_height_minus' ), "subtract", document.getElementById( 'heateor_rb_icon_height' ), 300, 0.7);
											</script>
										</td>
									</tr>

									<tr class="heateor_rb_help_content" id="heateor_rb_icon_height_help_cont">
										<td colspan="2">
										<div>
										<?php _e( 'Height of the reaction icons', 'reaction-buttons-by-heateor' ) ?>
										</div>
										</td>
									</tr>
								</tbody>

								<tbody id="heateor_rb_border_radius_options" <?php echo isset( $options['horizontal_reaction_shape'] ) && $options['horizontal_reaction_shape'] != 'round' ? '' : 'style="display: none"'; ?>>
									<tr>
										<th>
											<label><?php _e( "Border radius (in pixels)", 'reaction-buttons-by-heateor' ); ?></label>
											<img id="heateor_rb_icon_border_radius_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
										</th>
										<td>
											<input style="width:50px" id="heateor_rb_icon_border_radius" name="heateor_rb[horizontal_border_radius]" type="text" value="<?php echo esc_attr( $reaction_border_radius ); ?>" onkeyup="heateorRbReactionBorderRadius = this.value.trim() ? this.value.trim() + 'px' : '0px';heateorRbUpdateReactionPreview(heateorRbReactionBorderRadius, 'borderRadius', '0px', 'heateor_rb_preview' )" />
										</td>
									</tr>

									<tr class="heateor_rb_help_content" id="heateor_rb_icon_border_radius_help_cont">
										<td colspan="2">
										<div>
										<?php _e( 'Specify a value for rounded corners. More the value, more rounded will the corners be. Leave empty for sharp corners.', 'reaction-buttons-by-heateor' ) ?>
										</div>
										</td>
									</tr>
								</tbody>

								<tr>
									<th>
										<label><?php _e( "Logo Color", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_font_color_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<script type="text/javascript">var heateorRbReactionTempColor = '<?php echo $reaction_color ? esc_js( $reaction_color ) : "#000" ?>';</script>
										<label for="heateor_rb_font_color_default"><?php _e( "Default", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_font_color_default" onkeyup="if (this.value.trim() == '' || this.value.trim().length >= 3) { jQuery( '#horizontal_svg' ).attr( 'style', jQuery( '#horizontal_svg' ).attr( 'style' ).replace(heateorRbReactionTempColor.replace( '#', '%23' ), this.value.trim() ? this.value.trim().replace( '#', '%23' ) : '%23fff' ) ); heateorRbReactionTempColor = this.value.trim() ? this.value.trim() : '#000';jQuery( '#heateor_rb_preview' ).css( 'color', heateorRbReactionTempColor.replace( '%23','#' ) ) }" name="heateor_rb[horizontal_font_color_default]" type="text" value="<?php echo esc_attr( $reaction_color ); ?>" />
										<label style="margin-left:10px" for="heateor_rb_font_color_hover"><?php _e( "On Hover", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_font_color_hover" name="heateor_rb[horizontal_font_color_hover]" type="text" onkeyup="" value="<?php esc_attr( $reaction_color_hover ); ?>" />
									</td>
								</tr>

								<tr class="heateor_rb_help_content" id="heateor_rb_font_color_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Specify the color or hex code (example #cc78e0) for the logo of icon. Leave empty for default. You can get the hex code of the required color from <a href="http://www.colorpicker.com/" target="_blank">this link</a>', 'reaction-buttons-by-heateor' ) ?>
									</div>
									</td>
								</tr>

								<tr>
									<th>
										<label><?php _e( "Background Color", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_bg_color_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<label for="heateor_rb_bg_color_default"><?php _e( "Default", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_bg_color_default" name="heateor_rb[horizontal_bg_color_default]" type="text" onkeyup="heateorRbReactionBg = this.value.trim() ? this.value.trim() : '#3C589A'; heateorRbUpdateReactionPreview(this.value.trim(), 'backgroundColor', '#3C589A', 'heateor_rb_preview' )" value="<?php echo esc_attr( $horizontal_bg ) ?>" />
										<label style="margin-left:10px" for="heateor_rb_bg_color_hover"><?php _e( "On Hover", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_bg_color_hover" name="heateor_rb[horizontal_bg_color_hover]" type="text" onkeyup="heateorRbReactionBgHover = this.value.trim() ? this.value.trim() : '#3C589A';" value="<?php echo esc_attr( $horizontal_bg_hover ) ?>" />
									</td>
								</tr>

								<tr class="heateor_rb_help_content" id="heateor_rb_bg_color_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Specify the color or hex code (example #cc78e0) for icon background. Save "transparent" for transparent background. Leave empty for default. You can get the hex code of the required color from <a href="http://www.colorpicker.com/" target="_blank">this link</a>', 'reaction-buttons-by-heateor' ) ?>
									</div>
									</td>
								</tr>

								<tr>
									<th>
										<label><?php _e( "Border", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_border_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<script type="text/javascript">var heateorRbBorderWidthHover = '<?php echo $border_width_hover = isset( $options['horizontal_border_width_hover'] ) ? esc_js( $options['horizontal_border_width_hover'] ) : ''; ?>', heateorRbBorderColorHover = '<?php echo  esc_js( $border_color_hover = isset( $options['horizontal_border_color_hover'] ) ? $options['horizontal_border_color_hover'] : '' ); ?>'</script>
										<label><strong><?php _e( "Default", 'reaction-buttons-by-heateor' ); ?></strong></label>
										<br/>
										<label for="heateor_rb_border_width_default"><?php _e( "Border Width", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_border_width_default" onkeyup="heateorRbBorderWidth = this.value.trim(); jQuery( '#heateor_rb_preview' ).css( 'borderStyle', 'solid' ); heateorRbUpdateReactionPreview(this.value.trim(), 'borderWidth', '0px', 'heateor_rb_preview' ); heateorRbReactionHorizontalPreview();" name="heateor_rb[horizontal_border_width_default]" type="text" value="<?php echo esc_attr( $border_width ) ?>" />pixel(s)
										<label style="margin-left:10px" for="heateor_rb_border_color_default"><?php _e( "Border Color", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" onkeyup="heateorRbBorderColor = this.value.trim(); jQuery( '#heateor_rb_preview' ).css( 'borderStyle', 'solid' ); heateorRbUpdateReactionPreview(this.value.trim(), 'borderColor', 'transparent', 'heateor_rb_preview' )" id="heateor_rb_border_color_default" name="heateor_rb[horizontal_border_color_default]" type="text" value="<?php echo esc_attr( $border_color ) ?>" />
										<br/><br/>
										<label><strong><?php _e( "On Hover", 'reaction-buttons-by-heateor' ); ?></strong></label>
										<br/>
										<label for="heateor_rb_border_width_hover"><?php _e( "Border Width", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_border_width_hover" name="heateor_rb[horizontal_border_width_hover]" type="text" value="<?php echo esc_attr( $border_width_hover ) ?>" onkeyup="heateorRbBorderWidthHover = this.value.trim();" />pixel(s)
										<label style="margin-left:10px" for="heateor_rb_border_color_hover"><?php _e( "Border Color", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_border_color_hover" name="heateor_rb[horizontal_border_color_hover]" type="text" value="<?php echo esc_attr( $border_color_hover ) ?>" onkeyup="heateorRbBorderColorHover = this.value.trim();" />
									</td>
								</tr>

								<tr class="heateor_rb_help_content" id="heateor_rb_border_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Icon border', 'reaction-buttons-by-heateor' ) ?>
									</div>
									</td>
								</tr>

								<tr>
									<th>
										<label><?php _e( "Counter Position", 'reaction-buttons-by-heateor' ); ?><br/><?php _e( "(applies, if counter enabled)", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_counter_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<input id="heateor_rb_counter_left" name="heateor_rb[horizontal_counter_position]" onclick="heateorRbCounterPreview(this.value.trim() )" type="radio" <?php echo $counter_position == 'left' ? 'checked = "checked"' : '';?> value="left" />
										<label style="margin-right:10px" for="heateor_rb_counter_left"><?php _e( "Left", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_counter_top" name="heateor_rb[horizontal_counter_position]" onclick="heateorRbCounterPreview(this.value.trim() )" type="radio" <?php echo $counter_position == 'top' ? 'checked = "checked"' : '';?> value="top" />
										<label style="margin-right:10px" for="heateor_rb_counter_top"><?php _e( "Top", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_counter_right" name="heateor_rb[horizontal_counter_position]" onclick="heateorRbCounterPreview(this.value.trim() )" type="radio" <?php echo $counter_position == 'right' ? 'checked = "checked"' : '';?> value="right" />
										<label style="margin-right:10px" for="heateor_rb_counter_right"><?php _e( "Right", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_counter_bottom" name="heateor_rb[horizontal_counter_position]" onclick="heateorRbCounterPreview(this.value.trim() )" type="radio" <?php echo $counter_position == 'bottom' ? 'checked = "checked"' : '';?> value="bottom" />
										<label style="margin-right:10px" for="heateor_rb_counter_bottom"><?php _e( "Bottom", 'reaction-buttons-by-heateor' ); ?></label><br/>
										<input id="heateor_rb_counter_inner_left" name="heateor_rb[horizontal_counter_position]" onclick="heateorRbCounterPreview(this.value.trim() )" type="radio" <?php echo $counter_position == 'inner_left' ? 'checked = "checked"' : '';?> value="inner_left" />
										<label style="margin-right:10px" for="heateor_rb_counter_inner_left"><?php _e( "Inner Left", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_counter_inner_top" name="heateor_rb[horizontal_counter_position]" onclick="heateorRbCounterPreview(this.value.trim() )" type="radio" <?php echo $counter_position == 'inner_top' ? 'checked = "checked"' : '';?> value="inner_top" />
										<label style="margin-right:10px" for="heateor_rb_counter_inner_top"><?php _e( "Inner Top", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_counter_inner_right" name="heateor_rb[horizontal_counter_position]" onclick="heateorRbCounterPreview(this.value.trim() )" type="radio" <?php echo $counter_position == 'inner_right' ? 'checked = "checked"' : '';?> value="inner_right" />
										<label style="margin-right:10px" for="heateor_rb_counter_inner_right"><?php _e( "Inner Right", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_counter_inner_bottom" name="heateor_rb[horizontal_counter_position]" onclick="heateorRbCounterPreview(this.value.trim() )" type="radio" <?php echo $counter_position == 'inner_bottom' ? 'checked = "checked"' : '';?> value="inner_bottom" />
										<label style="margin-right:10px" for="heateor_rb_counter_inner_bottom"><?php _e( "Inner Bottom", 'reaction-buttons-by-heateor' ); ?></label>
									</td>
								</tr>
								<script type="text/javascript">heateorRbCounterPreview( '<?php echo esc_js( $counter_position ) ?>' );</script>

								<tr class="heateor_rb_help_content" id="heateor_rb_counter_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Position of reaction counter', 'reaction-buttons-by-heateor' ) ?>
									</div>
									</td>
								</tr>
								
							</table>
						</div>	
					</div>
				
					<div class="stuffbox">
						<h3><label><?php _e( 'Floating interface theme', 'reaction-buttons-by-heateor' );?></label></h3>
						<div class="inside">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
								<tr>
									<th>
										<label style="float:left"><?php _e( "Icon Preview", 'reaction-buttons-by-heateor' ); ?></label>
									</th>
									<td>
										<?php
										$vertical_bg = isset( $options['vertical_bg_color_default'] ) ? $options['vertical_bg_color_default'] : '';
										$vertical_bg_hover = isset( $options['vertical_bg_color_hover'] ) ? $options['vertical_bg_color_hover'] : '';
										$vertical_border_width = isset( $options['vertical_border_width_default'] ) ? $options['vertical_border_width_default'] : '';
										$vertical_border_color = isset( $options['vertical_border_color_default'] ) ? $options['vertical_border_color_default'] : '';
										$vertical_reaction_color = isset( $options['vertical_font_color_default'] ) ? $options['vertical_font_color_default'] : '';
										$vertical_reaction_color_hover = isset( $options['vertical_font_color_hover'] ) ? $options['vertical_font_color_hover'] : '';
										$vertical_reaction_shape = isset( $options['vertical_reaction_shape'] ) ? $options['vertical_reaction_shape'] : 'round'; 
										$vertical_reaction_size = isset( $options['vertical_reaction_size'] ) ? $options['vertical_reaction_size'] : 32;
										$vertical_reaction_width = isset( $options['vertical_reaction_width'] ) ? $options['vertical_reaction_width'] : 32;
										$vertical_reaction_height = isset( $options['vertical_reaction_height'] ) ? $options['vertical_reaction_height'] : 32;
										$vertical_reaction_border_radius = isset( $options['vertical_border_radius'] ) ? $options['vertical_border_radius'] : '';
										$vertical_vertical_bg_hover = isset( $options['vertical_bg_color_hover'] ) ? $options['vertical_bg_color_hover'] : '';
										$vertical_counter_position = isset( $options['vertical_counter_position'] ) ? $options['vertical_counter_position'] : '';
										$vertical_line_height = $vertical_reaction_shape == 'rectangle' ? $vertical_reaction_height : $vertical_reaction_size;
										?>
										<style type="text/css">
										#heateor_rb_vertical_preview{
											color:<?php echo $vertical_reaction_color ? esc_html( $vertical_reaction_color ) : "#000" ?>;
										}
										#heateor_rb_vertical_preview:hover{
											color:<?php echo esc_html( $vertical_reaction_color_hover ) ?>;
										}
										</style>
										<div>
											<div class="heateorRbCounterVerticalPreviewTop" style="width:<?php echo 60 + esc_attr( isset( $options['vertical_reaction_shape'] ) && $options['vertical_reaction_shape'] == 'rectangle' ? $options['vertical_reaction_width'] : $options['vertical_reaction_size'] ) ?>px">44</div>
											<div class="heateorRbCounterVerticalPreviewLeft">44</div>
											<div id="heateor_rb_vertical_preview" style="cursor:pointer;float:left">
												<div class="heateorRbCounterVerticalPreviewInnertop">44</div>
												<div class="heateorRbCounterVerticalPreviewInnerleft">44</div>
												<div id="vertical_svg" style="float:left;width:100%;height:100%;background:url('data:image/svg+xml;charset=utf8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20enable-background%3D%22new%200%200%2064%2064%22%3E%3Cg%20fill%3D%22<?php echo $vertical_reaction_color ? esc_attr( str_replace( '#', '%23', $vertical_reaction_color) ) : "%23000" ?>%22%3E%3Ccircle%20cx%3D%2220.5%22%20cy%3D%2226.6%22%20r%3D%225%22%3E%3C%2Fcircle%3E%3Ccircle%20cx%3D%2243.5%22%20cy%3D%2226.6%22%20r%3D%225%22%3E%3C%2Fcircle%3E%3Cpath%20d%3D%22m44.6%2040.3c-8.1%205.7-17.1%205.6-25.2%200-1-.7-1.8.5-1.2%201.6%202.5%204%207.4%207.7%2013.8%207.7s11.3-3.6%2013.8-7.7c.6-1.1-.2-2.3-1.2-1.6%22%3E%3C%2Fpath%3E%3C%2Fg%3E%0A%20%20%3C%2Fsvg%3E')  no-repeat center center; margin: auto"></div>
												<div class="heateorRbCounterVerticalPreviewInnerright">44</div>
												<div class="heateorRbCounterVerticalPreviewInnerbottom">44</div>
											</div>
											<div class="heateorRbCounterVerticalPreviewRight">44</div>
											<div class="heateorRbCounterVerticalPreviewBottom" style="width:<?php echo 60 + esc_attr( isset( $options['vertical_reaction_shape'] ) && $options['vertical_reaction_shape'] == 'rectangle' ? $options['vertical_reaction_width'] : $options['vertical_reaction_size'] ) ?>px">44</div>
										</div>
										
										<script type="text/javascript">
										var tempVerticalShape = '<?php echo esc_js( $vertical_reaction_shape ) ?>', tempVerticalSize = '<?php echo esc_js( $vertical_reaction_size ) ?>', tempVerticalHeight = '<?php echo esc_js( $vertical_reaction_height ) ?>', tempVerticalWidth = '<?php echo esc_js( $vertical_reaction_width ) ?>', heateorRbVerticalReactionBgHover = '<?php echo esc_js( $vertical_bg_hover ) ?>', heateorRbVerticalReactionBg = '<?php echo $vertical_bg ? esc_js( $vertical_bg ) : "#3C589A" ?>', heateorRbVerticalBorderWidth = '<?php echo esc_js( $vertical_border_width ) ?>', heateorRbVerticalBorderColor = '<?php echo esc_js( $vertical_border_color ) ?>', heateorRbVerticalBorderWidthHover = '<?php echo $vertical_border_width_hover = isset( $options['vertical_border_width_hover'] ) ? esc_js( $options['vertical_border_width_hover'] ) : ''; ?>', heateorRbVerticalBorderColorHover = '<?php echo $vertical_border_color_hover = isset( $options['vertical_border_color_hover'] ) ? esc_js( $options['vertical_border_color_hover'] ) : ''; ?>', heateorRbVerticalBorderRadius = '<?php echo $vertical_reaction_border_radius ? esc_js( $vertical_reaction_border_radius ) . "px" : "0px" ?>';
										
										heateorRbReactionVerticalPreview();
										
										jQuery( '#heateor_rb_vertical_preview' ).hover(function() {
											if (heateorRbVerticalReactionBgHover && heateorRbVerticalReactionBgHover != '#3C589A' ) {
												jQuery(this).css( 'backgroundColor', heateorRbVerticalReactionBgHover);
											}
											if (jQuery( '#heateor_rb_vertical_font_color_hover' ).val().trim() ) {
												jQuery(this).find( '#vertical_svg' ).attr( 'style', jQuery(this).find( '#vertical_svg' ).attr( 'style' ).replace(heateorRbVerticalReactionTempColor.replace( '#', '%23' ), jQuery( '#heateor_rb_vertical_font_color_hover' ).val().trim().replace( '#', '%23' ) ));
												jQuery(this).css( 'color', jQuery( '#heateor_rb_vertical_font_color_hover' ).val().trim() );
											}
											jQuery(this).css( 'borderStyle', 'solid' );
											jQuery(this).css( 'borderWidth', heateorRbVerticalBorderWidthHover ? heateorRbVerticalBorderWidthHover : heateorRbVerticalBorderWidth ? heateorRbVerticalBorderWidth : '0' );
											jQuery(this).css( 'borderColor', heateorRbVerticalBorderColorHover ? heateorRbVerticalBorderColorHover : 'transparent' );
										},function() {
											jQuery(this).css( 'backgroundColor', heateorRbVerticalReactionBg);
											if (jQuery( '#heateor_rb_vertical_font_color_hover' ).val().trim() ) {
												jQuery(this).find( '#vertical_svg' ).attr( 'style', jQuery(this).find( '#vertical_svg' ).attr( 'style' ).replace(jQuery( '#heateor_rb_vertical_font_color_hover' ).val().trim().replace( '#', '%23' ), heateorRbVerticalReactionTempColor.replace( '#', '%23' ) ));
												jQuery(this).css( 'color', heateorRbVerticalReactionTempColor);
											}
											jQuery(this).css( 'borderStyle', 'solid' );
											jQuery(this).css( 'borderWidth', heateorRbVerticalBorderWidth ? heateorRbVerticalBorderWidth : heateorRbVerticalBorderWidthHover ? heateorRbVerticalBorderWidthHover : '0' );
											jQuery(this).css( 'borderColor', heateorRbVerticalBorderColor ? heateorRbVerticalBorderColor : 'transparent' );
										});
										</script>
									</td>
								</tr>

								<tr>
									<td colspan="2">
										<div id="heateor_rb_vertical_preview_message" style="color:green;display:none"><?php _e( 'Do not forget to save the configuration after making changes by clicking the save button below', 'reaction-buttons-by-heateor' ); ?></div>
									</td>
								</tr>

								<tr>
									<th>
										<label><?php _e( "Shape", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_vertical_reaction_icon_shape_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<input id="heateor_rb_vertical_icon_round" onclick="tempVerticalShape = 'round';heateorRbReactionVerticalPreview()" name="heateor_rb[vertical_reaction_shape]" type="radio" <?php echo $vertical_reaction_shape == 'round' ? 'checked = "checked"' : '';?> value="round" />
										<label style="margin-right:10px" for="heateor_rb_vertical_icon_round"><?php _e( "Round", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_vertical_icon_square" onclick="tempVerticalShape = 'square';heateorRbReactionVerticalPreview()" name="heateor_rb[vertical_reaction_shape]" type="radio" <?php echo $vertical_reaction_shape == 'square' ? 'checked = "checked"' : '';?> value="square" />
										<label style="margin-right:10px" for="heateor_rb_vertical_icon_square"><?php _e( "Square", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_vertical_icon_rectangle" onclick="tempVerticalShape = 'rectangle';heateorRbReactionVerticalPreview()" name="heateor_rb[vertical_reaction_shape]" type="radio" <?php echo $vertical_reaction_shape == 'rectangle' ? 'checked = "checked"' : '';?> value="rectangle" />
										<label for="heateor_rb_vertical_icon_rectangle"><?php _e( "Rectangle", 'reaction-buttons-by-heateor' ); ?></label>
									</td>
								</tr>

								<tr class="heateor_rb_help_content" id="heateor_rb_vertical_reaction_icon_shape_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Shape of the reaction icons', 'reaction-buttons-by-heateor' ) ?>
									</div>
									</td>
								</tr>

								<tbody id="heateor_rb_vertical_size_options" <?php echo ! isset( $options['vertical_reaction_shape'] )  || $options['vertical_reaction_shape'] != 'rectangle' ? '' : 'style="display: none"'; ?>>	
									<tr>
										<th>
											<label><?php _e( "Size (in pixels)", 'reaction-buttons-by-heateor' ); ?></label>
											<img id="heateor_rb_vertical_reaction_icon_size_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
										</th>
										<td>
											<input style="width:50px" id="heateor_rb_vertical_reaction_icon_size" name="heateor_rb[vertical_reaction_size]" type="text" value="<?php echo esc_attr( $vertical_reaction_size ); ?>" />
											<input id="heateor_rb_vertical_reaction_size_plus" type="button" value="+" onmouseup="tempVerticalSize = document.getElementById( 'heateor_rb_vertical_reaction_icon_size' ).value;heateorRbReactionVerticalPreview()" />
											<input id="heateor_rb_vertical_reaction_size_minus" type="button" value="-" onmouseup="tempVerticalSize = document.getElementById( 'heateor_rb_vertical_reaction_icon_size' ).value;heateorRbReactionVerticalPreview()" />
											<script type="text/javascript">
												heateorRbIncrement(document.getElementById( 'heateor_rb_vertical_reaction_size_plus' ), "add", document.getElementById( 'heateor_rb_vertical_reaction_icon_size' ), 300, 0.7);
												heateorRbIncrement(document.getElementById( 'heateor_rb_vertical_reaction_size_minus' ), "subtract", document.getElementById( 'heateor_rb_vertical_reaction_icon_size' ), 300, 0.7);
											</script>
										</td>
									</tr>

									<tr class="heateor_rb_help_content" id="heateor_rb_vertical_reaction_icon_size_help_cont">
										<td colspan="2">
										<div>
										<?php _e( 'Size of the reaction icons', 'reaction-buttons-by-heateor' ) ?>
										</div>
										</td>
									</tr>
								</tbody>

								<tbody id="heateor_rb_vertical_rectangle_options" <?php echo isset( $options['vertical_reaction_shape'] ) && $options['vertical_reaction_shape'] == 'rectangle' ? '' : 'style="display: none"'; ?>>
									<tr>
										<th>
											<label><?php _e( "Width (in pixels)", 'reaction-buttons-by-heateor' ); ?></label>
											<img id="heateor_rb_vertical_icon_width_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
										</th>
										<td>
											<input style="width:50px" id="heateor_rb_vertical_icon_width" name="heateor_rb[vertical_reaction_width]" type="text" value="<?php echo esc_attr( $vertical_reaction_width ); ?>" />
											<input id="heateor_rb_vertical_width_plus" type="button" value="+" onmouseup="tempVerticalWidth = document.getElementById( 'heateor_rb_vertical_icon_width' ).value;heateorRbReactionVerticalPreview()" />
											<input id="heateor_rb_vertical_width_minus" type="button" value="-" onmouseup="tempVerticalWidth = document.getElementById( 'heateor_rb_vertical_icon_width' ).value;heateorRbReactionVerticalPreview()" />
											<script type="text/javascript">
												heateorRbIncrement(document.getElementById( 'heateor_rb_vertical_width_plus' ), "add", document.getElementById( 'heateor_rb_vertical_icon_width' ), 300, 0.7);
												heateorRbIncrement(document.getElementById( 'heateor_rb_vertical_width_minus' ), "subtract", document.getElementById( 'heateor_rb_vertical_icon_width' ), 300, 0.7);
											</script>
										</td>
									</tr>

									<tr class="heateor_rb_help_content" id="heateor_rb_vertical_icon_width_help_cont">
										<td colspan="2">
										<div>
										<?php _e( 'Width of the reaction icons', 'reaction-buttons-by-heateor' ) ?>
										</div>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e( "Height (in pixels)", 'reaction-buttons-by-heateor' ); ?></label>
											<img id="heateor_rb_vertical_icon_height_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
										</th>
										<td>
											<input style="width:50px" id="heateor_rb_vertical_icon_height" name="heateor_rb[vertical_reaction_height]" type="text" value="<?php echo esc_attr( $vertical_reaction_height ); ?>" />
											<input id="heateor_rb_vertical_height_plus" type="button" value="+" onmouseup="tempVerticalHeight = document.getElementById( 'heateor_rb_vertical_icon_height' ).value;heateorRbReactionVerticalPreview()" />
											<input id="heateor_rb_vertical_height_minus" type="button" value="-" onmouseup="tempVerticalHeight = document.getElementById( 'heateor_rb_vertical_icon_height' ).value;heateorRbReactionVerticalPreview()" />
											<script type="text/javascript">
												heateorRbIncrement(document.getElementById( 'heateor_rb_vertical_height_plus' ), "add", document.getElementById( 'heateor_rb_vertical_icon_height' ), 300, 0.7);
												heateorRbIncrement(document.getElementById( 'heateor_rb_vertical_height_minus' ), "subtract", document.getElementById( 'heateor_rb_vertical_icon_height' ), 300, 0.7);
											</script>
										</td>
									</tr>

									<tr class="heateor_rb_help_content" id="heateor_rb_vertical_icon_height_help_cont">
										<td colspan="2">
										<div>
										<?php _e( 'Height of the reaction icons', 'reaction-buttons-by-heateor' ) ?>
										</div>
										</td>
									</tr>
								</tbody>

								<tbody id="heateor_rb_vertical_border_radius_options" <?php echo isset( $options['vertical_reaction_shape'] ) && $options['vertical_reaction_shape'] != 'round' ? '' : 'style="display: none"'; ?>>
									<tr>
										<th>
											<label><?php _e( "Border radius (in pixels)", 'reaction-buttons-by-heateor' ); ?></label>
											<img id="heateor_rb_vertical_icon_border_radius_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
										</th>
										<td>
											<input style="width:50px" id="heateor_rb_vertical_icon_border_radius" name="heateor_rb[vertical_border_radius]" type="text" value="<?php echo esc_attr( $vertical_reaction_border_radius ); ?>" onkeyup="heateorRbVerticalBorderRadius = this.value.trim() ? this.value.trim() + 'px' : '0px';heateorRbUpdateReactionPreview(heateorRbVerticalBorderRadius, 'borderRadius', '0px', 'heateor_rb_vertical_preview' )" />
										</td>
									</tr>

									<tr class="heateor_rb_help_content" id="heateor_rb_vertical_icon_border_radius_help_cont">
										<td colspan="2">
										<div>
										<?php _e( 'Specify a value for rounded corners. More the value, more rounded will the corners be. Leave empty for sharp corners.', 'reaction-buttons-by-heateor' ) ?>
										</div>
										</td>
									</tr>
								</tbody>

								<tr>
									<th>
										<label><?php _e( "Logo Color", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_vertical_font_color_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<script type="text/javascript">var heateorRbVerticalReactionTempColor = '<?php echo $vertical_reaction_color ? esc_js( $vertical_reaction_color ) : "#000" ?>';</script>
										<label for="heateor_rb_vertical_font_color_default"><?php _e( "Default", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_vertical_font_color_default" name="heateor_rb[vertical_font_color_default]" onkeyup="if (this.value.trim() == '' || this.value.trim().length >= 3) { jQuery( '#vertical_svg' ).attr( 'style', jQuery( '#vertical_svg' ).attr( 'style' ).replace(heateorRbVerticalReactionTempColor.replace( '#', '%23' ), this.value.trim() ? this.value.trim().replace( '#', '%23' ) : '%23fff' ) ); heateorRbVerticalReactionTempColor = this.value.trim() ? this.value.trim() : '#000';jQuery( '#heateor_rb_vertical_preview' ).css( 'color', heateorRbVerticalReactionTempColor.replace( '%23','#' ) ) }" type="text" value="<?php echo esc_attr( $vertical_reaction_color ) ?>" />
										<input name="heateor_rb[vertical_reaction_replace_color]" type="hidden" value="<?php echo isset( $options['vertical_reaction_replace_color'] ) ? esc_attr( $options['vertical_reaction_replace_color'] ) : ''; ?>" />
										<label style="margin-left:10px" for="heateor_rb_vertical_font_color_hover"><?php _e( "On Hover", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_vertical_font_color_hover" name="heateor_rb[vertical_font_color_hover]" type="text" value="<?php echo esc_attr( $vertical_reaction_color_hover ); ?>" />
										<input name="heateor_rb[vertical_reaction_replace_color_hover]" type="hidden" value="<?php echo isset( $options['vertical_reaction_replace_color_hover'] ) ? esc_attr( $options['vertical_reaction_replace_color_hover'] ) : ''; ?>" />
									</td>
								</tr>

								<tr class="heateor_rb_help_content" id="heateor_rb_vertical_font_color_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Specify the color or hex code (example #cc78e0) for the logo of icon. Leave empty for default. You can get the hex code of the required color from <a href="http://www.colorpicker.com/" target="_blank">this link</a>', 'reaction-buttons-by-heateor' ) ?>
									</div>
									</td>
								</tr>

								<tr>
									<th>
										<label><?php _e( "Background Color", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_vertical_icon_bg_color_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<label for="heateor_rb_vertical_icon_bg_color_default"><?php _e( "Default", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_vertical_icon_bg_color_default" name="heateor_rb[vertical_bg_color_default]" type="text" onkeyup="heateorRbVerticalReactionBg = this.value.trim() ? this.value.trim() : '#3C589A'; heateorRbUpdateReactionPreview(this.value.trim(), 'backgroundColor', '#3C589A', 'heateor_rb_vertical_preview' )" value="<?php echo esc_attr( $vertical_bg ) ?>" />
										<label style="margin-left:10px" for="heateor_rb_vertical_bg_color_hover"><?php _e( "On Hover", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_vertical_bg_color_hover" name="heateor_rb[vertical_bg_color_hover]" type="text" onkeyup="heateorRbVerticalReactionBgHover = this.value.trim() ? this.value.trim() : '#3C589A';" value="<?php echo esc_attr( $vertical_bg_hover ) ?>" />
									</td>
								</tr>

								<tr class="heateor_rb_help_content" id="heateor_rb_vertical_icon_bg_color_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Specify the color or hex code (example #cc78e0) for icon background. Save "transparent" for transparent background. Leave empty for default. You can get the hex code of the required color from <a href="http://www.colorpicker.com/" target="_blank">this link</a>', 'reaction-buttons-by-heateor' ) ?>
									</div>
									</td>
								</tr>

								<tr>
									<th>
										<label><?php _e( "Border", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_vertical_border_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<label><strong><?php _e( "Default", 'reaction-buttons-by-heateor' ); ?></strong></label>
										<br/>
										<label for="heateor_rb_vertical_border_width_default"><?php _e( "Border Width", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" onkeyup="heateorRbVerticalBorderWidth = this.value.trim(); jQuery( '#heateor_rb_vertical_preview' ).css( 'borderStyle', 'solid' ); heateorRbUpdateReactionPreview(this.value.trim(), 'borderWidth', '0px', 'heateor_rb_vertical_preview' ); heateorRbReactionVerticalPreview();" id="heateor_rb_vertical_border_width_default" name="heateor_rb[vertical_border_width_default]" type="text" value="<?php echo esc_attr( $vertical_border_width ) ?>" />pixel(s)
										<label style="margin-left:10px" for="heateor_rb_vertical_border_color_default"><?php _e( "Border Color", 'reaction-buttons-by-heateor' ); ?></label><input onkeyup="heateorRbVerticalBorderColor = this.value.trim(); jQuery( '#heateor_rb_vertical_preview' ).css( 'borderStyle', 'solid' ); heateorRbUpdateReactionPreview(this.value.trim(), 'borderColor', 'transparent', 'heateor_rb_vertical_preview' )" style="width: 100px" id="heateor_rb_vertical_border_color_default" name="heateor_rb[vertical_border_color_default]" type="text" value="<?php echo $vertical_border_color = isset( $options['vertical_border_color_default'] ) ? esc_attr( $options['vertical_border_color_default'] ) : ''; ?>" />
										<br/><br/>
										<label><strong><?php _e( "On Hover", 'reaction-buttons-by-heateor' ); ?></strong></label>
										<br/>
										<label for="heateor_rb_vertical_border_width_hover"><?php _e( "Border Width", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_vertical_border_width_hover" name="heateor_rb[vertical_border_width_hover]" onkeyup="heateorRbVerticalBorderWidthHover = this.value.trim();" type="text" value="<?php echo esc_attr( $vertical_border_width_hover ) ?>" />pixel(s)
										<label style="margin-left:10px" for="heateor_rb_vertical_border_color_hover"><?php _e( "Border Color", 'reaction-buttons-by-heateor' ); ?></label><input style="width: 100px" id="heateor_rb_vertical_border_color_hover" name="heateor_rb[vertical_border_color_hover]" onkeyup="heateorRbVerticalBorderColorHover = this.value.trim()" type="text" value="<?php echo esc_attr( $vertical_border_color_hover ); ?>" />
									</td>
								</tr>

								<tr class="heateor_rb_help_content" id="heateor_rb_vertical_border_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Icon border', 'reaction-buttons-by-heateor' ) ?>
									</div>
									</td>
								</tr>

								<tr>
									<th>
										<label><?php _e( "Counter Position", 'reaction-buttons-by-heateor' ); ?><br/><?php _e( "(applies, if counter enabled)", 'reaction-buttons-by-heateor' ); ?></label>
										<img id="heateor_rb_vertical_counter_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
									</th>
									<td>
										<input id="heateor_rb_vertical_counter_left" name="heateor_rb[vertical_counter_position]" onclick="heateorRbVerticalCounterPreview(this.value.trim() )" type="radio" <?php echo $vertical_counter_position == 'left' ? 'checked = "checked"' : '';?> value="left" />
										<label style="margin-right:10px" for="heateor_rb_vertical_counter_left"><?php _e( "Left", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_vertical_counter_top" name="heateor_rb[vertical_counter_position]" onclick="heateorRbVerticalCounterPreview(this.value.trim() )" type="radio" <?php echo $vertical_counter_position == 'top' ? 'checked = "checked"' : '';?> value="top" />
										<label style="margin-right:10px" for="heateor_rb_vertical_counter_top"><?php _e( "Top", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_vertical_counter_right" name="heateor_rb[vertical_counter_position]" onclick="heateorRbVerticalCounterPreview(this.value.trim() )" type="radio" <?php echo $vertical_counter_position == 'right' ? 'checked = "checked"' : '';?> value="right" />
										<label style="margin-right:10px" for="heateor_rb_vertical_counter_right"><?php _e( "Right", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_vertical_counter_bottom" name="heateor_rb[vertical_counter_position]" onclick="heateorRbVerticalCounterPreview(this.value.trim() )" type="radio" <?php echo $vertical_counter_position == 'bottom' ? 'checked = "checked"' : '';?> value="bottom" />
										<label style="margin-right:10px" for="heateor_rb_vertical_counter_bottom"><?php _e( "Bottom", 'reaction-buttons-by-heateor' ); ?></label><br/>
										<input id="heateor_rb_vertical_counter_inner_left" name="heateor_rb[vertical_counter_position]" onclick="heateorRbVerticalCounterPreview(this.value.trim() )" type="radio" <?php echo $vertical_counter_position == 'inner_left' ? 'checked = "checked"' : '';?> value="inner_left" />
										<label style="margin-right:10px" for="heateor_rb_vertical_counter_inner_left"><?php _e( "Inner Left", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_vertical_counter_inner_top" name="heateor_rb[vertical_counter_position]" onclick="heateorRbVerticalCounterPreview(this.value.trim() )" type="radio" <?php echo $vertical_counter_position == 'inner_top' ? 'checked = "checked"' : '';?> value="inner_top" />
										<label style="margin-right:10px" for="heateor_rb_vertical_counter_inner_top"><?php _e( "Inner Top", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_vertical_counter_inner_right" name="heateor_rb[vertical_counter_position]" onclick="heateorRbVerticalCounterPreview(this.value.trim() )" type="radio" <?php echo $vertical_counter_position == 'inner_right' ? 'checked = "checked"' : '';?> value="inner_right" />
										<label style="margin-right:10px" for="heateor_rb_vertical_counter_inner_right"><?php _e( "Inner Right", 'reaction-buttons-by-heateor' ); ?></label>
										<input id="heateor_rb_vertical_counter_inner_bottom" name="heateor_rb[vertical_counter_position]" onclick="heateorRbVerticalCounterPreview(this.value.trim() )" type="radio" <?php echo $vertical_counter_position == 'inner_bottom' ? 'checked = "checked"' : '';?> value="inner_bottom" />
										<label style="margin-right:10px" for="heateor_rb_vertical_counter_inner_bottom"><?php _e( "Inner Bottom", 'reaction-buttons-by-heateor' ); ?></label>
									</td>
								</tr>
								<script type="text/javascript">heateorRbVerticalCounterPreview( '<?php echo esc_js( $vertical_counter_position ) ?>' );</script>

								<tr class="heateor_rb_help_content" id="heateor_rb_vertical_counter_help_cont">
									<td colspan="2">
									<div>
									<?php _e( 'Position of reaction counter', 'reaction-buttons-by-heateor' ) ?>
									</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<?php include 'reaction-buttons-for-wordpress-about.php'; ?>
			</div>

			<div class="menu_containt_div" id="tabs-2">
				<div class="clear"></div>
				<div class="heateor_rb_left_column">
				
				<div class="stuffbox">
					<h3><label><?php _e( 'Standard Reaction Interface Options', 'reaction-buttons-by-heateor' );?></label></h3>
					<div class="inside">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
						<tr>
							<th>
							<label for="heateor_rb_horizontal_enable"><?php _e( "Enable Standard reaction interface", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_horizontal_enable_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_horizontal_enable" onclick="heateorRbHorizontalReactionOptionsToggle(this)" name="heateor_rb[hor_enable]" type="checkbox" <?php echo isset( $options['hor_enable'] ) ? 'checked = "checked"' : '';?> value="1" />
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_horizontal_enable_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Master control to enable standard reaction', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tbody id="heateor_rb_horizontal_reaction_options" <?php echo isset( $options['hor_enable'] ) ? '' : 'style="display: none"'; ?>>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_horizontal_target_url_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'URL to react to', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tr>
							<th>
							<label for="heateor_rb_fblogin_title"><?php _e( "Title", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_title_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_fblogin_title" name="heateor_rb[title]" type="text" value="<?php echo isset( $options['title'] ) ? esc_attr( $options['title'] ) : '' ?>" />
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_title_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'The text to display above the reaction interface', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>

						<?php
						if ( ! isset( $options['horizontal_re_providers'] ) ) {
							$options['horizontal_re_providers'] = array();
						}
						if ( ! isset( $options['vertical_re_providers'] ) ) {
							$options['vertical_re_providers'] = array();
						}
						
						$like_buttons = array( 'smile', 'lol', 'love', 'sad', 'angry', 'wow', 'up' );
						$reaction_networks = array( 'smile', 'lol', 'love', 'sad', 'angry', 'wow', 'up' );
						?>

						<tr>
							<th>
							<label><?php _e( "Rearrange icons", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_rearrange_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
						</tr>

						<tr>
							<td colspan="2">
							<script>
							// facebook app id and secret options toggle variables
							var heateorRbHorizontalReactions = true, heateorRbHorizontalTotalReactions = <?php echo isset( $options['horizontal_total_reactions'] ) ? 'true' : 'false' ?>, heateorRbVerticalReactions = <?php echo isset( $options['vertical_counts'] ) ? 'true' : 'false' ?>, heateorRbVerticalTotalReactions = <?php echo isset( $options['vertical_total_reactions'] ) ? 'true' : 'false' ?>, heateorRbHorizontalFacebookShareEnabled = <?php echo in_array( 'facebook', $options['horizontal_re_providers'] ) ? 'true' : 'false'; ?>, heateorRbVerticalFacebookShareEnabled = <?php echo in_array( 'facebook', $options['vertical_re_providers'] ) ? 'true' : 'false'; ?>, heateorRbFacebookIDSecretNotSaved = 'false';
							<?php
							$horReactionStyle = 'width:' . ( $options['horizontal_reaction_shape'] != 'rectangle' ? $options['horizontal_reaction_size'] : $options['horizontal_reaction_width'] ) . 'px;height:' . $line_height . 'px;';
							$horDeliciousRadius = '';
							if ( $options['horizontal_reaction_shape'] == 'round' ) {
								$horReactionStyle .= 'border-radius:999px;';
								$horDeliciousRadius = 'border-radius:999px;';
							} elseif ( isset( $options['horizontal_border_radius'] ) && $options['horizontal_border_radius'] != '' ) {
								$horReactionStyle .= 'border-radius:' . $options['horizontal_border_radius'] . 'px;';
							}
							?>
							var heateorRbHorReactionStyle = '<?php echo esc_js( $horReactionStyle ) ?>', heateorRbHorDeliciousRadius = '<?php echo esc_js( $horDeliciousRadius ) ?>', heateorRbLikeButtons = ["<?php echo esc_js( implode( '","', $like_buttons ) ) ?>"];
							</script>
							<style type="text/css">
							<?php if ( $horizontal_bg != '' ) { ?>
								ul#heateor_rb_rearrange i.heateorRbInstagramBackground{background:<?php echo esc_html( $horizontal_bg ) ?>!important;}
							<?php } 
							if ( $horizontal_bg_hover != '' ) { ?>
								ul#heateor_rb_rearrange i.heateorRbInstagramBackground:hover{background:<?php echo esc_html( $horizontal_bg_hover ) ?>!important;}
							<?php } ?>
							.heateorRbReactionBackground{
								<?php if ( $horizontal_bg ) { ?>
								background-color: <?php echo esc_html( $horizontal_bg ) ?>;
								<?php } if ( $border_width ) { ?>
								border-width: <?php echo esc_html( $border_width ) ?>px;
								border-style: solid;
								<?php } ?>
								border-color: <?php echo $border_color ? esc_html( $border_color ) : 'transparent'; ?>;
							}
							.heateorRbReactionBackground:hover{
								<?php if ( $horizontal_bg_hover ) { ?>
								background-color: <?php echo esc_html( $horizontal_bg_hover ) ?>;
								<?php }if ( $border_width_hover ) { ?>
								border-width: <?php echo esc_html( $border_width_hover ) ?>px;
								border-style: solid;
								<?php } ?>
								border-color: <?php echo $border_color_hover ? esc_html( $border_color_hover ) : 'transparent'; ?>;
							}
							</style>
							<ul id="heateor_rb_rearrange">
								<?php 
								if ( isset( $options['horizontal_re_providers'] ) ) {
									foreach ( $options['horizontal_re_providers'] as $rearrange ) {
										?>
										<li title="<?php echo esc_attr( ucfirst( str_replace( '_', ' ', $rearrange ) ) ) ?>" id="heateor_rb_re_horizontal_<?php echo esc_attr( str_replace(array( ' ', '.' ), '_', $rearrange) ) ?>" >
										<i style="display:block;<?php echo esc_attr( $horReactionStyle ) ?>" class="heateorRbReactionBackground heateorRb<?php echo esc_attr( ucfirst(str_replace(array( '_', '.', ' ' ), '', $rearrange) ) ) ?>Background"><div class="heateorRbReactionSvg heateorRb<?php echo esc_attr( ucfirst(str_replace(array( '_', ' ', '.' ), '', $rearrange) ) ) ?>Svg" style="<?php echo esc_attr( $horDeliciousRadius ) ?>"></div></i>
										<input type="hidden" name="heateor_rb[horizontal_re_providers][]" value="<?php echo esc_attr( $rearrange ) ?>">
										</li>
										<?php
									}
								}
								?>
							</ul>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_rearrange_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Drag the icons to rearrange in desired order', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>

						

						
						<tr>
							<td colspan="2" class="selectReactionNetworks">
							<?php
							
							?>
							<div style="clear:both"></div>
							<div style="width:100%; margin: 10px 0"><input type="text" onkeyup="heateorRbSearchReactionNetworks(this.value.trim())" placeholder="<?php _e( 'Search social network', 'reaction-buttons-by-heateor' ) ?>" class="search" /></div>
							<div style="clear:both"></div>
							<?php
							foreach( $reaction_networks as $reaction_network ) {
								?>
								<div class="heateorRbStandardReactionsContainer">
								<?php echo $reaction_network == 'Goodreads' ? '<a href="https://www.heateor.com/comparison-between-reaction-buttons-for-wordpress-pro-and-premium/" target="_blank">' : ''; ?>
								<input id="heateor_rb_<?php echo esc_attr( $reaction_network ) ?>" type="checkbox" <?php echo $reaction_network == 'Goodreads' ? 'disabled ' : ''; ?><?php echo isset( $options['horizontal_re_providers'] ) && in_array( $reaction_network, $options['horizontal_re_providers'] ) ? 'checked = "checked"' : '';?> value="<?php echo esc_attr( $reaction_network ) ?>" />
								<label <?php echo esc_attr( $reaction_network ) != 'Goodreads' ? 'for="heateor_rb_' . $reaction_network . '"' : ''; ?>><i style="display:block;width:18px;height:18px;" class="heateorRbReaction heateorRb<?php echo esc_attr( str_replace( array( '_', '.', ' ' ), '', ucfirst( $reaction_network ) ) ) ?>Background"><ss style="display:block;" class="heateorRbReactionSvg heateorRb<?php echo esc_attr( str_replace(array( '_', '.', ' ' ), '', ucfirst( $reaction_network) ) ) ?>Svg"></ss></i></label>
								<label class="lblSocialNetwork" <?php echo $reaction_network != 'Goodreads' ? 'for="heateor_rb_' . esc_attr( $reaction_network ) . '"' : ''; ?>><?php echo esc_html( str_replace( '_', ' ', ucfirst( $reaction_network ) ) ) ?></label>
								<?php echo $reaction_network == 'Goodreads' ? '</a>' : ''; ?>
								</div>
								<?php
							}
							?>
							</td>
						</tr>
						
						<tr>
							<th>
							<label for="heateor_rb_hor_alignment"><?php _e( "Horizontal alignment", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_hor_alignment_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<select id="heateor_rb_hor_alignment" name="heateor_rb[hor_reaction_alignment]">
								<option value="left" <?php echo isset( $options['hor_reaction_alignment'] ) && $options['hor_reaction_alignment'] == 'left' ? 'selected="selected"' : '' ?>><?php _e( 'Left', 'reaction-buttons-by-heateor' ) ?></option>
								<option value="center" <?php echo isset( $options['hor_reaction_alignment'] ) && $options['hor_reaction_alignment'] == 'center' ? 'selected="selected"' : '' ?>><?php _e( 'Center', 'reaction-buttons-by-heateor' ) ?></option>
								<option value="right" <?php echo isset( $options['hor_reaction_alignment'] ) && $options['hor_reaction_alignment'] == 'right' ? 'selected="selected"' : '' ?>><?php _e( 'Right', 'reaction-buttons-by-heateor' ) ?></option>
							</select>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_hor_alignment_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Horizontal alignment of the reaction interface', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tr>
							<th>
							<label><?php _e( "Position with respect to content", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_position_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_top" name="heateor_rb[top]" type="checkbox" <?php echo isset( $options['top'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_top"><?php _e( 'Top of the content', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_bottom" name="heateor_rb[bottom]" type="checkbox" <?php echo isset( $options['bottom'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_bottom"><?php _e( 'Bottom of the content', 'reaction-buttons-by-heateor' ) ?></label>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_position_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify position of the reaction interface with respect to the content', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tr>
							<th>
							<label><?php _e( "Placement", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_location_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_home" name="heateor_rb[home]" type="checkbox" <?php echo isset( $options['home'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_home"><?php _e( 'Homepage', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_post" name="heateor_rb[post]" type="checkbox" <?php echo isset( $options['post'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_post"><?php _e( 'Posts', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_page" name="heateor_rb[page]" type="checkbox" <?php echo isset( $options['page'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_page"><?php _e( 'Pages', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_excerpt" name="heateor_rb[excerpt]" type="checkbox" <?php echo isset( $options['excerpt'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_excerpt"><?php _e( 'Excerpts and Posts page', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_category" name="heateor_rb[category]" type="checkbox" <?php echo isset( $options['category'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_category"><?php _e( 'Category Archives', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_archive" name="heateor_rb[archive]" type="checkbox" <?php echo isset( $options['archive'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_archive"><?php _e( 'Archive Pages (Category, Tag, Author or Date based pages)', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<?php
							$post_types = get_post_types( array( 'public' => true ), 'names', 'and' );
							$post_types = array_diff( $post_types, array( 'post', 'page' ) );
							if ( count( $post_types ) ) {	
								foreach ( $post_types as $post_type ) {
									?>
									<input id="heateor_rb_<?php echo esc_attr( $post_type ) ?>" name="heateor_rb[<?php echo esc_attr( $post_type ) ?>]" type="checkbox" <?php echo isset( $options[$post_type] ) ? 'checked = "checked"' : '';?> value="1" />
									<label for="heateor_rb_<?php echo esc_attr( $post_type ) ?>"><?php echo esc_attr( ucfirst( $post_type ) ) . 's'; ?></label><br/>
									<?php
								}
							}
							
							if ( $this->is_bp_active) {
								?>
								<input id="heateor_rb_bp_activity" name="heateor_rb[bp_activity]" type="checkbox" <?php echo isset( $options['bp_activity'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_bp_activity"><?php _e( 'BuddyPress activity', 'reaction-buttons-by-heateor' ) ?></label><br/>
								<input id="heateor_rb_bp_group" name="heateor_rb[bp_group]" type="checkbox" <?php echo isset( $options['bp_group'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_bp_group"><?php _e( 'BuddyPress group (only at top of content)', 'reaction-buttons-by-heateor' ) ?></label><br/>
								<?php
							}
							if (function_exists( 'is_bbpress' ) ) {
								?>
								<input id="heateor_rb_bb_forum" name="heateor_rb[bb_forum]" type="checkbox" <?php echo isset( $options['bb_forum'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_bb_forum"><?php _e( 'BBPress forum', 'reaction-buttons-by-heateor' ) ?></label>
								<br/>
								<input id="heateor_rb_bb_topic" name="heateor_rb[bb_topic]" type="checkbox" <?php echo isset( $options['bb_topic'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_bb_topic"><?php _e( 'BBPress topic', 'reaction-buttons-by-heateor' ) ?></label>
								<br/>
								<input id="heateor_rb_bb_reply" name="heateor_rb[bb_reply]" type="checkbox" <?php echo isset( $options['bb_reply'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_bb_reply"><?php _e( 'BBPress reply', 'reaction-buttons-by-heateor' ) ?></label>
								<br/>
								<?php
							}
							if ( $this->is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
								?>
								<input id="heateor_rb_woocom_shop" name="heateor_rb[woocom_shop]" type="checkbox" <?php echo isset( $options['woocom_shop'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_woocom_shop"><?php _e( 'After individual product at WooCommerce Shop page', 'reaction-buttons-by-heateor' ) ?></label>
								<br/>
								<input id="heateor_rb_woocom_product" name="heateor_rb[woocom_product]" type="checkbox" <?php echo isset( $options['woocom_product'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_woocom_product"><?php _e( 'WooCommerce Product Page', 'reaction-buttons-by-heateor' ) ?></label>
								<br/>
								<input id="heateor_rb_woocom_thankyou" name="heateor_rb[woocom_thankyou]" type="checkbox" <?php echo isset( $options['woocom_thankyou'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_woocom_thankyou"><?php _e( 'WooCommerce Thankyou Page', 'reaction-buttons-by-heateor' ) ?></label>
								<br/>
								<?php
							}
							?>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_location_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Select the page-groups where you want to integrate the Reaction Buttons', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						</tbody>
					</table>
					</div>
				</div>
				
				</div>
				<?php include 'reaction-buttons-for-wordpress-about.php'; ?>
			</div>
			
			<div class="menu_containt_div" id="tabs-3">
				<div class="clear"></div>
				<div class="heateor_rb_left_column">
					<div class="stuffbox">
					<h3><label><?php _e( 'Floating Reaction Interface Options', 'reaction-buttons-by-heateor' );?></label></h3>
					<div class="inside">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
						<tr>
							<th>
							<label for="heateor_rb_vertical_enable"><?php _e( "Enable Floating reaction interface", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_vertical_enable_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_vertical_enable" onclick="heateorRbVerticalReactionOptionsToggle(this)" name="heateor_rb[vertical_enable]" type="checkbox" <?php echo isset( $options['vertical_enable'] ) ? 'checked = "checked"' : '';?> value="1" />
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_vertical_enable_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Master control to enable floating reaction widget', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tbody id="heateor_rb_vertical_reaction_options" <?php echo isset( $options['vertical_enable'] ) ? '' : 'style="display: none"'; ?>>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_vertical_target_url_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'URL to react to', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<label><?php _e( "Rearrange icons", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_vertical_rearrange_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
						</tr>
						
						<tr>
							<td colspan="2">
							<script>
							<?php
							$verticalReactionStyle = 'width:' . ( $options['vertical_reaction_shape'] != 'rectangle' ? $options['vertical_reaction_size'] : $options['vertical_reaction_width'] ) . 'px;height:' . $vertical_line_height . 'px;';
							$verticalDeliciousRadius = '';
							if ( $options['vertical_reaction_shape'] == 'round' ) {
								$verticalReactionStyle .= 'border-radius:999px;';
								$verticalDeliciousRadius = 'border-radius:999px;';
							} elseif ( isset( $options['vertical_border_radius'] ) && $options['vertical_border_radius'] != '' ) {
								$verticalReactionStyle .= 'border-radius:' . $options['vertical_border_radius'] . 'px;';
							}
							?>
							var heateorRbVerticalReactionStyle = '<?php echo esc_js( $verticalReactionStyle ) ?>', heateorRbVerticalDeliciousRadius = '<?php echo esc_js( $verticalReactionStyle ) ?>';
							</script>
							<style type="text/css">
							<?php if ( $options['vertical_bg_color_default'] != '' ) {?>
								ul#heateor_rb_vertical_rearrange i.heateorRbInstagramBackground{background:<?php echo esc_html( $vertical_bg ) ?>!important;}
							<?php }
							if ( $options['vertical_bg_color_hover'] != '' ) { ?>
								ul#heateor_rb_vertical_rearrange i.heateorRbInstagramBackground:hover{background:<?php echo esc_html( $vertical_bg_hover ) ?>!important;}
							<?php } ?>
							.heateorRbVerticalReactionBackground{
								<?php if ( $vertical_bg ) { ?>
								background-color: <?php echo esc_html( $vertical_bg ) ?>;
								<?php }if ( $vertical_border_width) { ?>
								border-width: <?php echo esc_html( $vertical_border_width ) ?>px;
								border-style: solid;
								<?php } ?>
								border-color: <?php echo  $vertical_border_color ? esc_html( $vertical_border_color ) : 'transparent'; ?>;
							}
							.heateorRbVerticalReactionBackground:hover{
								<?php if ( $vertical_bg_hover ) { ?>
								background-color: <?php echo esc_html( $vertical_bg_hover ) ?>;
								<?php } if ( $vertical_border_width_hover ) { ?>
								border-width: <?php echo esc_html( $vertical_border_width_hover ) ?>px;
								border-style: solid;
								<?php } ?>
								border-color: <?php echo $vertical_border_color_hover ? esc_html( $vertical_border_color_hover ) : 'transparent'; ?>;
							}
							</style>
							<ul id="heateor_rb_vertical_rearrange">
								<?php
								if ( isset( $options['vertical_re_providers'] ) ) {
									foreach ( $options['vertical_re_providers'] as $rearrange ) {
										?>
										<li title="<?php echo esc_attr( ucfirst( str_replace( '_', ' ', $rearrange ) ) ) ?>" id="heateor_rb_re_vertical_<?php echo esc_attr( str_replace( array( ' ', '.' ), '_', $rearrange ) ) ?>" >
										<i style="display:block;<?php echo esc_js( $verticalReactionStyle ) ?>" class="heateorRbVerticalReactionBackground heateorRb<?php echo esc_attr( ucfirst( str_replace( array( '_', '.', ' ' ), '', $rearrange ) ) ) ?>Background"><div class="heateorRbReactionSvg heateorRb<?php echo esc_attr( ucfirst( str_replace( array( '_', '.', ' ' ), '', $rearrange ) ) ) ?>Svg" style="<?php echo esc_attr( $verticalDeliciousRadius ) ?>"></div></i>
										<input type="hidden" name="heateor_rb[vertical_re_providers][]" value="<?php echo esc_attr( $rearrange ) ?>">
										</li>
										<?php
									}
								}
								?>
							</ul>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_vertical_rearrange_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Drag the icons to rearrange in desired order', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<td colspan="2" class="selectReactionNetworks">
							<div style="clear:both"></div>
							<div style="width:100%; margin: 10px 0"><input type="text" onkeyup="heateorRbSearchReactionNetworks(this.value.trim())" placeholder="<?php _e( 'Search social network', 'reaction-buttons-by-heateor' ) ?>" class="search" /></div>
							<div style="clear:both"></div>
							<?php
							foreach ( $reaction_networks as $reaction_network ) {
								?>
								<div class="heateorRbVerticalReactionsContainer">
								<input id="heateor_rb_vertical_reaction_<?php echo esc_attr( $reaction_network ) ?>" type="checkbox" <?php echo isset( $options['vertical_re_providers'] ) && in_array( $reaction_network, $options['vertical_re_providers'] ) ? 'checked = "checked"' : '';?> value="<?php echo esc_attr( $reaction_network ) ?>" />
								<label for="heateor_rb_vertical_reaction_<?php echo esc_attr( $reaction_network ) ?>"><i style="display:block;width:18px;height:18px;" class="heateorRbReaction heateorRb<?php echo esc_attr( str_replace( array( '_', '.', ' ' ), '', ucfirst( $reaction_network ) ) ) ?>Background"><ss style="display:block;" class="heateorRbReactionSvg heateorRb<?php echo esc_attr( str_replace( array( '_', '.', ' ' ), '', ucfirst( $reaction_network ) ) ) ?>Svg"></ss></i></label>
								<label class="lblSocialNetwork" for="heateor_rb_vertical_reaction_<?php echo esc_attr( $reaction_network ) ?>"><?php echo esc_html( str_replace( '_', ' ', ucfirst( $reaction_network ) ) ) ?></label>
								</div>
								<?php
							}
							?>
							</td>
						</tr>
						
						<tr>
							<th>
							<label><?php _e( "Background Color", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_vertical_bg_color_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input style="width: 100px" name="heateor_rb[vertical_bg]" type="text" value="<?php echo isset( $options['vertical_bg'] ) ? esc_attr( $options['vertical_bg'] ) : '' ?>" />
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_vertical_bg_color_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify the color or hex code (example #cc78e0) for the background of vertical reaction bar. Leave empty for transparent. You can get the hex code of the required color from <a href="http://www.colorpicker.com/" target="_blank">this link</a>', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tr>
							<th>
							<label for="heateor_rb_alignment"><?php _e( "Horizontal alignment", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_alignment_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<select onchange="heateorRbToggleOffset(this.value)" id="heateor_rb_alignment" name="heateor_rb[alignment]">
								<option value="left" <?php echo isset( $options['alignment'] ) && $options['alignment'] == 'left' ? 'selected="selected"' : '' ?>><?php _e( 'Left', 'reaction-buttons-by-heateor' ) ?></option>
								<option value="right" <?php echo isset( $options['alignment'] ) && $options['alignment'] == 'right' ? 'selected="selected"' : '' ?>><?php _e( 'Right', 'reaction-buttons-by-heateor' ) ?></option>
							</select>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_alignment_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Horizontal alignment of the reaction interface', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tbody id="heateor_rb_left_offset_rows" <?php echo ( isset( $options['alignment'] ) && $options['alignment'] == 'left' ) ? '' : 'style="display: none"' ?>>
						<tr>
							<th>
							<label for="heateor_rb_left_offset"><?php _e( "Left offset", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_left_offset_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input style="width: 100px" id="heateor_rb_left_offset" name="heateor_rb[left_offset]" type="text" value="<?php echo isset( $options['left_offset'] ) ? esc_attr( $options['left_offset'] ) : '' ?>" />px
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_left_offset_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify a number. Increase in number will shift reaction interface towards right and decrease will shift it towards left. Number can be negative too.', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						</tbody>
						
						<tbody id="heateor_rb_right_offset_rows" <?php echo ( isset( $options['alignment'] ) && $options['alignment'] == 'right' ) ? '' : 'style="display: none"' ?>>
						<tr>
							<th>
							<label for="heateor_rb_right_offset"><?php _e( "Right offset", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_right_offset_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input style="width: 100px" id="heateor_rb_right_offset" name="heateor_rb[right_offset]" type="text" value="<?php echo isset( $options['right_offset'] ) ? esc_attr( $options['right_offset'] ) : '' ?>" />px
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_right_offset_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify a number. Increase in number will shift reaction interface towards left and decrease will shift it towards right. Number can be negative too.', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						</tbody>
						
						<tr>
							<th>
							<label for="heateor_rb_top_offset"><?php _e( "Top offset", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_top_offset_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input style="width: 100px" id="heateor_rb_top_offset" name="heateor_rb[top_offset]" type="text" value="<?php echo isset( $options['top_offset'] ) ? esc_attr( $options['top_offset'] ) : '' ?>" />px
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_top_offset_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify a number. Increase in number will shift reaction interface towards bottom and decrease will shift it towards top.', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tr>
							<th>
							<label><?php _e( "Placement", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_vertical_location_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_vertical_home" name="heateor_rb[vertical_home]" type="checkbox" <?php echo isset( $options['vertical_home'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_vertical_home"><?php _e( 'Homepage', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_vertical_post" name="heateor_rb[vertical_post]" type="checkbox" <?php echo isset( $options['vertical_post'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_vertical_post"><?php _e( 'Posts', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_vertical_page" name="heateor_rb[vertical_page]" type="checkbox" <?php echo isset( $options['vertical_page'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_vertical_page"><?php _e( 'Pages', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_vertical_excerpt" name="heateor_rb[vertical_excerpt]" type="checkbox" <?php echo isset( $options['vertical_excerpt'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_vertical_excerpt"><?php _e( 'Excerpts and Posts page', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_vertical_category" name="heateor_rb[vertical_category]" type="checkbox" <?php echo isset( $options['vertical_category'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_vertical_category"><?php _e( 'Category Archives', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<input id="heateor_rb_vertical_archive" name="heateor_rb[vertical_archive]" type="checkbox" <?php echo isset( $options['vertical_archive'] ) ? 'checked = "checked"' : '';?> value="1" />
							<label for="heateor_rb_vertical_archive"><?php _e( 'Archive Pages (Category, Tag, Author or Date based pages)', 'reaction-buttons-by-heateor' ) ?></label><br/>
							<?php
							if ( count( $post_types ) ) {
								foreach ( $post_types as $post_type ) {
									?>
									<input id="heateor_rb_vertical_<?php echo esc_attr( $post_type ) ?>" name="heateor_rb[vertical_<?php echo esc_attr( $post_type ) ?>]" type="checkbox" <?php echo isset( $options['vertical_' . $post_type] ) ? 'checked = "checked"' : '';?> value="1" />
									<label for="heateor_rb_vertical_<?php echo esc_attr( $post_type ) ?>"><?php echo esc_attr( ucfirst( $post_type ) ) . 's'; ?></label><br/>
									<?php
								}
							}

							if ( $this->is_bp_active ) {
								?>
								<input id="heateor_rb_vertical_bp_group" name="heateor_rb[vertical_bp_group]" type="checkbox" <?php echo isset( $options['vertical_bp_group'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_vertical_bp_group"><?php _e( 'BuddyPress group', 'reaction-buttons-by-heateor' ) ?></label><br/>
								<?php
							}

							if ( function_exists( 'is_bbpress' ) ) {
								?>
								<br/>
								<input id="heateor_rb_vertical_bb_forum" name="heateor_rb[vertical_bb_forum]" type="checkbox" <?php echo isset( $options['vertical_bb_forum'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_vertical_bb_forum"><?php _e( 'BBPress forum', 'reaction-buttons-by-heateor' ) ?></label>
								<br/>
								<input id="heateor_rb_vertical_bb_topic" name="heateor_rb[vertical_bb_topic]" type="checkbox" <?php echo isset( $options['vertical_bb_topic'] ) ? 'checked = "checked"' : '';?> value="1" />
								<label for="heateor_rb_vertical_bb_topic"><?php _e( 'BBPress topic', 'reaction-buttons-by-heateor' ) ?></label>
								<?php
							}
							?>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_vertical_location_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Specify the pages where you want to enable vertical Reaction interface', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_vertical_count_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'If enabled, reaction counts are displayed above reaction icons.', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_total_vertical_reactions_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'If enabled, total reactions will be displayed with the reaction icons', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_vmore_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'If enabled, "More" icon will be displayed after selected reaction icons which shows additional reaction networks in popup', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<img id="heateor_rb_mobile_reaction_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							<label for="heateor_rb_mobile_reaction"><?php _e( "Vertical floating bar responsiveness", 'reaction-buttons-by-heateor' ); ?></label>
							</th>
							<td>
							<input id="heateor_rb_mobile_reaction" name="heateor_rb[hide_mobile_reaction]" type="checkbox" <?php echo isset( $options['hide_mobile_reaction'] ) ? 'checked = "checked"' : '';?> value="1" /><label><?php echo sprintf( __( 'Display vertical interface only when screen is wider than %s pixels', 'reaction-buttons-by-heateor' ), '<input style="width:46px" name="heateor_rb[vertical_screen_width]" type="text" value="' . ( isset( $options['vertical_screen_width'] ) ? esc_attr( $options['vertical_screen_width'] ) : '' ) . '" />' ) ?></label>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_mobile_reaction_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Display vertical interface only when screen is wider than the width specified.', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<label for="heateor_rb_mobile_reaction_bottom"><?php _e( "Horizontal floating bar responsiveness", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_mobile_reaction_bottom_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_mobile_reaction_bottom" name="heateor_rb[bottom_mobile_reaction]" type="checkbox" <?php echo isset( $options['bottom_mobile_reaction'] ) ? 'checked = "checked"' : '';?> value="1" /><label><?php echo sprintf( __( 'Stick vertical floating interface horizontally at bottom only when screen is narrower than %s pixels', 'reaction-buttons-by-heateor' ), '<input style="width:46px" name="heateor_rb[horizontal_screen_width]" type="text" value="' . ( isset( $options['horizontal_screen_width'] ) ? esc_attr( $options['horizontal_screen_width'] ) : '' ) . '" />' ) ?></label>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_mobile_reaction_bottom_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Stick vertical floating interface horizontally at bottom only when screen is narrower than the width specified', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>

						<tbody id="heateor_rb_bottom_reaction_options" <?php echo isset( $options['bottom_mobile_reaction'] ) ? '' : 'style="display: none"'; ?>>
							<tr>
								<th>
								<label for="heateor_rb_mobile_reaction_position"><?php _e( "Horizontal floating bar position", 'reaction-buttons-by-heateor' ); ?></label>
								<img id="heateor_rb_mobile_reaction_position_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
								</th>
								<td>
								<input type="radio" id="bottom_reaction_position_radio_nonresponsive" <?php echo $options['bottom_reaction_position_radio'] == 'nonresponsive' ? 'checked' : ''; ?> name="heateor_rb[bottom_reaction_position_radio]" value="nonresponsive" /><label for="bottom_reaction_position_radio_nonresponsive"><?php echo sprintf( __( '%s pixels from %s', 'reaction-buttons-by-heateor' ), '<input id="heateor_rb_mobile_reaction_position" style="width:46px" name="heateor_rb[bottom_reaction_position]" type="text" value="' . ( isset( $options['bottom_reaction_position'] ) ? esc_attr( $options['bottom_reaction_position'] ) : '' ) . '" />', '<select style="width:63px" name="heateor_rb[bottom_reaction_alignment]"><option value="right" ' . ( ! isset( $options['bottom_reaction_alignment'] ) || $options['bottom_reaction_alignment'] == 'right' ? 'selected' : '' ) . '>right</option><option value="left" ' . ( isset( $options['bottom_reaction_alignment'] ) && $options['bottom_reaction_alignment'] == 'left' ? 'selected' : '' ) . '>left</option></select>' ) ?></label><br/>
								<input type="radio" id="bottom_reaction_position_radio_responsive" <?php echo $options['bottom_reaction_position_radio'] == 'responsive' ? 'checked' : ''; ?> name="heateor_rb[bottom_reaction_position_radio]" value="responsive" /><label for="bottom_reaction_position_radio_responsive"><?php _e( 'Auto-adjust according to screen width (responsive)', 'reaction-buttons-by-heateor' ); ?></label>
								</td>
							</tr>
							
							<tr class="heateor_rb_help_content" id="heateor_rb_mobile_reaction_position_help_cont">
								<td colspan="2">
								<div>
								<?php _e( 'Alignment of horizontal floating interface. Number can be negative too.', 'reaction-buttons-by-heateor' ) ?>
								</div>
								</td>
							</tr>
						</tbody>


						</tbody>
					</table>
					</div>
				</div>
				</div>
				<?php include 'reaction-buttons-for-wordpress-about.php'; ?>
			</div>

			<div class="menu_containt_div" id="tabs-4">
				<div class="clear"></div>
				<div class="heateor_rb_left_column">

				

				<div class="stuffbox">
					<h3><label><?php _e( 'Miscellaneous', 'reaction-buttons-by-heateor' ) ?></label></h3>
					<div class="inside">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
						

						<tr class="heateor_rb_help_content" id="heateor_rb_insta_bg_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Uses plain background for Instagram icon instead of multicolored background', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<label for="heateor_rb_js_when_needed"><?php _e( "Load Javascript only when needed", 'reaction-buttons-by-heateor' ) ?></label>
							<img id="heateor_rb_js_when_needed_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_js_when_needed" name="heateor_rb[js_when_needed]" type="checkbox" <?php echo isset( $options['js_when_needed'] ) ? 'checked = "checked"' : '';?> value="1" />
							</td>
						</tr>

						<tr class="heateor_rb_help_content" id="heateor_rb_js_when_needed_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Javascript file will be loaded only at the webpages where reaction icons have been integrated', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>

						<tr>
							<th>
							<label for="heateor_rb_delete_options"><?php _e( "Delete all the options on plugin deletion", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_delete_options_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_delete_options" name="heateor_rb[delete_options]" type="checkbox" <?php echo isset( $options['delete_options'] ) ? 'checked = "checked"' : '';?> value="1" />
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_delete_options_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'If enabled, plugin options will get deleted when plugin is deleted/uninstalled and you will need to reconfigure the options when you install the plugin next time.', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
					</table>
					</div>
				</div>

				<div class="stuffbox">
					<h3><label><?php _e( 'AMP', 'reaction-buttons-by-heateor' );?></label></h3>
					<div class="inside">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
						<tr>
							<th>
							<label for="heateor_rb_amp_enable"><?php _e( "Enable reaction on AMP pages", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_amp_enable_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<input id="heateor_rb_amp_enable" name="heateor_rb[amp_enable]" type="checkbox" <?php echo isset( $options['amp_enable'] ) ? 'checked = "checked"' : '';?> value="1" />
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_amp_enable_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'Enable this option to render reaction icons on AMP pages', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
					</table>
					</div>
				</div>

				<div class="stuffbox">
					<h3><label><?php _e( 'Custom CSS', 'reaction-buttons-by-heateor' );?></label></h3>
					<div class="inside">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
						<tr>
							<th>
							<label for="heateor_rb_custom_css"><?php _e( "Custom CSS", 'reaction-buttons-by-heateor' ); ?></label>
							<img id="heateor_rb_custom_css_help" class="heateor_rb_help_bubble" src="<?php echo esc_attr( plugins_url( '../../images/info.png', __FILE__ ) ) ?>" />
							</th>
							<td>
							<textarea rows="7" cols="63" id="heateor_rb_custom_css" name="heateor_rb[custom_css]"><?php echo isset( $options['custom_css'] ) ? esc_attr( $options['custom_css'] ) : '' ?></textarea>
							</td>
						</tr>
						
						<tr class="heateor_rb_help_content" id="heateor_rb_custom_css_help_cont">
							<td colspan="2">
							<div>
							<?php _e( 'You can specify any additional CSS rules (without &lt;style&gt; tag)', 'reaction-buttons-by-heateor' ) ?>
							</div>
							</td>
						</tr>
					</table>
					</div>
				</div>
							
				</div>
				<?php include 'reaction-buttons-for-wordpress-about.php'; ?>
			</div>

			<div class="menu_containt_div" id="tabs-6">
				<div class="clear"></div>
				<div class="heateor_rb_left_column">
				<div class="stuffbox">
					<h3><label><?php _e( 'Shortcode & Widget', 'reaction-buttons-by-heateor' );?></label></h3>
					<div class="inside" style="padding-left:7px">
						<p><a style="text-decoration:none" href="http://support.heateor.com/reaction-buttons-shortcode-and-widget" target="_blank"><?php _e( 'Reaction Buttons Shortcode & Widget', 'reaction-buttons-by-heateor' ) ?></a></p>
					</div>
				</div>
				</div>
				<?php include 'reaction-buttons-for-wordpress-about.php'; ?>
			</div>
			
			<div class="menu_containt_div" id="tabs-8">
				<div class="clear"></div>
				<div class="heateor_rb_left_column">
				<div class="stuffbox">
					<h3><label><?php _e( 'FAQ', 'reaction-buttons-by-heateor' ) ?></label></h3>
					<div class="inside faq" style="padding-left:8px">
						<p><strong><?php _e( 'Note', 'reaction-buttons-by-heateor' ) ?>:</strong><?php _e( 'Plugin will not work on local server. You should have an online website for the plugin to function properly.', 'reaction-buttons-by-heateor' ); ?></p>
						<p><a href="http://support.heateor.com/why-is-reactionr-not-showing-the-correct-image-title-and-other-meta-tags-content" target="_blank"><?php _e( 'Why is reactionr not showing the correct image, title and other content when reaction a webpage?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<a href="javascript:void(0)"><?php _e( 'Why is Facebook reaction count not working?', 'reaction-buttons-by-heateor' ); ?></a>
						<div><?php _e( 'Save Facebook App Id and Secret in the "Miscellaneous" section to track Facebook reactions', 'reaction-buttons-by-heateor' ); ?></div>
						<p><a href="http://support.heateor.com/how-to-customize-the-url-being-reactiond" target="_blank"><?php _e( 'How to Customize the Url being Shared?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<a href="javascript:void(0)"><?php _e( 'Why is Instagram icon redirecting to Instagram website?', 'reaction-buttons-by-heateor' ); ?></a>
						<div><?php _e( 'Instagram icon is there to send website visitors to the Instagram page of your choice. You can save the desired Instagram handle in "Instagram Username" option in "Standard Interface" and "Floating Interface" sections.', 'reaction-buttons-by-heateor' ); ?></div>
						<p>
						<a href="javascript:void(0)"><?php _e( 'Why are Twitter reactions not appearing even after registering at Twitcount.com?', 'reaction-buttons-by-heateor' ); ?></a>
						<div><?php _e( "It takes some time for their service to track the reactions made on Twitter from your website. If you still feel it's taking too long you can contact their support directly from their website.", 'reaction-buttons-by-heateor' ); ?></div>
						</p>
						<p><a href="https://www.heateor.com/recover-social-reaction-counts/" target="_blank"><?php _e('How to restore Social Share counts lost after moving my website to SSL/Https?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/how-to-integrate-google-analytics-with-reaction" target="_blank"><?php _e( 'How to integrate Google Analytics with reaction?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/color-reaction-icons-not-being-updated" target="_blank"><?php _e( 'Why the color of reaction icons is not being updated?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a style="text-decoration:none" href="https://www.heateor.com/facebook-comments-moderation" target="_blank"><?php _e( 'How to show recent Facebook Comments from all over the website in a widget?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a style="text-decoration:none" href="http://support.heateor.com/recover-facebook-comments-wordpress-moving-to-https-ssl/" target="_blank"><?php _e( 'How to recover the Facebook Comments lost after moving my website to SSL/Https?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/place-title-social-reaction-icons-row/" target="_blank"><?php _e( 'How to Place Title and Social Share Icons in the Same Row?', 'reaction-buttons-by-heateor' ) ?></a></p>
						
						<p><a href="http://support.heateor.com/how-can-i-disable-social-reaction-on-particular-pagepost/" target="_blank"><?php _e( 'How can I disable reaction on particular page/post?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/how-can-i-specify-minimum-reaction-count-for-reaction-networks/" target="_blank"><?php _e( 'How can I specify minimum reaction count for reaction networks?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/how-to-reaction-specific-page/" target="_blank"><?php _e( 'How to reaction specific page?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/how-to-customize-the-look-of-total-reaction-counts" target="_blank"><?php _e( 'How to customize the look of total reaction counts?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/how-to-customize-the-look-of-individual-reaction-counts" target="_blank"><?php _e( 'How to customize the look of individual reaction counts?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/how-to-show-whatsapp-icon-only-on-mobile-devices" target="_blank"><?php _e( 'How to show Whatsapp icon only on mobile devices?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/how-to-hide-arrow-after-floating-reaction-bar" target="_blank"><?php _e( 'How to hide arrow after floating reaction bar?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/why-is-reaction-count-not-getting-updated" target="_blank"><?php _e( 'Why is reaction count not getting updated?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/why-is-there-so-much-space-between-like-buttons" target="_blank"><?php _e( 'Why is there so much space between like buttons?', 'reaction-buttons-by-heateor' ) ?></a></p>
						<p><a href="http://support.heateor.com/why-is-floating-reaction-like-button-not-appearing-at-homepage" target="_blank"><?php _e( 'Why are floating reaction/like buttons not appearing at homepage?', 'reaction-buttons-by-heateor' ) ?></a></p>
					</div>
				</div>

				</div>
				<?php include 'reaction-buttons-for-wordpress-about.php'; ?>
			</div>
			
			<div class="heateor_rb_clear"></div>
			<p class="submit">
				<input style="margin-left:8px" type="submit" name="save" class="button button-primary" value="<?php _e( "Save Changes", 'reaction-buttons-by-heateor' ); ?>" />
			</p>
			<p>
				<?php
				echo esc_attr( sprintf( __( 'You can appreciate the effort put in this free plugin by rating it <a href="%s" target="_blank">here</a>', 'reaction-buttons-by-heateor' ), 'https://wordpress.org/support/view/plugin-reviews/reaction-buttons-for-wordpress' ) );
				?>
			</p>
			</form>

			<div class="stuffbox">
				<h3><label>Instagram Shoutout</label></h3>
				<div class="inside" style="padding-left:7px">
				<p><?php _e( 'If you can send (to hello@heateor.com) how this plugin is helping your business, we would be glad to shoutout on Instagram. You can also send any relevant hashtags and people to mention in the Instagram post.', 'reaction-buttons-by-heateor' ) ?></p>
				</div>
			</div>
		</div>
</div>
