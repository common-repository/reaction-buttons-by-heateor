"function" != typeof String.prototype.trim && (String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, "")
})

function heateorRbCapitaliseFirstLetter(e) {
    return e.charAt(0).toUpperCase() + e.slice(1)
}

/**
 * Search reaction services
 */
function heateorRbSearchReactionNetworks(val) {
    jQuery('td.selectReactionNetworks label.lblSocialNetwork').each(function(){
        if (jQuery(this).text().toLowerCase().indexOf(val.toLowerCase()) != -1) {
            jQuery(this).parent().css('display', 'block');
        } else {
            jQuery(this).parent().css('display', 'none');
        }
    });
}

function heateorRbUpdateReactionPreview(e, property, defaultVal, targetId) {
    if(!e){
        e = defaultVal;
    }
    jQuery('#' + targetId).css(property, e);
}

function heateorRbUpdateReactionPreviewHover(e, property, targetId) {
    var val = jQuery(e).val().trim();
    if(!val){
        jQuery('#' + targetId).hover(function(){
            jQuery(this).css(property, val);
        });
    }
}

function heateorRbHorizontalReactionOptionsToggle(e) {
    jQuery(e).is(":checked") ? jQuery("#heateor_rb_horizontal_reaction_options").css("display", "table-row-group") : jQuery("#heateor_rb_horizontal_reaction_options").css("display", "none")
}

function heateorRbVerticalReactionOptionsToggle(e) {
    jQuery(e).is(":checked") ? jQuery("#heateor_rb_vertical_reaction_options").css("display", "table-row-group") : jQuery("#heateor_rb_vertical_reaction_options").css("display", "none")
}

function heateorRbToggleOffset(e) {
    var t = "left" == e ? "right" : "left";
    jQuery("#heateor_rb_" + e + "_offset_rows").css("display", "table-row-group"), jQuery("#heateor_rb_" + t + "_offset_rows").css("display", "none")
}

function heateorRbIncrement(e, t, r, a, i) {
    var h, s, c = !1,
        _ = a;
    s = function() {
        "add" == t ? r.value++ : "subtract" == t && r.value > 16 && r.value--, h = setTimeout(s, _), _ > 20 && (_ *= i), c || (document.onmouseup = function() {
            clearTimeout(h), document.onmouseup = null, c = !1, _ = a
        }, c = !0)
    }, e.onmousedown = s
}

function heateorRbReactionHorizontalPreview() {
    var tempBorderWidth = heateorRbBorderWidth ? heateorRbBorderWidth : '0px';
    if("rectangle" != tempHorShape){
        jQuery("#heateor_rb_preview").css({
            borderRadius: "round" == tempHorShape ? "999px" : heateorRbReactionBorderRadius ? heateorRbReactionBorderRadius : '0px',
            height: tempHorSize,
            width: tempHorSize,
            backgroundColor: heateorRbReactionBg,
            borderWidth: tempBorderWidth,
            borderColor: heateorRbBorderColor ? heateorRbBorderColor : 'transparent',
            borderStyle: 'solid',
        });
        tempHorSize = parseInt(tempHorSize);
        jQuery('.heateorRbCounterPreviewRight,.heateorRbCounterPreviewLeft').css({
            height: ( tempHorSize + 2*parseInt(tempBorderWidth) ) + 'px',
            lineHeight: ( tempHorSize + 2*parseInt(tempBorderWidth) ) + 'px'
        });
        jQuery('.heateorRbCounterPreviewInnerright,.heateorRbCounterPreviewInnerleft').css("lineHeight", tempHorSize + 'px');
        jQuery('.heateorRbCounterPreviewInnertop').css("lineHeight", (tempHorSize*38/100) + "px");
        jQuery('.heateorRbCounterPreviewInnerbottom').css("lineHeight", (tempHorSize*19/100) + "px");
        jQuery('.heateorRbCounterPreviewTop,.heateorRbCounterPreviewBottom').css({
            width: 60 + 2*parseInt(tempBorderWidth) + tempHorSize,
        });
    }else{
        jQuery("#heateor_rb_preview").css({
            borderRadius: heateorRbReactionBorderRadius ? heateorRbReactionBorderRadius : '0px',
            height: tempHorHeight,
            width: tempHorWidth,
            backgroundColor: heateorRbReactionBg,
            borderWidth: tempBorderWidth,
            borderColor: heateorRbBorderColor ? heateorRbBorderColor : 'transparent',
            borderStyle: 'solid'
        });
        jQuery('.heateorRbCounterPreviewRight,.heateorRbCounterPreviewLeft').css({
            height: ( parseInt(tempHorHeight) + 2*parseInt(tempBorderWidth) ) + 'px',
            lineHeight: ( parseInt(tempHorHeight) + 2*parseInt(tempBorderWidth) ) + 'px',
        });
        jQuery('.heateorRbCounterPreviewInnerright,.heateorRbCounterPreviewInnerleft').css('lineHeight', tempHorHeight + 'px');
        jQuery('.heateorRbCounterPreviewInnertop').css('lineHeight', (tempHorHeight*38/100) + 'px');
        jQuery('.heateorRbCounterPreviewInnerbottom').css('lineHeight', (tempHorHeight*19/100) + 'px');
        jQuery('.heateorRbCounterPreviewTop,.heateorRbCounterPreviewBottom').css({
            width: 60 + 2*parseInt(tempBorderWidth) + parseInt(tempHorWidth),
        });
    }

    jQuery("#heateor_rb_preview_message").css("display", "block")
}

