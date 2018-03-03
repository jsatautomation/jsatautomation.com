<?php // Theme Switcha - Display Settings

if (!defined('ABSPATH')) exit;

function theme_switcha_menu_pages() {
	
	// add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function )
	add_options_page('Theme Switcha', 'Theme Switcha', 'manage_options', 'theme_switcha_settings', 'theme_switcha_display_settings');
	
}

function theme_switcha_display_settings() { ?>
	
	<div class="wrap">
		<h1>
			<span class="fa fa-pad fa-exchange"></span> <?php echo THEME_SWITCHA_NAME; ?> 
			<span class="theme-switcha-version"><?php echo THEME_SWITCHA_VERSION; ?></span>
		</h1>
		<form method="post" action="options.php">
			
			<?php 
				settings_fields('theme_switcha_options');
				do_settings_sections('theme_switcha_options');
				submit_button(); 
			?>
			
		</form>
	</div>
	
<?php }
