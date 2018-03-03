<?php

/**
 *Exit if Kirki not exist
 */
if (!class_exists('Kirki')) {
	return;
}

Kirki::add_config('business_prime_settings', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
));

Kirki::add_section('business_prime_homepage_layout_section', array(
	'title'    => __('Homepage Layout', 'business-prime'),
	'priority' => 1,
));

/**
 * Homepage Layout
 */
Kirki::add_field('business_prime_settings', array(
	'type'     => 'sortable',
	'section'  => 'business_prime_homepage_layout_section',
	'settings' => 'business_prime_homepage_layout',
	'label'    => esc_attr__('Homepage Sections', 'business-prime'),
	'help'     => esc_attr__('Drag and Drop to change order of section and enable/disable any section.', 'business-prime'),
	'default'  => array('slider', 'services', 'aboutus', 'callout', 'blog', 'portfolio', 'clients'),
	'priority' => 10,
	'choices'  => array(
		'slider'     => esc_attr__('Slider', 'business-prime'),
		'services'   => esc_attr__('Services ', 'business-prime'),
		'aboutus'    => esc_attr__('About Us ', 'business-prime'),
		'callout'    => esc_attr__('Callout ', 'business-prime'),
		'blog'       => esc_attr__('Blog', 'business-prime'),
		'portfolio'  => esc_attr__('Portfolio ', 'business-prime'),
		'clients'	 => esc_attr__('Brand Logo', 'business-prime'),
	),
));


/**
 * BusinessPrime Customizer UI Configuration.
 */
function business_prime_configuration() {

	$config['color_back']   = '#192429';
	$config['color_accent'] = '#008ec2';
	$config['width']        = '25%';

	return $config;
}

add_filter('kirki/config', 'business_prime_configuration');