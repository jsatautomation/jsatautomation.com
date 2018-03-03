<?php // Theme Switcha - Core

if (!defined('ABSPATH')) exit;

function theme_switcha_check_cookie() {
	
	if (is_admin()) return;
	
	if (isset($_GET['theme']) && !empty($_GET['theme'])) {
		
		global $theme_switcha_options;
		
		$options = $theme_switcha_options;
		
		$expire = time() + (int) $options['cookie_expire'];
		
		$theme = stripslashes($_GET['theme']);
		
		$domain = sanitize_text_field($_SERVER['HTTP_HOST']);
		
		setcookie('theme_switcha_theme_'. COOKIEHASH, $theme, $expire, COOKIEPATH, $domain, false, true);
		
		if (isset($_GET['passkey']) && !empty($_GET['passkey'])) {
			
			$passkey = stripslashes($_GET['passkey']);
			
			setcookie('theme_switcha_passkey_'. COOKIEHASH, $passkey, $expire, COOKIEPATH, $domain, false, true);
			
		}
		
		$params = array('theme', 'passkey');
		$redirect = esc_url_raw(remove_query_arg($params));
		wp_safe_redirect($redirect);
		
		exit;
		
	}
	
}

function theme_switcha_core($current, $key = 'Template') {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	if (!$options['enable_plugin']) return $current;
	
	if (!theme_switcha_check_permissions($options)) return $current;
	
	if (isset($_COOKIE['theme_switcha_theme_'. COOKIEHASH])) {
		
		$theme = $_COOKIE['theme_switcha_theme_'. COOKIEHASH];
		
	} else {
		
		return $current;
		
	}
	
	if (isset($theme) && !empty($theme)) {
		
		if ((!is_admin()) || (is_admin() && $options['enable_admin'])) {
			
			$theme_data = wp_get_theme($theme);
			
			if (!empty($theme_data)) {
				
				$theme_status = (isset($theme_data['Status'])) ? $theme_data['Status'] : false;
				
				if ($theme_status && ($theme_status !== 'publish') && ($theme_status !== 'admin-only')) return $current;
				
				return (string) $theme_data[$key];
				
			}
			
			$themes = wp_get_themes();
			
			foreach ($themes as $theme_data) {
				
				if ((string) $theme_data['Stylesheet'] === $theme) {
					
					$theme_status = (isset($theme_data['Status'])) ? $theme_data['Status'] : false;
					
					if ($theme_status && ($theme_status !== 'publish') && ($theme_status !== 'admin-only')) return $current;
					
					return (string) $theme_data[$key];
					
				}
				
			}
			
		}
		
	}
	
	return $current;
	
}

function theme_switcha_check_permissions($options) {
	
	switch ($options['allowed_users']) {
		
		case 'admin' :
			
			if (current_user_can('switch_themes')) return true;
			
		break;
		
		case 'passkey' :
			
			if (current_user_can('switch_themes')) return true;
			
			if ($_COOKIE['theme_switcha_passkey_'. COOKIEHASH] === $options['passkey']) return true;
			
		break;
		
		case 'everyone' :
			
			return true;
			
		break;
			
	}
	
	return false;
	
}

function theme_switcha_filter_template($current) {
	
	return theme_switcha_core($current, 'Template');
	
}

function theme_switcha_filter_stylesheet($current) {
	
	return theme_switcha_core($current, 'Stylesheet');
	
}

function theme_switcha_add_filters() {
	
	add_filter('template',   'theme_switcha_filter_template');
	
	add_filter('stylesheet', 'theme_switcha_filter_stylesheet');
	
}

function theme_switcha_get_theme_names() {
	
	$blog_id = get_current_blog_id();
	
	$themes = is_int($blog_id) ? wp_get_themes(array('errors' => false , 'allowed' => null, 'blog_id' => $blog_id)) : wp_get_themes();
	
	$theme_names = array_keys($themes);
	
	$theme_names = array_map('strval', $theme_names);
	
	natcasesort($theme_names);
	
	return $theme_names;
	
} 

function theme_switcha_truncate($string, $length = 10, $dots = '...') {
	
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
    
}

