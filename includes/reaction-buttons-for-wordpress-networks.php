<?php

/**
 * The file contains the class defining reaction networks and their reactionr urls
 *
 * @since      1.0
 *
 */

/**
 * This class defines reaction networks and their reactionr urls
 *
 * @since      1.0
 *
 */
class Reaction_Buttons_For_Wordpress_Reaction_Networks {
	/**
	 * Options saved in database
	 *
	 * @since    1.0
	 */
	private $options;

	/**
	 * Constructor
	 *
	 * @since    1.0
	 */
	public function __construct( $options ) {

		$this->options = $options;

	}

	/**
	 * Supported Social reaction networks
	 *
	 * @since    1.0
	 */
	private $reaction_networks = array(
		
		'angry' => '<a alt="%title%" Title="%title%" onclick=\'heateorRbTrackEmojiClicks(this, "angry")\' rel="nofollow noopener" target="_blank" style="font-size:24px!important;box-shadow:none;display:inline-block;vertical-align:middle;"><span class="heateor_rb_svg heateor_rb_s__default heateor_rb_s_angry" style="%style%border-radius: 4px;display: inline-block!important;opacity: 1;float: none;font-size: 32px!important;border: 0;box-shadow: none;display: inline-block;font-size: 16px;padding: 0 4px;vertical-align: middle;display: inline;line-height: 16px;background-repeat: repeat;overflow: hidden;padding:0;cursor:pointer;box-sizing:content-box"><svg xmlns="http://www.w3.org/2000/svg" style="%inner_style%" width="100%" height="100%" viewBox="0 0 64 64" enable-background="new 0 0 64 64"><path d="m41 49.7c-5.8-4.8-12.2-4.8-18 0-.7.6-1.3-.4-.8-1.3 1.8-3.4 5.3-6.5 9.8-6.5s8.1 3.1 9.8 6.5c.5.8-.1 1.8-.8 1.3" fill="%logo_color%"></path><path d="m10.2 24.9c-1.5 4.7.6 10 5.3 12.1 4.6 2.2 10 .5 12.7-3.7l-6.9-7.7-11.1-.7" fill="#fff" class="heateor_rb_no_fill"></path><g fill="%logo_color%"><path d="m14.2 25.8c-1.4 2.9-.1 6.4 2.8 7.7 2.9 1.4 6.4.1 7.7-2.8 1-1.9-9.6-6.8-10.5-4.9"></path><path d="m10.2 24.9c1.6-1 3.5-1.5 5.4-1.5 1.9 0 3.8.5 5.6 1.3 1.7.8 3.3 2 4.6 3.4 1.2 1.5 2.2 3.2 2.4 5.1-1.3-1.3-2.6-2.4-4-3.4-1.4-1-2.8-1.8-4.2-2.4-1.5-.7-3-1.2-4.6-1.7-1.8-.3-3.4-.6-5.2-.8"></path></g><path d="m53.8 24.9c1.5 4.7-.6 10-5.3 12.1-4.6 2.2-10 .5-12.7-3.7l6.9-7.7 11.1-.7" fill="#fff" class="heateor_rb_no_fill"></path><g fill="%logo_color%"><path d="m49.8 25.8c1.4 2.9.1 6.4-2.8 7.7-2.9 1.4-6.4.1-7.7-2.8-1-1.9 9.6-6.8 10.5-4.9"></path><path d="m53.8 24.9c-1.6-1-3.5-1.5-5.4-1.5-1.9 0-3.8.5-5.6 1.3-1.7.8-3.3 2-4.6 3.4-1.2 1.5-2.2 3.2-2.4 5.1 1.3-1.3 2.6-2.4 4-3.4 1.4-1 2.8-1.8 4.2-2.4 1.5-.7 3-1.2 4.6-1.7 1.8-.3 3.4-.6 5.2-.8"></path></g></svg></span></a>',
		'wow' => '<a alt="%title%" Title="%title%" onclick=\'heateorRbTrackEmojiClicks(this, "wow")\' rel="nofollow noopener" target="_blank" style="font-size:24px!important;box-shadow:none;display:inline-block;vertical-align:middle;"><span class="heateor_rb_svg heateor_rb_s__default heateor_rb_s_facebook" style="%style%border-radius: 4px;display: inline-block!important;opacity: 1;float: none;font-size: 32px!important;border: 0;box-shadow: none;display: inline-block;font-size: 16px;padding: 0 4px;vertical-align: middle;display: inline;line-height: 16px;background-repeat: repeat;overflow: hidden;padding: 0;cursor:pointer;box-sizing:content-box"><svg xmlns="http://www.w3.org/2000/svg" style="%inner_style%" width="100%" height="100%" viewBox="0 0 64 64" enable-background="new 0 0 64 64"><circle cx="19" cy="29" r="11" fill="%logo_color%"></circle><path d="m24 29c0 2.8-2.2 5-5 5-2.8 0-5-2.2-5-5s2.2-5 5-5c2.8 0 5 2.2 5 5" fill="%logo_color%"></path><path d="m56 29c0 6.1-4.9 11-11 11-6.1 0-11-4.9-11-11 0-6.1 4.9-11 11-11 6.1 0 11 4.9 11 11" fill="%logo_color%"></path><path d="m50 29c0 2.8-2.2 5-5 5-2.8 0-5-2.2-5-5s2.2-5 5-5c2.8 0 5 2.2 5 5" fill="%logo_color%"></path><g fill="%logo_color%"><path d="m50.2 15.8c-3.2-2.7-7.5-3.9-11.7-3.1-.6.1-1.1-2-.4-2.2 4.8-.9 9.8.5 13.5 3.6.6.5-1 2.1-1.4 1.7"></path><path d="m25.5 12.5c-4.2-.7-8.5.4-11.7 3.1-.4.4-2-1.2-1.4-1.7 3.7-3.2 8.7-4.5 13.5-3.6.7.2.2 2.3-.4 2.2"></path></g><circle cx="32" cy="49" r="9" fill="%logo_color%"></circle><path d="m26 46c1.2-2.4 3.4-4 6-4 2.6 0 4.8 1.6 6 4h-12" fill="%logo_color%"></path></svg></span></a>',
		'love' => '<a alt="%title%" Title="%title%" onclick=\'heateorRbTrackEmojiClicks(this, "love")\' rel="nofollow noopener" target="_blank" style="font-size:24px!important;box-shadow:none;display:inline-block;vertical-align:middle;"><span class="heateor_rb_svg heateor_rb_s__default heateor_rb_s_facebook" style="%style%border-radius: 4px;display: inline-block!important;opacity: 1;float: none;font-size: 32px!important;border: 0;box-shadow: none;display: inline-block;font-size: 16px;padding: 0 4px;vertical-align: middle;display: inline;line-height: 16px;background-repeat: repeat;overflow: hidden;padding: 0;cursor:pointer;box-sizing:content-box"><svg xmlns="http://www.w3.org/2000/svg" style="%inner_style%" width="100%" height="100%" viewBox="0 0 64 64" enable-background="new 0 0 64 64"><g fill="#f46767" class="heateor_rb_no_fill"><path d="m61.8 13.2c-.5-2.7-2-4.9-4.5-5.6-2.7-.7-5.1.3-7.4 2.7-1.3-3.6-3.3-6.3-6.5-7.7-3.2-1.4-6.4-.4-8.4 2.1-2.1 2.6-2.9 6.7-.7 12 2.1 5 11.4 15 11.7 15.3.4-.2 10.8-6.7 13.3-9.9 2.5-3.1 3-6.2 2.5-8.9"></path><path d="m29 4.7c-2-2.5-5.2-3.5-8.4-2.1-3.2 1.4-5.2 4.1-6.5 7.7-2.4-2.3-4.8-3.4-7.5-2.6-2.4.7-4 2.9-4.5 5.6-.5 2.6.1 5.8 2.5 8.9 2.6 3.1 13 9.6 13.4 9.8.3-.3 9.6-10.3 11.7-15.3 2.2-5.3 1.4-9.3-.7-12"></path></g><path d="m49 38.1c0-.8-.5-1.8-1.8-2.1-3.5-.7-8.6-1.3-15.2-1.3-6.6 0-11.7.7-15.2 1.3-1.4.3-1.8 1.3-1.8 2.1 0 7.3 5.6 14.6 17 14.6 11.4-.1 17-7.4 17-14.6" fill="%logo_color%"></path><path d="m44.7 38.3c-2.2-.4-6.8-1-12.7-1-5.9 0-10.5.6-12.7 1-1.3.2-1.4.7-1.3 1.5.1.4.1 1 .3 1.6.1.6.3.9 1.3.8 1.9-.2 23-.2 24.9 0 1 .1 1.1-.2 1.3-.8.1-.6.2-1.1.3-1.6 0-.8-.1-1.3-1.4-1.5" fill="%logo_color%"></path></svg></span></a>',
		'sad' => '<a alt="%title%" Title="%title%" onclick=\'heateorRbTrackEmojiClicks(this, "sad")\' rel="nofollow noopener" target="_blank" style="font-size:24px!important;box-shadow:none;display:inline-block;vertical-align:middle;"><span class="heateor_rb_svg heateor_rb_s__default heateor_rb_s_facebook" style="%style%border-radius: 4px;display: inline-block!important;opacity: 1;float: none;font-size: 32px!important;border: 0;box-shadow: none;display: inline-block;font-size: 16px;padding: 0 4px;vertical-align: middle;display: inline;line-height: 16px;background-repeat: repeat;overflow: hidden;padding: 0;cursor:pointer;box-sizing:content-box"><svg xmlns="http://www.w3.org/2000/svg" style="%inner_style%" width="100%" height="100%" viewBox="0 0 64 64" enable-background="new 0 0 64 64"><g fill="#65b1ef"><ellipse class="heateor_rb_no_fill" cx="17.5" cy="59.9" rx="12.5" ry="1.5"></ellipse><ellipse class="heateor_rb_no_fill" cx="44" cy="60.2" rx="18" ry="1.8"></ellipse></g><path d="m44.7 46c-1.4-3.6-4.8-6-12.7-6-8 0-11.3 2.4-12.7 6-.7 1.9.3 5 .3 5 1.3 3.9 1.1 5 12.4 5 11.3 0 11.1-1.1 12.4-5 0 0 1.1-3.1.3-5" fill="%logo_color%"></path><path d="m41 45c.1-.3 0-.6-.2-.8 0 0-2-2.2-8.8-2.2-6.8 0-8.8 2.2-8.8 2.2-.2.1-.2.5-.2.8l.2.6c.1.3.3.5.5.5h16.6c.2 0 .5-.2.5-.5l.2-.6" fill="%logo_color%"></path><g fill="#65b1ef"><path class="heateor_rb_no_fill" d="m44.5 60.5c2.3 0 4.6 0 6.8 0 8.2-9.9-1.5-20 .9-29.8-2.3 0-4.6 2.5-6.8 2.5-3.2 9.5 7.3 17.4-.9 27.3"></path><path class="heateor_rb_no_fill" d="m19.5 60.5c-2.3 0-4.6 0-6.8 0-8.2-9.9 1.5-20-.9-29.8 2.3 0 4.6 2.5 6.8 2.5 3.2 9.5-7.3 17.4.9 27.3"></path></g><g fill="%logo_color%"><path d="m40.7 18.3c3 3 7.2 4.5 11.4 4.1.6-.1.9 2.1.2 2.2-4.9.4-9.7-1.3-13.1-4.8-.6-.5 1.1-1.9 1.5-1.5"></path><path d="m12 22.4c4.2.4 8.4-1.1 11.4-4.1.4-.4 2.1 1 1.6 1.5-3.4 3.5-8.3 5.2-13.1 4.8-.9 0-.5-2.2.1-2.2"></path></g><g fill="%logo_color%"><path d="m35.9 30.3c4.2 8 12.7 8 16.9 0 .2-.4-.3-.6-1-1-4.2 3.3-11.1 3-14.9 0-.6.4-1.2.6-1 1"></path><path d="m11.2 30.3c4.2 8 12.7 8 16.9 0 .2-.4-.3-.6-1-1-4.2 3.3-11.1 3-14.9 0-.7.4-1.2.6-1 1"></path></g></svg></span></a>',
		'lol' => '<a alt="%title%" Title="%title%" onclick=\'heateorRbTrackEmojiClicks(this, "lol")\' rel="nofollow noopener" target="_blank" style="font-size:24px!important;box-shadow:none;display:inline-block;vertical-align:middle;"><span class="heateor_rb_svg heateor_rb_s__default heateor_rb_s_facebook" style="%style%border-radius: 4px;display: inline-block!important;opacity: 1;float: none;font-size: 32px!important;border: 0;box-shadow: none;display: inline-block;font-size: 16px;padding: 0 4px;vertical-align: middle;display: inline;line-height: 16px;background-repeat: repeat;overflow: hidden;padding: 0;cursor:pointer;box-sizing:content-box"><svg xmlns="http://www.w3.org/2000/svg" style="%inner_style%" width="100%" height="100%" viewBox="0 0 64 64" enable-background="new 0 0 64 64"><g fill="%logo_color%"><path d="m51.7 19.4c.6.3.3 1-.2 1.1-2.7.4-5.5.9-8.3 2.4 4 .7 7.2 2.7 9 4.8.4.5-.1 1.1-.5 1-4.8-1.7-9.7-2.7-15.8-2-.5 0-.9-.2-.8-.7 1.6-7.3 10.9-10 16.6-6.6"></path><path d="m12.3 19.4c-.6.3-.3 1 .2 1.1 2.7.4 5.5.9 8.3 2.4-4 .7-7.2 2.7-9 4.8-.4.5.1 1.1.5 1 4.8-1.7 9.7-2.7 15.8-2 .5 0 .9-.2.8-.7-1.6-7.3-10.9-10-16.6-6.6"></path><path d="m49.7 34.4c-.4-.5-1.1-.4-1.9-.4-15.8 0-15.8 0-31.6 0-.8 0-1.5-.1-1.9.4-3.9 5 .7 19.6 17.7 19.6 17 0 21.6-14.6 17.7-19.6"></path></g><path d="m33.8 41.7c-.6 0-1.5.5-1.1 2 .2.7 1.2 1.6 1.2 2.8 0 2.4-3.8 2.4-3.8 0 0-1.2 1-2 1.2-2.8.3-1.4-.6-2-1.1-2-1.6 0-4.1 1.7-4.1 4.6 0 3.2 2.7 5.8 6 5.8s6-2.6 6-5.8c-.1-2.8-2.7-4.5-4.3-4.6" fill="#4c3526" class="heateor_rb_no_fill"></path><path d="m24.3 50.7c2.2 1 4.8 1.5 7.7 1.5s5.5-.6 7.7-1.5c-2.1-1.1-4.7-1.7-7.7-1.7s-5.6.6-7.7 1.7" fill="#ff717f" class="heateor_rb_no_fill"></path><path d="m47 36c-15 0-15 0-29.9 0-2.1 0-2.1 4-.1 4 10.4 0 19.6 0 30 0 2 0 2-4 0-4" fill="%logo_color%"></path></svg></span></a>',
		'smile' => '<a alt="%title%" Title="%title%" onclick=\'heateorRbTrackEmojiClicks(this, "smile")\' rel="nofollow noopener" target="_blank" style="font-size:24px!important;box-shadow:none;display:inline-block;vertical-align:middle;"><span class="heateor_rb_svg heateor_rb_s__default heateor_rb_s_facebook" style="%style%border-radius: 4px;display: inline-block!important;opacity: 1;float: none;font-size: 32px!important;border: 0;box-shadow: none;display: inline-block;font-size: 16px;padding: 0 4px;vertical-align: middle;display: inline;line-height: 16px;background-repeat: repeat;overflow: hidden;padding: 0;cursor:pointer;box-sizing:content-box"><svg xmlns="http://www.w3.org/2000/svg" style="%inner_style%"width="100%" height="100%" viewBox="0 0 64 64" enable-background="new 0 0 64 64"><g fill="%logo_color%"><circle cx="20.5" cy="26.6" r="5"></circle><circle cx="43.5" cy="26.6" r="5"></circle><path d="m44.6 40.3c-8.1 5.7-17.1 5.6-25.2 0-1-.7-1.8.5-1.2 1.6 2.5 4 7.4 7.7 13.8 7.7s11.3-3.6 13.8-7.7c.6-1.1-.2-2.3-1.2-1.6"></path></g></svg></span></a>',
		'up' => '<a alt="%title%" Title="%title%" onclick=\'heateorRbTrackEmojiClicks(this, "up")\' rel="nofollow noopener" target="_blank" style="font-size:24px!important;box-shadow:none;display:inline-block;vertical-align:middle;"><span class="heateor_rb_svg heateor_rb_s__default heateor_rb_s_facebook" style="%style%border-radius: 4px;display: inline-block!important;opacity: 1;float: none;font-size: 32px!important;border: 0;box-shadow: none;display: inline-block;font-size: 16px;padding: 0 4px;vertical-align: middle;display: inline;line-height: 16px;background-repeat: repeat;overflow: hidden;padding: 0;cursor:pointer;box-sizing:content-box"><svg xmlns="http://www.w3.org/2000/svg" style="%inner_style%" width="100%" height="100%" viewBox="0 0 218.000000 232.000000"preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,232.000000) scale(0.100000,-0.100000)"fill="%logo_color%" stroke="none"><path d="M1538 2208 c-10 -7 -25 -40 -33 -73 -66 -252 -361 -534 -719 -687 l-98 -42 -22 26 c-47 57 -67 62 -241 66 -232 6 -290 -11 -334 -95 -8 -15 -11 -174 -11 -531 l0 -509 23 -33 c43 -63 69 -70 280 -70 211 0 238 6 281 62 l26 35 58 -9 c95 -14 161 -36 292 -98 161 -76 250 -93 439 -88 124 3 141 6 187 30 59 31 112 87 120 127 4 17 18 35 36 46 58 34 114 151 122 258 3 32 12 56 31 79 34 40 59 96 74 166 14 68 13 108 -3 154 -12 34 -11 41 18 99 28 57 31 72 31 159 0 77 -4 101 -20 129 -44 75 -92 90 -277 91 -71 0 -128 1 -128 3 0 2 18 39 40 84 59 122 92 227 97 318 6 92 -5 142 -45 205 -46 73 -180 132 -224 98z m117 -129 c97 -85 63 -278 -103 -577 -33 -59 -32 -89 5 -103 13 -5 112 -9 219 -9 l195 0 16 -37 c33 -79 -6 -220 -66 -241 -50 -17 -50 -81 0 -97 32 -10 41 -48 28 -120 -13 -77 -44 -130 -89 -153 -39 -19 -48 -43 -30 -78 34 -62 -30 -214 -94 -225 -22 -5 -30 -18 -46 -77 -8 -33 -20 -49 -52 -70 -41 -27 -44 -27 -197 -27 -178 1 -221 10 -360 79 -99 50 -189 80 -281 96 -36 6 -75 13 -88 16 l-22 4 2 421 3 422 75 28 c357 137 671 403 796 675 19 40 34 80 34 88 0 24 15 19 55 -15z m-1077 -701 c9 -9 12 -134 12 -499 0 -430 -2 -489 -16 -503 -24 -24 -349 -23 -376 1 -17 15 -18 44 -18 503 0 365 3 489 12 498 8 8 66 12 193 12 127 0 185 -4 193 -12z"/></g></svg></span></a>'
		
	);


