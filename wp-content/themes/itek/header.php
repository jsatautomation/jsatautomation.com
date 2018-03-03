<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 		
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
    <?php wp_head(); ?>
  </head>
<body <?php body_class(); ?>>
<div id="parallax-bg"></div>

<header id="masthead" class="site-header" role="banner">
<?php if ( get_theme_mod( 'itek_tagline_visibility' ) != 0 ) { ?>
    <div class="container">
	   <h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
   </div>
<?php } ?>
</header> <!--/#header-->
<?php do_action( 'itek_before_top_nav' ); ?>
<?php get_template_part( 'nav-top' ); ?>
<?php do_action( 'itek_after_top_nav' ); ?>

<div class="clearfix"></div>
<div id="page" class="hfeed site">

<?php 
do_action( 'itek_before_secondary' );
if ( has_nav_menu( 'secondary' ) || has_nav_menu( 'social' ) ) : // Check if there's a menu assigned to either the 'secondary' or 'social' locations. ?>
   <div class="clearfix"></div>
   <?php get_template_part( 'nav-sec' ); 
endif; // End check for menu.
do_action( 'itek_after_secondary' );
?>

<?php if ( is_front_page() ) : ?>
<div class="container">
<div id="showcase">
	<?php do_action( 'itek_before_in_showcase' ); ?>
        <?php get_sidebar( 'showcase' ); ?>
	<?php do_action( 'itek_after_in_showcase' ); ?>
</div>
</div>
<?php endif; ?>

<div class="container">