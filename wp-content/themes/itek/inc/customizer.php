<?php
/**
 * iTek Theme Customizer
 *
 * @package iTek
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function itek_customize_register( $wp_customize ) {
	
	// Add custom description to Title, Colors and Background sections.
	$wp_customize->get_section( 'title_tagline' )->description    = __( 'Enabling the tagline will push content section down off the header image!.', 'itek' );
	$wp_customize->get_section( 'colors' )->description           = __( 'TITLE NOTE: Default color is only applied to Site Title! Background may only be visible on wide screens.', 'itek' );
	$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'itek' );
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			
	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title & Tagline Color', 'itek' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title', 'itek' );

	$wp_customize->add_section( 'itek_general_options' , array(
       'title'      => __('iTek General Options','itek'),
	   'description' => sprintf( __( 'Use the following settings to set Sitewide General options.', 'itek' )),
       'priority'   => 31,
    ) );
	
	$wp_customize->add_section( 'itek_content_options' , array(
       'title'      => __('iTek Content Options','itek'),
	   'description' => sprintf( __( 'Use the following settings to set Content Options.', 'itek' )),
       'priority'   => 32,
    ) );
	
	// Add the featured content section in case it's not already there.
	$wp_customize->add_section( 'itek_showcase_content', array(
		'title'       => __( 'iTek Showcase Options', 'itek' ),
		'description' => sprintf( __( 'Use this section for extra finer controls of your Showcase area!', 'itek' ) ),
		'priority'    => 33,
	) );
	   
    $wp_customize->add_section( 'itek_fitvids_options' , array(
       'title'      => __('iTek FitVids Options','itek'),
	   'description' => sprintf( __( 'Use the following settings to set fitvids script options. Options are: Enable script, Set selector (Default is .post) and set custom selector (optional) for other areas like .sidebar or a custom section!', 'itek' )),
       'priority'   => 34,
    ) );
	
	$wp_customize->add_setting(
        'itek_tagline_visibility', array (
		'sanitize_callback' => 'itek_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'itek_tagline_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Display Site Tagline', 'itek'),
        'section' => 'title_tagline',
		'priority' => 20,
        )
    );
	
	$wp_customize->add_setting('itek_logo_image', array(
        'default-image'  => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'tanzanite_logo',
            array(
               'label'    => __( 'Upload a logo', 'itek' ),
               'section'  => 'title_tagline',
			   'priority' => 21,
               'settings' => 'itek_logo_image',
            )
        )
    );
	
	$wp_customize->add_setting(
        'itek_headerimage_visibility', array (
		'sanitize_callback' => 'itek_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'itek_headerimage_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Display Header On All Pages', 'itek'),
        'section' => 'header_image',
		'priority' => 1,
        )
    );
	
	// Begin General Options Section
	if (class_exists('woocommerce')) {

	$wp_customize->add_setting(
        'itek_woo_menu_cart_visibility', array (
		'sanitize_callback' => 'itek_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'itek_woo_menu_cart_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Add Cart Link To Primary Menu', 'itek'),
        'section' => 'itek_general_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
        'itek_woo_page_title_visibility', array (
		'sanitize_callback' => 'itek_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'itek_woo_page_title_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Hide WooCommerce Page Title', 'itek'),
        'section' => 'itek_general_options',
		'priority' => 2,
        )
    );
	}
	
	$wp_customize->add_setting(
        'itek_page_title_visibility', array (
		'sanitize_callback' => 'itek_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'itek_page_title_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Hide Standard Page Title', 'itek'),
        'section' => 'itek_content_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
        'itek_feed_excerpt_length', array (
		'sanitize_callback' => 'itek_sanitize_integer',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
    'itek_feed_excerpt_length',
    array(
        'type' => 'text',
		'default' => '85',
        'label' => __('Blog Feed Excerpt Length', 'itek'),
        'section' => 'itek_content_options',
		'priority' => 2,
        )
    );
	
	$wp_customize->add_setting(
    'itek_recentpost_excerpt_length', array (
		'sanitize_callback' => 'itek_sanitize_integer',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
    'itek_recentpost_excerpt_length',
    array(
        'type' => 'text',
		'default' => '25',
        'label' => __('Recent Post Widget Excerpt Length', 'itek'),
        'section' => 'itek_content_options',
		'priority' => 3,
        )
    );
	
    // Showcase Options
    $wp_customize->add_setting(
        'itek_showcase_disable_morphing', array (
		'sanitize_callback' => 'itek_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'itek_showcase_disable_morphing',
    array(
        'type'     => 'checkbox',
        'label'    => __('Disable Showcase Image Morphing', 'itek'),
        'section'  => 'itek_showcase_content',
		'priority' => 1,
        )
    );	
		
	// Add FitVids to site
    $wp_customize->add_setting(
        'itek_fitvids_enable', array (
		'sanitize_callback' => 'itek_sanitize_checkbox',
		'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'itek_fitvids_enable',
    array(
        'type'     => 'checkbox',
        'label'    => __('Enable FitVids?', 'itek'),
        'section'  => 'itek_fitvids_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
    'itek_fitvids_selector',
    array(
        'default' => '.post',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
    'itek_fitvids_selector',
    array(
        'label' => __('Enter a selector for FitVids - i.e. .post','itek'),
        'section' => 'itek_fitvids_options',
		'priority' => 2,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
    'itek_fitvids_custom_selector',
    array(
        'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
    ));
	
	$wp_customize->add_control(
    'itek_fitvids_custom_selector',
    array(
        'label' => __('Enter a custom selector for FitVids - i.e. .sidebar','itek'),
        'section' => 'itek_fitvids_options',
		'priority' => 3,
        'type' => 'text',
    ));
}
add_action( 'customize_register', 'itek_customize_register' );

/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'itek_sanitize_checkbox' ) ) :
	function itek_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return 0;
		}
	}
endif;

/**
 * Sanitize the Integer Input values.
 *
 * @since iTek 1.0.0
 *
 * @param string $input Integer type.
 */