function heateorRbReactionVerticalPreview() {
    var tempVerticalBorderWidth = heateorRbVerticalBorderWidth ? heateorRbVerticalBorderWidth : '0px';
    if("rectangle" != tempVerticalShape){
        jQuery("#heateor_rb_vertical_preview").css({
            borderRadius: "round" == tempVerticalShape ? "999px" : heateorRbVerticalBorderRadius ? heateorRbVerticalBorderRadius : '0px',
            height: tempVerticalSize,
            width: tempVerticalSize,
            backgroundColor: heateorRbVerticalReactionBg,
            borderWidth: tempVerticalBorderWidth,
            borderColor: heateorRbVerticalBorderColor ? heateorRbVerticalBorderColor : 'transparent',
            borderStyle: 'solid',
        });
        jQuery('.heateorRbCounterVerticalPreviewRight,.heateorRbCounterVerticalPreviewLeft').css({
            height: ( parseInt(tempVerticalSize) + 2*parseInt(tempVerticalBorderWidth) ) + 'px',
            lineHeight: ( parseInt(tempVerticalSize) + 2*parseInt(tempVerticalBorderWidth) ) + 'px',
        });
        jQuery('.heateorRbCounterVerticalPreviewInnerright,.heateorRbCounterVerticalPreviewInnerleft').css('lineHeight', tempVerticalSize + 'px');
        jQuery('.heateorRbCounterVerticalPreviewInnertop').css('lineHeight', (tempVerticalSize*38/100) + 'px');
        jQuery('.heateorRbCounterVerticalPreviewInnerbottom').css('lineHeight', (tempVerticalSize*19/100) + 'px');
        jQuery('.heateorRbCounterVerticalPreviewTop,.heateorRbCounterVerticalPreviewBottom').css({
            width: 60 + 2*parseInt(tempVerticalBorderWidth) + parseInt(tempVerticalSize)
        });
    }else{
        jQuery("#heateor_rb_vertical_preview").css({
            borderRadius: heateorRbVerticalBorderRadius ? heateorRbVerticalBorderRadius : '0px',
            height: tempVerticalHeight,
            width: tempVerticalWidth,
            backgroundColor: heateorRbVerticalReactionBg,
            borderWidth: tempVerticalBorderWidth,
            borderColor: heateorRbVerticalBorderColor ? heateorRbVerticalBorderColor : 'transparent',
            borderStyle: 'solid'
        });
        jQuery('.heateorRbCounterVerticalPreviewRight,.heateorRbCounterVerticalPreviewLeft').css({
            height: ( parseInt(tempVerticalHeight) + 2*parseInt(tempVerticalBorderWidth) ) + 'px',
            lineHeight: ( parseInt(tempVerticalHeight) + 2*parseInt(tempVerticalBorderWidth) ) + 'px',
        });
        jQuery('.heateorRbCounterVerticalPreviewInnerright,.heateorRbCounterVerticalPreviewInnerleft').css('lineHeight', tempVerticalHeight + 'px');
        jQuery('.heateorRbCounterVerticalPreviewInnertop').css('lineHeight', (tempVerticalHeight*38/100) + 'px');
        jQuery('.heateorRbCounterVerticalPreviewInnerbottom').css('lineHeight', (tempVerticalHeight*19/100) + 'px');
        jQuery('.heateorRbCounterVerticalPreviewTop,.heateorRbCounterVerticalPreviewBottom').css({
            width: 60 + 2*parseInt(tempVerticalBorderWidth) + parseInt(tempVerticalWidth),
        });
    }
    jQuery("#heateor_rb_vertical_preview_message").css("display", "block")
}

