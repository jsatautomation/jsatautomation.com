=== Theme Switcha ===

Plugin Name: Theme Switcha
Plugin URI: https://perishablepress.com/theme-switcha/
Description: Theme switching done right.
Tags: theme, switch, switcher, preview, demo,  development, admin, themes, plugin, testing, template, maintenance, theme development
Author: Jeff Starr
Contributors: specialk
Author URI: https://plugin-planet.com/
Donate link: https://m0n.co/donate
Requires at least: 4.1
Tested up to: 4.9
Stable tag: 1.5
Version: 1.5
Requires PHP: 5.2
Text Domain: theme-switcha
Domain Path: /languages
License: GPL v3 or later

Theme switching done right.



== Description ==

> Switch to an alternate theme for preview or development while visitors use the default theme :)

**Brand new plugin with all-new shiny code fresh from the WP API!**

There are many theme-switch plugins but none of them provide the simplicity, performance, and reliability that I require for my own sites. So I wrote my own plugin using the WP API and kept the plugin as focused and solid as possible. Only essential theme-switching features have been added, along with a simple yet informative UI. This gives you a consistent, quality theme-switching experience that you can optionally share with your visitors.

**Plugin Features**

* Develop new themes while visitors use the default theme
* Control who can switch themes (admins, w/ passkey, or everyone)
* Administrators can switch themes directly via the WP Admin Area
* Enable visitors to switch and preview themes on the front-end
* Each visitor can choose their own theme
* Send preview links to clients via the passkey
* Choose your own custom passkey code for preview links
* Set the duration (cookie timeout) for switched themes
* Enable/disable theme preview in the Admin Area
* Enable/disable all theme switching without deactivating the plugin
* Provides several shortcodes to enable visitors to switch themes
* Shortcodes display themes as a list, select menu, or thumbnails
* Changed options are saved when working on switched themes
* Simple, stylish UI featuring screenshots of each theme
* Works with any theme, parent themes and child themes
* Works with WP Multisite

Theme Switcha makes it easy for the site admin to preview and develop new themes without changing the default theme. So visitors will continue to use your site normally without ever knowing that you are testing new themes behind the scenes. And if you want to enable your visitors to switch themes, you can do that as well by adding a shortcode to any WP Post or Page. Then each visitor will be able to select and preview any of your WordPress themes.



**Core Features**

* Easy to use
* Squeaky clean code
* Simple and focused
* Built with the WordPress API
* Lightweight, fast and flexible
* Focused on performance and security
* Works great with other WordPress plugins
* Plugin options configurable via settings screen
* Plugin cleans up after itself upon uninstall
* One-click restore plugin default options



The Theme Switcha plugin is useful for things like:

* __Maintenance mode__ - display a temporary theme to visitors while you update your primary theme
* __Theme test drive__ - preview and test new themes without disrupting anything on the frontend
* __Theme development__ - perfect for developing new themes to fit your existing site content
* __Client presentations__ - send clients special "theme preview" links to show off new templates

The beauty of Theme Switcha is that it's all 100% transparent: visitors will never know that you are hard at work testing and building new themes behind the scenes.

Plus you get free, responsive support from one the world's top WordPress developers ;)



== Screenshots ==

1. Plugin Settings Screen (showing default options)



== Installation ==

**Installing the plugin**

1. Upload the plugin to your blog and activate
2. Configure the plugin settings as desired
3. Enable theme switching via settings or shortcode

[More info on installing WP plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins)



**Configuration**

The Theme Switcha plugin provides three basic configurations:

* __Admins only__ - useful for theme developers to work on themes on a live site
* __Passkey only__ - useful for sending clients preview links to new templates
* __Everyone__ - allow everyone to switch themes (required for shortcodes)

Note: it's a good idea to change the Passkey periodically to prevent access to alternate themes (only required when using "Passkey only" configuration).

Visit the Theme Switcha settings page for more options.



**Important**