function itek_sanitize_integer( $input ) {
	return absint( $input );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function itek_customize_preview_js() {
	wp_enqueue_script( 'itek_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'itek_customize_preview_js' );


function itek_HookCSS () {
  echo itek_CleanupCSS( itek_GenerateCSS() );
}
add_action( 'wp_head', 'itek_HookCSS' );

function itek_GenerateCSS() {

// The concatenating string for the CSS:
$s = '<style>';
 
if ( get_theme_mod( 'itek_showcase_disable_morphing' ) !=1 ) { 
  $s.='#supplementary .widget-area:hover .img-circle {
    border-radius: 3%;
	width: 75%;
	height: 125px;
	-webkit-transition: border-radius 1.9s linear, width 3.2s ease-in;
    -moz-transition: border-radius 1.9s linear, width 3.2s ease-in;
    -ms-transition: border-radius 1.9s linear, width 3.2s ease-in;
    -o-transition: border-radius 1.9s linear, width 3.2s ease-in;
    transition: border-radius 1.9s linear, width 3.2s ease-in;
    }';
}

if ( get_theme_mod( 'itek_page_title_visibility' ) !=0 ) {
    $s.='.page .entry-title {display: none; visibility: hidden;}';
}

if ( get_theme_mod( 'itek_woo_page_title_visibility' ) !=0 ) {
    $s.='.page-title {display: none; visibility: hidden;}';
	$s.='.woocommerce .woocommerce-ordering, .woocommerce .woocommerce-result-count, 
	.woocommerce-page .woocommerce-ordering, .woocommerce-page .woocommerce-result-count {
    margin-top: 30px;}';
}
  
$s.='</style>';

  return $s;

} // itek_GenerateCSS()


/**
* Little helper function 
* Does a better job then WP
*/
function itek_CleanupCSS($buffer) {
  // Remove comments
  $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
 
  // Remove some unnecessary white space
  $buffer = str_replace(': ', ':', $buffer);
  $buffer = str_replace('{ ', '{', $buffer);
  $buffer = str_replace(' }', '}', $buffer);
 
  // Remove rest of the whitespace and CR/LF/TAB
  $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '   ', '    '), '', $buffer);
  
  return $buffer;
} // itek_CleanupCSS()

// EOF