function theme_switcha_check_enabled() {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$cookie_passkey = (isset($_COOKIE['theme_switcha_passkey_'. COOKIEHASH]) && $_COOKIE['theme_switcha_passkey_'. COOKIEHASH]) ? $_COOKIE['theme_switcha_passkey_'. COOKIEHASH] : null;
	
	$switch_themes = (current_user_can('switch_themes')) ? true : false;
	
	$allowed_users = (isset($options['allowed_users'])) ? $options['allowed_users'] : null;
	
	$enable_plugin = (isset($options['enable_plugin']) && $options['enable_plugin']) ? true : false;
	
	$enable_cookie = (($switch_themes) || (($allowed_users === 'passkey') && ($cookie_passkey === $options['passkey']))) ? true : false;
	
	$enable_user   = (($switch_themes) || ($enable_cookie) || ($allowed_users === 'everyone')) ? true : false;
	
	$enabled = ($enable_plugin && $enable_user) ? true : false;
	
	return $enabled;
	
}

function theme_switcha_display_themes() {
	
	if (!is_admin()) return;
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$themes = wp_get_themes();
	
	$default_theme = wp_get_theme();
	
	$default_screenshot = THEME_SWITCHA_URL .'img/screenshot.png';
	
	$enable_admin = (isset($options['enable_admin']) && $options['enable_admin']) ? ' enable-admin' : '';
	
	$enable_plugin = (isset($options['enable_plugin']) && $options['enable_plugin']) ? ' enable-plugin' : '';
	
	$current_theme = (!empty($enable_plugin) && isset($_COOKIE['theme_switcha_theme_'. COOKIEHASH])) ? $_COOKIE['theme_switcha_theme_'. COOKIEHASH] : $default_theme->Stylesheet;
	
	$passkey = (isset($options['passkey'])) ? $options['passkey'] : '';
	
	$base_url = trailingslashit(get_bloginfo('url'));
	
	if (empty($enable_plugin)) return;
	
	//
	
	$output = '<div id="theme-switcha" class="theme-switcha-thumbs">';
	
	foreach($themes as $theme) {
		
		if (($theme->Status !== 'publish') && ($theme->Status !== 'admin-only')) continue;
		
		$src = ($theme->get_screenshot()) ? $theme->get_screenshot() : $default_screenshot;
		
		$dir = ($theme->get_stylesheet()) ? $theme->get_stylesheet() : get_stylesheet();
		
		$params = array('theme' => $dir, 'passkey' => $passkey);
		
		$href = add_query_arg($params, $base_url);
		
		$title = ($theme->Version !== '') ? esc_attr__('Version ', 'theme-switcha') . $theme->Version .' : ' : '';
		
		$title .= theme_switcha_truncate($theme->Description, 120);
		
		$name = ($theme->Name !== '') ? $theme->Name : esc_attr__('Untitled', 'theme-switcha');
		
		$text = theme_switcha_truncate($name, 20);
		
		$active = ((string) $theme->Stylesheet === $current_theme) ? ' theme-active' : '';
		
		$admin = ($theme->Name === $default_theme->Name) ? ' <span class="theme-admin">'. esc_html__('Admin Theme', 'theme-switcha') .'</span>' : '';
		
		$parent = ($theme->parent() && $theme->parent()->Name !== '') ? ' <span class="theme-child">'. esc_html__('Child Theme', 'theme-switcha') .'</span>' : '';
		
		$output .= '<a target="_blank" class="theme-screenshot theme-'. $dir . $enable_plugin . $enable_admin . $active .'" href="'. esc_url($href) .'" title="'. esc_attr($title) .'">';
		
		$output .= '<img src="'. esc_url($src) .'" alt="" />'. esc_html($text) . $admin . $parent .'</a>';
		
	}
	
	$output .= '</div>';
	
	return $output;
	
}