It is important to understand that all theme switching (viewing themes privately) must happen via the plugin settings page (or shortcode). There you can select which theme you want to view privately, without affecting anything with the default (active) WP theme. 

So if you want to use the Theme Customizer on a theme-switcha-enabled theme, you can experiment and preview all you want, but __DO NOT__ click the "Save & Publish" button while in the Theme Customizer. If you do, your theme-switcha-enabled theme will be activated as the default (live) theme, and will be visible to all site visitors. 

It's important to understand this in order to prevent accidental activation of the theme you are working on privately. Best advice is to stay away from the Theme Customizer for switched themes unless you understand the implications. Again, it's fine to preview options via the Theme Customizer, but do not click "Save & Publish" unless you want the theme to go live for all visitors.



**Usage**

Basically install, activate, and visit the Theme Switcha settings page. There you can configure your options and select any theme to preview. Then if you also want to provide a list of your themes on the front-end, you can add any of these shortcodes to any WP Post, Page, or widget:

	Display themes as list of links:
	[theme_switcha_list display="list"]
	// display = (list or flat) format of the list
	
	Display themes as thumbnail links:
	[theme_switcha_thumbs style="true"]
	// style = (true or false) include default CSS
	
	Display themes in select/dropdown menu:
	[theme_switcha_select text="Choose a theme.."]
	// text = for the default option

