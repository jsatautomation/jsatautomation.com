<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package business-prime
 */
?>
	</div><!-- #content -->
	<!-- Footer Start -->
    <footer class="site-footer footer" role="contentinfo">
        <div class="container-fluid w_footer">
            <div class="container">
				<div class="row bp-footer">
					<?php 
						$footer_widget  = array(
							'name' => esc_html__( 'Footer Widget Area', 'business-prime' ),
							'id' => 'footer-widget-area',
							'description' => esc_html__( 'footer widget area', 'business-prime' ),
							'before_widget' => '<div class="col-md-3 col-sm-6 widget footer-widget">',
							'after_widget'  =>  '</div>',
							'before_title'  =>  '<div class="row widget-heading"><h3>',
							'after_title'   =>  '</h3></div>',
						);

					   if ( is_active_sidebar( 'footer-widget-area' ) ) {
							 dynamic_sidebar( 'footer-widget-area'); 
						 }else{ 
							the_widget('WP_Widget_Calendar', 'title='.esc_attr__('Calendar', 'business-prime'), $footer_widget);
							the_widget('WP_Widget_Categories', null, $footer_widget);
							the_widget('WP_Widget_Pages', null, $footer_widget);
							the_widget('WP_Widget_Archives', null, $footer_widget);
						} 
					?>
				</div>
            </div>
        </div>
        <div class="conatainer-fluid footer-copy">
            <div class="container">
                <div class="col-md-8 col-sm-8 footer-copy-text">
                    <p>&copy; <?php echo esc_html(date('Y')).' '; bloginfo( 'name' ); ?> | <?php printf( esc_html__( 'Theme by %1$s', 'business-prime' ),  '<a href="'.esc_url('https://www.themefarmer.com').'" rel="designer">Theme Farmer</a>' ); ?></p>
                </div>
                <div class="col-md-4 col-sm-4 footer-copy-social">
                    <?php business_prime_get_social_block() ?>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>
