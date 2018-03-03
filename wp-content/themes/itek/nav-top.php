<div class="navbar navbar-inverse navbar-fixed-top">
       <div class="navbar-inner">
        <div class="container">
        <?php if (get_theme_mod( 'itek_logo_image' )) : ?>
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			    <img src="<?php echo esc_url(get_theme_mod( 'itek_logo_image' )); ?>" alt="<?php echo esc_html(get_theme_mod( 'itek_logo_alt_text' )); ?>" />
			</a>
		<?php else : ?>
            <a class="brand" href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span><?php bloginfo( 'name' ); ?></span></a>
        <?php endif; ?>
			<!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
			
			<!-- Our menu needs to go here -->
			<?php wp_nav_menu( array(
	           'theme_location'	 => 'primary',
			   'container_class' => 'nav-collapse top-collapse',
	           'menu_class'		 =>	'nav pull-right',
	           'depth'			 =>	0,
	           'fallback_cb'	 =>	false,
	           'walker'			 =>	new iTek_Nav_Walker,
			   )); 
            ?>
            			
        </div>
		</div><!-- /.navbar-inner -->
	</div><!-- /.navbar -->
