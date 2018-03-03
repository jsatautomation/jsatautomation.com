<?php if(!get_theme_mod('business_prime_hide_slider', false)): ?>
<!-- Slider Start  -->
<div class="row slider">
	<div class="swiper-container home-swiper">
		<div class="swiper-wrapper">
			<?php 
				for ($i=1; $i <= 3; $i++) :
	                $slide_page_id = absint(get_theme_mod( 'business_prime_slide_'.$i, 0));
	                if($slide_page_id){
	                	$slide_img = wp_get_attachment_image_src(get_post_thumbnail_id($slide_page_id), 'full');
	                	$slide_img = $slide_img[0];
	            	}else{
	            		$slide_img = get_template_directory_uri().'/images/slider'.$i.'.jpg';
	            	}
            	?>
				<div class="swiper-slide">
					<img src="<?php echo esc_url($slide_img); ?>" class="img-responsive"/>
					<div class="overlay"></div>
					<div class="carousel-caption">
						<div class="container">
							<div class="row bp-slider">
	                			<?php if($slide_page_id): $post = get_post($slide_page_id); ?>
								<h1 class="bp-slider-heading animation animated-item-1"><?php echo wp_kses_post($post->post_title); ?></h1>
								<p class="bp-slider-desc animation animated-item-2"><?php echo wp_kses_post($post->post_content); ?></p>
								<?php endif; ?>
								<a href="<?php echo esc_url(get_theme_mod('business_prime_slide_button_link')); ?>" class="btn s_link animation animated-item-3"> <?php echo esc_html(get_theme_mod('business_prime_slide_button_text')); ?> </a>
							</div>
						</div>
					</div>
				</div>
			<?php  endfor; ?>
		</div>
		 <!-- Add Pagination -->
	    <div class="swiper-pagination home-pagi"></div>

	    <!-- Add Arrows -->
	    <div class="swiper-button-prev home-prev"><i class="fa fa-angle-left"></i></div>
	    <div class="swiper-button-next home-next"><i class="fa fa-angle-right"></i></div>
	</div>			
</div>
<!-- Slider End -->
<?php endif; ?>