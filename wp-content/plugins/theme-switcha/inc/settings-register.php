<?php // Theme Switcha - Register Settings

if (!defined('ABSPATH')) exit;

function theme_switcha_register_settings() {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$enable_plugin = (isset($options['enable_plugin']) && $options['enable_plugin']) ? true : false;
	
	// register_setting( $option_group, $option_name, $sanitize_callback );
	register_setting('theme_switcha_options', 'theme_switcha_options', 'theme_switcha_validate_options');
	
	// add_settings_section( $id, $title, $callback, $page ); 
	add_settings_section('settings', 'General Settings', 'theme_switcha_settings_section_options', 'theme_switcha_options');
	
	if ($enable_plugin) add_settings_section('themes',   'Available Themes', 'theme_switcha_themes_section_options',   'theme_switcha_options');
	
	// add_settings_field( $id, $title, $callback, $page, $section, $args );
	add_settings_field('enable_plugin', 'Enable Switching',  'theme_switcha_callback_checkbox', 'theme_switcha_options', 'settings', array('id' => 'enable_plugin', 'label' => esc_html__('Enable theme switching', 'theme-switcha')));
	add_settings_field('enable_admin',  'Enable Admin Area', 'theme_switcha_callback_checkbox', 'theme_switcha_options', 'settings', array('id' => 'enable_admin',  'label' => esc_html__('Apply switching to Admin Area', 'theme-switcha')));
	add_settings_field('allowed_users', 'Allowed Users',     'theme_switcha_callback_select',   'theme_switcha_options', 'settings', array('id' => 'allowed_users', 'label' => esc_html__('Allow these users to switch themes', 'theme-switcha')));
	add_settings_field('cookie_expire', 'Cookie Expiration', 'theme_switcha_callback_number',   'theme_switcha_options', 'settings', array('id' => 'cookie_expire', 'label' => esc_html__('Cookie Expiration (in seconds)', 'theme-switcha')));
	add_settings_field('passkey',       'Passkey',           'theme_switcha_callback_text',     'theme_switcha_options', 'settings', array('id' => 'passkey',       'label' => esc_html__('Passkey for theme-switch links (alphanumeric only)', 'theme-switcha')));
	add_settings_field('reset_options', 'Reset Options',     'theme_switcha_callback_reset',    'theme_switcha_options', 'settings', array('id' => 'reset_options', 'label' => esc_html__('Restore default plugin options', 'theme-switcha')));
	add_settings_field('rate_plugin',   'Support Plugin',    'theme_switcha_callback_rate',     'theme_switcha_options', 'settings', array('id' => 'rate_plugin',   'label' => esc_html__('Show support with a 5-star rating &raquo;', 'theme-switcha')));
	
}

function theme_switcha_validate_options($input) {
	
	if (!isset($input['enable_plugin'])) $input['enable_plugin'] = null;
	$input['enable_plugin'] = ($input['enable_plugin'] == 1 ? 1 : 0);
	
	if (!isset($input['enable_admin'])) $input['enable_admin'] = null;
	$input['enable_admin'] = ($input['enable_admin'] == 1 ? 1 : 0);
	
	$allowed_users = theme_switcha_allowed_users();
	if (!isset($input['allowed_users'])) $input['allowed_users'] = null;
	if (!array_key_exists($input['allowed_users'], $allowed_users)) $input['allowed_users'] = null;
	
	if (isset($input['cookie_expire']) && is_numeric($input['cookie_expire'])) $input['cookie_expire'] = $input['cookie_expire'];
	else $input['cookie_expire'] = 0;
	
	if (isset($input['passkey'])) $input['passkey'] = preg_replace('/[^a-z0-9]+/i', '', $input['passkey']);
	
	return $input;
	
}

function theme_switcha_settings_section_options() {
	
	echo '<p>'. esc_html__('Thanks for using Theme Switcha :)', 'theme-switcha') .'</p>';
	
	echo '<p>'. esc_html__('Need help?', 'theme-switcha');
	
	echo ' <a target="_blank" href="https://wordpress.org/plugins/theme-switcha/installation/">'. esc_html__('Visit the plugins docs', 'theme-switcha') .' &raquo;</a></p>';
	
	echo '<p class="book-blurb"><a target="_blank" href="https://wp-tao.com/wordpress-themes-book/" title="'. esc_html__('WordPress Themes In Depth', 'theme-switcha') .'">';
	
	echo '<img src="'. plugins_url('img/wp-themes-480x120.jpg', dirname(__FILE__)) .'" width="240" height="60" alt="'. esc_html__('WordPress Themes In Depth', 'theme-switcha') .'"></a></p>';
	
}