	/**
	 * Social reaction networks for AMP
	 *
	 * @since    1.0
	 */
	private $amp_reaction_networks = array();

	/**
	 * Fetch social reaction networks
	 *
	 * @since    1.0
	 */
	public function fetch_reaction_networks( $reaction_type ) {
		
		return $this->reaction_networks;
	
	}

	/**
	 * Fetch social reaction networks to display for AMP
	 *
	 * @since    1.0
	 */
	public function fetch_amp_reaction_networks() {

		$this->amp_reaction_networks['angry'] = '<a class="heateor_rb_amp heateor_rb_amp_angry" href="' . home_url() . '/wp-admin/admin-ajax.php?action=heateor_rb_track_emoji_clicks&emoji=angry&url=%encoded_post_url%" title="Angry" rel="nofollow noopener" target="_blank"><amp-img src="%img_url%/angry.svg" width="%width%" height="%height%" alt="Angry" class="amp-wp-enforced-sizes" style="width: %width%px;"></amp-img></a>';
		$this->amp_reaction_networks['wow'] = '<a class="heateor_rb_amp heateor_rb_amp_wow" href="' . home_url() . '/wp-admin/admin-ajax.php?action=heateor_rb_track_emoji_clicks&emoji=wow&url=%encoded_post_url%" title="Wow" rel="nofollow noopener" target="_blank"><amp-img src="%img_url%/wow.svg" width="%width%" height="%height%" alt="Wow" class="amp-wp-enforced-sizes" style="width: %width%px;"></amp-img></a>';
		$this->amp_reaction_networks['love'] = '<a class="heateor_rb_amp heateor_rb_amp_love" href="' . home_url() . '/wp-admin/admin-ajax.php?action=heateor_rb_track_emoji_clicks&emoji=love&url=%encoded_post_url%" title="Love" rel="nofollow noopener" target="_blank"><amp-img src="%img_url%/love.svg" width="%width%" height="%height%" alt="Love" class="amp-wp-enforced-sizes" style="width: %width%px;"></amp-img></a>';
		$this->amp_reaction_networks['sad'] = '<a class="heateor_rb_amp heateor_rb_amp_sad" href="' . home_url() . '/wp-admin/admin-ajax.php?action=heateor_rb_track_emoji_clicks&emoji=sad&url=%encoded_post_url%" title="Sad" rel="nofollow noopener" target="_blank"><amp-img src="%img_url%/sad.svg" width="%width%" height="%height%" alt="Sad" class="amp-wp-enforced-sizes" style="width: %width%px;"></amp-img></a>';
		$this->amp_reaction_networks['lol'] = '<a class="heateor_rb_amp heateor_rb_amp_lol" href="' . home_url() . '/wp-admin/admin-ajax.php?action=heateor_rb_track_emoji_clicks&emoji=lol&url=%encoded_post_url%" title="Lol" rel="nofollow noopener" target="_blank"><amp-img src="%img_url%/lol.svg" width="%width%" height="%height%" alt="Lol" class="amp-wp-enforced-sizes" style="width: %width%px;"></amp-img></a>';
		$this->amp_reaction_networks['smile'] = '<a class="heateor_rb_amp heateor_rb_amp_smile" href="' . home_url() . '/wp-admin/admin-ajax.php?action=heateor_rb_track_emoji_clicks&emoji=smile&url=%encoded_post_url%" title="smile" rel="nofollow noopener" target="_blank"><amp-img src="%img_url%/smile.svg" width="%width%" height="%height%" alt="Smile" class="amp-wp-enforced-sizes" style="width: %width%px;"></amp-img></a>';
		$this->amp_reaction_networks['up'] = '<a class="heateor_rb_amp heateor_rb_amp_up" href="' . home_url() . '/wp-admin/admin-ajax.php?action=heateor_rb_track_emoji_clicks&emoji=up&url=%encoded_post_url%" title="Up" rel="nofollow noopener" target="_blank"><amp-img src="%img_url%/up.svg" width="%width%" height="%height%" alt="Up" class="amp-wp-enforced-sizes" style="width: %width%px;"></amp-img></a>';

		return $this->amp_reaction_networks;
	
	}

}
