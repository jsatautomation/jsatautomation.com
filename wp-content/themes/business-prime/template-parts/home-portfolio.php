<!-- portfolio  Start -->
<div class="container-fluid bp-portfolio bp-space">
	<div class="container">
		<div class="row bp-section">
			<h2 class="bp-section-title"><span> <?php echo esc_html(get_theme_mod('business_prime_portfolio_heading')); ?></span></h2>
			<p class="bp-section-description"> <?php echo esc_html(get_theme_mod('business_prime_portfolio_desc')); ?> </p>
		</div>
		<div class="row bp-home-portfolio">
			<?php for ($i=1; $i <= 6; $i++) :
                	$image = get_theme_mod( 'business_prime_portfolio_image'.$i, get_template_directory_uri().'/images/portfolio/port'.$i.'.jpg');
                ?>
				<div class="col-md-4 col-sm-6 portfolio-item">
					<div class="portfolio-inner">
						<img src="<?php echo esc_url($image); ?>" class="img-thumbnail"/>
						<div class="port-overlay">
							<a class="port-show" href="<?php echo esc_url($image); ?>"><i class="fa fa-search"></i></a>
						</div>
					</div>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</div>
<!-- portfolio End -->