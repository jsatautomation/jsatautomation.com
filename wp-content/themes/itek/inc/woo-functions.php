<?php // WooCommerce Functions for iTek theme

if ( ! function_exists( 'itek_woo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function itek_woo_setup() {
	
	/*
	 * Enable support for WooCemmerce.
	*/
	add_theme_support( 'woocommerce' );

}
endif; // itek_woo_setup
add_action( 'after_setup_theme', 'itek_woo_setup' );

/**
 * Set Default Thumbnail Sizes for Woo Commerce Product Pages, on Theme Activation
*/
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'itek_woocommerce_image_dimensions', 1 );
/**
 * Define image sizes
*/
function itek_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '472',	// px
		'height'	=> '300',	// px
		'crop'		=> 1 		// true
	);
	$single = array(
		'width' 	=> '672',	// px
		'height'	=> '472',	// px
		'crop'		=> 1 		// true
	);	 
	$thumbnail = array(
		'width' 	=> '372',	// px
		'height'	=> '186',	// px
		'crop'		=> 0 		// false
	);	 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

function itek_woo_scripts() {
$itek_theme = wp_get_theme();
$version = $itek_theme->get( 'Version' );

	wp_enqueue_style('itek-woocommerce', get_template_directory_uri().'/css/customwoo.css', false ,$version, 'all' );
	wp_enqueue_style( 'font_awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', false, null, 'all' );
	
}
add_action( 'wp_enqueue_scripts', 'itek_woo_scripts' );

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 */

function itek_woomenucart($menu, $args) {

	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		$viewing_cart = __('View your shopping cart', 'itek');
		$start_shopping = __('Start shopping', 'itek');
		$cart_url = $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'itek'), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// if ( $cart_contents_count > 0 ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="right"><a class="woomenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
			} else {
				$menu_item = '<li class="right"><a class="woomenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
			}

			$menu_item .= '<i class="fa fa-shopping-cart"></i> ';

			$menu_item .= $cart_contents.' - '. $cart_total;
			$menu_item .= '</a></li>';
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// }
		echo $menu_item;
	$social = ob_get_clean();
	return $menu . $social;

}
if ( get_theme_mod( 'itek_woo_menu_cart_visibility' ) != 0 ) {
add_filter('wp_nav_menu_items','itek_woomenucart', 10, 2);
}