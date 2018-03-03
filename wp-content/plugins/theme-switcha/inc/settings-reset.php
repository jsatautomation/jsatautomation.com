<?php // Theme Switcha - Reset Settings

if (!defined('ABSPATH')) exit;

function theme_switcha_admin_notice() {
	
	$screen = get_current_screen();
	
	if ($screen->id === 'settings_page_theme_switcha_settings') {
		
		if (isset($_GET['reset-options'])) {
			
			if ($_GET['reset-options'] === 'true') : ?>
				
				<div class="notice notice-success is-dismissible"><p><strong><?php esc_html_e('Default options restored.', 'theme-switcha'); ?></strong></p></div>
				
			<?php else : ?>
				
				<div class="notice notice-info is-dismissible"><p><strong><?php esc_html_e('No changes made to options.', 'theme-switcha'); ?></strong></p></div>
				
			<?php endif;
			
		}
		
	}
	
}

function theme_switcha_reset_options() { 
	
	if (isset($_GET['reset-options-verify']) && wp_verify_nonce($_GET['reset-options-verify'], 'theme_switcha_reset_options')) {
		
		if (!current_user_can('manage_options')) exit;
		
		$options_default = Theme_Switcha::options();
		$options_update = update_option('theme_switcha_options', $options_default);
		
		$result = 'false';
		if ($options_update) $result = 'true';
		
		$location = admin_url('options-general.php?page=theme_switcha_settings&reset-options='. $result);
		wp_redirect($location);
		exit;
		
	}
	
}
