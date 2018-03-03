/* Dashboard Widgets Suite - Admin JavaScript */

jQuery(document).ready(function($) {
	
	$('.reset-options').on('click', function(e) {
		e.preventDefault();
		$('.modal-dialog').dialog('destroy');
		var link = this;
		var button_names = {}
		button_names[theme_switcha_settings.reset_true]  = function() { window.location = link.href; }
		button_names[theme_switcha_settings.reset_false] = function() { $(this).dialog('close'); }
		$('<div class="modal-dialog">'+ theme_switcha_settings.reset_message +'</div>').dialog({
			title: theme_switcha_settings.reset_title,
			buttons: button_names,
			modal: true,
			width: 350
		});
	});
	
	$('.theme-screenshot').on('click', function() {
		if ($(this).hasClass('enable-plugin')) {
			$('.theme-screenshot').removeClass('theme-active');
			$(this).addClass('theme-active');
			if ($(this).hasClass('enable-admin')) {
				$(this).append($('.theme-screenshot').find('.theme-admin'));
			}
		}
	});

});
