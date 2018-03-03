<div id="post-<?php the_ID(); ?>" <?php post_class("col-md-12 w_blogs_post"); ?>>
	<?php if(has_post_thumbnail()): 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	<div class="img-thumbnail">
		<?php the_post_thumbnail('business-prime-825x350-crop', array( 'class' => 'img-responsive' )); ?>
	</div>
	<?php endif; ?>
	<div class="col-md-12 w_blogs_post_desc">
		<ul class="post-info">
			<li>
				<i class="fa fa-calendar"></i>
				<?php echo business_prime_get_post_date(); ?>
			</li>
			<li><i class="fa fa-folder"></i>
				<?php echo wp_kses_post(business_prime_get_categories()); ?>
			</li>
		</ul>
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-prime' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
</div>