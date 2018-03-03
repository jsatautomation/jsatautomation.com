<?php 
/*
	Plugin Name: Theme Switcha
	Plugin URI: https://perishablepress.com/theme-switcha/
	Description: Theme switching done right.
	Tags: theme, switch, switcher, preview, demo,  development, admin, themes, plugin, testing, template, maintenance, theme development
	Author: Jeff Starr
	Contributors: specialk
	Author URI: https://plugin-planet.com/
	Donate link: https://m0n.co/donate
	Requires at least: 4.1
	Tested up to: 4.9
	Stable tag: 1.5
	Version: 1.5
	Requires PHP: 5.2
	Text Domain: theme-switcha
	Domain Path: /languages
	License: GPL v3 or later
*/

/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 
	2 of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	with this program. If not, visit: https://www.gnu.org/licenses/
	
	Copyright 2017 Monzilla Media. All rights reserved.
*/

if (!defined('ABSPATH')) die();

if (!class_exists('Theme_Switcha')) {
	
	final class Theme_Switcha {
		
		private static $instance;
		
		public static function instance() {
			
			if (!isset(self::$instance) && !(self::$instance instanceof Theme_Switcha)) {
				
				self::$instance = new Theme_Switcha;
				self::$instance->constants();
				self::$instance->includes();
				
				add_action('admin_init',          array(self::$instance, 'check_existing'));
				add_action('admin_init',          array(self::$instance, 'check_version'));
				add_action('plugins_loaded',      array(self::$instance, 'load_i18n'));
				add_filter('plugin_action_links', array(self::$instance, 'action_links'), 10, 2);
				add_filter('plugin_row_meta',     array(self::$instance, 'plugin_links'), 10, 2);
				
				add_action('admin_enqueue_scripts', 'theme_switcha_enqueue_resources_admin');
				add_action('admin_print_scripts',   'theme_switcha_print_js_vars_admin');
				add_action('admin_notices',         'theme_switcha_admin_notice');
				add_action('admin_init',            'theme_switcha_register_settings');
				add_action('admin_init',            'theme_switcha_reset_options');
				add_action('admin_menu',            'theme_switcha_menu_pages');
				
				add_action('plugins_loaded', 'theme_switcha_add_filters');
				add_action('init',           'theme_switcha_check_cookie');
				add_filter('widget_text',    'do_shortcode', 10);
				
			}
			
			return self::$instance;
		}
		
		public static function options() {
			
			$options = array(
				'enable_plugin' => false,
				'enable_admin'  => false,
				'allowed_users' => 'admin',
				'cookie_expire' => 3600,
				'passkey'       => uniqid(mt_rand()),
			);
			
			return apply_filters('theme_switcha_options', $options);
		}
		
		private function constants() {
			
			if (!defined('THEME_SWITCHA_REQUIRE')) define('THEME_SWITCHA_REQUIRE', '4.1');
			if (!defined('THEME_SWITCHA_VERSION')) define('THEME_SWITCHA_VERSION', '1.5');
			if (!defined('THEME_SWITCHA_NAME'))    define('THEME_SWITCHA_NAME',    'Theme Switcha');
			if (!defined('THEME_SWITCHA_AUTHOR'))  define('THEME_SWITCHA_AUTHOR',  'Jeff Starr');
			if (!defined('THEME_SWITCHA_HOME'))    define('THEME_SWITCHA_HOME',    'https://perishablepress.com/theme-switcha/');
			if (!defined('THEME_SWITCHA_URL'))     define('THEME_SWITCHA_URL',     plugin_dir_url(__FILE__));
			if (!defined('THEME_SWITCHA_DIR'))     define('THEME_SWITCHA_DIR',     plugin_dir_path(__FILE__));
			if (!defined('THEME_SWITCHA_FILE'))    define('THEME_SWITCHA_FILE',    plugin_basename(__FILE__));
			if (!defined('THEME_SWITCHA_SLUG'))    define('THEME_SWITCHA_SLUG',    basename(dirname(__FILE__)));
			
		}
		
		private function includes() {
			
			require_once THEME_SWITCHA_DIR .'inc/plugin-core.php';
			require_once THEME_SWITCHA_DIR .'inc/resources-enqueue.php';
			require_once THEME_SWITCHA_DIR .'inc/settings-display.php';
			require_once THEME_SWITCHA_DIR .'inc/settings-register.php';
			require_once THEME_SWITCHA_DIR .'inc/settings-reset.php';
			
		}
		
		public function action_links($links, $file) {
			
			if ($file == THEME_SWITCHA_FILE) {
				
				$add_links = '<a href="'. admin_url('options-general.php?page=theme_switcha_settings') .'">'. esc_html__('Settings', 'theme-switcha') .'</a>';
				array_unshift($links, $add_links);
				
			}
			
			return $links;
		}
		
		public function plugin_links($links, $file) {
			
			if ($file == plugin_basename(__FILE__)) {
				
				$rate_href  = 'https://wordpress.org/support/plugin/'. THEME_SWITCHA_SLUG .'/reviews/?rate=5#new-post';
				$rate_title = esc_html__('Click here to rate and review this plugin on WordPress.org', 'theme-switcha');
				$rate_text  = esc_html__('Rate this plugin', 'theme-switcha') .'&nbsp;&raquo;';
				
				$pro_href   = 'https://plugin-planet.com/theme-switcha-pro/?plugin';
				$pro_title  = esc_html__('Get Theme Switcha Pro!', 'theme-switcha');
				$pro_text   = esc_html__('Go&nbsp;Pro', 'theme-switcha');
				$pro_style  = 'padding:1px 5px;color:#eee;background:#333;border-radius:1px;';
				
				$links[]    = '<a target="_blank" href="'. $rate_href .'" title="'. $rate_title .'">'. $rate_text .'</a>';
				// $links[]    = '<a target="_blank" href="'. $pro_href .'" title="'. $pro_title .'" style="'. $pro_style .'">'. $pro_text .'</a>';
				
			}
			return $links;
		}
		
		public function check_existing() {
			
			if (class_exists('Theme_Switcha_Pro')) {
				if (is_plugin_active(THEME_SWITCHA_FILE)) {
					deactivate_plugins(THEME_SWITCHA_FILE);
					
					$msg  = '<strong>'. esc_html__('Warning:', 'theme-switcha') .'</strong> ';
					$msg .= esc_html__('Pro version of ', 'theme-switcha') . THEME_SWITCHA_NAME;
					$msg .= esc_html__(' currently active. Free and Pro versions cannot be activated at the same time. ', 'theme-switcha');
					$msg .= esc_html__('Please return to the', 'theme-switcha');
					$msg .= ' <a href="'. admin_url() .'">'. esc_html__('WP Admin Area', 'theme-switcha') .'</a> ';
					$msg .= esc_html__('and try again.', 'theme-switcha');
					
					wp_die($msg);
				}
			}
		}
		
		public function check_version() {
			
			$wp_version = get_bloginfo('version');
			
			if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
				if (version_compare($wp_version, THEME_SWITCHA_REQUIRE, '<')) {
					if (is_plugin_active(THEME_SWITCHA_FILE)) {
						deactivate_plugins(THEME_SWITCHA_FILE);
						
						$msg  = '<strong>'. THEME_SWITCHA_NAME .'</strong> ';
						$msg .= esc_html__('requires WordPress ', 'theme-switcha') . THEME_SWITCHA_REQUIRE;
						$msg .= esc_html__(' or higher, and has been deactivated! ', 'theme-switcha');
						$msg .= esc_html__('Please return to the', 'theme-switcha');
						$msg .= ' <a href="'. admin_url() .'">'. esc_html__('WP Admin Area', 'theme-switcha') .'</a> '; 
						$msg .= esc_html__('to upgrade WordPress and try again.', 'theme-switcha');
						
						wp_die($msg);
					}
				}
			}
		}
		
		public function load_i18n() {
			load_plugin_textdomain('theme-switcha', false, THEME_SWITCHA_DIR .'languages/');
		}
		
		public function __clone() {
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&rsquo; huh?', 'theme-switcha'), THEME_SWITCHA_VERSION);
		}
		
		public function __wakeup() {
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&rsquo; huh?', 'theme-switcha'), THEME_SWITCHA_VERSION);
		}
		
	}
}

if (class_exists('Theme_Switcha')) {
	
	$theme_switcha_options = get_option('theme_switcha_options', Theme_Switcha::options());
	$theme_switcha_options = apply_filters('theme_switcha_get_options', $theme_switcha_options);
	
	if (!function_exists('theme_switcha')) {
		
		function theme_switcha() {
			
			return Theme_Switcha::instance();
		}
	}
	
	theme_switcha();
	
}
