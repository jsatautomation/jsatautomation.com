<?php 
/*
* Template Name: Full Width
*/

get_header(); 
business_prime_page_header();
if(have_posts()): the_post();
?>
<div class="container-fluid bp-space w_blog">
    <div class="container">
        <div class="row w_blog_detail">
            <div class="col-md-12 w_right_side">
                <div class="row w_blog_single">
                    <?php get_template_part('template-parts/content','page'); ?>
                </div>
                <?php 
	                if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
            </div>
        </div>
    </div>
</div>
<?php 
endif; 
get_footer();
