<?php
/**
 * Template Name: Full Width Page
 *
 * @package iTek
 * @since iTek 1.0.0
 */

get_header(); ?>

<div class="container">
	<div class="main row" role="main">
        <div class="content span12">
        <?php do_action( 'itek_before_page' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
        <?php do_action( 'itek_after_page' ); ?>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
