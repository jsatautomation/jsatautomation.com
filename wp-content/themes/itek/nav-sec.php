    <div class="navbar navbar-inverse navbar-static-top">
       <div class="navbar-inner">
        <div class="container">
		
     	<!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".bottom-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
			
			<!-- Our menu needs to go here -->
			<?php wp_nav_menu( array(
	           'theme_location'	 => 'social',
			   'container'       => 'div',
			   'container_id'    => 'itek-social',
			   'container_class' => 'menu',
	           'menu_class'		 =>	'nav',
	           'depth'			 =>	1,
			   'link_before'     => '<span class="screen-reader-text">',
			   'link_after'      => '</span>',
	           'fallback_cb'	 =>	false,
	           )); 
            ?>
			
			<?php wp_nav_menu( array(
	           'theme_location'	 => 'secondary',
			   'container_class' => 'nav-collapse bottom-collapse',
	           'menu_class'		 =>	'nav pull-right',
	           'depth'			 =>	0,
	           'fallback_cb'	 =>	false,
	           'walker'			 =>	new iTek_Nav_Walker,
	           )); 
            ?>
					
        </div>
		</div><!-- /.navbar-inner -->
	</div><!-- /.navbar -->
