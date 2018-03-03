<?php 
get_header();
$homepage_layout = get_theme_mod('business_prime_homepage_layout', array('slider', 'services', 'aboutus', 'callout', 'blog', 'portfolio', 'clients'));
if($homepage_layout){
	foreach ($homepage_layout as $key => $section) {
		get_template_part('template-parts/home', $section);
	}
}
get_footer();
