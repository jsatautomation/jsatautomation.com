<!-- Our Blog Start-->
<div class="container-fluid bp-space bp-blogs">
	<div class="container">
		<div class="row bp-section">
			<h2 class="bp-section-title"><span> <?php echo esc_html(get_theme_mod('business_prime_home_blog_heading')); ?></span></h2>
			<p class="bp-section-description"> <?php echo esc_html(get_theme_mod('business_prime_home_blog_desc')); ?> </p>
		</div>
		<div class="row bp-home-blog">
			<?php 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'post', 'paged'=>$paged, 'posts_per_page' => 3, 'ignore_sticky_posts' => 1, );
				$wp_query = new WP_Query( $args );
				while($wp_query->have_posts()){
					$wp_query->the_post();
					get_template_part('template-parts/content','home'); 
				}
				wp_reset_postdata(); 
			?>
		</div>
	</div>
</div>
<!-- Our Blog End -->