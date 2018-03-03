<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package business-prime
 */?>
<div id="secondary" class="col-md-3 w_left_sidebar" role="complementary">
<?php
if (is_active_sidebar( 'sidebar' ) ) {
	 dynamic_sidebar( 'sidebar' ); 
}else{

	$args = array(
		'name'          => esc_html__( 'Sidebar', 'business-prime' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Sidebar Widget Area', 'business-prime' ),
		'before_widget' => '<div class="row widget sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	);
	the_widget('WP_Widget_Calendar', 'title='.esc_html__('Calendar', 'business-prime'), $args);
	the_widget('WP_Widget_Search', 'title='.esc_html__('Search', 'business-prime'), $args);
	the_widget('WP_Widget_Tag_Cloud', null, $args);
	the_widget('WP_Widget_Archives', null, $args);
	the_widget('WP_Widget_Recent_Posts', null, $args);
	the_widget('WP_Widget_Categories', null, $args);

}
?>
</div><!-- #secondary -->