These shortcodes can be included in any WP Post, Page, or supportive widget (e.g., the default "Text" widget that's included with WordPress).

If you would rather include the theme lists via your theme, you can use any of these template tags:

	<?php if (function_exists('theme_switcha_display_list'))     theme_switcha_display_list(); ?>
	<?php if (function_exists('theme_switcha_display_thumbs'))   theme_switcha_display_thumbs(); ?>
	<?php if (function_exists('theme_switcha_display_dropdown')) theme_switcha_display_dropdown(); ?>

Alternately you can call the shortcodes in your theme template using [do_shortcode](https://developer.wordpress.org/reference/functions/do_shortcode/).

If the plugin settings are configured to allow everyone to switch themes, you can create your own theme-switch links as follows:

1. Determine the theme slug (typically the same as the name of the theme directory)
2. Append `?theme=mytheme` to any permalink URL

For example, if you have a theme named "My Awesome Theme" that is located in a directory named `/my-awesome-theme/`, you would create a theme-switch URL like so:

`http://example.com/?theme=my-awesome-theme`

This URL can then be used to craft a custom link, for example:

`<a href="http://example.com/?theme=my-awesome-theme">Switch to My Awesome Theme</a>`

If the plugin settings are configured to allow passkey theme-switching, you can create a passkey link for any theme by following the previous steps and then appending the Passkey to the URL. You can find the Passkey in the plugin settings. Here is an example:

`http://example.com/?theme=my-awesome-theme&passkey=1234567890`

Tip: to grab a passkey link for any theme:

1. Visit the Theme Switcha settings page
2. Right-click on any thumbnail image
3. Select "Copy link address" to copy the URL to your clipboard

Passkey links are a great way to enable sharing of themes without giving the user access to the WP Admin Area.



**How It Works**

If you're still scratching your head at this point, here are some points that may help to clarify how theme-switching works:

* Your site always will have a default active theme
* The primary theme always will be visible to regular visitors
* If you enable Theme Switcha, you can privately view other themes
* So you can switch to a theme that only is active for YOU only
* You can also enable visitors to switch themes on the front-end
* You can even send a private theme-switch URL to friends, etc.

So while you re viewing and working on a switched theme, all other users will continue to see/use the default active theme. When you are done working on your switched theme, you can disable theme switching via the plugin settings. Upon doing so, you will be viewing the default theme like everyone else.

Also keep in mind that theme-switching is browser-specific (via cookies). So if you need to view the theme in multiple browsers, the easiest way is to use the passkey link. The passkey enables you to quickly switch themes by simply entering the URL in your browser's address bar. See the next section for details.



**Switching via Passkey**

Theme Switcha makes it possible to create passkey links that enable users to switch themes. Here are some notes about this feature:

* Passkey links work for logged-in users and logged-out users
* Passkey links must include the theme name and valid passkey
* The theme name must be the theme slug (e.g., "my-theme" not "My Theme")
* Here is an example of proper passkey format:

	http://example.com/?theme=THEMESLUG&passkey=PASSKEY

Here you would replace "THEMESLUG" with the slug of the theme you want to preview, and "PASSKEY" with the current passkey (provided via the "Passkey" setting). 

To use a passkey link, follow these steps:

1. Enable theme switching via the setting "Enable Switching" (save changes).
2. If the passkey will be used by non-logged-in user(s), change the setting "Allowed Users" to either "Only with Passkey" or "Everyone".
3. From the theme thumbnails that are displayed, right-click on any theme and select "Copy Link Address" (or similar, depending on browser).
4. You now have the theme's passkey URL copied to your clipboard, so you can share it or create a link like so:

	<a href="http://example.com/?theme=THEMESLUG&passkey=PASSKEY">Switch Theme!</a>

Note also that the front-end theme-switch shortcodes depend on the "Allowed Users" setting, so make sure to set the option according to who will be switching themes.



**Going Live**

Here are the steps to "go live" with your switched theme once you are ready to do so:

1. Visit the plugin settings and disable the option "Enable Switching".
2. Visit Appearance &gt; Themes to activate the theme for the world to see.

After these steps, the active theme will be visible to you and everyone else.



**Settings**

For most themes written according to the WP API, all theme settings should be saved in the WP database. This means that when you are working on a switched theme, any changes that you make to the theme settings will remain effective even after disabling the plugin. So when it's time to go live, the settings will be exactly as specified during theme switching. 

Some themes, however, sort of go "off the rails" with how they manage/save their settings, in ways that aren't compatible with the WP API. Thus, not all themes are going to "remember" changes made to settings while previewed via Theme Switcha. Until a permanent solution is found, the best workaround for this is to simply backup or make note of any theme settings, and then re-apply them after the theme is officially active (i.e., activated via Appearance &gt; Themes).



**Widgets**

Unlike theme settings, which in most cases are retained after switching, widgets are a whole other story. When working on a switched theme (i.e., a theme that is active via Theme Switcha plugin), you can play with widgets and try them out, etc., but they will not be saved with the theme. So when theme switching is disabled, widgets will be forgotten.

To workaround this limitation, it is best to use the WP Theme Customizer to preview and configure widgets as desired, and then save changes and publish the theme directly from there. That way you can preview widgets and save them to the final published theme. Alternately, you can use a plugin such as [Widget Settings Importer/Exporter](https://wordpress.org/plugins/widget-settings-importexport/) to export all widget settings of your switched theme, and then import them once the theme is live on the site.

Note that widgets are the only thing that this applies to; everything else (e.g., template tags, CSS, JavaScript, settings, content, et al) works normally for themes enabled via Theme Switcha.



**Excluding Themes**

To exclude a theme from theme switching, open the theme's `style.css` file and add `Status: private` or `Status: unpublished` to the file header. Or, to exclude a theme only for visitors, add `Status: admin-only` to the file header. 

Here is a summary:

	Status: private     = theme excluded from theme switching
	Status: unpublished = theme excluded from theme switching
	Status: admin-only  = theme available for switching only by admin-level users
	Status: publish     = theme available for switching by all users (depending on settings)
	No Status header    = theme available for switching by all users (depending on settings)

You can remove the Status file header at any time to make the theme available for theme switching.



**Troubleshooting**

If theme-switching isn't working for you, here are some things to check:

* Make sure you have more than one theme installed
* Make sure there are no .htaccess rules interfering
* Make sure only one theme-switching plugin is enabled
* Make sure `WP_DEFAULT_THEME` not defined in `wp-config.php`
* Make sure your theme is using the WP API for settings, etc.
* Try using a different browser and/or clearing your cache and cookies

Those are the main things to check. If theme-switching still isn't working for your site, most likely something is interfering with normal functionality. In that case, you can do some basic [troubleshooting](https://perishablepress.com/how-to-troubleshoot-wordpress/) to identify the culprit.



**Uninstalling**

This plugin cleans up after itself. All plugin settings will be removed from your database when the plugin is uninstalled via the Plugins screen.



== Upgrade Notice ==

To upgrade this plugin, remove the old version and replace with the new version. Or just click "Update" from the Plugins screen and let WordPress do it for you automatically.

Note: uninstalling the plugin from the WP Plugins screen results in the removal of all settings and data from the WP database. 



== Credit ==

Thanks to [Ryan Boren](http://boren.nu/) for the original [Theme Switcher](https://plugins.trac.wordpress.org/wiki/ThemeSwitcher) plugin.



== Frequently Asked Questions ==

**Does the plugin enable anyone to switch themes (and not just logged in users)?**

Yes, just set the "Allowed Users" option to "Everyone", and then add any shortcode to your page.


**I click the links but the theme does not switch?**

It could be because of a caching plugin, or if you are trying to switch themes while logged out of WP, it could be that the setting "Allowed Users" is not set to "Everyone".


**How do exclude themes from theme switching?**

Open the theme's `style.css` file and add `Status: private` or `Status: unpublished` to the file header.


**Does this plugin support Multisite?**

It should work fine with Multisite, but it hasn't been officially tested yet.


**I am having problems with white screens or other errors?**

Two things: 1) deactivate the plugin or remove via FTP, and 2) [report the issue](https://perishablepress.com/contact/) so I can investigate and try to fix any bugs.


**How is the CSS included for the front-end shortcodes?**

For better performance, the styles are included inline. The styles for each shortcode are minimal, so it's faster to include them inline via style tags rather than chewing up another HTTP request. If you are concerned for whatever reason, you can use disable the styles in the `[theme_switcha_thumbs]` shortcode, like so: `[theme_switcha_thumbs style="false"]`. That way the styles won't be included and you can add your own however desired.


**Do I need to activate my alternate theme via Appearance &gt; Themes?**

Short answer: "no", stay away from the Appearance &gt; Themes screen while switching themes. Long answer: whenever you activate a theme via the Appearance &gt; Themes screen in the WP Admin Area, that theme will be the one that is publicly displayed (live). That's why, with Theme Switcha, you don't make any changes via the Themes screen; rather, you just visit the plugin settings and click on whichever theme you want to view privately. Complete instructions are available [here](https://wordpress.org/plugins/theme-switcha/installation/) and in the plugin's readme.txt.


**Theme settings are not saved after theme switching is disabled?**

As explained in the "Settings" section [in the plugin docs](https://wordpress.org/plugins/theme-switcha/installation/), some themes may not save changes made to settings while previewing via Theme Switcha. Some themes that user their own "visual" tools for theme settings may be doing stuff behind the scenes with Ajax or whatever that is outside of the WP API. The Theme Switcher plugin is tightly integrated with WordPress, so any themes that stray too far outside of that are sort of on their own. My recommendation for any themes that provide their own custom visual options/builders is to activate the theme via Appearance &gt; Themes. Then once the theme is "live", make any settings changes directly. This will help ensure that the settings are saved to the database and nothing unexpected happens. 


**Widgets are not saved after theme switching is disable?**

As explained in the "Widgets" section [in the plugin docs](https://wordpress.org/plugins/theme-switcha/installation/), widgets are not "remembered" for switched themes. You can read that section in the docs to learn more and get some workarounds, etc.


**When I switch themes, will it apply to all admins or just me?**

Great question. Theme-switching uses cookies to work, so it is browser-specific. That basically means that only the person who switched the theme will be able to view it. There currently is no option to switch themes for multiple users (e.g., based on user role).


**How can I let visitors choose their own theme?**

You can use any of the front-end shortcodes to enable visitors to select any available theme. It's also possible to exclude themes from switching. Visit the [plugin docs](https://wordpress.org/plugins/theme-switcha/installation/) for more information (under "Usage" and "Excluding Themes", respectively).


**When switching themes, will visitors still be able to see content from the database?**

Yes, the same database/content will be displayed regardless of which theme is enabled or switched. The WP database provides the content for ALL themes.


**How can I test demo content (like posts and pages) while switching themes?**

Just make sure that all of the demo content is added as "Draft" or "Pending" instead of "Published". Then only logged-in users with proper capabilities will be able to see it.


**I still don't get it.. how do I switch themes?**

Here are the steps to use the plugin: __1)__ Visit the plugin settings and enable the setting, “Enable Switching”. __2)__ Under “Available Themes”, you will see all themes that are available for switching; click one to enable it only for you (admin). Whichever theme you enable via the plugin settings will be available to you only, so you can work on the theme while regular visitors see whichever theme is activated under the Appearance menu. Note that changes made to the switched theme will be visible only by you and other admins. Changes made to content (like post content, page content, categories, tags, et al), on the other hand, are affect all themes and will be visible to your regular visitors.


**If I want to permanently switch themes then I have to do it in the theme portion of the site and not the plugin. Right?**

Correct. The Theme Switcha only applies to the admin user. To actually switch themes do it via the Plugins screen.


**I am assuming the switches made in your plugin takes effect for the world to see once the switch is made permanently. Right?**

Yes for anything related to the theme template. Most themes also will remember any changes made to Menus and Widgets and so forth, but some themes use their own weird code and do not remember these values. But yeah, any changes made to your theme files will be remembered when the theme goes live; that's the whole point.


**Got a question?**

Send any questions or feedback via my [contact form](https://perishablepress.com/contact/)



== Support development of this plugin ==

I develop and maintain this free plugin with love for the WordPress community. To show support, you can [make a cash donation](https://m0n.co/donate), [bitcoin donation](https://m0n.co/bitcoin), or purchase one of my books: 

* [The Tao of WordPress](https://wp-tao.com/)
* [Digging into WordPress](https://digwp.com/)
* [.htaccess made easy](https://htaccessbook.com/)
* [WordPress Themes In Depth](https://wp-tao.com/wordpress-themes-book/)

And/or purchase one of my premium WordPress plugins:

* [BBQ Pro](https://plugin-planet.com/bbq-pro/) - Pro version of Block Bad Queries
* [Blackhole Pro](https://plugin-planet.com/blackhole-pro/) - Pro version of Blackhole for Bad Bots
* [SES Pro](https://plugin-planet.com/ses-pro/) - Super-simple &amp; flexible email signup forms
* [USP Pro](https://plugin-planet.com/usp-pro/) - Pro version of User Submitted Posts

Links, tweets and likes also appreciated. Thanks! :)



== Changelog ==

**1.5 (2017/10/28)**

* Adds blurb for WP Themes In Depth! :)
* Adds new default translation template
* Tests on WordPress 4.9

**1.4 (2017/08/01)**

* Updates GPL license blurb
* Adds GPL license text file
* Tests on WordPress 4.9 (alpha)

**1.3 (2017/03/26)**

* Fixes not isset notice
* Adds link to plugin docs
* Adds some missing global variables
* Tweaks styles of plugin settings page
* Changes so themes are displayed only when switching is enabled
* Fixes bug when two theme lists are displayed on the same page
* Improves documentation on plugin usage
* Fixes some incorrect translation domains
* Replaces global `$wp_version` with `get_bloginfo('version')`
* Generates new default translation template
* Tests on WordPress version 4.8

**1.2 (2016/11/18)**

* Adds rate this plugin link to settings page
* Adds `&raquo;` to rate this plugin link on plugins screen
* Removes default styles for abbr tag from settings page
* Cookies now sent with "HTTP Only" flag (security enhancement)
* Regenerated default translation template
* Tests on WordPress version 4.7 (beta)

**1.1 (2016/09/29)**

* Fixes bug: "can't use method return value in write context"
* Tests on WordPress 4.7 (alpha)

**1.0 (2016/09/22)**

* Initial release