function heateorRbCounterPreview(val){
    if(val){
        jQuery('input[name="heateor_rb[horizontal_counter_position]"]').each(function(){
            if(jQuery(this).val().indexOf('inner') == -1){
                var property = 'visibility', value = 'visible', inverseValue = 'hidden';
                jQuery('#horizontal_svg').css({
                    'width': '100%',
                    'height':'100%'
                });
            }else{
                var property = 'display', value = 'block', inverseValue = 'none';
            }
            if(jQuery(this).val() == val){
               jQuery('.heateorRbCounterPreview' + heateorRbCapitaliseFirstLetter(val.replace('_',''))).css(property, value); 
            }else{
                jQuery('.heateorRbCounterPreview' + heateorRbCapitaliseFirstLetter(jQuery(this).val().replace('_',''))).css(property, inverseValue);
            }
        });

        if(val == 'inner_left' || val == 'inner_right'){
            jQuery('#horizontal_svg').css({
                'width': '50%',
                'height':'100%'
            });
        }else if(val == 'inner_top' || val == 'inner_bottom'){
            jQuery('#horizontal_svg').css({
                'width': '100%',
                'height':'70%'
            });
        }
    }
}

function heateorRbVerticalCounterPreview(val){
    if(val){
        jQuery('input[name="heateor_rb[vertical_counter_position]"]').each(function(){
            if(jQuery(this).val().indexOf('inner') == -1){
                var property = 'visibility', value = 'visible', inverseValue = 'hidden';
                jQuery('#vertical_svg').css({
                    'width': '100%',
                    'height':'100%'
                });
            }else{
                var property = 'display', value = 'block', inverseValue = 'none';
            }
            if(jQuery(this).val() == val){
               jQuery('.heateorRbCounterVerticalPreview' + heateorRbCapitaliseFirstLetter(val.replace('_',''))).css(property, value); 
            }else{
                jQuery('.heateorRbCounterVerticalPreview' + heateorRbCapitaliseFirstLetter(jQuery(this).val().replace('_',''))).css(property, inverseValue);
            }
            if(val == 'inner_left' || val == 'inner_right'){
                jQuery('#vertical_svg').css({
                    'width': '50%',
                    'height':'100%'
                });
            }else if(val == 'inner_top' || val == 'inner_bottom'){
                jQuery('#vertical_svg').css({
                    'width': '100%',
                    'height':'70%'
                });
            }
        });
    }
}

function heateor_rb_toggle_fb_reaction_count_options() {
    if(heateorRbHorizontalFacebookShareEnabled || heateorRbVerticalFacebookShareEnabled){
        jQuery('#heateor_rb_fb_reaction_count_options').css('display', 'block');
    }else{
        jQuery('#heateor_rb_fb_reaction_count_options').css('display', 'none');
    }
    if(((heateorRbHorizontalFacebookShareEnabled && (heateorRbHorizontalReactions || heateorRbHorizontalTotalReactions)) || (heateorRbVerticalFacebookShareEnabled && (heateorRbVerticalReactions || heateorRbVerticalTotalReactions))) && heateorRbFacebookIDSecretNotSaved){
        jQuery('.heateor_rb_fb_reaction_count_msg').css('display', 'table-row-group');
    }else{
        jQuery('.heateor_rb_fb_reaction_count_msg').css('display', 'none');
    }
}

