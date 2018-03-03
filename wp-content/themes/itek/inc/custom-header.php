<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package iTek
 * @since iTek 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses itek_header_style()
 * @uses itek_admin_header_style()
 * @uses itek_admin_header_image()
 *
 * @package iTek
 */
function itek_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'itek_custom_header_args', array(
		'default-image'          => '%s/img/header.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1600,
		'height'                 => 380,
		'flex-width'				 => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'itek_header_style',
		'admin-head-callback'    => 'itek_admin_header_style',
		'admin-preview-callback' => 'itek_admin_header_image',
	) ) );

	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(
		'header-image' => array(
			'url'           => '%s/img/header.jpg',
			'thumbnail_url' => '%s/img/header-thumbnail.jpg',
			'description'   => __( 'Header Image', 'itek' )
		)	
	) );
}
add_action( 'after_setup_theme', 'itek_custom_header_setup' );

if ( ! function_exists( 'itek_header_style' ) ) :

/**
 * Styles the header text displayed on the blog.
 *
 */
function itek_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.brand {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.brand,
        .site-description {
			color: #<?php echo $header_text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // itek_header_style

if ( ! function_exists( 'itek_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see itek_custom_header_setup().
 */
function itek_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
			text-decoration: none;
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // itek_admin_header_style

if ( ! function_exists( 'itek_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see itek_custom_header_setup(). 
 */
function itek_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // itek_admin_header_image
