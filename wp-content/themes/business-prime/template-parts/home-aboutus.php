<!-- About Us  Start -->
<?php 
	$page_id = get_theme_mod('business_prime_aboutus', 0); 
	$post = get_post($page_id);
	if(isset($page_id) && absint($page_id) >0 && has_post_thumbnail($page_id)){
		$image_src = wp_get_attachment_image_url(get_post_thumbnail_id($page_id));
	}else{
		$image_src = get_template_directory_uri().'/images/about-us.jpg';
	}
?>
<div class="container-fluid bp-aboutus bp-space">
	<div class="container">
		<div class="row">
			<div class="col-md-6 bp-aboutus-img">
				<img class="img-responsive" src="<?php echo esc_url($image_src); ?>">
			</div>
			<div class="col-md-6 bp-section">
				<h2 class="bp-section-title"><span> <?php echo apply_filters('the_title', $post->post_title); ?> </span></h2>
				<p class="bp-section-description"> <?php echo wp_kses_post(wp_trim_words($post->post_content, 100, ''));  ?> </p>
			</div>
		</div>
	</div>
</div>
<!-- About Us End -->