/* ------------------------------------------------------------------------ */
/* one page home														*/
/* ------------------------------------------------------------------------ */

(function($) {
		if( $("body#featured-template").length && singlepage_params.section_height_mode == '1' ){
    var e = function() {
	
        var e = 0,
        t = null,
        n = null,
        r = 0,
        i = 0,
        s = 0,
        o = 0,
        u = $(".sub_nav li"),
		l = u.length,
        a = $("html,body"),
        f = $(window);
        f.resize(function(e) {
            s = $(window).height()
        }).resize(),
        f.scroll(function(t) {
            r = $(this).scrollTop()+1,
            r < .3 * s ? e = 0 : r >= s && r < 1.3 * s ? e = 1 : r >= 2 * s && r < 2.3 * s ? e = 2 : r >= 3 * s && r < 3.3 * s ? e = 3 : r >= 4 * s && r < 4.3 * s ? e = 4 : r >= 5 * s && r < 5.3 * s && (e = 5),
            u.removeClass("cur").eq(e).addClass("cur");
        }),
        a.on("mousewheel",
        function(n) {
            o = window.event.detail ? -(window.event.detail || 0) / 3 : window.event.wheelDelta / 120,
            clearTimeout(t),
            t = setTimeout(function() {
                o > 0 && e > 0 ? e--:o < 0 && e < (l-1) && e++,
                a.animate({
                    scrollTop: s * e
                },
                Number(singlepage_params.scrolldelay), "easeInOutQuart")
            },
            300),
            n.preventDefault()
        }),
        u.on("click",
        function(t) {
            i = $(this).index(),
            a.animate({
                scrollTop: s * i
            },
            Number(singlepage_params.scrolldelay), "easeInOutQuart",
            function() {
                e = i
            });
			
        });
		
		
    },
    t = function() {
        var e = $("nav > ul");
      if( e.length ){
		e.find(" > li.current-menu-item, > li.current-menu-parent").addClass("cur");
        var n = $("nav > ul > li.cur").not(".nav_default");
		if( !n.length){
			var n = $("nav > ul > li.nav_default");
			$("nav > ul > li.nav_focus").hide();
			}
		var t = $("nav > ul > li").not(".nav_focus"),
        r = e.find(".nav_focus"),
        i = n.outerWidth(),
        s = n.position().left + 6,
        o = n.index();
        r.stop(!0, !1).animate({
            left: s,
            width: i
        },
        300),
        t.eq(o).addClass("cur").end().on("mouseenter",
        function(e) {
			jQuery("nav > ul > li.nav_focus").show();
            var t = $(this),
            n = t.position().left + 6,
            i = t.outerWidth();
            t.addClass("cur").siblings().removeClass("cur"),
            r.stop(!0, !1).animate({
                left: n,
                width: i
            },
            300)
        }).siblings().removeClass("cur"),
        e.on("mouseleave",
        function(e) {
			if(i===0){
				$("nav > ul > li.nav_focus").hide();
				}
            r.stop(!0, !1).animate({
                left: s,
                width: i
            },
            300),
            t.eq(o).addClass("cur").siblings().removeClass("cur");
			
        });
		}
    };
    t(),
    e()
	}
})(jQuery)

function singlepageClick(o){ 
	var o = document.getElementById(o); 
	if( document.all && typeof( document.all ) == "object" ) //IE 
	{ 
	o.fireEvent("onclick"); 
	} 
	else 
	{ 
	var e = document.createEvent('MouseEvent'); 
	e.initEvent('click',false,false); 
	o.dispatchEvent(e); 
	} 
} 

