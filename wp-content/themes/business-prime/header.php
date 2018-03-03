<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package business-prime
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div  class="wrapper site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'business-prime' ); ?></a>
	
	<header id="masthead" class="site-header nav-down" role="banner">
		<!-- Primary Nav Start-->
	    <nav class="navbar navbar-default menu">
			<div class="container-fluid">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#TF-Navbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>                        
						</button>
						<div class="site-branding">
							<?php
								if ( function_exists( 'the_custom_logo' ) && function_exists( 'has_custom_logo' ) && has_custom_logo()) :
									
									if ( is_front_page() && is_home() ) : ?>
										<h1 class="site-title"><?php the_custom_logo();?></h1>
									<?php else : ?>
										<p class="site-title"><?php the_custom_logo();?></a></p>
									<?php
									endif;
								else :
									if ( is_front_page() && is_home() ) : ?>
										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php else : ?>
										<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
									<?php
									endif;
									$description = get_bloginfo( 'description', 'display' );
									if ( $description || is_customize_preview() ) : ?>
										<p class="site-description"><?php echo $description; ?></p>
									<?php
									endif; 
								endif;
							?>	
						</div><!-- .site-branding -->
					</div>			
					<?php 
						$args = array(
										'theme_location'    => 'primary',
										'depth'             =>  0,
										'container'         => 'div',
										'container_class'   => 'collapse navbar-collapse',
										'container_id'      => 'TF-Navbar',
										'menu_class'        => 'nav navbar-nav navbar-right',
										'fallback_cb'       => 'business_prime_fallback_page_menu',
										'walker'            => new business_prime_nav_walker()
							  );
						wp_nav_menu($args);
					?>
				</div>
			</div>
		</nav>
		<!-- Primary Nav End-->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
