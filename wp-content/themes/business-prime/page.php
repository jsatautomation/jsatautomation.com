<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
                            <?php get_template_part('template-parts/content','page'); ?>
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
