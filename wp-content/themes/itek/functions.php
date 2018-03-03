<?php
/**
 * itek functions and definitions
 *
 * @package iTek
 */

if ( ! function_exists( 'itek_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function itek_setup() {
	
	/**
     * Set the content width based on the theme's design and stylesheet.
     */
    global $content_width;
	if ( ! isset( $content_width ) ) {
	   $content_width = 780; /* pixels */
	}
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on itek, use a find and replace
	 * to change 'itek' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'itek', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'itek-full-width', 1380, 770, true );
	add_image_size( 'itek-page-feature', 1230, 500, true ); //(cropped)
	add_image_size( 'itek-post-feature', 280, 180, true ); //(cropped)
	add_image_size( 'itek-post-standard', 940, 500, true ); //(cropped)
	add_image_size( 'itek-recentpost-thumb', 372, 176, true ); //(cropped)

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'itek' ),
		'secondary' => __( 'Secondary Menu', 'itek' ),
		'social'    => __( 'Social Menu', 'itek' ),
		'footer'    => __( 'Footer Menu', 'itek' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'itek_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );
}
endif; // itek_setup
add_action( 'after_setup_theme', 'itek_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function itek_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'iTek_Ephemera_Widget' );
	register_widget( 'iTek_RecentPostWidget' );
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'itek' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Showcase One - Above Content.', 'itek' ),
		'id' => 'header-showcase1',
		'description' => __( 'One of four above content showcase widget - ideal for use with the iTek - Alternative Recent Posts widget', 'itek' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Two - Above Content.', 'itek' ),
		'id' => 'header-showcase2',
		'description' => __( 'One of four above content showcase widget - ideal for use with the iTek - Alternative Recent Posts widget', 'itek' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Three - Above Content', 'itek' ),
		'id' => 'header-showcase3',
		'description' => __( 'One of four above content showcase widget - ideal for use with the iTek - Alternative Recent Posts widget', 'itek' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'itek_widgets_init' );

if ( !class_exists( 'PageShowcaseWidget' ) ) :
    include(get_template_directory() . '/inc/itek-page-showcase.php');
endif;

/**
 * Returns number of widgets in a widget position - used in the Header Showcase widget area.
 *
 * @since Itek 1.0.0
 */
function itek_header_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'header-showcase1' ) )
		$count++;

	if ( is_active_sidebar( 'header-showcase2' ) )
		$count++;

	if ( is_active_sidebar( 'header-showcase3' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

// Itek Custom Excerpt
function itek_trim_excerpt($itek_excerpt) {
  $raw_excerpt = $itek_excerpt;
  if ( '' == $itek_excerpt ) {
    $itek_excerpt = get_the_content(''); // Original Content
    $itek_excerpt = strip_shortcodes($itek_excerpt); // Minus Shortcodes
    $itek_excerpt = apply_filters('the_content', $itek_excerpt); // Filters
    $itek_excerpt = str_replace(']]>', ']]&gt;', $itek_excerpt); // Replace
    
	if (get_theme_mod( 'itek_feed_excerpt_length' )) :
		$feedlimit = get_theme_mod( 'itek_feed_excerpt_length' );
	else :
		$feedlimit = '85';
	endif;
    $excerpt_length = apply_filters('excerpt_length', $feedlimit); // Length
    $itek_excerpt = wp_trim_words( $itek_excerpt, $excerpt_length );
    
    // Use First Video as Excerpt
    $postcustom = get_post_custom_keys();
    if ($postcustom){
      $i = 1;
      foreach ($postcustom as $key){
        if (strpos($key,'oembed')){
          foreach (get_post_custom_values($key) as $video){
            if ($i == 1){
              $itek_excerpt = $video.$itek_excerpt;
            }
          $i++;
          }
        }  
      }
    }
  }
  return apply_filters('itek_trim_excerpt', $itek_excerpt, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'itek_trim_excerpt');

// Lets do a separate excerpt length for the alternative recent post widget
function itek_recentpost_excerpt () {
	$theContent = trim(strip_tags(get_the_content()));
		$output = str_replace( '"', '', $theContent);
		$output = str_replace( '\r\n', ' ', $output);
		$output = str_replace( '\n', ' ', $output);
			if (get_theme_mod( 'itek_recentpost_excerpt_length' )) :
			$limit = get_theme_mod( 'itek_recentpost_excerpt_length' );
			else : 
			$limit = '14';
			endif;
			$content = explode(' ', $output, $limit);
			array_pop($content);
		$content = implode(" ",$content)."  ";
	return strip_tags($content, ' ');
}

/**
 * Register Lato Google font for iTek.
 *
 * @since iTek 1.0
 *
 * @return string
 */
function itek_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'PT+Sans|Lato font: on or off', 'itek' ) ) {
		$font_url = esc_url(add_query_arg( 'family', urlencode( 'PT+Sans|Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" ));
	}

	return $font_url;
}


/**
 * Enqueue scripts and styles for the front end.
 *
 * @since iTek 1.0
 *
 * @return void
 */
 
function itek_ie_support_header() {
    echo '<!--[if lt IE 9]>'. "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>'. "\n";
    echo '<![endif]-->'. "\n";
}
add_action( 'wp_head', 'itek_ie_support_header', 1 );

/**
 * Enqueue scripts and styles
 */
function itek_scripts() {
	global $wp_styles;
	// Bump this when changes are made to bust cache
    $itek_theme = wp_get_theme();
    $version = $itek_theme->get( 'Version' );
	// CSS Scripts
    // Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'itek-lato', itek_font_url(), array(), null );
		
	wp_enqueue_style('itek-style', get_template_directory_uri().'/css/style.css', false ,$version, 'all' );
	wp_enqueue_style('itek-bootstrap', get_template_directory_uri().'/css/app.css', false ,$version, 'all' );
    wp_enqueue_style('itek-responsive', get_template_directory_uri().'/css/app-responsive.css', false ,$version, 'all' );
	wp_enqueue_style('itek-custom', get_template_directory_uri().'/css/custom.css', false ,$version, 'all' );
		
	// Load style.css from child theme
    if (is_child_theme()) {
        wp_enqueue_style('itek_child', get_stylesheet_uri(), false, $version, null);
    }
	
	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'itek-ie', get_template_directory_uri() . '/css/ie.css', array( 'itek-style' ), $version );
	wp_style_add_data( 'itek-ie', 'conditional', 'lt IE 8' );
		
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    	
	wp_enqueue_script('bootstrap.min.js', get_template_directory_uri().'/js/app.js', array('jquery'),$version, true );
	
	wp_enqueue_script( 'itek-bootstrapnav', get_template_directory_uri() . '/js/twitter-bootstrap-hover-dropdown.js', array(), $version, true );
	
	wp_enqueue_script( 'itek-custom-js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), false, true );
    
	wp_enqueue_script('modernizr.js', get_template_directory_uri().'/js/modernizr.custom.79639.js', array('jquery'),$version, false );
	
	$itek_header_image_link = get_header_image();
	wp_localize_script( 'itek-custom-js', 'itekScriptParam', array('itek_image_link'=> $itek_header_image_link ) );
		
}
add_action( 'wp_enqueue_scripts', 'itek_scripts' );

if ( get_theme_mod( 'itek_fitvids_enable' ) != 0 ) {

function itek_fitvids_scripts() {
$itek_theme = wp_get_theme();
$version = $itek_theme->get( 'Version' );
wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), $version, true );
} // end fitvids_scripts
add_action('wp_enqueue_scripts','itek_fitvids_scripts', 20);
// selector script
function itek_fitthem() { ?>
   	<script type="text/javascript">
   	jQuery(document).ready(function() {
   		jQuery('<?php echo get_theme_mod('itek_fitvids_selector'); ?>').fitVids({ customSelector: '<?php echo stripslashes(get_theme_mod('itek_fitvids_custom_selector')); ?>'});
   	});
   	</script>
<?php } // End selector script
add_action( 'wp_footer', 'itek_fitthem', 210 );
}


/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since iTek 1.0
 *
 * @return void
 */
function itek_admin_fonts() {
	wp_enqueue_style( 'itek-lato', itek_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'itek_admin_fonts' );

require get_template_directory() . '/inc/nav-menu-walker.php';

require get_template_directory() . '/inc/custom-header.php';

if ( ! function_exists( 'itek_internal_css' ) ) :
// Implement Custom Header features.

/**
 * Hooks the Custom Internal CSS to head section
 */
function itek_internal_css() {
	if ( get_header_image() ) : 
		$header_image_height = get_custom_header()->height;
		if ( get_theme_mod( 'itek_tagline_visibility' ) != 0 ) {
		    $height = $header_image_height -25;
        } else {
            $height = $header_image_height +20;
        }	

		$header = get_header_image();

		$header_image = "background-image: url('$header');";
		$header_repeat = " background-repeat: repeat-x;";
		$header_position = " background-position: center top;";
		$header_attachment = " background-attachment: scroll;";
		$header_image_style = $header_image . $header_repeat . $header_position . $header_attachment;
		if ( get_theme_mod( 'itek_headerimage_visibility' ) != 0 ) { ?>
		<style type="text/css" id="custom-header-css">
		#parallax-bg { <?php echo trim( $header_image_style ); ?> } .site { margin-top: <?php echo $height; ?>px; } 
		</style>
		<?php } elseif ( is_front_page() ) { ?>
		<style type="text/css" id="custom-header-css">
		#parallax-bg { <?php echo trim( $header_image_style ); ?> } .site { margin-top: <?php echo $height; ?>px; } 
		</style>
		<?php }
	endif;
}
add_action('wp_head', 'itek_internal_css');
endif;

if ( class_exists( 'woocommerce' ) ) {
/**
 * Custom WooCommerce functions for this theme.
 */
require get_template_directory() . '/inc/woo-functions.php';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since iTek 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function itek_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}
	return $classes;
}
add_filter( 'post_class', 'itek_post_classes' );