function theme_switcha_themes_section_options() {
	
	echo '<p>'. esc_html__('Click any thumbnail to switch themes.', 'theme-switcha') .'</p>';
	
	echo theme_switcha_display_themes();
	
}

function theme_switcha_allowed_users() {
	
	$users = array(
		'admin' => array(
			'value' => 'admin',
			'label' => esc_html__('Only Admin', 'theme-switcha'),
		),
		'passkey' => array(
			'value' => 'passkey',
			'label' => esc_html__('Only with Passkey', 'theme-switcha'),
		),
		'everyone' => array(
			'value' => 'everyone',
			'label' => esc_html__('Everyone', 'theme-switcha'),
		),
	);
	
	return $users;
	
}

function theme_switcha_callback_text($args) {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';
	
	echo '<input name="theme_switcha_options['. $id .']" type="text" size="40" value="'. $value .'" />';
	echo '<label class="custom-label" for="theme_switcha_options['. $id .']">'. $label .'</label>';
	
}

function theme_switcha_callback_number($args) {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';
	
	echo '<input name="theme_switcha_options['. $id .']" type="number" min="0" value="'. $value .'" /> ';
	echo '<label class="custom-label inline-block" for="theme_switcha_options['. $id .']">'. $label .'</label>';
	
}

function theme_switcha_callback_textarea($args) {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$allowed_tags = wp_kses_allowed_html('post');
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($options[$id]) ? wp_kses(stripslashes_deep($options[$id]), $allowed_tags) : '';
	
	echo '<textarea name="theme_switcha_options['. $id .']" rows="3" cols="50">'. $value .'</textarea>';
	echo '<label class="custom-label" for="theme_switcha_options['. $id .']">'. $label .'</label>';
	
}

function theme_switcha_callback_checkbox($args) {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$checked = isset($options[$id]) ? checked($options[$id], 1, false) : '';
	
	echo '<input name="theme_switcha_options['. $id .']" type="checkbox" value="1" '. $checked .' /> ';
	echo '<label class="custom-label inline-block" for="theme_switcha_options['. $id .']">'. $label .'</label>';
	
}

function theme_switcha_callback_select($args) {
	
	global $theme_switcha_options;
	
	$options = $theme_switcha_options;
	
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';
	
	$items = array();
	
	if ($id === 'allowed_users') $items = theme_switcha_allowed_users();
	
	echo '<select name="theme_switcha_options['. $id .']">';
	
	foreach ($items as $item) {
		
		$item_value = $item['value'];
		$item_label = $item['label'];
		
		echo '<option '. selected($item_value, $value, false) .' value="'. $item_value .'">'. $item_label .'</option>';
		
	}
	echo '</select> <label class="custom-label inline-block" for="theme_switcha_options['. $id .']">'. $label .'</label>';
}

function theme_switcha_callback_reset($args) {
	
	$nonce = wp_create_nonce('theme_switcha_reset_options');
	$href  = esc_url(add_query_arg(array('reset-options-verify' => $nonce), admin_url('options-general.php?page=theme_switcha_settings')));
	$label = isset($args['label']) ? $args['label'] : esc_html__('Restore default plugin options', 'theme-switcha');
	
	echo '<a class="reset-options" href="'. $href .'">'. $label .'</a>';
	
}

function theme_switcha_callback_rate($args) {
	
	$href  = 'https://wordpress.org/support/plugin/'. THEME_SWITCHA_SLUG .'/reviews/?rate=5#new-post';
	$title = esc_attr__('Help keep Theme Switcha going strong! A huge THANK YOU for your support!', 'theme-switcha');
	$text  = isset($args['label']) ? $args['label'] : esc_html__('Show support with a 5-star rating &raquo;', 'theme-switcha');
	
	echo '<a target="_blank" class="rate-plugin" href="'. $href .'" title="'. $title .'">'. $text .'</a>';
	
}
