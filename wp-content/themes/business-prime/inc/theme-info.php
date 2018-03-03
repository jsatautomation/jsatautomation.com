<?php

/* * *
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the WordPress Dashboard.
 *
 */


// Display Theme Info page.
function business_prime_theme_info_page() {
	// Get Theme Details from style.css.
	$theme = wp_get_theme();
	?>
	<div class="wrap theme-info-wrap">
		<div class="row">
			<div class="theme-left">
				<div class="theme-info-inner">
					<img src="<?php echo esc_url(get_template_directory_uri().'/screenshot.png'); ?>" class="img-responsive theme-screenshot">
				</div>
			</div>
			<div class="theme-right">
				<div class="theme-info-inner">
					<h1 class="theme-heading"> <?php esc_html_e( 'Welcome to', 'business-prime'); ?> <span class="theme-name"> <?php echo esc_html($theme->get( 'Name' )) ?> </span> <span class="theme-version"> <?php echo esc_html($theme->get( 'Version' )) ?> </span> </h1>
					<div class="theme-description"><?php echo esc_html( $theme->get( 'Description' ) ); ?></div>
					<br>
					<hr>
					<div class="info-links">
							<strong><?php esc_html_e( 'Theme Links', 'business-prime' ); ?></strong>
							<br>
							<br>
							<a class="button button-default" href="<?php echo esc_url( 'https://demo.themefarmer.com/business-prime/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Demo', 'business-prime' ); ?></a>
							<a class="button button-default" href="<?php echo esc_url( 'https://www.themefarmer.com/documentation/documentation-business-prime/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'business-prime' ); ?></a>
							<a class="button button-default" href="<?php echo esc_url( 'https://www.themefarmer.com/free-themes/business-prime/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'business-prime' ); ?></a>
							<a class="button button-default" href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/business-prime?filter=5' ); ?>" target="_blank"><?php esc_html_e( 'Give Us 5 Stars', 'business-prime' ); ?></a>
							<hr>
							<a class="button button-primary" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customize', 'business-prime' ); ?></a>
					</div>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<?php
}

// Add Theme Info page to admin menu.
function business_prime_add_theme_info_page() {
	// Get Theme Details from style.css
	$theme = wp_get_theme();
	add_theme_page(sprintf( esc_html__( 'Welcome to %1$s %2$s', 'business-prime' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ), esc_html__( 'Theme Info', 'business-prime' ), 'edit_theme_options', 'business-prime', 'business_prime_theme_info_page');
}
add_action( 'admin_menu', 'business_prime_add_theme_info_page' );

function business_prime_theme_info_page_css( $hook ) {

	if ( 'appearance_page_business-prime' != $hook ) {
		return;
	}
	wp_enqueue_style( 'business-prime-theme-info-style', get_template_directory_uri() . '/css/theme-info.css' );
}
add_action( 'admin_enqueue_scripts', 'business_prime_theme_info_page_css' );
