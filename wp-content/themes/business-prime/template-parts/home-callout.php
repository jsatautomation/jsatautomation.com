<?php 
$cta_page_id = get_theme_mod('business_prime_callout', 0);
$post = get_post($cta_page_id);
$style ='';
if(isset($cta_page_id) && absint($cta_page_id) >0 && has_post_thumbnail($cta_page_id)){
	$image_src = wp_get_attachment_image_url(get_post_thumbnail_id($cta_page_id));
	$style = 'background-image:URL('.esc_url($image_src).')';
}
?>
<!-- callout  Start -->
<div class="bs-p-callout-con">
	<div class="blur-backgound callout-backgound" style="<?php echo (!empty($style))? esc_attr($style):''; ?>"></div>
		<div class="container-fluid bp-callout">
			<div class="container">
				<div class="bp-section text-center">
					<?php if(isset($cta_page_id) && absint($cta_page_id) >0 ): ?>
					<h2 class="bp-section-title"> <?php echo apply_filters('the_title', $post->post_title); ?> </h2>
					<p class="bp-section-description"> <?php echo wp_kses_post(wp_trim_words($post->post_content, 55, ''));  ?> </p>
					<?php endif; ?>
				</div>
				<div class="callout-buttons">
					<a class="btn call-link bt-1" href="<?php echo esc_url(get_theme_mod('business_prime_home_cta_one_url')); ?>"> <?php echo esc_html(get_theme_mod('business_prime_home_cta_one_text')); ?> </a>
					<a class="btn call-link bt-2" href="<?php echo esc_url(get_theme_mod('business_prime_home_cta_two_url')); ?>"> <?php echo esc_html(get_theme_mod('business_prime_home_cta_two_text')); ?> </a>
				</div>
			</div>
	</div>
</div>
<!-- callout End -->