jQuery(document).ready(function() {
    // instagram username option
    jQuery('input#heateor_rb_instagram').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_rb_instagram_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_rb_instagram_options').css('display', 'none');
        }
    });
    jQuery('input#heateor_rb_vertical_reaction_instagram').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_rb_vertical_instagram_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_rb_vertical_instagram_options').css('display', 'none');
        }
    });
    // youtube url option
    jQuery('input#heateor_rb_youtube').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_rb_youtube_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_rb_youtube_options').css('display', 'none');
        }
    });
    jQuery('input#heateor_rb_vertical_reaction_youtube').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_rb_vertical_youtube_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_rb_vertical_youtube_options').css('display', 'none');
        }
    });
    // facebook reaction count option
    jQuery('input#heateor_rb_facebook').click(function(){
        if(jQuery(this).is(':checked')){
            heateorRbHorizontalFacebookShareEnabled = true;
        }else{
            heateorRbHorizontalFacebookShareEnabled = false;
        }
        heateor_rb_toggle_fb_reaction_count_options();
    });
    jQuery('input#heateor_rb_vertical_reaction_facebook').click(function(){
        if(jQuery(this).is(':checked')){
            heateorRbVerticalFacebookShareEnabled = true;
        }else{
            heateorRbVerticalFacebookShareEnabled = false;
        }
        heateor_rb_toggle_fb_reaction_count_options();
    });
    // Twitter reaction count options
    jQuery('input#heateor_rb_vertical_newreactioncounts').click(function(){
        jQuery('#heateor_rb_newreactioncounts').attr('checked', 'checked');
    });
    jQuery('input#heateor_rb_vertical_openreactioncount').click(function(){
        jQuery('#heateor_rb_openreactioncount').attr('checked', 'checked');
    });
    jQuery('input#heateor_rb_newreactioncounts').click(function(){
        jQuery('#heateor_rb_vertical_newreactioncounts').attr('checked', 'checked');
    });
    jQuery('input#heateor_rb_openreactioncount').click(function(){
        jQuery('#heateor_rb_vertical_openreactioncount').attr('checked', 'checked');
    });
    jQuery('input#heateor_rb_counts').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_rb_twitter_reaction_count').css('display', 'table-row');
        }else{
            jQuery('#heateor_rb_twitter_reaction_count').css('display', 'none');
        }
    });
    jQuery('input#heateor_rb_vertical_counts').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_rb_twitter_vertical_reaction_count').css('display', 'table-row');
        }else{
            jQuery('#heateor_rb_twitter_vertical_reaction_count').css('display', 'none');
        }
    });
    jQuery('input[name="heateor_rb[horizontal_reaction_shape]"]').click(function(){
        // toggle height, width options
        if(jQuery(this).val() == 'rectangle'){
            jQuery('#heateor_rb_rectangle_options').css('display', 'table-row-group');
            jQuery('#heateor_rb_size_options').css('display', 'none');
        }else{
            jQuery('#heateor_rb_rectangle_options').css('display', 'none');
            jQuery('#heateor_rb_size_options').css('display', 'table-row-group');
        }

        // toggle border radius option
        if(jQuery(this).val() == 'round'){
            jQuery('#heateor_rb_border_radius_options').css('display', 'none');
        }else{
            jQuery('#heateor_rb_border_radius_options').css('display', 'table-row-group');
        }
    });
    jQuery('input#heateor_rb_mobile_reaction_bottom').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_rb_bottom_reaction_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_rb_bottom_reaction_options').css('display', 'none');
        }
    });
    jQuery('input[name="heateor_rb[vertical_reaction_shape]"]').click(function(){
        // toggle height, width options
        if(jQuery(this).val() == 'rectangle'){
            jQuery('#heateor_rb_vertical_rectangle_options').css('display', 'table-row-group');
            jQuery('#heateor_rb_vertical_size_options').css('display', 'none');
        }else{
            jQuery('#heateor_rb_vertical_rectangle_options').css('display', 'none');
            jQuery('#heateor_rb_vertical_size_options').css('display', 'table-row-group');
        }

        // toggle border radius option
        if(jQuery(this).val() == 'round'){
            jQuery('#heateor_rb_vertical_border_radius_options').css('display', 'none');
        }else{
            jQuery('#heateor_rb_vertical_border_radius_options').css('display', 'table-row-group');
        }
    });
    jQuery("#heateor_rb_rearrange, #heateor_rb_vertical_rearrange").sortable(), jQuery(".heateorRbStandardReactionsContainer input").click(function() {
        jQuery(this).is(":checked") ? jQuery("#heateor_rb_rearrange").append('<li title="' + jQuery(this).val().replace(/_/g, " ") + '" id="heateor_rb_re_horizontal_' + jQuery(this).val().replace(/[. ]/g, "_") + '" ><i style="display:block;' + heateorRbHorReactionStyle + '" class="heateorRbReactionBackground heateorRb' + heateorRbCapitaliseFirstLetter(jQuery(this).val().replace(/[_. ]/g, "")) + 'Background"><div class="heateorRbReactionSvg heateorRb' + heateorRbCapitaliseFirstLetter(jQuery(this).val().replace(/[_. ]/g, "")) + 'Svg" style="' + heateorRbHorDeliciousRadius + '"></div></i><input type="hidden" name="heateor_rb[horizontal_re_providers][]" value="' + jQuery(this).val() + '"></li>') : jQuery("#heateor_rb_re_horizontal_" + jQuery(this).val().replace(/[. ]/g, "_")).remove()
    }), jQuery(".heateorRbVerticalReactionsContainer input").click(function() {
        jQuery(this).is(":checked") ? jQuery("#heateor_rb_vertical_rearrange").append('<li title="' + jQuery(this).val().replace(/_/g, " ") + '" id="heateor_rb_re_vertical_' + jQuery(this).val().replace(/[. ]/g, "_") + '" ><i style="display:block;' + heateorRbVerticalReactionStyle + '" class="heateorRbVerticalReactionBackground heateorRb' + heateorRbCapitaliseFirstLetter(jQuery(this).val().replace(/[_. ]/g, "")) + 'Background"><div class="heateorRbReactionSvg heateorRb' + heateorRbCapitaliseFirstLetter(jQuery(this).val().replace(/[_. ]/g, "")) + 'Svg" style="' + heateorRbVerticalDeliciousRadius + '"></div></i><input type="hidden" name="heateor_rb[vertical_re_providers][]" value="' + jQuery(this).val() + '"></li>') : jQuery("#heateor_rb_re_vertical_" + jQuery(this).val().replace(/[. ]/g, "_")).remove()
    }), jQuery("#heateor_rb_target_url_column").find("input[type=radio]").click(function() {
        jQuery(this).attr("id") && "heateor_rb_target_url_custom" == jQuery(this).attr("id") ? jQuery("#heateor_rb_target_url_custom_url").css("display", "block") : jQuery("#heateor_rb_target_url_custom_url").css("display", "none")
    }), jQuery("#heateor_rb_vertical_target_url_column").find("input[type=radio]").click(function() {
        jQuery(this).attr("id") && "heateor_rb_vertical_target_url_custom" == jQuery(this).attr("id") ? jQuery("#heateor_rb_vertical_target_url_custom_url").css("display", "block") : jQuery("#heateor_rb_vertical_target_url_custom_url").css("display", "none")
    }), jQuery("#heateor_rb_target_url_custom").is(":checked") ? jQuery("#heateor_rb_target_url_custom_url").css("display", "block") : jQuery("#heateor_rb_target_url_custom_url").css("display", "none"), jQuery("#heateor_rb_vertical_target_url_custom").is(":checked") ? jQuery("#heateor_rb_vertical_target_url_custom_url").css("display", "block") : jQuery("#heateor_rb_vertical_target_url_custom_url").css("display", "none")
})