function theme_switcha_display_thumbs() {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$themes = wp_get_themes();
	
	$default_theme = wp_get_theme();
	
	$default_screenshot = THEME_SWITCHA_URL .'img/screenshot.png';
	
	$enable_plugin = (isset($options['enable_plugin']) && $options['enable_plugin']) ? ' enable-plugin' : '';
	
	$current_theme = (!empty($enable_plugin) && isset($_COOKIE['theme_switcha_theme_'. COOKIEHASH])) ? $_COOKIE['theme_switcha_theme_'. COOKIEHASH] : $default_theme->Stylesheet;
	
	$base_url = get_permalink();
	
	if (empty($enable_plugin)) return;
	
	//
	
	$output = '<div id="theme-switcha" class="theme-switcha-thumbs">';
	
	$output .= (!theme_switcha_check_enabled()) ? '<p>'. esc_html__('Theme switching currently disabled.', 'theme-switcha') .'</p>' : '';
	
	foreach($themes as $theme) {
		
		if (($theme->Status !== 'publish') && ($theme->Status !== 'admin-only')) continue;
		
		if ((!current_user_can('switch_themes')) && ($theme->Status === 'admin-only')) continue;
		
		$src = ($theme->get_screenshot()) ? $theme->get_screenshot() : $default_screenshot;
		
		$dir = ($theme->get_stylesheet()) ? $theme->get_stylesheet() : get_stylesheet();
		
		$params = array('theme' => $dir);
		
		$href = add_query_arg($params, $base_url);
		
		$title = ($theme->Version !== '') ? esc_attr__('Version ', 'theme-switcha') . $theme->Version .' : ' : '';
		
		$title .= theme_switcha_truncate($theme->Description, 120);
		
		$name = ($theme->Name !== '') ? $theme->Name : esc_attr__('Untitled', 'theme-switcha');
		
		$text = theme_switcha_truncate($name, 20);
		
		$active = ((string) $theme->Stylesheet === $current_theme) ? ' theme-active' : '';
		
		$parent = ($theme->parent() && $theme->parent()->Name !== '') ? ' <span class="theme-child">'. esc_html__('Child Theme', 'theme-switcha') .'</span>' : '';
		
		$output .= '<a class="theme-screenshot theme-'. $dir . $active .'" href="'. esc_url($href) .'" title="'. esc_attr($title) .'">';
		
		$output .= '<img src="'. esc_url($src) .'" alt="" />'. esc_html($text) . $parent .'</a>';
		
	}
	
	$output .= '</div>';
	
	return $output;
	
}

function theme_switcha_frontend_thumb_styles() {
	
	$styles  = '.theme-switcha-thumbs{font-family:sans-serif;text-align:center}';
	$styles .= '.theme-screenshot[style]:link,.theme-screenshot[style]:visited{color:#efefef!important}';
	$styles .= '.theme-screenshot[style]:hover,.theme-screenshot[style]:active,.theme-screenshot[style]:focus{color:#fff!important}';
	$styles .= '.theme-switcha-thumbs{margin-top:30px}.theme-screenshot:link,.theme-screenshot:visited{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:relative;display:inline-block;width:200px;height:auto;margin:0 10px 10px 0;padding:10px;font-size:12px;line-height:18px;text-decoration:none;text-align:center;cursor:pointer;border:0;border-radius:2px;color:#efefef;background-color:#555;opacity:.8;-webkit-transition:opacity .2s ease-in-out;-moz-transition:opacity .2s ease-in-out;transition:opacity .2s ease-in-out}.theme-screenshot:active,.theme-screenshot:focus,.theme-screenshot:hover{opacity:1;color:#fff}.theme-active:link,.theme-active:visited{background-color:#696}.theme-screenshot img{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;width:100%;height:auto;margin:0 0 8px;padding:0;border-radius:2px;border:1px solid #777;box-shadow:0 0 10px 0 rgba(0,0,0,.7)}.theme-admin,.theme-child{position:absolute;left:0;width:100%;height:50px;line-height:50px}.theme-admin{top:0;background-color:rgba(0,0,0,.7)}.theme-child{top:50px;background-color:rgba(153,51,51,.7)}';
	
	return '<style type="text/css">'. $styles .'</style>';
	
}

function theme_switcha_display_thumbs_shortcode($attr, $content = null) {
	
	extract(shortcode_atts(array(
		'style'  => 'true',
	), $attr));
	
	$output = theme_switcha_display_thumbs();
	
	if ($style === 'true') {
		
		$styles = theme_switcha_frontend_thumb_styles();
		
		$output = $styles . $output;
		
	}
	
	return $output;
	
}
add_shortcode('theme_switcha_thumbs', 'theme_switcha_display_thumbs_shortcode');

