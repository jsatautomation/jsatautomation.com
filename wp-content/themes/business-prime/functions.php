<?php
/**
 * Business Prime functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package business-prime
 */


if ( ! function_exists( 'business_prime_setup' ) ) :
function business_prime_setup() {
	load_theme_textdomain( 'business-prime', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-background', array( 'default-color' => 'f4f4f4' ));
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'business-prime' ),
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	));
	add_theme_support( 'woocommerce' );
	add_image_size( 'business-prime-825x350-crop', '825', '350', true);
	add_image_size( 'business-prime-285x230-crop', '285', '230', true);
	
}
endif;
add_action( 'after_setup_theme', 'business_prime_setup' );

function business_prime_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'business_prime_content_width', 640 );
}
add_action( 'after_setup_theme', 'business_prime_content_width', 0 );

function business_prime_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'business-prime' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Sidebar Widget Area', 'business-prime' ),
		'before_widget' => '<div class="row widget sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
        'name' => esc_html__( 'Footer Widget Area', 'business-prime' ),
        'id' => 'footer-widget-area',
        'description' => esc_html__( 'footer widget area', 'business-prime' ),
        'before_widget' => '<div class="col-md-3 col-sm-6 widget footer-widget">',
        'after_widget'  =>  '</div>',
        'before_title'  =>  '<div class="row widget-heading"><h3>',
        'after_title'   =>  '</h3></div>',
    ));
		
}
add_action( 'widgets_init', 'business_prime_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function business_prime_scripts() {
	
	
	wp_enqueue_style( 'business-prime-google-fonts', 'https://fonts.googleapis.com/css?family=Alegreya+Sans:100,300,400,400i,700'); 
    wp_enqueue_style( 'business-prime-font-awesome',  get_template_directory_uri()."/css/font-awesome.min.css");
    wp_enqueue_style( 'business-prime-animate',  get_template_directory_uri()."/css/animate.min.css");
    wp_enqueue_style( 'business-prime-bootstrap',  get_template_directory_uri()."/css/bootstrap.min.css");
    wp_enqueue_style( 'business-prime-simplelightbox',  get_template_directory_uri()."/css/simplelightbox.min.css");
    wp_enqueue_style( 'business-prime-swiper',  get_template_directory_uri()."/css/swiper.min.css");
    wp_enqueue_style( 'business-prime-style', get_stylesheet_uri() );
	wp_enqueue_style( 'business-prime-media',  get_template_directory_uri()."/css/media-screen.css");
    
    
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); 	}
	wp_enqueue_script( 'business-prime-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'business-prime-wow', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'business-prime-simple-lightbox', get_template_directory_uri() . '/js/simple-lightbox.min.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'business-prime-swiper', get_template_directory_uri() . '/js/swiper.min.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'business-prime-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'business-prime-custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'business-prime-respond', get_template_directory_uri().'/js/respond.min.js' );
    wp_script_add_data( 'business-prime-respond', 'conditional', 'lt IE 9' );
 
    wp_enqueue_script( 'business-prime-html5shiv',get_template_directory_uri().'/js/html5shiv.js');
    wp_script_add_data( 'business-prime-html5shiv', 'conditional', 'lt IE 9' );
	
}
add_action( 'wp_enqueue_scripts', 'business_prime_scripts' );

remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination');
function business_prime_woocommerce_pagination() {
	?>
        <div class="clearfix"></div>
        <div class="bp-pagination">
            <?php the_posts_pagination();?>
        </div>
    <?php
}
add_action('woocommerce_after_shop_loop', 'business_prime_woocommerce_pagination', 10);

require get_template_directory() . '/inc/business-prime-customizer.php';
require get_template_directory() . '/inc/business-prime-sanitize-cb.php';
require get_template_directory() . '/inc/business-prime-walker.php';
require get_template_directory() . '/inc/business-prime-functions.php';
require get_template_directory() . '/inc/themefarmer-breadcrumbs.php';
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/theme-info.php';
require get_template_directory() . '/inc/include-kirki.php';
require get_template_directory() . '/inc/kirki-config.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
