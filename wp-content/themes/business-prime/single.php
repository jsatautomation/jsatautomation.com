<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package business-prime
 */
get_header(); 
business_prime_page_header();
?>
<div class="container-fluid bp-space w_blog">
    <div class="container">
        <div class="row w_blog_detail">
            <div class="col-md-9 w_right_side">
                <?php
                    while ( have_posts() ) : the_post();
                    ?>
                        <div class="row w_blog_single">
                            <?php get_template_part('template-parts/content','single'); ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row w_blog_pagination">
                            <ul class="pager">
                                <li class="previous"><?php previous_post_link('%link', '<i class="fa fa-angle-left icon"></i>'.__('Previous Post','business-prime'), TRUE); ?></li>
                                <li class="next"><?php next_post_link('%link', __('Next Post', 'business-prime').'<i class="fa fa-angle-right icon"></i>', TRUE); ?> </li>
                            </ul>
                        </div>
                <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    endwhile; // End of the loop.
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php
get_footer();
