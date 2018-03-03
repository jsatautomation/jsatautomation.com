<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package business-prime
 */
?>
 <?php if ( post_password_required() ) : ?>
	<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'business-prime' ); ?></p>
<?php return;
endif; ?>
<?php if ( have_comments() ) : ?>
<div id="comments" class="row bp_comment">	
	<h2><?php echo comments_number(__('No Comments','business-prime'), __('1 Comment','business-prime'), '% Comments'); ?></h2>
	<?php wp_list_comments( array( 'callback' => 'business_prime_comment' ) ); ?>		
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="row pagination bp_blog_pagination">
		<h1 class="assistive-text"><?php _e( 'Comment navigation', 'business-prime' ); ?></h1>
		<ul class="pager">
			<li class="nav-previous previous"><?php previous_comments_link( __( 'Previous Comments', 'business-prime' ) ); ?>
			</li>
			<li class="nav-next next"><?php next_comments_link( __( 'Next Comments', 'business-prime' ) ); ?>
			</li>
		</ul>
	</nav>
<?php endif;  ?>
</div>		
<?php endif; ?>
<?php if ( comments_open() ) : ?>
	<div class="row bp_comment_form">
		<?php  comment_form(); ?>		
	</div>
<?php endif; // If registration required and not logged in ?>