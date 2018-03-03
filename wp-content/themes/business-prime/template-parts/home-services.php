<!-- Services  Start -->
<div class="container-fluid bp-services bp-space">
	<div class="container">
		<div class="row bp-section">
			<h2 class="bp-section-title"><span> <?php echo esc_html(get_theme_mod('business_prime_services_header')); ?></span></h2>
			<p class="bp-section-description"> <?php echo esc_html(get_theme_mod('business_prime_services_desc')); ?> </p>
		</div>
		<div class="row bp-home-service">
		<?php 
			for ($i=1; $i <= 3; $i++) :
                $page_id = absint(get_theme_mod( 'business_prime_service_'.$i, 0));
            	$icon_class = get_theme_mod( 'business_prime_services_icon_'.$i, 'fa fa-star');
                $post = get_post($page_id);
	            ?>
				<div class="col-md-4 col-sm-6 home-service">
					<div class="col-md-12 home-service-inner">
						<div class="row bp-service-title">
							<i class="fa <?php echo esc_attr($icon_class); ?>"></i>
							<h2><?php echo wp_kses_post($post->post_title); ?></h2>
						</div>
						<div class="row bp-service-description">
							<p><?php echo wp_kses_post(strip_shortcodes($post->post_content)); ?></p>
						</div>
					</div>
				</div>
				<?php 
			endfor;
		?>
		</div>
	</div>
</div>
<!-- Services End -->