jQuery(document).ready(function($) {

// onepage nav
$('#featured-template #sub_nav_2 li').each(function(){
     $(this).click(function(){
				singlepageClick($(this).find("a").attr("id"));
			});
	 
	});

$('#featured-template #sub_nav_2').onePageNav({
		changeHash: false,
		filter: "ul li a[href^='#']",
		currentClass:"cur",
		scrollThreshold:0.15,
		scrollSpeed:Number(singlepage_params.scrolldelay)
	});

// section full screen
if(singlepage_params.section_height_mode == '2'){
$("#featured-template section").each(function(){
											  
  $(this).css({'min-height':$(window).height()});						  
											  
  });
}else{

$("#featured-template section").each(function(){
				$(this).css({'height':$(window).height()});
				});
$( window ).resize(function() {
	$("#featured-template section").each(function(){
				$(this).css({'height':$(window).height()});
				});						
   });
}

////
if( $('#wrapper #main').length && $('#wrapper #side').length  ){
	if( $('#wrapper #main').outerHeight() >  $('#wrapper #side').height()  ){
		$('#wrapper #side').height($('#wrapper #main').outerHeight());
	}
	
	}								
/* ------------------------------------------------------------------------ */
/* fixed header															*/
/* ------------------------------------------------------------------------ */
var adminbarHeight = 0;
	if( $("body.admin-bar").length){
		if( $(window).width() < 765) {
				adminbarHeight = 46;
				
			} else {
				adminbarHeight = 32;
			}
	  }
 var headerHeight = $('header.navbar').height();
$('header').affix({offset: {top: headerHeight-adminbarHeight}}); 
$('.navbar').click(function(){	
								 
//	$(".main-menu").toggle();		 
   });
$(".site-nav-toggle").click(function(){
				$(".site-nav").toggle();
			});
/* ------------------------------------------------------------------------ */
/* Preserving aspect ratio for embedded iframes														*/
/* ------------------------------------------------------------------------ */
$('.entry-content embed,.entry-content iframe').each(function(){
										
		var width  = $(this).attr('width');	
		var height = $(this).attr('height');
		if($.isNumeric(width) && $.isNumeric(height)){
			if(width > $(this).width()){
				var new_height = (height/width)*$(this).width();
				$(this).css({'height':new_height});
				}
			
			}				
    });
$('.sub_nav ul li a').click(function(e){
							e.preventDefault();		 
						});

/* ------------------------------------------------------------------------ */
/* home page video background														*/
/* ------------------------------------------------------------------------ */
 if( $('section.singlepage-video-section').length && typeof singlepage_video !== 'undefined' ){
		  var video_loop = true ;
		  if( singlepage_video.video_loop === 'false'){
			  video_loop = false;
			  }
		  
	    var BV;
            var BV = new jQuery.BigVideo({
				useFlashForFirefox:false,
				forceAutoplay:true,
				controls:false,
				doLoop:video_loop,
				container: $(".singlepage-video-section")
			});
			BV.init();
			if (Modernizr.touch) {
				BV.show(singlepage_video.poster_url);
			} else {
				BV.show(
				[
        { type: "video/mp4",  src: singlepage_video.mp4_video_url },
        { type: "video/webm", src: singlepage_video.webm_video_url },
        { type: "video/ogg",  src: singlepage_video.ogv_video_url }
    ],{ambient: video_loop});
	BV.getPlayer().volume( singlepage_video.video_volume );
	BV.getPlayer().on("durationchange",function(){jQuery("#big-video-wrap").fadeIn();});
	
			}
	}
		

/* ------------------------------------------------------------------------ */
/* home page full screen google map													*/
/* ------------------------------------------------------------------------ */
 if( $('section.singlepage-google-map-section').length && typeof singlepage_google_map !== 'undefined' && typeof google !== 'undefined' ){
var geocoder;
var map;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: Number(singlepage_google_map.google_map_zoom),
    center: latlng
  }
  map = new google.maps.Map(document.getElementById(singlepage_google_map.google_map_wrap), mapOptions);
  codeAddress();
  var trafficLayer = new google.maps.TrafficLayer();
  trafficLayer.setMap(map);
}

function codeAddress() {
  var address = singlepage_google_map.google_map_address;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
  
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);


 }
 
  
 /* ------------------------------------------------------------------------ */
/* home page sidebar menu style 											*/
/* ------------------------------------------------------------------------ */
 
 if( $('#sub_nav').length){
	var adminbarHeight = 0;
	if( $("body.admin-bar").length){
		if( $(window).width() < 765) {
				adminbarHeight = 46;
				
			} else {
				adminbarHeight = 32;
			}
	  }
	  var headerHeight = $('header.navbar').height();
	  var marginTop    = headerHeight+adminbarHeight+20;
	  if( $(window).width() > 768) {
		  marginTop    = marginTop + 30;
	  }
	  
	  
$('#sub_nav .sub_nav').css({'top':marginTop});

}

$("#panel-cog").click(function(){
			if($(".sub_nav_style2 .sub_nav").hasClass("hide-sidebar")){
				$(".sub_nav_style2 .sub_nav").removeClass("hide-sidebar");
				//$('#panel-cog i').removeClass('fa-chevron-right').addClass('fa-chevron-left');
				}
				else{
				$(".sub_nav_style2 .sub_nav").addClass("hide-sidebar");	
				//$('#panel-cog i').removeClass('fa-chevron-left').addClass('fa-chevron-right');
					}
       })
 
  /* ------------------------------------------------------------------------ */
/*  smooth scrolling  btn       	  								  	    */
/* ------------------------------------------------------------------------ */

   jQuery("header a[href^='#']").on('click', function(e){
				var selectorHeight = jQuery('header').height();   
				var scrollTop = jQuery(window).scrollTop(); 
				e.preventDefault();
		 		var id = jQuery(this).attr('href');
				if(typeof jQuery(id).offset() !== 'undefined'){
				if( $("#featured-template").length ){
					var goTo = jQuery(id).offset().top;
					}else{
				    var goTo = jQuery(id).offset().top - selectorHeight;
				}
				jQuery("html, body").animate({ scrollTop: goTo }, 1000);
				}

 });	
  
  

 });
