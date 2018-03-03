<?php
/**
 * Set up the WordPress core custom header feature.
 *
 * @uses business_prime_header_style()
 */
function business_prime_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'business_prime_custom_header_args', array(
		'default-image'          => esc_url(get_template_directory_uri() . '/images/header-bg.jpg'),
		'flex-height'            => true,
		'flex-width'             => true,
		'header-text'            => false,
		'width'                  => 1200,
		'height'                 => 700,
		'wp-head-callback'       => 'business_prime_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'business_prime_custom_header_setup' );

if ( ! function_exists( 'business_prime_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see business_prime_custom_header_setup().
 */
function business_prime_header_style() {
	// If we get this far, we have custom styles. Let's do this.
	?>
	<?php if ( get_header_image() ) : ?>
	<style type="text/css">
	.bp_header_pics {
    	background-image: url(<?php header_image(); ?>);
	}
	</style>
	<?php endif; // End header image check. 
}
endif;