function theme_switcha_display_list($display) {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$themes = wp_get_themes();
	
	$default_theme = wp_get_theme();
	
	$enable_plugin = (isset($options['enable_plugin']) && $options['enable_plugin']) ? ' enable-plugin' : '';
	
	$current_theme = (!empty($enable_plugin) && isset($_COOKIE['theme_switcha_theme_'. COOKIEHASH])) ? $_COOKIE['theme_switcha_theme_'. COOKIEHASH] : $default_theme->Stylesheet;
	
	$base_url = get_permalink();
	
	if (empty($enable_plugin)) return;
	
	//
	
	$output = (!theme_switcha_check_enabled()) ? '<p>'. esc_html__('Theme switching currently disabled.', 'theme-switcha') .'</p>' : '';
	
	$output .= '<ul id="theme-switcha" class="theme-switcha-'. $display .'">';
	
	foreach($themes as $theme) {
		
		if (($theme->Status !== 'publish') && ($theme->Status !== 'admin-only')) continue;
		
		if ((!current_user_can('switch_themes')) && ($theme->Status === 'admin-only')) continue;
		
		$dir = ($theme->get_stylesheet()) ? $theme->get_stylesheet() : get_stylesheet();
		
		$params = array('theme' => $dir);
		
		$href = add_query_arg($params, $base_url);
		
		$title = ($theme->Version !== '') ? esc_attr__('Version ', 'theme-switcha') . $theme->Version .' : ' : '';
		
		$title .= theme_switcha_truncate($theme->Description, 120);
		
		$text = ($theme->Name !== '') ? $theme->Name : esc_attr__('Untitled', 'theme-switcha');
		
		$active = ((string) $theme->Stylesheet === $current_theme) ? ' active-theme' : '';
		
		$output .= '<li><a class="theme-'. $dir . $active .'" href="'. esc_url($href) .'" title="'. esc_attr($title) .'">'. esc_html($text) .'</a></li>';
		
	}
	
	$output .= '</ul>';
	
	return $output;
}

function theme_switcha_frontend_list_styles($display) {
	
	if ($display === 'list') {
		
		$styles = '.active-theme{font-weight:bold}';
		
	} else {
		
		$styles = '.theme-switcha-list{margin-left:0;padding:0}.theme-switcha-list li{display:inline-block;margin:0 5px 5px 0}.theme-switcha-list a:link,.theme-switcha-list a:visited{display:inline-block;padding:5px 10px;border:1px solid #fbf0cb;border-radius:2px;color:#777;background-color:#fefaed;text-decoration:none}.theme-switcha-list a:hover,.theme-switcha-list a:active,.theme-switcha-list a:focus{color:#777;background-color:#fbf0cb}';
		
	}
	
	return '<style type="text/css">'. $styles .'</style>';
	
}

function theme_switcha_display_list_shortcode($attr, $content = null) {
	
	extract(shortcode_atts(array(
		'display' => 'list',
		'style'   => 'true',
	), $attr));
	
	$output = theme_switcha_display_list($display);
	
	if ($style === 'true') {
		
		$styles = theme_switcha_frontend_list_styles($display);
		
		$output = $styles . $output;
		
	}
	
	return $output;
	
}
add_shortcode('theme_switcha_list', 'theme_switcha_display_list_shortcode');

function theme_switcha_display_dropdown($text) {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$themes = wp_get_themes();
	
	$default_theme = wp_get_theme();
	
	$enable_plugin = (isset($options['enable_plugin']) && $options['enable_plugin']) ? ' enable-plugin' : '';
	
	$current_theme = (!empty($enable_plugin) && isset($_COOKIE['theme_switcha_theme_'. COOKIEHASH])) ? $_COOKIE['theme_switcha_theme_'. COOKIEHASH] : $default_theme->Stylesheet;
	
	$base_url = get_permalink();
	
	if (empty($enable_plugin)) return;
	
	//
	
	$output = (!theme_switcha_check_enabled()) ? '<p>'. esc_html__('Theme switching currently disabled.', 'theme-switcha') .'</p>' : '';
	
	$output .= '<select id="theme-switcha" class="theme-switcha-dropdown" onChange="window.document.location.href=this.options[this.selectedIndex].value;">';
	
	$output .= ($text !== 'disable') ? '<option>'. $text .'</option>' : '';
	
	foreach($themes as $theme) {
		
		if (($theme->Status !== 'publish') && ($theme->Status !== 'admin-only')) continue;
		
		if ((!current_user_can('switch_themes')) && ($theme->Status === 'admin-only')) continue;
		
		$dir = ($theme->get_stylesheet()) ? $theme->get_stylesheet() : get_stylesheet();
		
		$params = array('theme' => $dir);
		
		$href = add_query_arg($params, $base_url);
		
		$text = ($theme->Name !== '') ? $theme->Name : esc_attr__('Untitled', 'theme-switcha');
		
		$active = ((string) $theme->Stylesheet === $current_theme) ? ' selected="selected"' : '';
		
		$output .= '<option value="'. esc_url($href) .'"'. $active .'>'. esc_html($text) .'</option>';
		
	}
	
	$output .= '</select>';
	
	return $output;
}

function theme_switcha_display_dropdown_shortcode($attr, $content = null) {
	
	extract(shortcode_atts(array(
		'text' => 'Choose a theme..',
	), $attr));
	
	$output = theme_switcha_display_dropdown($text);
	
	return $output;
	
}
add_shortcode('theme_switcha_select', 'theme_switcha_display_dropdown_shortcode');
