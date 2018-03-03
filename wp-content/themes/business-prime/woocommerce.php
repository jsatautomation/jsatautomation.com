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
            <div class="col-md-12 w_right_side bp-woocommerce">
                <?php if ( have_posts() ) : ?>
                    <?php woocommerce_content(); ?>
                <?php endif; ?> 
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
