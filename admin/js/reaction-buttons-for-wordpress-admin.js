var heateorRbReferrer = null, heateorRbReferrerVal = '', heateorRbReferrerTabId = '';
jQuery(document).ready(function() {
	heateorRbReferrer = jQuery('input[name=_wp_http_referer]'), heateorRbReferrerVal = jQuery('input[name=_wp_http_referer]').val(), heateorRbReferrerTabId = location.href.indexOf('#') > 0 ? location.href.substring(location.href.indexOf('#'), location.href.length) : '';
    if(heateorRbReferrerTabId){heateorRbSetReferrer(heateorRbReferrerTabId) }
    jQuery("#tabs").tabs(), jQuery("#heateor_rb_login_redirection_column").find("input[type=radio]").click(function() {
        jQuery(this).attr("id") && "heateor_rb_login_redirection_custom" == jQuery(this).attr("id") ? jQuery("#heateor_rb_login_redirection_url").css("display", "block") : jQuery("#heateor_rb_login_redirection_url").css("display", "none")
    }), jQuery(".heateor_rb_help_bubble").attr("title", heateorRbHelpBubbleTitle), jQuery(".heateor_rb_help_bubble").click(function() {
        jQuery("#" + jQuery(this).attr("id") + "_cont").toggle(500)
    })
    jQuery('#tabs ul a').click(function(){
    	heateorRbSetReferrer(jQuery(this).attr('href'));
    });
});
function heateorRbSetReferrer(href){
	jQuery(heateorRbReferrer).val( heateorRbReferrerVal.substring(0, heateorRbReferrerVal.indexOf('#') > 0 ? heateorRbReferrerVal.indexOf('#') : heateorRbReferrerVal.length) + href );
}
jQuery("html, body").animate({ scrollTop: 0 });