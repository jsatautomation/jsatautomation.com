<div id="post-<?php the_ID(); ?>" <?php post_class("col-md-12 w_blogs_post"); ?>>
	<?php if(has_post_thumbnail()): 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
	<div class="img-thumbnail">
		<?php the_post_thumbnail('business-prime-825x350-crop', array( 'class' => 'img-responsive' )); ?>
		<?php if ( is_single() ): ?>
		<div class="overlay">
			<a class="bp-left" href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-chain icon"></i></a>
			<a class="bp-right" href="<?php echo esc_url($image[0]); ?>"><i class="fa fa-search icon"></i></a>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<div class="col-md-12 w_blogs_post_desc">
		<?php if(has_post_thumbnail() && !is_single()): ?>
		<div class="w_gravtor">
			<img src="<?php echo esc_url(get_avatar_url(get_the_author_meta( 'ID' ))); ?>" class="img-responsive"/>
		</div>
		<?php endif; ?>
		<ul class="post-info">
			<li>
				<i class="fa fa-calendar"></i>
				<?php echo business_prime_get_post_date(); ?>
			</li>
			<li><i class="fa fa-folder"></i>
				<?php echo wp_kses_post(business_prime_get_categories()); ?>
			</li>
		</ul>
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
		<?php if(is_single()): ?>
			<div class="entry-content">
				<?php
					the_excerpt( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'business-prime' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-prime' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php else: ?>
			<div class="entry-summary col-md-12"><?php the_excerpt(); ?></div>
			<a class="btn w-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php _e('READ MORE', 'business-prime'); ?></a>
		<?php endif; ?>
		
	</div>
</div>