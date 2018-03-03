<!-- Clients  Start -->
<div class="container-fluid bp-clients bp-space">
	<div class="container">
		<div class="row bp-section">
			<h2 class="bp-section-title"><span> <?php echo esc_html(get_theme_mod('business_prime_clients_heading')); ?></span></h2>
			<p class="bp-section-description"> <?php echo esc_html(get_theme_mod('business_prime_clients_desc')); ?> </p>
		</div>
		<div class="swiper-container home-clients">
			<div class="bp-home-clients swiper-wrapper">
				<?php for ($i=1; $i <= 4; $i++) :
                		$image = get_theme_mod( 'business_prime_brand_image'.$i, get_template_directory_uri().'/images/brands/brand'.$i.'.png');
                 ?>
				<div class="clients swiper-slide">
					<div class="img-thumbnail">
						<img src="<?php echo esc_url($image); ?>" class="img-thumbnail"/>
					</div>
				</div>
				<?php endfor; ?>
			</div>
			<div class="swiper-button-prev client-prev"><i class="fa fa-angle-left"></i></div>
			<div class="swiper-button-next client-next"><i class="fa fa-angle-right"></i></div>
		</div>		
	</div>
</div>
<!-- Clients End -->