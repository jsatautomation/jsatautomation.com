<?php // Uninstall Remove Options

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) exit();

delete_option('theme_switcha_options');
