jQuery(document).ready(function() {
	
	if( itekScriptParam.itek_image_link == ''){
		var divheight = jQuery('.header-image').height()+'px';
		jQuery('body').css({ "margin-top": divheight });
	}
		
	jQuery(window).bind('scroll', function(e) {
		header_image_effect();
	});

});  	
    	
function header_image_effect() {
	var scrollPosition = jQuery(window).scrollTop();
	jQuery('#parallax-bg').css('top', (0 - (scrollPosition * .3)) + 'px');
}