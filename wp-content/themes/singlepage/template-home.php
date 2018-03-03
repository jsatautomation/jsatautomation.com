<?php
/**
 * Template Name: Home Page
 *
 * @since SinglePage 1.2.5
 */
      get_header("featured");
     global $allowedposttags;
	 
	  $allowedposttags['iframe'] = array(
	  'align' => true,
	  'width' => true,
	  'height' => true,
	  'frameborder' => true,
	  'name' => true,
	  'src' => true,
	  'id' => true,
	  'class' => true,
	  'style' => true,
	  'scrolling' => true,
	  'marginwidth' => true,
	  'marginheight' => true,
	  
	  );
	 $detect                     = new Mobile_Detect;
     $sectionNum                 = of_get_option('section_num', 4);
	 $hide_scroll_bar            = of_get_option('hide_scroll_bar', 0);
	 $section_height_mode        = of_get_option('section_height_mode', 1);
     $section_menu_title         = array("SECTION ONE","SECTION TWO","SECTION THREE","SECTION FOUR");
	 $section_menu_slug          = array("section-one","section-two","section-three","section-four");
	 $section_content_color      = array("#ffffff","#ffffff","#ffffff","#ffffff");
	 $section_css_class          = array("","","","");
	 $section_background_size    = array("yes","no","no","yes");
	 $imagepath =  get_template_directory_uri() . '/images/';
	 
	  $video_background_section  = of_get_option( 'video_background_section',0);
	  $mp4_video_url       = esc_url( of_get_option( 'mp4_video_url' ) );
	  $ogv_video_url       = esc_url( of_get_option( 'ogv_video_url' ));
	  $webm_video_url      = esc_url( of_get_option( 'webm_video_url' ));
	  $poster_url          = esc_url( of_get_option( 'poster_url' ));
	  $video_loop          = esc_attr( of_get_option( 'video_loop' ));
	  $video_volume        = esc_attr( of_get_option( 'video_volume' ));
	  $video_volume        = $video_volume == "" ? 0.8 : $video_volume ;
	  
	  $google_map_section  = of_get_option( 'google_map_section',0);
	  $google_map_address  = esc_attr( of_get_option( 'google_map_address','Sydney, NSW'));
	  $google_map_zoom     = absint( of_get_option( 'google_map_zoom',10));
	  
	  $menu_style_desktop   = absint( of_get_option( 'menu_style_desktop',1));
	  $menu_status_desktop  = esc_attr( of_get_option( 'menu_status_desktop','open'));
	  $menu_style_tablet    = absint( of_get_option( 'menu_style_tablet',1));
	  $menu_status_tablet   = esc_attr( of_get_option( 'menu_status_tablet','open'));
	  $menu_style_mobile    = absint( of_get_option( 'menu_style_mobile',2));
	  $menu_status_mobile   = esc_attr( of_get_option( 'menu_status_mobile','close'));
	  
	  $menu_style   = $menu_style_desktop;
	  $menu_status  = $menu_status_desktop;
	  
	  if( $detect->isTablet() ){
         $menu_style  = $menu_style_tablet;
		 $menu_status = $menu_status_tablet;
	   }
	  if( $detect->isMobile() && !$detect->isTablet() ){
		 $menu_style  = $menu_style_mobile;
		 $menu_status = $menu_status_mobile;
	  }
	 
  
 
	 $section_background = array(
	     array(
		'color' => '',
		'image' => $imagepath.'bg_01.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' ),
		 array(
		'color' => '',
		'image' => $imagepath.'bg_02.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' ),
		 array(
		'color' => '',
		'image' => $imagepath.'bg_03.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' ),
		 array(
		'color' => '',
		'image' => $imagepath.'bg_04.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'fixed' )
		 );
	 $section_image     = array(
								$imagepath.'1.png',
								$imagepath.'2.png',
							    $imagepath.'3.png',
								$imagepath.'4.png'
								);
	 
	 $section_content   = array('<p><h1 class="section-title">Impressive Design</h1><br>
<ul>
	<li>Elegans Lorem Ratio amoena</li>
	<li>fons et oculorum captans iconibus</li>
	<li> haec omnia faciant ad melioris propositi vestri website</li>
</ul>
</p>',
		'<p><h1 class="section-title">Responsive Layout</h1><br>
</p>',
			'<p><h1 class="section-title">Flexibility</h1><br>
<ul>
	<li>Lorem ipsum dolor sit amet</li>
	<li>consectetur adipiscingelit</li>
	<li>Integer sed magna vel </li>
	<li>Dapibus ege-stas turpis.</li>
</ul>
</p>',
		'<p><h1 class="section-title">Continuous  Support</h1><br>
<ul>
	<li>Lorem ipsum dolor sit amet</li>
	<li>consectetur adipiscingelit</li>
	<li>Integer sed magna vel velit</li>
	<li>Dapibus ege-stas turpis.</li>
</ul>
</p>' );
  $output                   = "";
  $sub_nav                  = "";
  
		if(  $sectionNum > 0 ) { 
		    for( $i=0; $i<$sectionNum; $i++ ){ 
			
	$section_full_width =  of_get_option('section_full_width_'.$i, 0 );
	$menu_title        =  of_get_option('section_menu_title_'.$i, $section_menu_title[$i] );
	$menu_slug         =  of_get_option('section_menu_slug_'.$i, $section_menu_slug[$i] );
	if( !$menu_slug )
	$menu_slug         =  'section-'.($i+1);
	
	$class             =  of_get_option('section_css_class_'.$i, $section_css_class[$i]) ;
	$image  	       =  of_get_option('section_image_'.$i, $section_image[$i]) ;
	$image_link        =  of_get_option('section_image_link_'.$i, '') ;
	$image_link_target =  of_get_option('section_image_link_target_'.$i,'') ;
	
	$content	       =  of_get_option('section_content_'.$i, $section_content[$i]);
	$content_color     =  of_get_option('section_content_color_'.$i, $section_content_color[$i]) ;
	$section_background_       = of_get_option( 'section_background_'.$i,$section_background[$i]);
    $background                = singlepage_get_background( $section_background_ );
	
	// background for mobile 
		
	$background_tablet         = singlepage_get_background( of_get_option( 'section_background_tablet_'.$i,'') );
	$background_mobile         = singlepage_get_background( of_get_option( 'section_background_mobile_'.$i,'') );
	

	if( $detect->isTablet() && $background_tablet ){
       $background             = $background_tablet;
     }
	if( $detect->isMobile() && !$detect->isTablet() && $background_mobile ){
       $background             = $background_mobile;
    }
	
	
    $section_background_size_  = of_get_option( 'background_size_'.$i, $section_background_size[$i] );
	
	// section content
	
	$content_style             = '';
	
	$section_content_background =  of_get_option( 'section_content_background_'.$i,'');
	$border_radius	            =  of_get_option('border_radius_'.$i, '0');
	$opacity    	            =  of_get_option('opacity_'.$i, '1');

	if( $section_content_background ){
		$rgb = singlepage_hex2rgb( $section_content_background );
	    $content_style .= "background-color: rgba(".$rgb[0].",".$rgb[1].",".$rgb[2].",".$opacity.");";
		$content_style .= 'border-radius: '.$border_radius.';-moz-border-radius: '.$border_radius.';-webkit-border-radius: '.$border_radius.';';
	}
	
	$section_content_typography       = of_get_option("section_content_typography_".$i,'');
	if( $section_content_typography )
	$content_style     .= singlepage_options_typography_font_styles2($section_content_typography );
	
	$cur            = "";
	if( $i==0 )
	$cur  = "cur";
	$sub_nav       .= '<li class="'.$cur.'"><a id="nav-'.$menu_slug.'" href="#'.$menu_slug.'">'.esc_attr($menu_title).'</a></li>';

			if( $section_background_size_ == 'yes'){
				 $background .= '-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;background-size:100% 100%;';
				}
			//if( $content_color  != "" ) $content_color = 'color:'.esc_attr($content_color).';';
      $video_enable = 0;
	  
	  if(  $video_background_section == ($i+1) && !$detect->isMobile() && !$detect->isTablet() ){
		$video_enable = 1;  
		$class       .= " singlepage-video-section";
		$background   = "";
	  }
	  if( $google_map_section == ($i+1) ){
		  
		$class       .= " singlepage-google-map-section";
	    $google_map   = array("google_map_address"=>$google_map_address,"google_map_zoom"=>$google_map_zoom,"google_map_wrap"=>$menu_slug);
	    wp_localize_script( 'singlepage-main', 'singlepage_google_map',$google_map);
		$background   = "";
		  
		  }
	 
	   if( $section_full_width == 1){
		   
		    $output .= '<section class="section '.esc_attr($class).'" style="'.$background.'"  id="'.$menu_slug.'">
	 
			<div class="section-full-content" style="'.$content_style.'">'.do_shortcode( wp_kses( $content , $allowedposttags ) ).'</div>';
		
		if( $image!='' ){
			if( $image_link !='' ){
				$output .= '<a href="'.esc_url($image_link).'"  style=" display:black;" target="'.esc_attr($image_link_target).'"><div class="section-image" style="background-image:url('.esc_url($image).')"></div></a>';
				}else{
	 	        $output .= '<div class="section-image" style="background-image:url('.esc_url($image).')"></div>';
			}
		}
		
		$output .= '<div class="clear"></div></section>';
		   
		   
		   }else{
       $output .= '<section class="section '.esc_attr($class).'" style="'.$background.'"  id="'.$menu_slug.'">
	   <div class="container">
		<div class="section-inner">
			<div class="section-content" style="'.$content_style.'">'.do_shortcode( wp_kses( $content , $allowedposttags ) ).'</div>';
		
		if( $image!='' ){
			if( $image_link !='' ){
				$output .= '<a href="'.esc_url($image_link).'"  style=" display:black;" target="'.esc_attr($image_link_target).'"><div class="section-image" style="background-image:url('.esc_url($image).')"></div></a>';
				}else{
	 	        $output .= '<div class="section-image" style="background-image:url('.esc_url($image).')"></div>';
			}
		}
		
		
		$output .= '</div>
		  <div class="clear"></div>
		</div>
        </section>';
		
	   }
	
	
	  if( $video_enable == 1 ){
		 
		 if( $video_loop == 1 ){
		$video_loop = 'true';
		}
		else{
		$video_loop = 'false';	
			}
	 
	 $background_video  = array("video_loop"=>$video_loop,"mp4_video_url"=>$mp4_video_url,"webm_video_url"=>$webm_video_url,"ogv_video_url"=>$ogv_video_url,'poster_url'=>$poster_url,'video_volume' => $video_volume);
	
	  wp_localize_script( 'singlepage-main', 'singlepage_video',$background_video);
	 }
	 
			
		  }
		}
		?>
         <?php 
		if( $sectionNum > 1 && $menu_style == '1' && $menu_status == 'open' ){
		?>
        <div id="sub_nav" class="sub_nav_style1">
        <div id="sub_nav_<?php echo $section_height_mode;?>" class="sub_nav">
		<ul><?php echo $sub_nav;?></ul>
	</div></div>
        <?php }?>
        <?php if( $sectionNum > 1 && $menu_style == '2' ){
			$hide_sidebar = '';
			if( $menu_status == 'close' )
			$hide_sidebar = 'hide-sidebar';
			?>
        <div id="sub_nav" class="sub_nav_style2">
	<div id="sub_nav_<?php echo $section_height_mode;?>" class="sub_nav <?php echo $hide_sidebar;?>">
     <span id="panel-cog">
			<i class="fa fa-bars"></i>
		</span>
		<ul><?php echo $sub_nav;?></ul>
	</div>
    </div>
     <?php }?>
    <?php
	$featured_homepage_sidebar = of_get_option( 'featured_homepage_sidebar' ,'' );
	if( $featured_homepage_sidebar != '' ){
		echo '<div class="widget"><div class="widget_area">'.do_shortcode( wp_kses( $featured_homepage_sidebar , $allowedposttags ) ).'</div></div>';
		}
      
	 ?>
	<div class="content">
  <?php echo $output;?>
  <div class="clear"></div>
	</div>
<?php
get_footer();