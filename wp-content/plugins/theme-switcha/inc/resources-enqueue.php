<?php // Theme Switcha - Enqueue Resources

if (!defined('ABSPATH')) exit;

function theme_switcha_enqueue_resources_admin() {
	
	$screen = get_current_screen();
	
	if (!property_exists($screen, 'id')) return;
	
	if ($screen->id === 'settings_page_theme_switcha_settings') {
		
		wp_enqueue_style('wp-jquery-ui-dialog');
		
		wp_enqueue_style('theme-switcha-font-icons', THEME_SWITCHA_URL .'css/font-icons.css', array(), null);
		
		wp_enqueue_style('theme-switcha-settings', THEME_SWITCHA_URL .'css/settings.css', array(), null);
		
		$js_deps = array('jquery', 'jquery-ui-core', 'jquery-ui-dialog');
		
		wp_enqueue_script('theme_switcha_settings', THEME_SWITCHA_URL .'js/settings.js', $js_deps);
		
		$data = theme_switcha_print_js_vars_admin();
		
		wp_localize_script('theme_switcha_settings', 'theme_switcha_settings', $data);
		
	}
	
}

function theme_switcha_print_js_vars_admin() {
	
	$data = array(
		'reset_title'   => __('Confirm Reset',            'theme-switcha'),
		'reset_message' => __('Restore default options?', 'theme-switcha'),
		'reset_true'    => __('Yes, make it so.',         'theme-switcha'),
		'reset_false'   => __('No, abort mission.',       'theme-switcha'),
	);
	
	return $data;
	
}
